<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactanosMailable extends Mailable
{
    use Queueable, SerializesModels;

    private $details;

    //Aqui definiremos el asunto del correo 
    public $subject = "Información de contacto";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    /*Este metodo se encarga de generar la 
    vista con el contenido del correo*/
    public function build() 
    {
        return $this->subject('Mail de tus peluditos')->view('contactanos');
    }
}
