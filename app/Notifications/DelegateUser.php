<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DelegateUser extends Notification implements ShouldQueue
{
    use Queueable;
    public $data;
    public $url;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $url)
    {
        $this->data = $data;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $radicado = $this->data;
        $url = $this->url;
        return (new MailMessage)->markdown('mail/notify/DelegateUser', compact('radicado','url'))
                    ->subject('Nuevo Radicado '.$radicado->consecutive.' ( '.$radicado->atention.' )');
    }

    public function toDatabase($notifiable){
        $state = $this->data['state'];
        $delegate = $this->data['delegateId'];
        $url = $this->url;
        return [
            'title' => 'Responder radicado #'.$this->data->consecutive,
            'affair' => 'Se le ha delegado un nuevo radicado',
            'url' => $this->data->slug,
        ];
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
