<?php
namespace App\Controllers;


use App\Models\UserModel;

class Login extends BaseController
{

    public function __construct()
    {
        if (isset($_COOKIE['ci_session'])) {
            header('Location: dashboard');
            exit();
        }
        $this->validate =\Config\Services::validation();

    }


    public function index(){

        if ($this->request->is('get')) 
            return view('login');

        $form_post_data = $this->request->getPost(['email', 'username', 'password', 'confirm_password']);
        $rules=[
                'username' => 'required',
                'password' => 'required',
            ];
        $this->validate->setRules($rules);
        $ajax_response=["success"=>false];

    
        if (!$this->validate->run($form_post_data))//form validation 
            // echo "Validation failed";
            $validationResult=$this->validate->getErrors();
        
        else{
            // echo "Validation passed";
            $userModel=new UserModel();
            $result=$userModel->getUserData($form_post_data["username"]);
            if(isset($result)){// record was found

                // echo var_dump($result);

                if(password_verify($form_post_data["password"],$result["password"])){

                    $validationResult["login_status"]="Password Verified!";
                    $session = \Config\Services::session();
                    $_SESSION['id']=$result["id"];
                    $ajax_response["success"]=true;
                    // return redirect('dashboard');
                }
            
                else
                    $validationResult["login_status"]="Invalid credentials";
            }
    
            else // record was not found
                $validationResult["login_status"]="Invalid credentials";
        }
        if($ajax_response["success"]==false)
            $ajax_response["validations"]=$validationResult;

        exit(json_encode($ajax_response));
        
        // return view('login',$validationResult);

    }

}

