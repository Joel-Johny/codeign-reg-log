<?php

namespace App\Controllers;
use \CodeIgniter\View\Table;
use App\Models\UserModel;
class Trial extends BaseController
{
    public function index()
    {
        $tableData=[
            ["Name","Maths","Science","English"],
            ["Joel","23","55","56"],
            ["Johny","66","23","23"],
        ];

        $table=new Table();
        echo "This is  a table from controller";

        echo $table->generate($tableData);
        // return view('trial');
        echo "This is  a text from controller";

        $arrayData=[
            ["subject"=>"maths","marks"=>"23"],
            ["subject"=>"science","marks"=>"55 SHEET"],
            ["subject"=>"physics","marks"=>"80"],
        ];
        echo var_dump($arrayData);
        $datavar=["key"=>"5"];
        return view('trial',$datavar);

    }

    public function realpage(){
        // echo "The number (from controller )is ".$variable;
        echo "HI";
        // echo var_dump($record);
        // $viewVariable["number"]=$variable;
        echo "</pre>";

        $users=new UserModel();
        echo "<pre>";
        echo var_dump($users->getallUsers());
        // return view('realpage',$viewVariable);
        
    }
    
}

