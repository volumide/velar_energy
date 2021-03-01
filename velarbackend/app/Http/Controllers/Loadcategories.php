<?php

namespace App\Http\Controllers;
use App\Loadcategory;
use Illuminate\Http\Request;

class Loadcategories extends Controller
{
    function getload(){
        return array("data" => loadcategory::all()); 
    }
    
    function saveload(Request $request){
        $data = $request->all();
        $inverter = new Loadcategory;
        $res = Kva::create($data);
        return array("data" => $res, "message" => "successful");

    }
}
