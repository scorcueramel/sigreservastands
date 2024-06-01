<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Rechazar extends Mailable
{
    use Queueable, SerializesModels;

    public $nombres;

    public function __construct($nombres)
    {
        $this->nombres = $nombres;
    }

    public function build(){
        return $this->view('mail.rechazar')->subject('Estado actual de tu reserva');
    }
}
