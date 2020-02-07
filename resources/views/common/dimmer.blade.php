@hasrole('Direccion')
@if ($radicado->state->recived_dir == false)
<div class="ui active top aligned dimmer justify-content-center">
  <div class="content">
    <h2 class="ui inverted header">Recibir Radicado {{$radicado->consecutive}} </h2>
    <form id="getDir" action="{{action('RadicadoController@getDir', $radicado->slug)}}" method="post">@method('PUT') @csrf</form>
    <button type="submit" form="getDir" id="{{$radicado->slug}}" class="ui primary getDirection button">Recibir</button type="submit">
    <div class="ui button">View</div>
  </div>
</div>    
@endif
@endhasrole