<?php

namespace App\Mail;

use App\Models\Demande;
use App\Models\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class DemandeValideMail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $nom;
    public $prenom;
    public $dateDeb;
    public $msg;
    public $lib;
    public $de;
    public $id;
    public $dateSoum;
    public $celui;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Demande $demande, User $user)
    {
        $this->celui = $demande->user->id;
        $this->nom = $user->nom;
        $this->lib = $demande->typeDem;
        $this->prenom = $user->prenom;
        $this->de = $user->email;
        $this->id= $demande->id;
        $this->dateDeb = $demande->dateDeb->format('d/m/y');
        $this->dateSoum = $demande->dateDem->format('d/m/y');
        $this->msg = "Bravo ".$this->sexe($user)." ".$this->nom.". Votre demande de ".$this->lib." envoyée le ".$this->dateDeb." 
        a été accetptée. Cliquez sur ce boutton pour voir plus de détails.";
        $this->createMonMail($this->msg,$this->celui);
    }
    
    function sexe($user) 
    { 
        if ($user->sexe == "M") {
            return $this->sexe = "Monsieur";
        } else {
            return $this->sexe = "Madame";
        }
    }
    function createMonMail($msg,$celui)
    {
        $mail = Mail::create([
            'message'=>$msg,
            'auteur' => Auth::user()->id
        ]);
        //Le mail est attaché au destinataire
        $mail->users()->attach($celui);
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->from('taalcorp@gmail.com')
            ->subject("Confirmation d'accord de congé par la TAAL-corp")
            ->markdown('emails.demande.valideMail');
    }
}
