@hasrole('Admisiones')
  @if($radicado->date_sent_dir && $radicado->state->aproved == false) 
    <i class="spinner massive loading icon"></i>
  @endif
  @if($radicado->state->aproved && $radicado->state->answered && !$radicado->state->sentAdmissions) 
    <i class="spinner massive loading icon"></i>
  @endif
  @if ($radicado->state->aproved && $radicado->state->answered && $radicado->state->sentAdmissions)
    <i class="check massive circle outline icon"></i>
  @endif
@endhasrole

@hasrole('Direccion')
  @if ($radicado->state->aproved && $radicado->state->answered && $radicado->state->sentAdmissions)
    <i class="check massive circle outline icon"></i>
  @endif
  @if ($radicado->state->delegated && !$radicado->state->answered && $radicado->state->redirection == false)
    <i class="spinner massive loading icon"></i>
  @endif
  @if ($radicado->state->answered && $radicado->state->aproved == false && !$radicado->state->answerCheck)
    <i class="eye massive icon"></i>
  @endif
  @if ($radicado->state->answered && $radicado->state->aproved == false && $radicado->state->answerCheck)
    <i class="spinner massive loading icon"></i>
  @endif
  @if (!$radicado->state->sentAdmissions && $radicado->state->aproved == true)
    <i class="share massive icon"></i>
  @endif
  @if ($radicado->state->delegated && !$radicado->state->answered && $radicado->state->redirection == true)
    <i class="info circle massive icon"></i>
  @endif
@endhasrole

@hasrole('Jef Programa')
  @if ($radicado->state->aproved && $radicado->state->answered)
    <i class="check massive circle outline icon"></i>
  @endif
  @if (!$radicado->state->aproved && $radicado->state->answerCheck && $radicado->consecutiveAnswer) {{--spinner entrega--}}
    <i class="spinner massive loading icon"></i>
  @endif
  @if ($radicado->state->answered && !$radicado->state->answerCheck && $radicado->consecutiveAnswer ) {{--spinner entrega--}}
    <i class="spinner massive loading icon"></i>
  @endif
  @if ($radicado->state->answered && $radicado->state->answerCheck) {{--oculto hasta que tenga que modificar--}}
    <i class="info circle massive icon"></i>
  @endif
  @if ($radicado->state->delegated && !$radicado->state->answered && $radicado->state->redirection == false )
    <i class="edit massive icon"></i>
  @endif
@endhasrole