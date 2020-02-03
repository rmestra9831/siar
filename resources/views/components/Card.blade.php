@foreach ($radicados as $radicado)
<div class="ui cards justify-content-center">
  <div class="card w-85 mt-4">
        <div class="ribbon">
          <span class="ribbon4">Скидка 10%</span>
        </div>
        <div class="content">
          <div class="ui grid centered">
            
            <div class="column row p-0 pt-3">
              <div class="column right floated right aligned ml-3 mr-3"><strong class="h3 text-white">{{$radicado->consecutive}}</strong></div>
            </div>
            
            <div class="ui divider"></div>
            <div class="three column row p-0">
              <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">nombres:<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->first_name}}</p></strong></div>
              <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">apellidos:<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->last_name}}</p></strong></div>
              <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">correo: </strong><p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->origin_correo}}</p></div>
              <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">celular:</strong><p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->origin_cel}}</p></div>
              <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">programa:</strong><p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->program->name}}</p></div>
              <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">origen:</strong><p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->origin->origin_name}}</p></div>
            </div>
            
            <div class="ui divider"></div>
            <div class="three column row p-0">
              <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">destino<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->destination->name}}</p></strong></div>
              <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">tipo<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->type_reason}}</p></strong></div>
              <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">motivo<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->reason->name}}</p></strong></div>
              <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex as-center">creado por:<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->createById->name}}</p></strong></div>
              <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">asunto<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->affair}}</p></strong></div>
              <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex as-center">respondido por:<p class="ml-2 text-capitalize font-weight-light as-center">@if(!$radicado->delegateId) No respondido @else {{$radicado->delegateId->name}} @endif</p></strong></div>
            </div>
            <div class="ui divider"></div>
            
          </div>
        </div>
        
        <div class="extra content">
          <div class="three ui buttons">
            <button class="ui teal  basic button"><i class="eye icon"></i>Visualizar</button>
            <button class="ui brown basic button"><i class="arrow alternate circle down outline icon"></i>Descargar</button>
            <button class="ui green button"><i class="external alternate icon"></i> Mirar más...</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach