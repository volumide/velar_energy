<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\form;
class formcontroller extends Controller
{
     function savedata(Request $request){

        $data = $request->all();
        $customer = new form;
        $res = form::create($data);

       
        

        return array("data" => $res);
    }
}
