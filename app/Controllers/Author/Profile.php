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
