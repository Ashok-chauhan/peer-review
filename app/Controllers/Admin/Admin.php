<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

/**
 * Description of Admin
 *
 * @author Ashok
 */
class Admin extends BaseController
{

    public $adminModel;
    public $session;
    public $email;

    public function __construct()
    {
        helper(['url', 'form', 'role']);
        $this->adminModel = new AdminModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        if ($this->request->getMethod() == 'post') {
            $usrid = $this->request->getVar('userid');
            $role = $this->request->getVar('roleID');
            $status = $this->request->getVar('status');
            $this->adminModel->updateUser($usrid, $role, $status);

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
}
