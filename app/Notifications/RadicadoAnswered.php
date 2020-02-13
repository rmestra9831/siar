<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RadicadoAnswered extends Notification implements ShouldQueue
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
        return (new MailMessage)->markdown('mail/notify/RadicadoAnswered', compact('radicado','url'))
                    ->subject('Respuesta emitida '.$radicado->consecutiveAnswer.' ( '.$radicado->atention.' )');
    }

    public function toDatabase($notifiable){
        $state = $this->data['state'];
        $delegate = $this->data['delegateId'];
        if ($state->answerCheck) {
            return [
                'title' => 'Modificación de Radicado'.$this->data->consecutive ,
                'affair' => 'debe modificar el radicado '.$this->data->consecutive,
                'url' => $this->data->slug,
            ];
        }else{
            return [
                'title' => 'Respuesta al Radicado '.$this->data->consecutive,
                'affair' => $delegate->name.' a emitido una respuesta',
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
        ];
    }
}
