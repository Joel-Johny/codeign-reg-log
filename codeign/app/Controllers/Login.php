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
        
        return view('login');
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

