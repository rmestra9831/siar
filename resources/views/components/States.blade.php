@hasrole('Admisiones')
  @if($radicado->date_sent_dir && $radicado->state->aproved == false) 
    <i class="spinner massive loading icon"></i>
  @endif
  @if ($radicado->state->aproved && $radicado->state->answered)
    <i class="check massive circle outline icon"></i>
  @endif
@endhasrole

@hasrole('Direccion')
  @if ($radicado->state->aproved && $radicado->state->answered)
    <i class="check massive circle outline icon"></i>
  @endif
  @if ($radicado->state->delegated && !$radicado->state->answered && $radicado->state->redirection == false)
    <i class="spinner massive loading icon"></i>
  @endif
  @if ($radicado->state->delegated && !$radicado->state->answered && $radicado->state->redirection == true)
    <i class="info circle massive icon"></i>
  @endif
@endhasrole