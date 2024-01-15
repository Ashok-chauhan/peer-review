<?php
namespace App\Controllers\Author;

use App\Controllers\BaseController;


/**
 * Description of Dashboard
 *
 * @author Ashok
 */
class Profile extends BaseController{
    public function index(){
        
        return view('author/index');
    }
    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }
}
