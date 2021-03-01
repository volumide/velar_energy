<?php

namespace App\Http\Controllers;

use App\inverter;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mypdf;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Carbon;
// use App\Http\Controllers\Generatepdf;
use PDF;

class Invertercontroller extends Controller
{
    // public $email;??/

    function getinverter(){
        return array("data" => Inverter::all()); 
    }

    function getkva($kva, $hour, $email){
        $fetch = inverter::where('kva', $kva)->where('hours', $hour)->get()->toArray();
        $content = array();
        
        foreach ($fetch as $value) {
            array_push($content, $value);
        }

        $kva = $content[0]['kva'];
        $inverterprice = $content[0]['inverter-price'];
        $batteryprice = $content[0]['battery-price'];
        $nosolarprice = $content[0]['store-price-no-solar'];
        $panelprice = $content[0]['panel-price'];
        $solarfee = $content[0]['solar-fee'];
        $withsolarprice = $content[0]['store-price-with-solar'];
        $panelcount = $content[0]['panelcount'];
        $batteryamp = $content[0]['battery-amp'];
        $batterycount = $content[0]['battery-quantity'];
        $solaramp = $content[0]['solar-amp'];
        $solarcharge = $content[0]['solar-charge'];
        $id = $content[0]['id'];
        $totalwithsolar = $inverterprice + $batteryprice + ($panelprice * $panelcount) + $solarfee + $withsolarprice ;
        $totalwithnosolar = $inverterprice + $batteryprice + $nosolarprice ;

        $order = array(
            'totalpricewithsolar' => $totalwithsolar,
            'totalpricewithoutsolar' => $totalwithnosolar,
            'panelcount' => $panelcount,
            'batteryamp' => $batteryamp,
            'solaramp' => $solaramp,
            'kva' => $kva,
            'batterycount' => $batterycount,
            'solarcharge' => $solarcharge,
            'id' => $id
        );
        
        // $mis = array(
        //     'title' => 'this should work'
        // );
        
        $this->mail = $email;
       
        $pdf = PDF::loadView('myPDF', $order);
        $mirror =function ($message)use($order, $pdf) {
            $message->to($email);
            $message->subject('Invoice');
            $message->attachData($pdf->output(),'invoice', array('mime' => 'application/pdf'));
        };

        Mail::send('myPDF',$order, $mirror);
            // return $pdf->download('invoice.pdf');
            // Mail::to($email)->send(new Mypdf($pdf->output()));
            // Mail::to($email)->send(new Mypdf( 'myPDF', $pdf->output()));
            // dd('email sent');
        

        
        // $Mail = new Generatepdf;
        // $Mail->generatePDF($email,$order);

        return array("data" => $content );
    }

    function saveinverter(Request $request){
        $data = $request->all();
        $inverter = new Inverter;
        $res = Inverter::create($data);
        return array("data" => $res, "message" => "successful");
    }
}
