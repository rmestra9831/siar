@extends('layouts.extructure')
@section('title','Radicado')
{{-- vista del main --}}
@include('components.Main')

@section('title_content')
  datos de radicado
@endsection
@section('body_main')
    <div class="container h-100 d-flex">
      <div class="ui cards m-auto justify-content-center">
        @if ($radicado->reasonAnswerCheck && auth()->user()->hasrole('Jef Programa|Aux Direccion')) @include('common.InfoReasonEdit') @endif {{--Mensaje de modificacion--}}
        <div class="card w-90 mt-4">
         
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
                  <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">correo: </strong><p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->origin_correo}}</p></div>
                  <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">celular:</strong><p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->origin_cel}}</p></div>
                  <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">programa:</strong><p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->program->name}}</p></div>
                  <div class="column d-inline-flex text-truncate"><strong class="text-uppercase d-flex">origen:</strong><p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->origin->origin_name}}</p></div>
              </div>
              
              <div class="ui divider"></div>
              <div class="four column row p-0">
                  <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">destino<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->destination->name}}</p></strong></div>
                  <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">tipo<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->type_reason}}</p></strong></div>
                  <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">motivo<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->reason->name}}</p></strong></div>
                  <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex as-center">creado por:<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->createById->name}}</p></strong></div>
                  <div class="left floated column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex ">asunto<p class="ml-2 text-capitalize font-weight-light as-center">{{$radicado->affair}}</p></strong></div>
                  <div class="column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex as-center">delegado a:<p class="ml-2 text-capitalize font-weight-light as-center">@if(!$radicado->delegateId) No respondido @else {{$radicado->delegateId->name}} @endif</p></strong></div>
                  <div class="right floated column d-inline-flex text-truncate"><strong data-tooltip="Agregar" data-position="top center" class="text-uppercase d-flex as-center">respondido por:<p class="ml-2 text-capitalize font-weight-light as-center">@if(!$radicado->userAnswered) No respondido @else {{$radicado->userAnswered->name}} @endif</p></strong></div>
              </div>              
              <div class="ui divider"></div> 
              <div class="ui form pt-0 column row ">
                <div class="right floated column  text-truncate">
                  <strong data-tooltip="Agregar" data-position="top center" class="text-uppercase justify-content-center d-flex ">notas / observaciones</strong>
                  <textarea disabled class="" rows="2" name="note" placeholder="@if(!$radicado->notes) Sin notas @endif" spellcheck="false" data-gramm="false">@if($radicado->notes) {{$radicado->notes}} @endif</textarea> 
                </div>  
              </div>  

            </div>
          </div>
          <div class="ui form extra content">
            @include('forms.uploadFile') {{--BOTONES DE DESCARGAR - VISAULIZAR--}}

            @if ($radicado->delegate_id)  {{--ESTADOS DEL RADICADO, PARA VER SI FUE RESPONDIDO O NO--}}
              @include('forms.delegateAnswer')
            @else
              @if (!$radicado->delegate_id)          
                @if ($radicado->answered_id && $radicado->state->aproved)
                  @include('forms.answered')
                @else
                  @if($radicado->file && $radicado->date_sent_dir != false ||$radicado->date_sent_dir == false) <div class="ui horizontal divider"><i class="clock outline icon"></i> Acciones</div> @endif
                  @include('forms.delegateForm')
                @endif
              @endif
            @endif
            
            {{--TABLAS--}}
            <div class="ui horizontal divider"><i class="calendar alternate outline icon"></i> Fechas de Movimiento</div>
              <table class="ui
                @if(auth()->user()->hasRole('Admisiones') && $radicado->atention == 'Normal') b-admissions @else b-urgente @endif
                very compact table">
                <thead>
                  <tr><th>Creado</th>
                  <th>Enviado a Dirección</th>
                  <th>Recivido en Dirección</th>
                  <th>Delegado</th>
                  <th>Petición de Redirección</th>
                  <th>Respuesta de Redirección</th>
                  <th>Respondido</th>
                  <th>Email enviado</th>
                  <th>Entregado</th>
                </tr></thead>
                <tbody>
                  <tr>
                    <td>@if(!$radicado->date_creation) N/a @else{{$radicado->date_creation}}@endif</td>
                    <td>@if(!$radicado->date_sent_dir) N/a @else{{$radicado->date_sent_dir}}@endif</td>
                    <td>@if(!$radicado->date_get_dir) N/a @else{{$radicado->date_get_dir}}@endif</td>
                    <td>@if(!$radicado->date_delegate) N/a @else{{$radicado->date_delegate}}@endif</td>
                    <td>@if(!$radicado->date_petition_redirection) N/a @else{{$radicado->date_delegate}}@endif</td>
                    <td>@if(!$radicado->date_update_redirection) N/a @else{{$radicado->date_delegate}}@endif</td>
                    <td>@if(!$radicado->date_answered) N/a @else{{$radicado->date_answered}}@endif</td>
                    <td>@if(!$radicado->date_sent_mail) N/a @else{{$radicado->date_sent_mail}}@endif</td>
                    <td>@if(!$radicado->date_delivered) N/a @else{{$radicado->date_delivered}}@endif</td>
                  </tr>
                </tbody>
              </table>
            <div class="ui horizontal divider"><i class="circle icon"></i><i class="circle outline icon"></i> Estados del Radicado <i class="circle outline icon"></i><i class="circle icon"></i></div>
            <table class="ui
              @if(auth()->user()->hasRole('Admisiones') && $radicado->atention == 'Normal') b-admissions @else b-urgente @endif
              very compact table">
              <thead>
                <th>Delegado</th>
                <th>Petición de Redirección</th>
                <th>Revisar Respuesta</th>
                <th>Respondido</th>
                <th>Aprobado</th>
              </tr></thead>
              <tbody>
                <tr>
                  <td class="">@if($radicado->state->delegated) <i class="large checkmark green icon"></i> @else<i class="large close red icon"></i>@endif</td>
                  <td class="">@if($radicado->state->redirection) <i class="large checkmark green icon"></i> @else<i class="large close red icon"></i>@endif</td>
                  <td class="">@if($radicado->state->answerCheck) <i class="large checkmark green icon"></i> @else<i class="large close red icon"></i>@endif</td>
                  <td class="">@if($radicado->state->answered) <i class="large checkmark green icon"></i> @else<i class="large close red icon"></i>@endif</td>
                  <td class="">@if($radicado->state->aproved == true) <i class="large checkmark green icon"></i> @else<i class="large close red icon"></i>@endif</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    @include('common.ModalPreview')
    @hasrole('Direccion')@include('common.ModalReasonAnswerCheck') @endhasrole
@endsection
