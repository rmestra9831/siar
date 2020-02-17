@extends('layouts.extructure')

{{-- vista del main --}}
@include('components.Main')
@section('title_content') Filtrado de estado @endsection

@section('body_main')
  <div class="container">

    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-tab" data-toggle="tab" href="#nav" role="tab" aria-controls="nav" aria-selected="true">Home</a>
        <a class="nav-item nav-link" id="nav-tab" data-toggle="tab" href="#nav" role="tab" aria-controls="nav" aria-selected="false">Profile</a>
        <a class="nav-item nav-link" id="nav-tab" data-toggle="tab" href="#nav" role="tab" aria-controls="nav" aria-selected="false">Contact</a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav" role="tabpanel" aria-labelledby="nav-tab">
        dss
      </div>
    </div>

  </div>
@endsection
