<div class="ui horizontal divider"><i class="clock outline icon"></i> Delegado a {{$radicado->delegateId->name}} @if($radicado->delegateId->program) | {{$radicado->delegateId->program->name}} @endif </div>

@hasrole('Direccion')
  @if($radicado->state->answered && $radicado->state->aproved)
    @include('forms.answered')
  @else
    @if ($radicado->state->redirection)
      @include('components.cardRedirection')
    @else
      <div class="ui centered pt-3 pb-3 grid ai-center">
        @if (!$radicado->state->answered)
          @include('common.waitingResponse') {{--MENSAJE DE ESPERA--}}
        @else
          @if($radicado->state->answerCheck == true)
            @include('common.waitingResponse') {{--MENSAJE DE ESPERA--}}
          @else
          @if ($radicado->answer_file) {{--VALIDA QUE TIPO DE RESPUESTA ES--}}
              La respuesta es un archivo <a href="{{route('downloadAnswer',$radicado->slug)}}" class="ui blue button">{{$radicado->consecutiveAnswer}}</a>
            @else
            <strong>Respuesta: </strong>
              <textarea disabled="" class=" disabled w-25 mr-1" rows="1">{{$radicado->answer_text}}</textarea>
            @endif
            @if (!$radicado->state->answerCheck )
              <button form="EditAnswerForm" class="ui pink button">Editar Respuesta</button>     
              <button form="aproveAnswerForm" class="ui green button">Aprobar</button>     
            @endif
          @endif
        @endif
      </div>
    @endif
  @endif
  {{-- FORMULARIOS --}}
  <form id="EditAnswerForm" action="{{action('AnswerController@EditAnswer', $radicado->slug)}} " method="POST">@method('PUT') @csrf</form>
  <form id="aproveAnswerForm" action="{{action('AnswerController@aproveAnswer', $radicado->slug)}} " method="POST">@method('PUT') @csrf</form>
@endhasrole

@hasrole('Jef Programa')
  @if($radicado->state->answered && $radicado->state->aproved) {{--SI LA RESPUESTA ESTA APROVADA --}}
    @include('forms.answered')
  @else
    @if($radicado->state->answerCheck)
      @if ($radicado->state->redirection)
        @include('common.waitingResponse') {{--MENSAJE DE ESPERA--}}  
      @else
        <div class="ui centered pt-3 grid ai-center">
          <strong>Editar Respuesta</strong>
          @if ($radicado->answer_file) {{--VERIFICANDO EL TIPO DE RESPUESTA--}}
            <a href="{{route('downloadAnswer',$radicado->slug)}}" class="ui blue button">Descargar respuesta</a>     
          @else
            <textarea disabled="" class=" disabled w-25 mr-1" rows="1">{{$radicado->answer_text}}</textarea>
          @endif
        </div>
        @include('forms.answerDelegateForm')
      @endif
    @else
      @if ($radicado->state->answered)
        @if (!$radicado->state->aproved)
          @include('common.waitingResponse') {{--MENSAJE DE ESPERA--}}  
        @endif  
      @else
        @if ($radicado->state->redirection)
          @include('common.waitingResponse')
        @else
          @include('forms.answerDelegateForm')
        @endif
      @endif
    @endif
  @endif
@endhasrole

