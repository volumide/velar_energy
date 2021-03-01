<?php

namespace App\Http\Controllers;
use App\load;
use Illuminate\Http\Request;

class Loadcontroller extends Controller
{
    function getload(){
        return array("data" => load::all()); 
    }
    
    
    function saveload(Request $request){
        $data = $request->all();
        $inverter = new load;
        $res = load::create($data);
        return array("data" => $res, "message" => "successful");

    }
}
