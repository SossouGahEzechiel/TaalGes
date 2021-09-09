<?php

namespace App\Mail;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class DemandeSentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Demande $demande)
    {
        $this->demande = $demande;
        $this->msg = $this->sexe().' '.Auth::user()->nom.' vient d\'envoyer une demande cliquez sur le boutton pour consulter';
    }

    function sexe()
    {
        if (Auth::user()->sexe == "M") {
            return $this->sexe = "Monsieur";
        } else {
            return $this->sexe = "Madame";
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(Auth::user()->email,Auth::user()->nom)
            ->subject('Soumission de demande')
            ->markdown('emails.demande.sentMail');
    }
}
