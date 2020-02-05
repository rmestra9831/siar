@if (!$radicado->file)
<div class="field">
  <div class="two fields">
    <div class="field">
      <form class="w-100" id="uploadFile" method="POST" action="{{action('RadicadoController@uploadFile', $radicado->slug)}}"
        enctype="multipart/form-data">
        @method('PUT') @csrf
        <div class="ui labeled upload_radic input">
          <input class="@error('filePDF') is-invalid @enderror" type="text" id="uploadRadic" placeholder="Seleccionar" readonly>
          <input class="@error('filePDF') is-invalid @enderror" type="file" name="uploadRadic">
          <label class="ui label" for="uploadRadic">Cargar</label>
        </div>
      </form>
    </div>
    <div class="field">
      <button type="submit" form="uploadFile" class="ui blue inverted fluid button"><i class="cloud upload icon"></i>Subir
        Archivo</button>
    </div>
  </div>
  @if ($errors->has('uploadRadic'))<p>@include('common.denegado')</p>@endif {{--notificacion de error de subida--}}
</div>
@else
  @include('common.success') {{--NOTIFICACION DE ARCHIVO SUBIDO--}}
<div class="three ui buttons">
    <a href="" class="ui teal  basic button"><i class="eye icon"></i>Visualizar</a>
    <a href="{{route('downloadRadic',$radicado->slug)}}" class="ui brown basic button"><i class="arrow alternate circle down outline icon"></i>Descargar</a>
    @include('forms.sendToDirection')
</div>
@endif


{{-- <form method="POST" action="{{action('RegctrolController@uploadPDF', $radicado->slug)}}"
enctype="multipart/form-data">
@method('PUT') @csrf
<div class="row" style="margin-left: 5px">
  <div class="col-7">
    <input name="filePDF" type="file" class="custom-file-input @error('filePDF') is-invalid @enderror"
      id="customFileLang" lang="es">
    <label class="custom-file-label col-form-label col-form-label-sm text-truncate" for="customFileLang"
      data-browse="Cargar">Archivo</label>
  </div>
  <div class="col-1">
    <button class="btn btn-outline-success" type="submit"><i class="far fa-file-pdf"></i> Cargar</button>
  </div>
</div>
</form> --}}