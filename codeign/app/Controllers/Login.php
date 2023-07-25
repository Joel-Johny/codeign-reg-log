<?php
namespace App\Controllers;

if (isset($_COOKIE['ci_session'])) {
    header('Location: dashboard');
    exit();
}
use App\Models\UserModel;

class Login extends BaseController
{
    public function index(){

        if ($this->request->is('get')) 
            return view('login');

        $form_post_data = $this->request->getPost(['email', 'username', 'password', 'confirm_password']);
        $validations =\Config\Services::validation();
        $rules=[
                'username' => 'required',
                'password' => 'required',
            ];
        $validations->setRules($rules);
    
        if (!$validations->run($form_post_data)) {//form validation 
            echo "Validation failed";
            $validationResult=$validations->getErrors();
        }
        else{
            echo "Validation passed";
            $userModel=new UserModel();
            $result=$userModel->getUserData($form_post_data["username"]);
            if(isset($result)){// record was found

                // echo var_dump($result);

                if(password_verify($form_post_data["password"],$result["password"])){
                    
                    $validationResult["login_status"]="Password Verified!";
                    $session = \Config\Services::session();
                    $_SESSION['id']=$result["id"];
                    return redirect('dashboard');
                }
            
                else
                    $validationResult["login_status"]="Invalid credentials";
            }
    
            else // record was not found
                $validationResult["login_status"]="Invalid credentials";
        }

        return view('login',$validationResult);

    }

    public function loginValidate(){

        
        $form_username=$this->request->getPost('username');
        $form_password=$this->request->getPost('password');
        $userModel=new UserModel();
        $result=$userModel->validateLogin($form_username,$form_password);
        
        if($result["validationStatus"]){
            //start sess and redirect user to dash
            // echo "redirecting user to dash";
            $session = \Config\Services::session();
            $_SESSION['id']=$result["id"];
            return redirect('dashboard');
        }
        $loginParam=["login_err"=>$result["message"]];
        return view('login',$loginParam);

        // echo "post request made to login <br>";
        // echo var_dump($result);


    }
    
}

