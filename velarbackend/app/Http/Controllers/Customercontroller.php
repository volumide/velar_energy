<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;
use App\Http\Controllers\Generatepdf;


use PDF;

class Customercontroller extends Controller
{
    function getcustomer(){
        return array("data" => customer::all()); 
    }
    
    function savecustomer(Request $request){

        $data = $request->all();
        $customer = new customer;
        $res = customer::create($data);

        $email = $request->input('email');

        $Mail = new Generatepdf;
        $Mail->generatePDF($email);
        

        return array("data" => $email);
    }
}
