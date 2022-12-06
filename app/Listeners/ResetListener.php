<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ResetCreateEvent;
use App\Models\User;

class ResetListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ResetCreateEvent $event)
    {
        //
        $email=$event->email;
        $user=User::where('email',$email)->first();
        
        $mails = array($email);
        //password reset mail
        $subject = "Reset password";
       
        $info['first_name']=$user->first_name;
        $info['email']=$user->email;
        $info['password']=$user->password;
        \Mail::to($mails)->send(new ResetMail($subject, $info));
    }
}
