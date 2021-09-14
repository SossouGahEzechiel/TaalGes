<?php

namespace App\Notifications;

use App\Mail\DemandeValideMail;
use App\Models\Demande;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
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
    public function __construct(Demande $demande,User $user)
    {
        $this->demande = $demande;
        $this->user = $user;
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
    public function toMail($notifiable)
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
            'date'=>$this->demande->dateDem->format('d/m/y'),
            'type'=>$this->demande->typeDem,
            'id'=>$this->demande->id,
            'objet'=>'Mail de validation',
            'de' => 'taalcorp@gmail.com'
        ];
    }
}
