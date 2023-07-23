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
        $this->insert($userData);
    }



    public function dulpicateUser($email,$usermame){
        
    }

    
}
