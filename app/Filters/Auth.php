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

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
//        $db = \Config\Database::connect();
//        $role = $db->table('role')->get();
//        $roles = $role->getResult();
//       foreach ($role->getResult() as $row) {
//       echo $row->role_name;
//        }
        
       
        if(!session()->get('logged_user')){
            return redirect ()->to('/login');
        }
        

      
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}