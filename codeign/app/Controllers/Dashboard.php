<?php
namespace App\Controllers;

if (!isset($_COOKIE['ci_session'])) {
    header('Location: login');
    exit();
}
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index(){
        $userModel=new UserModel();
        $session = \Config\Services::session();

        $result=$userModel->getUserDetails($_SESSION['id']);
        $userData=["name"=>$result[0]["username"],"email"=>$result[0]["email"]];
        return view('dashboard',$userData);
    }


    public function logout(){
        echo"inside logout";
        if (isset($_COOKIE['ci_session'])) {
            $params = session_get_cookie_params();
            setcookie('ci_session', '', time() - 100, $params['path'], $params['domain']);
        
            session()->remove(['id']);
            session()->destroy();
        
        }
        return redirect('login');
    }

    
}

