@component('mail::message')
@component('mail::panel')
# Respuesta de petición
@endcomponent

La petición de redireccionamiento ha sido  @if($radicado->state->delegated == 1 ) <strong style="color: red">Denegada</strong> @else <strong style="color: green">Aceptada</strong> @endif

@if ($radicado->state->delegated == 1)
  @component('mail::button', ['url' => ''])
  Ver radicado
  @endcomponent
@else

@endif

Gracias<br>
{{ config('app.name') }}
@endcomponent
