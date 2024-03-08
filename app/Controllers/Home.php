<?php

namespace App\Controllers;

class Home extends BaseController
{

    public $email;
    public function __construct()
    {
        helper(['url', 'form', 'role']);
        $this->email = \Config\Services::email();
    }
    public function index()
    {
        //return view('welcome_message');
        /// $data['title'] = 'this is title';
        return view('welcome_message');
    }

    public function about()
    {
        $data['title'] = 'About us page';
        return view('home/about', $data);

        /*
        $to = 'ashok975@gmail.com';
        $sent = $this->notificationEmail($to);
        if ($sent) {

            return $sent;
        } else {
            return $sent;
        }
        */
    }

    public function notificationEmail($to)
    {

        $subject = 'Update Required for Your Article Submission titled "';
        $this->email->setMailType('html');
        $this->email->setTo($to);
        //$this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        $body =  view('mails/testmail');
        $this->email->setMessage($body);
        // $sent = $this->email->send();
        //if ($this->email->send()) {

        if ($this->email->send()) {
            return $this->email->printDebugger();
        } else {
            return $this->email->printDebugger();
        }
    }
}
