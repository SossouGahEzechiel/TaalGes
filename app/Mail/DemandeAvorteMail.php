<?php

namespace App\Mail;

use App\Models\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class DemandeAvorteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dest; 
    public $msg; 
    public $dateDem; 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dest)
    {
        $this->dest = $dest;
        $this->dateDem = now();
        $this->msg = $this->sexe($dest).' '.$dest->nom.', la demande que vous avez soumise le '.$this->dateDem->format('d-m-y').' a été rejetée par l\'adminsistration car vous avez 
            épuiser vos 30 jours de congés déductibles par année. En cas d\'une quelconque plainte, veuillez ecrire à cette adresse mail : taalcorp@gmail.com ou contacter le services des ressources humaines de votre service.';
        $this->createMonMail($this->msg);
    }

    function sexe($dest) 
    { 
        if ($dest->sexe == "M") {
            return $this->sexe = "Monsieur";
        } else {
            return $this->sexe = "Madame";
        }
    }

    function createMonMail($msg)
    {
        $mail = Mail::create([
            'message'=>$msg,
            'auteur' => Auth::user()->id
        ]);
        //Le mail est attaché au destinataire
        // $mail->users()->attach(User::whereFonction('admin')->first()->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('taalcorp@gmail.com')
                    ->subject('Mail d\'information')
                    ->markdown('emails.demande.demandeAvorteMail');
    }
}
