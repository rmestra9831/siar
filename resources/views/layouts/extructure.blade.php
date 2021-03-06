@extends('layouts.app')

@section('content')
  <div class="body_content">
    {{-- seccion del main --}}
    <div class="@auth main_section bg-admissions @else main_section_log @endauth">
      <div class="container @auth pan @else pan_login @endauth">
        {{-- validación de lo que muesta el menu si esta autenticado --}}
        @auth
          {{-- logo --}}
            <div class="row head">
              <div class="col">
                @yield('img')
              </div>
              <h3 class="c-white ui horizontal divider header">
                @role('Super Admin') Super Administrador @endrole
                @role('Direccion') Dirección @endrole
                @role('Admisiones') Admisiones y Registro @endrole
                @role('Jef Programa') Jef. de Programa @endrole
              </h3>
              @include('components.notifications')
            </div>
          {{-- cuerpo del main --}}
            <div class="row body">
              <div class="main_body">
                @yield('menus')
              </div>
            </div>
          {{-- piecera --}}
            <div class="row foter">
              <div class="ui divider"></div>
                <div class="ui middle aligned column centered grid h-100">
                  @yield('footer')
                </div>
            </div>
        @else
          @yield('main')
        @endauth
      </div>
      {{-- info de pie de pagina --}}
        @auth @else
          <div class="marca">
                <p class="container-fluid">
                  Copyright © 2019 Universidad de Investigación Y Desarrollo - UDI - <br>
                  Autores: <br>
                  <strong>Ing Martha Cecilia Guarnizo García.</strong> Dirección ORI <br>
                  <strong>Richard Andres Mestra Alvarez</strong> - Programador <br>
                  Todos los derechos reservados.
                </p>
          </div>
        @endauth
    </div>

    {{-- seccion del contenido --}}
    <div class="@auth content_section @else content_section_log @endauth">
      @auth
        <div class="container-fluid pan">
          <div class="content_header">
            <div class="title">
              <h1> @yield('title_content') </h1>
            </div>
          </div>
          <div class="contents_body">
            <div class="body">
              @yield('body_main')
            </div>
          </div>
          <div class="content_foter">
            @yield('foter')
          </div>
        </div>
      @else
        @yield('content_body')
      @endauth
    </div>
  </div>
@endsection