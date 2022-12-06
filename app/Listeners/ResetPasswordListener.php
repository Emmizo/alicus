<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ResetPasswordEvent;
use Illuminate\Auth\Passwords\PasswordBroker;
use App\Mail\ResetPasswordEventMail;
use App\Models\User;

class ResetPasswordListener
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
    public function handle(ResetPasswordEvent $event)
    {
        //
        $email=$event->email;
        $user=User::where('email',$email)->first();
        // if($user->account_verified==1)
        // {
        $mails = array($email);
        //password reset mail
        $subject = "Reset password";
        $token = app(PasswordBroker::class)->createToken(User::where('email', $email)->first());
        $info['name']=$user->name;
        $info['tokenUrl'] = url('/reset-password/'.$token.'?email='.$email);
        \Mail::to($mails)->send(new ResetPasswordEventMail($subject, $info));
        
    }
}
