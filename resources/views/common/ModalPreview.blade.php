<div class="ui modal previewPdf" style="position: sticky; height: 84%;">
  <i class="close icon"></i>
  <div class="header">
    Radicado {{$radicado->consecutive ?? ''}}
  </div>
  <div class="image content" style="height: inherit;">
    <div class="description">
      <iframe class="w-100 h-100" src="{{Storage::url($radicado->file ?? '')}}" frameborder="0"></iframe>
    </div>
  </div>
  <div class="actions">
    <div class="ui cancel button">OK</div>
  </div>
</div>