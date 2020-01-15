<form method="POST" action=" " style="margin: auto 5%;">
    @csrf
    <div class="form-group row">
        <div class="col">
            <input autocomplete="off" id="name" placeholder="Nombre del Programa" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col">
            <input autocomplete="off" id="correo_director" placeholder="Correo del Programa" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="correo_director" value="{{ old('name') }}" required autocomplete="off" autofocus>
        </div>
        <div class="col">
            <select name="sede" id="sede" class="form-control form-control-sm text-capitalize">
                <option>Seleccióna la sede</option>
                @foreach ($sedes as $sede)
                <option  class="text-capitalize" id="motivo_select_op" value="{{$sede->id}}" >{{$sede->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-outline-secondary btn-sm btn-block">
                {{ __('Registrar') }}
            </button>
        </div>
    </div>
</form>