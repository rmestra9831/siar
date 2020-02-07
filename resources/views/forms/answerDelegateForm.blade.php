<div class="ui grid">
  <div class="five wide column">
    <div class="ui large buttons">
      <button id="answerRedirect" class="ui red active button">Redireccionar</button>
      <div class="or"></div>
      <button id="delegateAnswerUser" class="ui button">Responder</button>
    </div>
  </div>

  <div class="eleven wide column pl-4 as-center row">
    {{-- SELECT DE OPCIONES DE RESPUESTA --}}
    <div class="selectMulipleAnswer col">
      <form class="m-0" id="delegateAnswerForm" action="{{action('AnswerController@delegateAnswer', $radicado->slug)}}" method="post">
        @method('PUT') @csrf
        <select class="ui fluid dropdown" name="selectMulipleAnswer">
          <option value="">Sin opciones</option>
        </select>
      </form>
    </div>
    {{-- MOSTRANDO INPUT DE TEXTO O DE ARCHIVO SEGUN EL SELECT --}}
    <div class="typeAnswer col col-6">
      <div class="textAnswer"> {{--RESPUESTA DE TEXTO--}}
        <form class="w-100" id="AnswertextForm" method="POST" action="{{action('AnswerController@Answertext', $radicado->slug)}}">
          @method('PUT') @csrf
          <textarea rows="1" name="answer" disabled="" class="disabled" placeholder="Respuesta" spellcheck="false"data-gramm="false"></textarea>
        </form>
      </div>
      <div class="fileAnswer"> {{--RESPUESTA DE ARCHIVO--}}
        <div class="field">
          <form class="w-100" id="fileAnswerForm" method="POST" action="{{action('AnswerController@fileAnswer', $radicado->slug)}}"enctype="multipart/form-data">
            @method('PUT') @csrf
            <div class="ui labeled upload_radic input">
              <input class="@error('filePDF') is-invalid @enderror" type="text" id="fileAnswer" placeholder="Seleccionar" readonly>
              <input class="@error('filePDF') is-invalid @enderror" type="file" name="fileAnswer">
              <label class="ui label" for="uploadRadic">Cargar</label>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- BOTONES DE ENVIO DE RESPUESTA O DELEGADO --}}
    <div class="col">
      <div class="typeAnswer">
        <button  class="ui basic blue fluid button textAnswer btn"><i class="icon user"></i>Responder</button>
        <button  class="ui basic blue fluid button fileAnswer btn"><i class="icon user"></i>Responder</button>
      </div>
      <div class="btnFile">
        <button class="ui basic blue fluid button delegate btn"><i class="icon user"></i>Delegar</button>
      </div>
    </div>
  </div>
  
</div>