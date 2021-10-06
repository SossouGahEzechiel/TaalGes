<?php

namespace App\Notifications;

use App\Mail\DemandeValideMail;
use App\Models\Demand;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DemanadeValideNotification extends Notification
{
    use Queueable;

    public $demande;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Demand $demande)
    {
        $this->demande = $demande;
        $this->user = Demand::whereUser_id($demande->user_id)->first();
        // $this->toMail();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        return (new DemandeValideMail($this->demande,$this->user));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'date'=>$this->demande->dateDem->locale('fr')->calendar(),
            'type'=>$this->demande->typeDem,
            'id'=>$this->demande->id,
            'objet'=>'Mail de Réponse',
            'de' => 'taalcorp@gmail.com'
        ];
    }
}
