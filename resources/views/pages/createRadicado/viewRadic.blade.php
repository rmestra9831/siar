@extends('layouts.extructure')

{{-- vista del main --}}
@include('components.Main')

@section('title_content')
  datos de radicado
@endsection

@section('body_main')
    <div class="container h-100 d-flex">
      <div class="ui cards m-auto justify-content-center">
        <div class="card w-90 mt-4">
          <div class="ribbon">
            <span class="ribbon4 c-white text-uppercase font-weight-bolder
              @if(auth()->user()->hasRole('Super Admin') && $radicado->atention == 'Normal') bg-secundary @else bg-urgente @endif 
              @if(auth()->user()->hasRole('Admisiones') && $radicado->atention == 'Normal') bg-admissions @else bg-urgente @endif 
            ">{{$radicado->atention}}</span>
          </div>
          <div class="content">
            <div class="ui grid centered">
              
              <div class="column row p-0 pt-3">
                  <div class="column right floated right aligned ml-3 mr-3"><strong class="h4 text-white">{{$radicado->consecutive}}</strong></div>
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

          <div class="ui form extra content">
            @if (!$radicado->file)
              <div class="field">
                <div class="two fields">
                  <div class="field">
                    <div class="ui labeled upload_radic input">
                       <input type="text" id="uploadRadic" name="uploadRadic" placeholder="Seleccionar" readonly>
                       <input type="file">
                       <label class="ui label" for="uploadRadic">Cargar</label>
                    </div>
                  </div>
                  <div class="field">
                    <button class="ui blue inverted fluid button"><i class="cloud upload icon"></i>Subir Archivo</button>
                  </div>
                </div>
              </div>
            @else
              <div class="two ui buttons">      
                  <a href="" class="ui teal  basic button"><i class="eye icon"></i>Visualizar</button>
                  <a href="" class="ui brown basic button"><i class="arrow alternate circle down outline icon"></i>Descargar</a>
              </div>
            @endif

            <div class="ui horizontal divider"><i class="clock outline icon"></i> Fechas de Movimiento</div>
            <table class="ui
              @if(auth()->user()->hasRole('Admisiones') && $radicado->atention == 'Normal') b-admissions @else b-urgente @endif
              very compact table">
              <thead>
                <tr><th>Creado</th>
                <th>Env. dirección</th>
                <th>Rec. dirección</th>
                <th>Delegado</th>
                <th>Respondido</th>
                <th>Email env.</th>
                <th>Entregado</th>
              </tr></thead>
              <tbody>
                <tr>
                  <td>@if(!$radicado->date_creation) Null @else{{$radicado->date_creation}}@endif</td>
                  <td>@if(!$radicado->date_sent_dir) Null @else{{$radicado->date_sent_dir}}@endif</td>
                  <td>@if(!$radicado->date_get_dir) Null @else{{$radicado->date_get_dir}}@endif</td>
                  <td>@if(!$radicado->date_delegate) Null @else{{$radicado->date_delegate}}@endif</td>
                  <td>@if(!$radicado->date_answered) Null @else{{$radicado->date_answered}}@endif</td>
                  <td>@if(!$radicado->date_sent_mail) Null @else{{$radicado->date_sent_mail}}@endif</td>
                  <td>@if(!$radicado->date_delivered) Null @else{{$radicado->date_delivered}}@endif</td>
                </tr>
              </tbody>
            </table>
            <div class="ui horizontal divider"><i class="circle icon"></i><i class="circle outline icon"></i> Estados del Radicado <i class="circle outline icon"></i><i class="circle icon"></i></div>
            <table class="ui
            @if(auth()->user()->hasRole('Admisiones') && $radicado->atention == 'Normal') b-admissions @else b-urgente @endif
            very compact table">
            <thead>
              <th>Respondido</th>
              <th>Rec. Delegado</th>
              <th>Redireccionado</th>
              <th>Enviado a Aprovación</th>
              <th>Entregado</th>
            </tr></thead>
            <tbody>
              <tr>
                <td class="">@if($radicado->state->answered) <i class="large checkmark green icon"></i> @else<i class="large close red icon"></i>@endif</td>
                <td class="">@if($radicado->state->delegated) <i class="large checkmark green icon"></i> @else<i class="large close red icon"></i>@endif</td>
                <td class="">@if($radicado->state->redirection) <i class="large checkmark green icon"></i> @else<i class="large close red icon"></i>@endif</td>
                <td class="">@if($radicado->state->sent_to_check == true) <i class="large checkmark green icon"></i> @else<i class="large close red icon"></i>@endif</td>
                <td class="">@if($radicado->state->aproved == true) <i class="large checkmark green icon"></i> @else<i class="large close red icon"></i>@endif</td>
              </tr>
            </tbody>
          </table>

        </div>

        </div>
      </div>
    </div>
@endsection
