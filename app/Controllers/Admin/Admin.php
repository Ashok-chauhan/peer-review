<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

/**
 * Description of Admin
 *
 * @author Ashok
 */
class Admin extends BaseController {

    public $adminModel;
    public $session;
    public $email;

    public function __construct() {
        helper(['url', 'form']);
        $this->adminModel = new AdminModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
    }

    public function index() {
        if ($this->request->getMethod() == 'post') {
            $usrid = $this->request->getVar('userid');
            $role = $this->request->getVar('roleID');
            $status = $this->request->getVar('status');
            $this->adminModel->updateUser($usrid, $role, $status);
        }
        $data = [];
        $data['users'] = $this->adminModel->getUsers();
        $data['submissions'] = $this->adminModel->getAllSubmission();
        return view('admin/index', $data);
    }
}
