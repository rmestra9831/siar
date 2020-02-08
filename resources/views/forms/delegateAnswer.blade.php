<div class="ui horizontal divider"><i class="clock outline icon"></i> Delegado a {{$radicado->delegateId->name}} @if($radicado->delegateId->program) | {{$radicado->delegateId->program->name}} @endif </div>

@hasrole('Direccion')
  @if ($radicado->state->redirection)
    @include('components.cardRedirection')
  @else
    @if (!$radicado->state->answered)
      @include('common.waitingResponse') {{--MENSAJE DE ESPERA--}}
      @else
       @if ($radicado->answer_file) {{--VALIDA QUE TIPO DE RESPUESTA ES--}}
         La respuesta es un archivo
       @else
         la respuesta es texto
       @endif
       @if (!$radicado->state->answerEdit)
         <button class="ui pink button">Pink</button>     
       @endif
    @endif
  @endif
@endhasrole

@hasrole('Jef Programa')
@if ($radicado->state->answered)
    esta respondido
@else
  @if ($radicado->state->redirection)
    @include('common.waitingResponse')
  @else
    @include('forms.answerDelegateForm')
  @endif
@endif
@endhasrole

