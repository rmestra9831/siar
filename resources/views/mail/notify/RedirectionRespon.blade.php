@component('mail::message')
@component('mail::panel')
# Respuesta de petición
@endcomponent

La petición de redireccionamiento del radicado <strong>{{$radicado->consecutive}}</strong> ha sido  @if($radicado->state->delegated == 1 ) <strong style="color: red">Denegada</strong> @else <strong style="color: green">Aceptada</strong> @endif

@if ($radicado->state->delegated == 1)
  @component('mail::button', ['url' => "http://".$url."/radicado/".$radicado->slug."/show"])
  Ver radicado
  @endcomponent
@else

@endif

Gracias<br>
{{ config('app.name') }}
@endcomponent
