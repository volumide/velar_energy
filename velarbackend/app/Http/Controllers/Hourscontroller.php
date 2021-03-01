<?php

namespace App\Http\Controllers;
use App\hours;

use Illuminate\Http\Request;

class Hourscontroller extends Controller
{
    function getautonomy(){
        return array("data" => hours::all()); 
    }
    
    function saveautonomy(Request $request){
        $data = $request->all();
        $inverter = new hours;
        $res = Kva::create($data);
        return array("data" => $res, "message" => "successful");
    }
}
