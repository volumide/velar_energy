<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mypdf;
class mailcontroller extends Controller
{
    function mail() {
        $order = array(
            'title' => 'hello',
            'body' => 'testing'
        );
        
        Mail::to('olumideafowowe@gmail.com')->send(new Mypdf($order));
        dd('email sent');
    }
}
