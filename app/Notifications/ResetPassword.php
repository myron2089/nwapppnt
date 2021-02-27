<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    //https://ffontanesf.es/laravel-14-recuperacion-contrasena-password-recovery/
    //https://medium.com/@adnanxteam/how-to-customize-laravel-5-4-notification-email-templates-header-and-footer-158b1c7cc1c

    public $user;

    public function __construct($user)
    {
        //
        //$this->actionUrl = action('Auth\ResetPasswordController@showResetForm',$token);
        $this->user = $user;
    }

    public $actionUrl;

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
       // dd("tomail");
         /*return (new MailMessage)
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $this->actionUrl)
            ->line('If you did not request a password reset, no further action is required.');

            */



            
            return (new MailMessage)
            ->from('info@sometimes-it-wont-work.com', 'Admin')
            ->subject('Welcome to the the Portal')
            ->markdown('emails.password-reset-email', ['user' => $this->user]);


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
