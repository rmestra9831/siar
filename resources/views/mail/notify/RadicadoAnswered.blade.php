@component('mail::message')
@component('mail::panel')
# Respuesta a radicado {{$radicado->consecutive}}
@endcomponent

@if ($radicado->state->answerCheck)
  Se ha emitido una solicitud de modificación de la respuesta con N.° de consecutivo <strong>{{$radicado->consecutiveAnswer}}</strong>, del radicado <strong>{{$radicado->consecutive}}</strong> delegado a <strong>{{$radicado->delegateId->name}}</strong>
@else
  Se ha emitido la respuesta con N.° de consecutivo <strong>{{$radicado->consecutiveAnswer}}</strong>, del radicado <strong>{{$radicado->consecutive}}</strong> delegado a <strong>{{$radicado->delegateId->name}}</strong>
@endif

@if ($radicado->state->sentAdmissions)
  Haga entrega de este radicado a su radicador 
@else
  Por favor revisar esta respuesta para su pronta confirmación
@endif
@component('mail::button', ['url' => "http://".$url."/radicado/".$radicado->slug."/show"])
Ver Radicado
@endcomponent

Gracias <br>
{{ config('app.name') }}
@endcomponent
