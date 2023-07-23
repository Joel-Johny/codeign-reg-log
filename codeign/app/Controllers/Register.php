<?php

namespace App\Controllers;
use App\Models\UserModel;
class Register extends BaseController
{
    public function index(){
        
        return view('register');

    }

    public function registerValidate(){
        include APPPATH . 'Controllers/validations.php';

        $form_email=$this->request->getPost('email');
        $form_username=$this->request->getPost('username');
        $form_password=$this->request->getPost('password');
        $form_c_password=$this->request->getPost('c-password');
        
        $validation_result=validations($form_email,$form_username,$form_password,$form_c_password);
        if(count($validation_result)==0){
            //check in db for duplicate user
            $userModel=new UserModel();
            $result_duplicate=$userModel->dulpicateUser($form_email,$form_username);

            // echo var_dump($result_duplicate);
            if($result_duplicate["duplicate"]==false){
                
                //register user 
                $userData=["email"=>$form_email,"username"=>$form_username,"password"=>password_hash($form_password,PASSWORD_DEFAULT)];
                $saveUser=$userModel->registerUser($userData);
                if($saveUser)
                    $validation_result["dbValidation"]="Account created Successfully";
                else    //failed to register user
                    $validation_result["dbValidation"]="Something went wrong!";


            }
            
            else //username/pass already present
                $validation_result["dbValidation"]=$result_duplicate["duplicate"];
            
        }
        // echo "invalid form inputs<br>";
        // echo var_dump($validation_result);
        return view('register',$validation_result);

    }

    
}

