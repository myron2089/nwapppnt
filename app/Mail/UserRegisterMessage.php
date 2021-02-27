<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterMessage extends Mailable 
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $mailData;

    public function __construct($mailData)
    {
        //
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // dd($this->mailData);
        if($this->mailData['fromEvent'] == 1){
            return $this->subject('Registro de visitante NetworkingApp')->view('emails.accountregistered')
                    ->with(['data' => $this->mailData]);
        }
        else if($this->mailData['fromEvent'] == 0){
            return $this->subject('Registro de usuario NetworkingApp')->view('emails.accountregisterednoevent')
                    ->with(['data' => $this->mailData]);   
        }


    }
}
