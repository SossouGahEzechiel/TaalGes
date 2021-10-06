<?php

namespace App\Mail;

use App\Models\Demand;
use App\Models\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use MercurySeries\Flashy\Flashy;

class DemandeSentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $msg;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Demand $demande,User $user)
    {
        $this->user = $user;
        $this->demande = $demande;
        $this->msg = $this->sexe().' '.$this->user->nom.' vient d\'envoyer une demande cliquez sur le boutton pour consulter';
        $this->createMonMail($this->msg);
    }

    function createMonMail($msg)
    {
        $mail = Mail::create([
            'message'=>$msg,
            'user_id' => Auth::user()->id
        ]);
        //Le mail est attaché au destinataire
        // $mail->users()->attach(User::whereFonction('admin')->first()->id);
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
        // dd($this->demande->user->email);
        Flashy::message($this->demande->user->email);
        return $this
            ->from($this->demande->user->email,$this->demande->user->nom)
            ->subject('Soumission de demande')
            ->markdown('emails.demande.sentMail');
    }
}
