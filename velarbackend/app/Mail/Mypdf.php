<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mypdf extends Mailable
{
    use Queueable, SerializesModels;
    // public $order;
  
    public $pdf;
    public $email;
    public $order;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $email, $order ,$pdf)
    {
        // $this->order = $order;
        $this->pdf = $pdf;
        $this->email = $email;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return Mail::send('myPDF', $this->order, function ($message)use($order, $pdf) {
            $message->to($this->email);
            $message->subject('Invoice');
            $message->attachData($pdf->output(),'invoice', array('mime' => 'application/pdf'));
        });
    }
}

