<?php

namespace App\Mail;

use App\Models\Demand;
use App\Models\Demande;
use App\Models\Mail;
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
    public function __construct(Demand $demande, $user)
    {
        $this->celui = $demande->user->id;
        $this->nom = $user->nom;
        $this->lib = $demande->typeDem;
        $this->prenom = $user->prenom;
        $this->de = $user->email;
        $this->id= $demande->id;
        $this->dateDeb = $demande->dateDeb->locale('fr')->calendar();
        $this->dateSoum = $demande->dateDem->locale('fr')->calendar();
        $this->msg = "Bonjour ".$this->sexe($user)." ".$this->nom.". Votre demande de ".$this->lib." envoyée le ".$this->dateDeb." 
        a été ".$this->decision($demande)." .Cliquez sur ce boutton pour voir plus de détails.";
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
        return $mail = Mail::create([
            'message'=>$msg,
            'user_id' => Auth::user()->id,
            'destinataire' => $celui
        ]);
    }
    
    public function decision($demande)
    {
        return ($demande->decision === "Accorde") ? "acceptée" : "rejetée" ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->from('taalcorp@gmail.com')
            ->subject("Mail de confirmation")
            ->markdown('emails.demande.valideMail');
    }
}
