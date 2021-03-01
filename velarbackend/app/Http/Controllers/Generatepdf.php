<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mypdf;
use Illuminate\Http\Request;
use PDF;
class Generatepdf extends Controller
{
    public function generatePDF($email, $order)
    {
        // $this->order = $order;
        
        $pdf = PDF::loadView('emails.myPDF', $order);

        try{
            Mail::to($email)->send(new Mypdf($order, $pdf->output()));
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";
        }else{
            $this->statusdesc  =   "Message sent Succesfully";
            $this->statuscode  =   "1";
        }
        
        return \response()->json(\compact('this'));
      
        // return $pdf->download('itsolutionstuff.pdf');
    }
}
