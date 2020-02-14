<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedirectionPetition extends Notification implements ShouldQueue
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
        return (new MailMessage)->markdown('mail/notify/RedirectionPetition', compact('radicado','url'))
                    ->subject('Petición de Redireccionamiento '.$radicado->consecutive.' ( '.$radicado->atention.' )');
    }

    public function toDatabase($notifiable){
        $delegate = $this->data['delegateId'];
        return [
            'title' => 'Petición de redirección a radicado '.$this->data->consecutive,
            'affair' => $delegate->name.' esta solcitiando una redirección',
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
