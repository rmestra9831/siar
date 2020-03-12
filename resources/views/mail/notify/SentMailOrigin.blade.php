@component('mail::message')
@component('mail::panel')
# Respuesta a Radicado #{{$radicado->consecutive}} @if($radicado->atention == 'Urgente') <strong style="color: red;">(URGENTE)</strong> @endif
@endcomponent
Le informamos que en atención a su comunicación recibida el día ({{$radicado->created_at}}) con radicado N° <strong>{{$radicado->consecutive}}</strong>, la respuesta la puede solicitar en la oficina de admisiones y registro.<br>
Los horarios de atención son:<br><br>
Lunes a viernes de 8:00am a 12:00m y 2:00pm a 6:15pm<br>
Sábados de 8:00am a 12:00m.<br><br>
En caso de no reclamo dentro de los 5 días siguientes de este llamado, entenderemos que acoge la(s) decisión(es) emitida y será archivada en su hoja de vida académica.<br>

Cordial saludo,<br>

Dirección Sede
{{ $radicado->sede->name }}

Gracias.<br>
@endcomponent
