<?php

namespace App\Listeners;

use App\Events\EmailSent;
use App\Mail\SendEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailSendingFromClientToUser implements ShouldQueue
{



    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EmailSent $event)
    {
        $defaultMail = 'lucaslpra@gmail.com';
        $email = new SendEmail(
            $event->clientName,
            $event->clientEmail,
            $event->clientSubject,
            $event->clientMessage
        );

        $when = now()->addSeconds();
        Mail::to($defaultMail)->later($when , $email);
    }
}
