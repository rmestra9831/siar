<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedirectionRespon extends Notification implements ShouldQueue
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
        return (new MailMessage)->markdown('mail/notify/RedirectionRespon', compact('radicado','url'))
                    ->subject('Petición de Redireccionamiento '.$radicado->consecutive.' ( '.$radicado->atention.' )');
    }

    public function toDatabase($notifiable){
        $delegate = $this->data['delegateId'];
        $stateDelegate = $this->data['state'];
        if (!$stateDelegate->delegated) {
            return [
                'title' => 'Redirección aceptada',
                'affair' => 'Se ha revocado este radicado de su poder',
                'url' => $this->data->slug,
            ];
        }else{
            return [
                'title' => 'Redirección Denegada',
                'affair' => 'Debe responder a este radicado',
                'url' => $this->data->slug,
            ];
        }
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
