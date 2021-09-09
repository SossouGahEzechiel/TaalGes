<?php

namespace App\Mail;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandeValideMail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $nom;
    public $prenom;
    public $dateDeb;
    public $dateFin;
    public $msg;
    public $lib;
    public $from;
    public $id;
    public $dateSoum;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Demande $demande, User $user)
    {
        $this->nom = $user->nom;
        $this->lib = $demande->typeDem;
        $this->prenom = $user->prenom;
        $this->from = $user->email;
        $this->id= $demande->id;
        $this->dateDeb = $demande->dateDeb->format('d/m/y');
        // $this->dateFin = [];
        $this->dateSoum = $demande->dateDem->format('d/m/y');
        $this->dateFin = array(
            'jour' => $demande->dateDeb->format('d')+$demande->duree,
            'mois' => $demande->dateDeb->format('m'),
            'annee' => $demande->dateDeb->format('y'),
        ); 
        $this->msg = "Bravo ".$this->sexe($user)." ".$this->nom.". Votre demande de ".$this->lib." envoyée le ".$this->dateDeb." 
            a été accetptée . <br> Cliquez sur ce boutton pour voir plus de détails.";
    }
    
    function sexe($user) 
    {
        if ($user->sexe == "M") {
            return $this->sexe = "Monsieur";
        } else {
            return $this->sexe = "Madame";
        }
    }
    public function miseAJour($fin) : void
    {
        if ($fin['jour']> 30) {
            $fin['jour'] =1;
            $fin['mois'] +=1;               
        }
        if ($fin['mois']> 12) {
            $fin['mois'] =01;
            $fin['annee'] +=1;               
        }
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('$this->from@gmail.com')
            ->subject("Confirmation d'accord de congé par la TAAL-corp")
            ->markdown('emails.demande.valideMail');
    }
}
