<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function predict(Request $request){

        $arguments    = 'hellooo,imagine';
        $full_path_to_python_script = 'C:\xampp\htdocs\e-commerce\e-commerce\public\storage\pythin\app.py';
        $command      = "python $full_path_to_python_script \"{$arguments}\"";
        //echo $command;
        $output       = shell_exec($command);
        $return_value = ['data' => $output];
        var_dump($return_value);

        //return response()->json($return_value);
    }


        //return view("test",compact("prediction"));
}

