<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DepositSuccessful extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $amount;

    public function __construct($amount)
    {
        //
        $this->amount=$amount;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $url = url('/home');
        return (new MailMessage)
                    ->greeting('Hello,')
                    ->line('Thank you for your interest in the Backend Developer position.')
                    ->line('Your application with ID '.$this->amount.' was received and processed successfully.')

                    // ->action('View dashboard', url('/home'))
                    ->line('If you are interested in the Backend Developer position, please respond to this email with your CV attached.')
                    ->line('Thank you for your interest in the job');
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'data' =>' Your deposit of '. $this->amount.' was successful'
        ];
    }



}
