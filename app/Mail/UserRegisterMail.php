<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nom;
    public $id;
    public $msg;
    public $sexe;
    public $pswd;
    public $mail;
    public $taal = "ezecsossougah@gmail.com";
    // public $profil = "route('user.show',)";

    /**
     * Create a new message instance.   
     *
     * @return void
     */
    public function __construct(User $user,string $pswd)
    {
        $this->taal;
        $this->id = $user->id;
        $this->pswd = $pswd;
        $this->mail = $user->email;
        $this->nom = $user->nom;
        $this->msg= $this->sexe($user)." ".$this->nom.", soyez les bienvenus au sein de la TAAL-corporation.\n Ce présent mail contient vos identifiants.
            \n veuillez vous connecter à votre compte pour voir votre profil.\n Email : ".$this->mail."\n Mot de passe : ".$this->pswd."\n. En cas de plaintes, veuillez vous addresser au service des 
            ressources humaines de votre service ou envoyer un mail à cet addresse: ".$this->taal."\n .Merci de votre comprehension\n . Cliquez sur ce boutton pour vous authentifier...";
    }


    function sexe($user)
    {
        if ($user->sexe == "M") {
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
        return $this->from('hsossougah@gmail.com')
            ->subject('Mail de communication des indentifiants')
            ->markdown('user.self.registerMail');
    }
}