<div class="ui teal w-50 m-auto icon message">
  <i class="notched circle loading icon"></i>
  <div class="content">
    <div class="header">
      @if ($radicado->state->answered && $radicado->state->aproved == false)
        Esperando Aprovación
      @else
        Esperando respuesta
      @endif
    </div>
  </div>
</div>