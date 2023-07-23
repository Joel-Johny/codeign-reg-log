<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(){
        
        return view('login');
    }

    public function loginValidate(){

        
        $form_username=$this->request->getPost('username');
        $form_password=$this->request->getPost('password');
        echo "post request made to login <br>";

        echo $form_username,$form_password;

    }
    
}

