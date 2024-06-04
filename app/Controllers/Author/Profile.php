<?php

namespace App\Controllers\Author;

use App\Controllers\BaseController;
use App\Models\SubmissionModel;

/**
 * Description of Dashboard
 *
 * @author Ashok
 */
class Profile extends BaseController
{
    public $submissionModel;
    public function __construct()
    {
        helper(['role']);
        $this->submissionModel = new SubmissionModel();
        $this->session = \Config\Services::session();
        if (session()->get('role') == 3) {
        } elseif (isset($_GET['r'])) {
            session()->set('role', base64_decode($_GET['r']));
        } elseif (session()->get('role') != 3) {
            session_destroy();
            die('Access denied');
        }
        session()->remove('roles'); //multiple role
    }
    public function index()
    {

        return view('author/index');
    }
    public function bellnotification()
    {
        $data = [];
        $data['notifications'] = $this->submissionModel->getBellNotification(session()->get('userID'));
        $updated = $this->submissionModel->updateNotifications(session()->get('userID'));
        return view('author/notification', $data);
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
