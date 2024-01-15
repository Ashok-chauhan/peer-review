<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\RegistrationModel;
/**
 * Description of Register
 *
 * @author Ashok
 */
class Registration extends Controller {
    public $registrationModel;
    public $session;
    public $email;
    public function __construct() {
        helper('form');
        $this->registrationModel = new RegistrationModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
    }
    public function index(){
        $data=[];
        $data['validation']= null;
        
        if($this->request->getMethod()=='post'){
         
            $rules =[
                'username' => 'required',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' =>'required',
                'cpass' => 'required|matches[password]',
                'phone'=>'required|exact_length[10]|numeric',
                'country' => 'required',
            ];
            if($this->validate($rules))
            {
                $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
            
                $userdata = [
                    'username' => $this->request->getVar('username',FILTER_SANITIZE_STRING),
                    'email' => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'uniid' => $uniid,
                    'activation_date' => date("Y-m-d h:i:s"),
                    'country'=> $this->request->getVar('country', FILTER_SANITIZE_STRING),
                    'roleID' => $this->request->getVar('roleID'),
                ];
                //print('<pre>');
                //print_r($userdata);
               if($this->registrationModel->createUsers($userdata)){
                  //end email. 
                   $to = $this->request->getVar('email');
                   $subject = 'Account Activation link -';
                   $message = 'Hi '. $this->request->getVar('username',FILTER_SANITIZE_STRING).",<br><br>Thanks Your account created successfully. Please click the below link to activate your Account<br><br>"
                           ."<a href='".base_url()."activate/".$uniid."'target='_blank'>Activate Now</a><br>";
                   $this->email->setTo($to);
                   $this->email->setFrom('ashok@whizti.com','Info');
                   $this->email->setSubject($subject);
                   $this->email->setMessage($message);
                   if($this->email->send()){
                      $this->session->setTempdata("success","Account created successfully, Please activate your account.",3);
                   return redirect()->to(current_url()); 
                   }else{
//                       $errorData = $this->email->printDebugger(['headers']);
//                       print($errorData);
                       $this->session->setTempdata('error','Account created successfully. Sorry! unable to send activation link. Contact Admin');
                       return redirect()->to(current_url());
                   }
                   
               }else{
                   //send error.
                   $this->session->setTempdata("error", "Sorry! Unable to crate an account, try again",3);
                   return redirect()->to(current_url());
               }
            }else{
                $data['validation'] = $this->validator;
            }
        }
       return view("registration", $data);
        //echo "Registration";
    }
    public function activate($uniid=null){
        $data=[];
        
       
        if(isset($uniid)){
           // return view('activation', $data);
            $userData = $this->registrationModel->verifyUniid($uniid);
            if($userData){
                if($userData->status =='inactive'){
                    $status = $this->registrationModel->updateStatus($uniid);
                    if($status == true){
                        $data['success']= 'Account activated successfully';
                    }
                }else{
                    $data['success'] = 'Your account is alredy activated';
                }
                
            }else{
                $data['error'] = 'Sorry!, we are unable to find your account';
            }
        }
        
//        else{
//         $data['error'] = 'Sorry!, unable to process your request';
//        }
        
        return view('activation', $data);
    }
}
