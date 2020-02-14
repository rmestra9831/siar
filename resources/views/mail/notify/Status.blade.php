@component('mail::message')
@component('mail::panel')
# Respuesta aprobada #{{$radicado->consecutive}}
@endcomponent
La respuesta fue emitida correctamente con consecutivo de respuesta <strong>{{$radicado->consecutiveAnswer}}</strong>

Prontamente será enviada a Admisiones y Registro para su respectiva entrega
@component('mail::button', ["url" => "http://".$url."/home"])
Ver radicado
@endcomponent

Gracias.<br>
{{ config('app.name') }}
@endcomponent
