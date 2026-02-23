<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Messages\MailMessage;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $data = [])
    {
        $this->user = $user;

        $this->message = (new MailMessage)
                ->subject(( isset($data['subject'])? $data['subject']: 'Exact Manpower Support' ))
                ->line(( isset($data['intro'])? $data['intro']: 'ExactO Manpower Support sent you this email' ))
                ->action(
                    (isset($data['action'])? $data['action']: 'Confirm' ), 
                    url((isset($data['action_url'])? $data['action_url']: '' ))
                )
                ->line((isset($data['footer'])? $data['footer']: 'Thank you for your connection with us.' ));
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notification', $this->message->data());
    }
}
