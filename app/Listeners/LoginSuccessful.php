<?php

namespace App\Listeners;

use IlluminateAuthEventsLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Login;
class LoginSuccessful
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
     * @param  \IlluminateAuthEventsLogin  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();

        $userinfo = $event->user;

        $saveHistory = DB::table('users')->where('id',\Auth::user()->id)->update(['created_at'=>date('Y/m/d H:i:s')]);
        return $saveHistory;
    }
}
