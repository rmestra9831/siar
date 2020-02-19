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
              @if (!$radicado->state->answered) <a class="ui basic brown fluid button" href="{{action('RadicadoController@downloadTemplateWord',$radicado->slug)}}">formato</a> @endif
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-8 redirectAnswer"> {{--REDIRECCIONAMIENTO--}}
        <form class="w-100" id="redirectAnswer" method="POST" action="{{action('AnswerController@redirectionAnswerPetition', $radicado->slug)}}">
          @method('PUT') @csrf
          <textarea rows="1" name="redirectAnswer" placeholder="Redirección" spellcheck="false"data-gramm="false"></textarea>
        </form>
    </div>
    {{-- BOTONES DE ENVIO DE RESPUESTA O DELEGADO --}}
    <div class="col">
      <div class="typeAnswer">
        <button  class="ui basic blue fluid button textAnswer btn"><i class="i cursor icon"></i>Responder</button>
        <button  class="ui basic blue fluid button fileAnswer btn"><i class="i cursor icon"></i>Responder</button>
      </div>
      <div class="btnFile">
        <button class="ui basic blue fluid button delegate btn"><i class="share icon"></i>Delegar</button>
      </div>
      <div class="redirectAnswer">
        <button class="ui basic blue fluid button redirect btn"><i class="reply icon"></i>Continuar</button>
      </div>
    </div>
  </div>
  
</div>