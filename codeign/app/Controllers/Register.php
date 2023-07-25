<?php
namespace App\Controllers;

use App\Models\UserModel;
class Register extends BaseController
{

    public function __construct()
    {
        echo "constructor called";
        if (isset($_COOKIE['ci_session'])) {
            header('Location: dashboard');
            exit();
        }
    }

    public function index(){

        if ($this->request->is('get')) 
            return view('register');
        
        $form_post_data = $this->request->getPost(['email', 'username', 'password', 'confirm_password']);
        $validations =\Config\Services::validation();
        $rules=[
            'email' => 'required|valid_email',
            'username' => 'required|min_length[4]',
            'password' => 'required|min_length[8]',
            'confirm_password'  => 'required|matches[password]'
        ];
        $validations->setRules($rules);


        if (!$validations->run($form_post_data)) {
            echo "Validation failed";
            $validationResult=$validations->getErrors();
        }

        else{
            echo "Validation passed";
            // check for duplicate user
            $userModel=new UserModel();
            $result=$userModel->dulpicateUser($form_post_data["email"],$form_post_data["username"]);
            echo var_dump($result);
            if(isset($result)){

                if($result["username"]==$form_post_data["username"])
                    $validationResult["dbValidation"]="Username already exists!";
                else
                    $validationResult["dbValidation"]="Email already exists!";
            }
    
            else {
                //NO duplicate account so save the user
                $userModel->save([
                    'email' => $form_post_data["email"],
                    'username' => $form_post_data["username"],
                    'password' => password_hash($form_post_data["password"],PASSWORD_DEFAULT)
                ]);
                $validationResult["dbValidation"]="Account created successfully !";
            }
               

        }

     return view('register',$validationResult);

    }
}



