<?php

namespace App\Notifications;

use App\Mail\AvisMail;
use App\Models\Demand;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

class AvisNotification extends Notification
{
    use Queueable;
    
    public $demande;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Demand $demande)
    {
        $this->demande = $demande;
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
        return (new AvisMail($this->demande,now()));
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
            'demandeId' =>$this->demande->id
        ];
    }
}
