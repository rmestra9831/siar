@extends('layouts.extructure')

{{-- vista del main --}}
@include('components.Main')

@section('title_content')
  Programas
@endsection

@section('body_main')
  <div class="container">
    {{-- tabla e muestra de usuarios --}}
    <table id="programs" class="ui fixed single line celled table">
  <thead>
    <tr><th>Name</th>
    <th>Status</th>
    <th>Description</th>
  </tr></thead>
  <tbody>
    <tr>
      <td>John</td>
      <td>Approved</td>
      <td title="This is much too long to fit I'm sorry about that">This is much too long to fit I'm sorry about that</td>
    </tr>
    <tr>
      <td>Jamie</td>
      <td>Approved</td>
      <td>Shorter description</td>
    </tr>
    <tr>
      <td>Jill</td>
      <td>Denied</td>
      <td>Shorter description</td>
    </tr>
  </tbody>
</table>
  </div>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#programs').DataTable();
  } );
</script>

@endsection