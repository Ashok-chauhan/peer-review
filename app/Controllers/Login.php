<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;

/**
 * Description of Login
 *
 * @author Ashok
 */
class Login extends Controller
{
    public $loginModel;
    public $session;
    public function __construct()
    {
        helper('form');
        $this->session = session();
        $this->loginModel = new LoginModel();
    }
    public function index()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required',
            ];
            if ($this->validate($rules)) {
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $userdata = $this->loginModel->verifyEmail($email);
                $roles = $this->loginModel->getRole($userdata['userID']);

                if ($userdata) {
                    if (password_verify($password, $userdata['password'])) {
                        if ($userdata['status'] == 'active') {
                            $fullname = $userdata['title'] . ' ' . $userdata['username'] . ' ' . $userdata['middle_name'] . ' ' . $userdata['last_name'];
                            $this->session->set('logged_user', $userdata['email']);
                            $this->session->set('userID', $userdata['userID']);
                            $this->session->set('role', $userdata['roleID']);
                            $this->session->set('roles', $roles);
                            $this->session->set('title', $userdata['title']);
                            $this->session->set('username', $userdata['username']);
                            $this->session->set('middle_name', $userdata['middle_name']);
                            $this->session->set('last_name', $userdata['last_name']);
                            $this->session->set('fullName', $fullname);


                        } else {
                            $this->session->setTempdata('error', 'Please activate your account. Contact Admin', 3);
                            return redirect()->to(current_url());
                        }
                    } else {
                        $this->session->setTempdata('error', 'Invalid credential!', 3);
                        return redirect()->to(current_url());
                    }
                } else {
                    $this->session->setTempdata('error', 'Sorry! Email does not exists', 3);
                }
                return redirect()->to(current_url());
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('login_view', $data);
    }


}
