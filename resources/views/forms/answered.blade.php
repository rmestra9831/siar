@hasrole('Direccion|Jef Programa')
<div class="ui horizontal divider"><i class="check icon"></i> Respondido</div>
<div class="ui centered pt-3 pb-3 grid ai-center">
  <strong>Respuesta con consecutivo {{$radicado->consecutiveAnswer}}</strong>
  @if ($radicado->answer_file)
    <a href="{{route('downloadAnswer',$radicado->slug)}}" class="ui blue button">Descargar respuesta</a>
  @else
    <textarea disabled="" class=" disabled w-25 mr-1" rows="1">{{$radicado->answer_text}}</textarea>
  @endif
  @hasrole('Direccion')
    @if (!$radicado->state->sentAdmissions)
      <button form="sentAdmissionsForm" class="ui purple button">Enviar a Admisiones</button>
      <form id="sentAdmissionsForm" action="{{action('RadicadoController@sentAdmissions', $radicado->slug)}} " method="POST">@method('PUT') @csrf</form>
    @endif
  @endhasrole
</div>
@endhasrole

@hasrole('Admisiones')
  @if ($radicado->state->sentAdmissions)
    <div class="ui horizontal divider"><i class="check icon"></i> Respondido</div>
    <div class="ui centered pt-3 pb-3 grid ai-center">
      <strong>Respuesta con consecutivo {{$radicado->consecutiveAnswer}}</strong>
      @if ($radicado->answer_file)
        <a href="{{route('downloadAnswer',$radicado->slug)}}" class="ui blue button">Descargar respuesta</a>
      @else
        <textarea disabled="" class=" disabled w-25 mr-1" rows="1">{{$radicado->answer_text}}</textarea>
      @endif
    </div>
  @else
    <div class="ui horizontal divider"><i class="wait outline icon"></i> Esperando envio</div> 
  @endif
@endhasrole