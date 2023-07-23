<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table = 'user_details';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['email', 'username', 'password'];

    public function registerUser($userData){
        // $db=\Config\Database :: connect();
        // $query=$db->query("select * from user_details");
        // $records= $query->getResult();
        // return $records;
        $result=$this->insert($userData);
        return $result;
    }



    public function dulpicateUser($email,$username){
        // select * from user_details where email = '$email' OR username = '$username;'

        $executeQ=$this->db->table('user_details')->select('*')->where('email', $email)->orWhere('username', $username)->get();
        $result = $executeQ->getResultArray();
        // echo var_dump($result);
        if(count($result)>0){

            if($result[0]["username"]==$username)
                return ["duplicate"=>"Username already exists!"];
            else
                return ["duplicate"=>"Email already exists!"];
        }

        else
            return ["duplicate"=>false];
    }

    
}
