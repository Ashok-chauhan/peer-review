<?php

/**
 * Description of Auth
 *
 * @author Ashok
 */
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Loggedin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(session()->get('logged_user') && session()->get('role') ==1){
            return redirect ()->to('/admin');
        }elseif(session()->get('logged_user') && session()->get('role') ==2){
            return redirect ()->to('/editor');
        }elseif(session()->get('logged_user') && session()->get('role') ==3){
            return redirect ()->to('/author/profile');
        }elseif(session()->get('logged_user') && session()->get('role') ==4){
            return redirect ()->to('/peer'); //reviewer
        }elseif(session()->get('logged_user') && session()->get('role') ==5){
            return redirect ()->to('/translator');
        }elseif(session()->get('logged_user') && session()->get('role') ==6){
            return redirect ()->to('/reader');
        }elseif(session()->get('logged_user') && session()->get('role') ==7){
            return redirect ()->to('/editcopy');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}