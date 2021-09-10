<?php

namespace App\Notifications;

use App\Mail\DemandeSentMail;
use App\Mail\TestMail;
use App\Models\Demande;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class DemanadeSentNotification extends Notification
{
    use Queueable;

    public $demande;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Demande $demande)
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
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        new TestMail(Auth::user(),"message de test");
        return (new DemandeSentMail($this->demande,$notifiable));
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
            'de'=>$notifiable->email,
            'nom'=>$notifiable->nom,
            'a'=>'taalcorp@gmail.com',
            'objet'=>$this->demande->objet,
            'id'=>$this->demande->id,
        ];
    }
}
