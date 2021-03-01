<?php

namespace App\Http\Controllers;
use App\Kva;
use Illuminate\Http\Request;

class Kvacontroller extends Controller
{
    function getkva(){
        return array("data" => Kva::all()); 
    }
    
    function savekva(Request $request){
        $data = $request->all();
        $inverter = new Kva;
        $res = Kva::create($data);
        return array("data" => $res, "message" => "successful");

    }
}
