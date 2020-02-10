<div class="ui cards justify-content-center">
  <div class="card w-50">
    <div class="content">
      <div class="header">
        Petición de redirección
      </div>
      <div class="description"><strong>{{$radicado->delegateId->name}} </strong> está solicitando una redirección
      <p><strong>Motivo: </strong> {{$radicado->redirect_txt}} </p>
      </div>
    </div>
    <div class="extra content">
      <div class="ui two buttons">
        <form class="w-100" id="refuseRedirectionForm" method="POST" action="{{action('AnswerController@refuseRedirection', $radicado->slug)}}"> @method('PUT') @csrf</form>
        <form class="w-100" id="acceptRedirectionForm" method="POST" action="{{action('AnswerController@acceptRedirection', $radicado->slug)}}"> @method('PUT') @csrf</form>
        <div class="ui basic red refuseRedirection button">Rechazar</div>
        <div class="ui basic green acceptRedirection button">Aprovar</div>
      </div>
    </div>
  </div>
</div>