<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\RegistrationModel;


/**
 * Description of Admin
 *
 * @author Ashok
 */
class Admin extends BaseController
{
    public $registrationModel;
    public $adminModel;
    public $session;
    public $email;

    public function __construct()
    {
        helper(['url', 'form', 'role']);
        $this->adminModel = new AdminModel();
        $this->registrationModel = new RegistrationModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        // if (session()->get('role') != 1) {
        //     print session()->get('role');
        //     die('Access denied');
        // }

        if (session()->get('role') == 1) {
        } elseif (isset($_GET['r'])) {
            session()->set('role', base64_decode($_GET['r']));
        } elseif (session()->get('role') != 1) {
            session_destroy();
            die('Access denied');
        }
        session()->remove('roles'); //multiple role
    }

    public function index()
    {
        if ($this->request->getMethod() == 'post') {
            $usrid = $this->request->getVar('userid');
            $role = $this->request->getVar('roleID');
            $status = $this->request->getVar('status');
            $this->adminModel->updateUser($usrid, $role, $status);
            /// $this->adminModel->updateUserRoles($usrid, $role);
            $jid = $this->request->getVar('jid');
            $editor_id = $this->request->getVar('editor_id');
            if ($jid) {
                $this->adminModel->updateJournal($jid, $editor_id);
            }
        }
        $data = [];
        $users = $this->adminModel->getUsers();
        foreach ($users as $user) {
            $uroles = $this->adminModel->rolesbyUserId($user->userID);
            $user->userRoles = $uroles;
        }

        $data['users'] = $users;
        $data['editors'] = $this->adminModel->getEditors();
        $journals = $this->adminModel->getJournal();
        $data['submissions'] = $this->adminModel->getAllSubmission();
        if ($journals) {
            foreach ($journals as $journal) {
                $data['selected'][$journal->id] = $journal->editor_id;
                $data['journals'][$journal->id] = $journal->journal_name;
            }
        }


        return view('admin/index', $data);
    }

    public function registration()
    {
        $data = [];
        $data['validation'] = null;
        $data['journals'] = $this->registrationModel->getJournal();

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'username' => 'required',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required',
                'cpass' => 'required|matches[password]',
                'phone' => 'required|exact_length[10]|numeric',
                'country' => 'required',
                'roles' => 'required',

            ];
            if ($this->validate($rules)) {
                $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));

                $roles = $this->request->getVar('roles');



                $userdata = [
                    'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                    'username' => $this->request->getVar('username', FILTER_SANITIZE_STRING),
                    'middle_name' => $this->request->getVar('middle_name', FILTER_SANITIZE_STRING),
                    'last_name' => $this->request->getVar('last_name', FILTER_SANITIZE_STRING),
                    'email' => $this->request->getVar('email'),
                    'phone' => $this->request->getVar('phone'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'uniid' => $uniid,
                    'activation_date' => date("Y-m-d h:i:s"),
                    'country' => $this->request->getVar('country', FILTER_SANITIZE_STRING),
                    'interests' => serialize($this->request->getVar('interests')),
                    'roleID' => $roles[0],
                ];

                $insertID = $this->adminModel->createUsers($userdata);

                if ($insertID) {
                    foreach ($roles as $role) {
                        $roleData = [
                            'user_id' => $insertID,
                            'role_id' => $role,
                        ];
                        $this->adminModel->userRoles($roleData);
                    }

                    //inserting into journal_peer table for multiple journal
                    if ($this->request->getVar('interests')) {
                        foreach ($this->request->getVar('interests') as $jid) {
                            $journalData = [
                                'pid' => $insertID,
                                'jid' => $jid,
                            ];
                            $this->registrationModel->journalPeer($journalData);
                        }
                    }
                }

                //if ($this->registrationModel->createUsers($userdata)) {
                if ($insertID) {
                    //send activation email. 
                    $mailData = [];
                    $mailData['title'] = $this->request->getVar('title');
                    $mailData['name'] = $this->request->getVar('username');
                    $mailData['last_name'] = $this->request->getVar('last_name');
                    $mailData['link'] = base_url() . 'activate/' . $uniid;
                    $to = $this->request->getVar('email');
                    $subject = 'Verify Your Scripture Account';
                    $this->email->setMailType('html');
                    $this->email->setTo($to);
                    $this->email->setSubject($subject);
                    $body = view('activation_email', $mailData);
                    $this->email->setMessage($body);
                    $sent = $this->email->send();
                    $session = session();
                    $session->setFlashdata("success", "Account created successfully, Account activation email sent.", 3);
                    return redirect()->to('admin');
                } else {
                    //send error.
                    $session = session();
                    $session->setFlashdata("error", "Sorry! Unable to crate an account, try again", 3);
                    return redirect()->to('admin/registration');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/registration', $data);

    }

    function useredit()
    {
        if ($this->request->getMethod() == 'post') {

            $data = [
                'title' => $this->request->getVar('title'),
                'username' => $this->request->getVar('username'),
                'middle_name' => $this->request->getVar('middle_name'),
                'last_name' => $this->request->getVar('last_name'),
                'roleID' => $this->request->getVar('roleID'),
                'email' => $this->request->getVar('email'),
                'phone' => $this->request->getVar('phone'),
                'country' => $this->request->getVar('country'),
                'status' => ($this->request->getVar('status')) ? 'active' : 'inactive',
            ];
            $userid = $this->request->getVar('userid');
            $roles = $this->request->getVar('roles');
            $roleUpdate = $this->adminModel->updateUserRoles($userid, $roles);
            $user = $this->adminModel->useredit($userid, $data);

            if ($user || $roleUpdate) {
                $session = session();
                $session->setFlashdata('success', 'User has been updated successfully!');
                return redirect()->to('admin');
            } else {
                $session = session();
                $session->setFlashdata('warning', 'No updates!');
                return redirect()->to('admin');
            }

        } else {
            $uri = $this->request->getUri();
            $userid = $uri->getSegment(3);
            $data = [];
            $user = $this->adminModel->getUser($userid);
            $roles = $this->adminModel->rolesbyUserId($userid);
            $data['user'] = $user;

            $data['roles'] = ($roles) ? $roles : [];

            return view('admin/useredit', $data);
        }

    }

    function addJournal()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $file = $this->request->getFile('icon');
            $jname = $this->request->getVar('journal_name');
            $data['journal_name'] = $jname;
            $data['status'] = 1;
            if (!$file->hasMoved()) {
                $newName = time() . '_' . $file->getClientName();
                //if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                if ($file->move(ROOTPATH . 'public/assets/images/icon/', $newName)) {
                    $data['icon'] = $newName;
                }
            }

            $j = $this->adminModel->addJournal($data);
            if ($j) {
                $session = session();
                $session->setFlashdata('success', 'Journal added successfully!');
                return redirect()->to('admin');
            }


        }

        return view('admin/addJournal', $data);
    }

    function journal()
    {
        $data = [];
        $journals = $this->adminModel->getJournal();
        $data['journals'] = $journals;
        return view('admin/journal', $data);
    }

    function editJournal()
    {
        $data = [];
        $uri = $this->request->getUri();
        $jid = $uri->getSegment(3);

        if ($this->request->getMethod() == 'post') {

            $jname = $this->request->getVar('journal_name');
            $jid = $this->request->getVar('jid');
            $status = $this->request->getVar('status');

            $data['journal_name'] = $jname;
            $data['status'] = $status;


            if (!empty($_FILES['icon']['name'])) {
                $file = $this->request->getFile('icon');
                if (!$file->hasMoved()) {
                    $newName = time() . '_' . $file->getClientName();
                    if ($file->move(ROOTPATH . 'public/assets/images/icon/', $newName)) {
                        $data['icon'] = $newName;
                    }
                }
            }

            $j = $this->adminModel->updateJournalById($jid, $data);
            if ($j) {
                $session = session();
                $session->setFlashdata('success', 'Journal Updated successfully!');
                return redirect()->to('admin/journal');
            }


        }

        $journal = $this->adminModel->journalById($jid);
        $data['journal'] = $journal;
        return view('admin/editJournal', $data);

    }

    function sbubmissions()
    {
        $data = [];
        $uri = $this->request->getUri();
        $jid = $uri->getSegment(3);
        $submissions = $this->adminModel->getSubmissionByJid($jid);
        return view('admin/submissions', $data);
    }

    function journalDetails()
    {
        $data = [];

        $uri = $this->request->getUri();
        $jid = $uri->getSegment(3);
        $journal = $this->adminModel->journalById($jid);
        $allEditors = $this->adminModel->editorsList();
        $editors = $this->adminModel->getJournalEditorByid($jid);
        if ($editors) {
            $data['editors'] = $editors;
        } else {
            $data['editors'] = '';
        }

        $data['journal'] = $journal;

        $eids = [];
        if ($editors) {
            foreach ($editors as $editor) {
                $eids[] = $editor->userID;
            }
        }
        $editorList = [];
        foreach ($allEditors as $editor) {
            if (!in_array($editor->userID, $eids)) {
                $editorList[] = $editor;
            }
        }
        $data['allEditors'] = $editorList;
        return view('admin/journaldetails', $data);

    }
    function assigneditor()
    {
        if ($this->request->getMethod('post')) {
            if ($this->request->getVar('eid')) {
                $data = [
                    'jid' => $this->request->getVar('jid'),
                    'eid' => $this->request->getVar('eid'),
                ];
                $id = $this->adminModel->assigneditor($data);
                if ($id) {
                    $session = session();
                    $session->setFlashdata('success', 'Editor assigned successfully!');
                    return redirect()->to('admin/journalDetails/' . $this->request->getVar('jid'));
                } else {
                    $session = session();
                    $session->setFlashdata('error', 'Something happens wrong , try again later!');
                    return redirect()->to('admin/journalDetails/' . $this->request->getVar('jid'));
                }

            } else {
                $session = session();
                $session->setFlashdata('error', 'Something happens wrong , try again later!');
                return redirect()->to('admin/journalDetails/' . $this->request->getVar('jid'));
            }
        }
    }

    function revoke()
    {
        if ($this->request->getMethod('post')) {

            $this->adminModel->revoke($this->request->getVar('jid'), $this->request->getVar('eid'));
            $session = session();
            $session->setFlashdata('success', 'Editor access removed.!');
            return redirect()->to('admin/journalDetails/' . $this->request->getVar('jid'));

        }
    }
}
