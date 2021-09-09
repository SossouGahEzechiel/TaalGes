<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $email;
    public $mess;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,string $mess)
    {
        $this->email = $user->email;
        $li = "\n\t";
        $this->mess = $mess;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)
            ->subject('Demande de congé')
            ->view('emails.test.mail')
            ->attach(public_path('images/auth/lockscreen-bg.jpg'));
    }
}
