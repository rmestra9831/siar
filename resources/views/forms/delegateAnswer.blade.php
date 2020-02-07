<div class="ui horizontal divider"><i class="clock outline icon"></i> Delegado a {{$radicado->delegateId->name}} @if($radicado->delegateId->program) | {{$radicado->delegateId->program->name}} @endif </div>

@hasrole('Direccion')
  esto es lo que ve direccion
  @if (!$radicado->state->answered)
      No esta respodnido
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
@endhasrole

@hasrole('Jef Programa')
lo que ve el jefe de programa
@if ($radicado->state->answered)
    esta respondido
@else
  @include('forms.answerDelegateForm')
@endif
@endhasrole

