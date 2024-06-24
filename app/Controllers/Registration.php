<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RegistrationModel;

/**
 * Description of Register
 *
 * @author Ashok
 */
class Registration extends Controller
{
    public $registrationModel;
    public $session;
    public $email;
    public function __construct()
    {
        helper('form');
        $this->registrationModel = new RegistrationModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
    }
    public function index()
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

            ];
            if ($this->validate($rules)) {
                $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
                $roles = [];
                $roles[] = $this->request->getVar('roleID');
                if ($this->request->getVar('contact')) {
                    $roles[] = 4; //Peer role
                }


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
                    'data_consent' => $this->request->getVar('data_consent', FILTER_SANITIZE_STRING),
                    'notification' => $this->request->getVar('notification', FILTER_SANITIZE_STRING),
                    'contact' => $this->request->getVar('contact', FILTER_SANITIZE_STRING),
                    'interests' => serialize($this->request->getVar('interests')),
                    'roleID' => $roles[0], //$this->request->getVar('roleID'),
                ];

                $insertID = $this->registrationModel->createUsers($userdata);
                if ($insertID) {
                    foreach ($roles as $role) {
                        $roleData = [
                            'user_id' => $insertID,
                            'role_id' => $role,
                        ];
                        $this->registrationModel->userRoles($roleData);
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
                    //$this->email->setFrom('support@orthotvprime.com', 'Info');
                    $this->email->setSubject($subject);
                    $body = view('activation_email', $mailData);
                    $this->email->setMessage($body);
                    $sent = $this->email->send();
                    $this->session->setTempdata("success", "Account created successfully, Please activate your account.", 3);
                    return redirect()->to('registration/thankyou');
                } else {
                    //send error.
                    $this->session->setTempdata("error", "Sorry! Unable to crate an account, try again", 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view("registration", $data);
        //echo "Registration";
    }
    public function activate($uniid = null)
    {
        $data = [];


        if (isset($uniid)) {
            // return view('activation', $data);
            $userData = $this->registrationModel->verifyUniid($uniid);
            if ($userData) {
                if ($userData->status == 'inactive') {
                    $status = $this->registrationModel->updateStatus($uniid);
                    if ($status == true) {
                        $data['success'] = 'Your account has been successfully verified. Now you can submit your articles.';
                        //send credential email.
                        $cred = [];
                        $cred['email'] = $userData->email;
                        $cred['link'] = base_url();
                        $to = $userData->email;
                        $subject = 'Your login activated';
                        $config['mailtype'] = 'html';
                        $this->email->setTo($to);
                        //$this->email->setFrom('support@orthotvprime.com', 'Info');
                        $this->email->setSubject($subject);
                        $credBody = view('user_cred_email', $cred);
                        $this->email->setMessage($credBody);
                        $this->email->send();

                        // if (!$this->email->send()) {
                        //     $data['error'] = 'Sorry!, we are unable to find your account';
                        // }
                    } else {
                        $data['error'] = 'Sorry!, we are unable to find your account';
                    }
                } else {
                    $data['success'] = 'Your account is alredy activated';
                }
            } else {
                $data['error'] = 'Sorry!, we are unable to find your account';
            }
        }

        //        else{
        //         $data['error'] = 'Sorry!, unable to process your request';
        //        }

        return view('activation', $data);
    }

    public function thankyou()
    {
        return view('thankyou');
    }
}
