<?php

namespace App\Mail;

use App\Models\Demand;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $timestamps;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Demand $demande,DateTime $timestamps)
    {
        $this->demande = $demande;
        $this->timestamps = $timestamps;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $demande = $this->demande;
        $notification = $this->timestamps ;
        return $this->view('emails.demande.avisMail',compact('demande','notification'));
    }
}
