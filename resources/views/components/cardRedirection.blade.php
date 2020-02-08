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
        <div class="ui basic red button">Rechazar</div>
        <div class="ui basic green button">Aprovar</div>
      </div>
    </div>
  </div>
</div>