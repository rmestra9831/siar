@if (!$radicado->date_sent_dir)
  <form id="sentDirForm" method="post" action="{{action('RadicadoController@sentDir', $radicado->slug)}}">@method('PUT') @csrf</form>
<button type="submit" form="sentDirForm" class="ui inverted green button"><i class="share icon"></i>Enviar a dirección</button>
@else
  @hasrole('Admisiones')
    <a href="" class="ui disabled green button"><i class="spinner loading icon"></i>Enviado a dirección</a>
  @endhasrole
@endif