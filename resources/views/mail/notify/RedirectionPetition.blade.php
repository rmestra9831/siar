@component('mail::message')
@component('mail::panel')
# Petición de redireccionamiento
@endcomponent
El/la Jefe de programa de <strong>{{$radicado->delegateId->name}}</strong> está pidiendo el redireccionamiento de este radicado (<strong>{{$radicado->consecutive}}</strong>)

# Razón
{{$radicado->redirect_txt}}

Por favor dar pronta respuesta a esta petición
@component('mail::button', ['url' => "http://".$url."/radicado/".$radicado->slug."/show"])
Ver radicado
@endcomponent

Gracias<br>
{{ config('app.name') }}
@endcomponent
