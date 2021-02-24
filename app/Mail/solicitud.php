<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class solicitud extends Mailable
{
    use Queueable, SerializesModels;
    private $detalls;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detalls)
    {
        $this->detalls = $detalls;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail de tus peluditos')->view('solicitud');
    }
}
