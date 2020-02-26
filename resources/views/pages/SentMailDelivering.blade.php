@extends('layouts.extructure')

{{-- vista del main --}}
@include('components.Main')
@section('title','Entrega')
@section('title_content')
  Entrega final
@endsection

@section('body_main')
  <div class="container h-100 d-flex">
    <div class="ui cards m-auto w-75">
      <div class="card w-100">
        <div class="content">
          <div class="header">Correo a <strong class="text-uppercase">{{ $radicado->first_name }} {{ $radicado->last_name }}</strong> <em>( {{ $radicado->origin_correo }} )</em> </div>
          <div class="description">
            Le informamos que en atención a su comunicación recibida el día ({{$radicado->created_at}}) con radicado N° <strong>{{$radicado->consecutive}}</strong>, la respuesta la puede solicitar en la oficina de admisiones y registro.<br>
            Los horarios de atención son:<br><br>
            Lunes a viernes de 8:00am a 12:00m y 2:00pm a 6:15pm<br>
            Sábados de 8:00am a 12:00m.<br><br>
            En caso de no reclamo dentro de los 5 días siguientes de este llamado, entenderemos que acoge la(s) decisión(es) emitida y será archivada en su hoja de vida académica.<br>
            
            Cordial saludo,<br>
            
            Dirección Sede
            {{ $radicado->sede->name }}
          </div>
        </div>
        <div class="two ui buttons">
          <a href="" class="ui green button"><i class="external alternate icon"></i>Enviar correo</a>  
      </div>
      </div>
    </div>
  </div>
@endsection