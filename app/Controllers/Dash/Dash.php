<?php

namespace App\Controllers\Dash;

use App\Controllers\BaseController;

//use App\Models\AdminModel;

/**
 * Description of Admin
 *
 * @author Ashok
 */
class Dash extends BaseController
{

    // public $adminModel;
    // public $session;
    // public $email;

    public function __construct()
    {
        helper(['url', 'form', 'role']);
        // $this->adminModel = new AdminModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();

    }

    public function index()
    {
        return view('dash/index');
    }
}
