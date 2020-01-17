@extends('layouts.extructure')

{{-- vista del main --}}
@include('components.Main')

@section('title_content')
  sedes
@endsection

@section('body_main')
  <div class="container">
    {{-- tabla e muestra de usuarios --}}
      <table id="table-sedes" class="ui single line celled table">
        <thead>
          <tr>
            <th class="ui center aligned">Sede</th>
            <th class="ui center aligned">Contadores</th>
            <th class="ui center aligned justify-content-center"style="width: 20%;" >Acción</th>
          </tr>
        </thead>
      </table>
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      $('#table-sedes').DataTable({
          "scrollCollapse": true,
          "ajax": "{{ route('getSede') }}",
          "columns": [
              {data: 'name'},
              {data: 'cont_radic'},
              {data: 'action'},
          ],
          "language": {
            "info":"_TOTAL_ Registros",
            "search": "Buscar",
            "paginate":{
              "next": "Siguiente",
              "previous": "Anterior",
            },
            "lengthMenu": 'Mostrar <select class="ui compact selection dropdown">'+
                          '<option value="5">5</option>'+
                          '<option value="10">10</option>'+
                          '<option value="-1">Todos</option>'+
                          '</select> registros',
            "loadingRecords": "Cargando...",
            "Processing": "Procesando...",
            "emptyTable": "No se encontraron datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmpty": "",
            "infoFiltered": "",
          }
        });
    });
  </script>
@endsection