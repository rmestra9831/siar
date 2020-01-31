<div class="ui basic create_radic modal" style="position: sticky; height: auto;">
  <div class="ui icon header">
    <i class="question circle outline icon" style="font-size: 7em !important"></i>
    Creando nuevo Radicado # {{$number ?? ''}}-{{$name_sede ?? ''}}-{{$year ?? ''}}
  </div>
  <div class="text-center content">
    <p>¿Está seguro de crear este nuevo radicado?</p>
  </div>
  <div class="text-center actions">
    <div class="ui red basic cancel inverted button">
      <i class="remove icon"></i>
      No
    </div>
    <button form="create_radic" type="submit"  id="" class="ui green ok inverted button">
      <i class="checkmark icon"></i>
      Si
    </button>
  </div>
</div>