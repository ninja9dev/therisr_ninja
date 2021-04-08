<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangePassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $settings;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$settings)
    {
        $this->user = $user; // get global settings
        $this->settings = $settings;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->user->name;
        $email = $this->user->email;

        $appname = $this->settings->app_name ? $this->settings->app_name : config('app.name');

        $message  = '';
        $message .= "This is a confirmation that your ".$appname." password has just been changed. <br/> If you don't make this change, please reply to this email immediately.";

        return $this->replyTo($this->settings->email)
             ->cc('simranindiit@gmail.com', 'simran')
             ->Subject($appname.' password changed!')
             ->view('vendor.custom_mails.custom_mail')
             ->with([ 
                'type' => 'user_password_changed',
                'data' => $this->user,
                'button_text' => 'Login',
                'button_link' => url('/'), 
                'messagethis' => $message,
                'greetings' => ''. $name. ','
            ]); 
    }
}
