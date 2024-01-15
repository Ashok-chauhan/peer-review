<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //return view('welcome_message');
      /// $data['title'] = 'this is title';
       return view('welcome_message');
       
    }

    public function about(): string{
        $data['title'] = 'About us page';
        return view('home/about', $data);
        
    }
    
}
