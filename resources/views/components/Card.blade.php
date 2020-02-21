@if (count($radicados) > 0)
  @foreach ($radicados as $radicado)
    <div class="ui link cards justify-content-center">
      <div class="card w-85 mt-4 ">

        <div class="content">
          <div class="ui column row top attached label d-flex justify-content-between 
            @if(auth()->user()->hasRole('Super Admin') && $radicado->atention == 'Normal') bg-secundary @else bg-urgente @endif 
            @if(auth()->user()->hasRole('Admisiones') && $radicado->atention == 'Normal') bg-admissions @else bg-urgente @endif 
            @if(auth()->user()->hasRole('Direccion') && $radicado->atention == 'Normal') bg-direction @else bg-urgente @endif 
            @if(auth()->user()->hasRole('Jef Programa') && $radicado->atention == 'Normal') bg-jefprogram @else bg-urgente @endif 
            ">
            <strong class="h4 text-white m-0">{{$radicado->atention}}</strong>
            <strong class="h4 text-white m-0">{{$radicado->consecutive}}</strong>
          </div>
          <div class="ui grid centered pt-3">

            <div class="three column row p-0">
                <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">nombres:<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->first_name}}</p></strong></div>
                <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">apellidos:<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->last_name}}</p></strong></div>
                <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">correo: </strong><p class="ml-2 text-initial font-weight-light as-center">{{$radicado->origin_correo}}</p></div>
                <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">celular:</strong><p class="ml-2 text-initial font-weight-light as-center">{{$radicado->origin_cel}}</p></div>
                <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">programa:</strong><p class="ml-2 text-initial font-weight-light as-center">{{$radicado->program->name}}</p></div>
                <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">origen:</strong><p class="ml-2 text-initial font-weight-light as-center">{{$radicado->origin->origin_name}}</p></div>
            </div>

            <div class="ui divider"></div>
            <div class="four column row p-0">
                <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">destino<p class="ml-2 text-initial font-weight-light as-center">{{$radicado->destination->name}}</p></strong></div>
                <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">tipo<p class="ml-2 text-initial font-weight-light as-center">{{$radicado->type_reason}}</p></strong></div>
                <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">motivo<p class="ml-2 text-initial font-weight-light as-center">{{$radicado->reason->name}}</p></strong></div>
                <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex as-center">creado por:<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->createById->name}}</p></strong></div>
                <div class="left floated column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">asunto<p class="ml-2 text-initial font-weight-light as-center">{{$radicado->affair}}</p></strong></div>
                <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex as-center">delegado a:<p class="ml-2 text-initial font-weight-light as-center">@if(!$radicado->delegateId) No respondido @else {{$radicado->delegateId->name}} @endif</p></strong></div>
                <div class="right floated column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex as-center">respondido por:<p class="ml-2 text-initial font-weight-light as-center">@if(!$radicado->userAnswered) No respondido @else {{$radicado->userAnswered->name}} @endif</p></strong></div>
            </div>
            <div class="ui divider"></div>      
          </div>
        </div>

        <div class="extra content z-8">
          <div class="three ui buttons">
              @if (!$radicado->file)
                <a href="{{route('viewRadic',$radicado->slug)}}" class="ui green button"><i class="external alternate icon"></i> Mirar más...</a>  
                @else
                <a href="{{route('downloadRadic',$radicado->slug)}}" class="ui brown basic button"><i class="arrow alternate circle down outline icon"></i>Descargar</a>               
                <a href="{{route('viewRadic',$radicado->slug)}}" class="ui green button"><i class="external alternate icon"></i> Mirar más...</a>  
              @endif
          </div>
        </div>
        @include('common.dimmer') {{--EL MODAL EN NEGRO PARA RECIBIR EL RADICADO--}}
        <div class="states">@include('components.States')</div> {{--aqui se muestran los estados del radicado--}}
      </div>
    </div>
  @endforeach
@else
  <div class="ui big olive icon message"> {{--MENSAJE CUANDO NO HAY NINGUN RADICADO--}}
    <i class="frown outline icon"></i>
    <div class="content">
      <div class="header">
        No hemos encontrado ninguna información
      </div>
      <p>Al parecer no se han generado nuevas peticiones o radicados</p>
    </div>
  </div>
@endif
@section('foter')
<div class="container section_paginate">
  {{ $radicados->links() }}
</div>
@endsection
