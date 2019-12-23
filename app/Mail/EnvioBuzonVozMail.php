<?php

namespace Nimbus\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnvioBuzonVozMail extends Mailable
{
    use Queueable, SerializesModels;

    public $grabacion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $grabacion )
    {
        $this->grabacion = $grabacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('voicemail::grabacionesVoiceMail.mail')
                    ->subject("Grabación de buzón de voz")
                    ->attach(__DIR__.'/../../public/'.$this->grabacion->ruta);
    }
}
