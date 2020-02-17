@extends('layouts.extructure')
{{-- vista del main --}}
@include('components.Main')
@section('title','Nuevo Radicado')
@section('title_content')
  nuevo radicado
@endsection

@section('body_main')
   <div class="container as-center">
      <form id="create_radic" action="#" class="ui create_radic form">
         {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
         <input type="hidden" name="consecutive" value="{{$number ?? ''}}-{{$name_sede ?? ''}}-{{$year ?? ''}}">
         <div class="ui horizontal divider">Información de Contacto</div>
         {{-- nombres --}}
         <div class="field">
            <div class="two fields">
               <div class="field">
               <label>Nombres</label>
               <input type="text" name="firstName" placeholder="Nombres">
               </div>
               <div class="field">
               <label>Apellidos</label>
                 <input type="text" name="lastName" placeholder="Apellidos">
               </div>
            </div>
         </div>
         {{-- correo, telefono, programa --}}
         <div class="field">
            <div class="three fields">
               <div class="nine wide field"> {{--correo--}}
                   <label>Correo</label>
                 <input type="text" name="email" placeholder="Correo Electronico">
               </div>
               <div class="field"> {{--celular--}}
                   <label>Celular</label>
                 <input type="text" name="celphone" placeholder="Número de celular" id="celphone">
               </div>
               <div class="field"> {{--programa--}}
                  <label>Programa</label>
                  <select class="ui fluid dropdown" name="program_radic">
                    <option value="">Programa</option>
                  </select>
               </div>
            </div>
         </div>
         <div class="ui horizontal divider">Datos del radicado</div>
         {{-- datos del radicado --}}
         <div class="field">
            <div class="three fields">         
               <div class="four wide field"> {{-- select destino--}}
                  <label>Destino</label>
                  <select class="ui fluid dropdown" name="destination_radic">
                     <option value="">Destino</option>
                  </select>
               </div>
               <div class="nine wide field"> {{-- select del motivo (reason) --}}
                  <label>Motivo</label>
                  <div class="ui m-0 secondary labeled menu">
                     <div class="five wide field">
                        <select class="ui fluid type_reason dropdown" name="type_reason_radic">
                           <div class="menu">
                              <option value="">Tipo</option>
                              <option value="1">Administrativo</option>
                              <option value="2">Academico</option>
                           </div>
                        </select>
                     </div>
                     <div class="eleven wide field">
                        <select class="ui fluid reason disabled bg-secondary dropdown" name="reason_radic">          
                           <option value="">Motivo</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="three wide field"> {{-- asunto (affair)--}}
                  <label>Asunto</label>
                  <textarea rows="1" disabled="" name="affair" class="c-white bg-secondary" placeholder="Asunto" spellcheck="false" data-gramm="false"></textarea>
               </div>
            </div>
         </div>

         <div class="field">
            <div class="two fields">
               <div class="field"> {{-- select tipo de atención--}}
                  <label>Atención</label>
                  <select class="ui fluid dropdown" name="atention_radic">
                     <option value="">Tipo de atención</option>
                     <option value="Normal">Normal</option>
                     <option value="Urgente">Urgente</option>
                  </select>
               </div>
               <div class="field"> {{-- select origen--}}
                  <label>Origen</label>
                  <select class="ui fluid dropdown" name="origin_radic">
                     <option value="">EST - DOC - GEN</option>
                  </select>
               </div>              
            </div>
         </div>
         <div class="ui horizontal divider">Observaciones</div>
         <div class="sixtyn wide field"> {{-- Observaciones--}}
            <textarea rows="3" name="note" placeholder="Nota" spellcheck="false" data-gramm="false"></textarea>
         </div>
         <div class="ui fluid green create_radic button">Crear</div>
         <div class="ui error message"></div>
       </form>
   </div>
@endsection