<?php

namespace App\Listeners;

use App\Mail\ChangePassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use  App\Models\Settings;
class SendPasswordResetEmail
{
    /**
     * Handle the event.
     *
     * @param  PasswordReset  $event
     *
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        $user = $event->user;
        $settings = Settings::first();
        // send email to user 
          try{
              Mail::to($user->email)
                    ->send(new ChangePassword($user, $settings));
          }
          catch(\Exception $e){
              // Never reached
          }
    }
}