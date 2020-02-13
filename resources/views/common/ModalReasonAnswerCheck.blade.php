<div class="ui modal reasonAnswerCheck" style="position: sticky; height: auto;">
  <i class="close icon"></i>
  <div class="header">
    Motivo de revisión
  </div>
  <div class="image content" style="height: inherit;">
    <div class="ui form description">
      <form class="m-auto" id="EditAnswerForm" action="{{action('AnswerController@EditAnswer', $radicado->slug)}} " method="POST">@method('PUT') @csrf
        <textarea id="answerReasonEdit" name="answerReasonEdit" value="" rows="2" placeholder="Motivo de modificación de la respeusta emitida"></textarea>
      </form>
    </div>
  </div>
  <div class="actions">
    <div id="EditAnswerFormSend" class="ui green button">Confirmar</div>
  </div>
</div>