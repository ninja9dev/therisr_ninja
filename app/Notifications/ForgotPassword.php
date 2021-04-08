<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;

class ForgotPassword extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = User::where('email', $notifiable->getEmailForPasswordReset())->first();

        return (new MailMessage)
                ->greeting(''.@$user->name.',')
                ->line('Someone has requested a link to change your password. You can do this through the button below.')
                ->action('Change my password', route('password.reset', [
                                                'token' => $this->token,
                                                'email' => $notifiable->getEmailForPasswordReset(),
                                            ])
                        )
                ->line("If you didn't request this, please ignore this email. Your password won't change until you access the link above and create a new one.");
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
            //
        ];
    }
}
