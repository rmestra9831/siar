@hasrole('Direccion')
@if ($radicado->state->recived_dir == false)
<div class="ui active top aligned dimmer">
  <div class="content">
    <h2 class="ui inverted header">Title</h2>
    <div class="ui primary button">Add</div>
    <div class="ui button">View</div>
  </div>
</div>    
@endif
@endhasrole