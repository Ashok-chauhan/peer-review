<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;

/**
 * Description of Admin
 *
 * @author Ashok
 */
class User extends BaseController
{

    public $userModel;
    public $session;
    public $email;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
    }

    public function resetpass()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $user = $this->userModel->getUserBymail($this->request->getVar('email'));
            if (!$user) {

                $this->session->setTempdata('error', 'Sorry! Email does not exists', 3);
                return view('user/resetpass', $data);
            }
            $ftime = time() + (10 * 60);
            $data['name'] = $user->title . ' ' . $user->username . ' ' . $user->middle_name . ' ' . $user->last_name;
            $data['link'] = base_url() . '/user/resetlink/' . $user->uniid . '/' . $ftime;
            $subject = 'Password Reset for Scripture';
            $subject = $subject;
            $this->email->setMailType('html');
            $this->email->setTo($user->email);
            $this->email->setSubject($subject);
            $body =  view('user/resetpass_email', $data);
            $this->email->setMessage($body);
            $sent = $this->email->send();
            $sent = $this->email->send();
            if ($sent) {
                //die('get here' . $sent);
                return redirect()->to('user/resetfeedback');
            } else {
                //die('false' . $sent);
                return false;
            }
        }
        return view('user/resetpass', $data);
        //return 'Got it';
    }
    public function resetfeedback()
    {
        return view('user/reset_feedback');
    }
    public function resetlink()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $password = $this->request->getVar('password');
            $confirmPassword = $this->request->getVar('confirmPassword');
            if ($password !== $confirmPassword) {
                $this->session->setTempdata('error', 'Password did not match', 3);
                return redirect()->to(current_url());
            }
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $uniid = $this->request->getVar('uniid');
            if ($this->userModel->updatePassword($uniid, $hashPassword)) {
                $this->session->setTempdata('success', 'Password reset successfully!', 3);
                return redirect()->to('/');
            } else {
                $this->session->setTempdata('error', 'Something went worng try again to reset password', 3);
            }
        }

        $uri = $this->request->getUri();
        $uniid = $uri->getSegment(3);
        $time = $uri->getSegment(4);
        $currentTime = time();
        $data['uniid'] = $uniid;

        if ($time > $currentTime) {
            return view('user/newpassword', $data);
        } else {
            $this->session->setTempdata('error', 'Sorry! Link has been expired , try again', 3);
        }
    }
}
