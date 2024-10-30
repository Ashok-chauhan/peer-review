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
        if (session()->get('role') != 1) {
            print session()->get('role');
            die('Access denied');
        }
    }

    public function index()
    {
        if ($this->request->getMethod() == 'post') {
            $usrid = $this->request->getVar('userid');
            $role = $this->request->getVar('roleID');
            $status = $this->request->getVar('status');
            $this->adminModel->updateUser($usrid, $role, $status);
            $this->adminModel->updateUserRoles($usrid, $role);
            $jid = $this->request->getVar('jid');
            $editor_id = $this->request->getVar('editor_id');
            if ($jid) {
                $this->adminModel->updateJournal($jid, $editor_id);
            }
        }
        $data = [];
        $data['users'] = $this->adminModel->getUsers();
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
                    foreach ($this->request->getVar('interests') as $jid) {
                        $journalData = [
                            'pid' => $insertID,
                            'jid' => $jid,
                        ];
                        $this->registrationModel->journalPeer($journalData);
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
                    $this->session->setTempdata("success", "Account created successfully, Account activation email sent.", 3);
                    // return redirect()->to('registration/thankyou');
                } else {
                    //send error.
                    $this->session->setTempdata("error", "Sorry! Unable to crate an account, try again", 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/registration', $data);
    }
}
