<?php
namespace App\Controllers;

use App\Models\UserModel;
class Register extends BaseController
{

    public function __construct()
    {
        // echo "constructor called";
        if (isset($_COOKIE['ci_session'])) {
            header('Location: dashboard');
            exit();
        }
        $this->validate =\Config\Services::validation();

    }

    public function index(){

        if ($this->request->is('get')) 
            return view('register');
        
        $form_post_data = $this->request->getPost(['email', 'username', 'password', 'confirm_password']);
        $rules=[
            'email' => 'required|valid_email',
            'username' => 'required|min_length[4]',
            'password' => 'required|min_length[8]',
            'confirm_password'  => 'required|matches[password]'
        ];
        $this->validate->setRules($rules);
        $ajax_response=["success"=>false];


        if (!$this->validate->run($form_post_data)) {
            // echo "Validation failed";
            $validationResult=$this->validate->getErrors();
        }

        else{
            // echo "Validation passed";
            // check for duplicate user
            $userModel=new UserModel();
            $result=$userModel->dulpicateUser($form_post_data["email"],$form_post_data["username"]);
            // echo var_dump($result);
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
                $ajax_response=["success"=>true];

            }
               

        }
    if($ajax_response["success"]==false)
        $ajax_response["validations"]=$validationResult;
    
    exit(json_encode($ajax_response));
    //  return view('register',$validationResult);

    }
}



