<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table = 'user_details';
    protected $allowedFields = ['email', 'username', 'password'];

    public function dulpicateUser($email,$username){
        // select * from user_details where email = '$email' OR username = '$username;'
        $executeQ=$this->where('email', $email)->orWhere('username', $username)->first();
        return $executeQ;
    }


    public function getUserData($username){
        $executeQ=$this->where('username', $username)->first();
        return $executeQ;
        // echo var_dump($result);
    }

    public function getUserDetails($id){
        $executeQ=$this->where('id', $id)->first();
        return $executeQ;
    }

    
}
