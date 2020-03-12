@if (!$radicado->date_sent_dir)
  <form id="sentDirForm" method="post" action="{{action('RadicadoController@sentDir', $radicado->slug)}}">@method('PUT') @csrf</form>
<button type="submit" form="sentDirForm" class="ui inverted green button"><i class="share icon"></i>Enviar a dirección</button>
@else
  @hasrole('Admisiones')
    @if (!$radicado->state->sentAdmissions)
      <a href="" class="ui disabled green button"><i class="spinner loading icon"></i>Enviado a dirección</a>
    @else
      <button name="{{ $radicado->slug }}" class="ui blue button FinalState @if($radicado->date_delivered) disabled @endif ">@if($radicado->date_delivered)<i class="check icon"></i> Entregado @else <i class="share icon"></i> Entregar @endif</button  >
      <a hidden href="{{route('sentMailDeliveredView', $radicado->slug)}}" class="sentMailDeliveredView ui brown basic button"><i class="arrow alternate circle down outline icon"></i></a>               
    @endif
  @endhasrole
@endif