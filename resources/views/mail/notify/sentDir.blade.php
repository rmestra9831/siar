@component('mail::message')
@component('mail::panel')
# Nuevo radicado #{{$radicado->consecutive}} @if($radicado->atention == 'Urgente') <strong style="color: red;">(URGENTE)</strong> @endif
@endcomponent
Se a generado un nuevo radicado con caracter {{$radicado->atention}} de <em style="text-transform: capitalize;">{{$radicado->first_name}} {{$radicado->last_name}}</em>

El tiempo de respuesta es de maximo 3 dìas a partir recibido este correo
@component('mail::button', ["url" => "http://".$url."/home"])
Ver radicado
@endcomponent

Gracias.<br>
{{ config('app.name') }}
@endcomponent
