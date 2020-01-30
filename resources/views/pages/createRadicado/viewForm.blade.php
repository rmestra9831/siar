@extends('layouts.extructure')
{{-- vista del main --}}
@include('components.Main')

@section('title_content')
  nuevo radicado
@endsection

@section('body_main')
   <div class="container">
      <form class="ui create_radic form">
         <div class="ui horizontal divider">Información de Contacto</div>
         {{-- nombres --}}
         <div class="field">
            <div class="two fields">
               <div class="field">
               <label>Nombres</label>
               <input type="text" name="first-name" placeholder="Nombres">
               </div>
               <div class="field">
               <label>Apellidos</label>
                 <input type="text" name="last-name" placeholder="Apellidos">
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
                 <input type="text" name="celphone" placeholder="Número de celular">
               </div>
               <div class="field"> {{--programa--}}
                  <label>Programa</label>
                  <select class="ui fluid dropdown" id="program_radic">
                    <option value="">Programa</option>
                    <option value="1"> un programa</option>
                    <option value="2">Seleccione un programa</option>
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
                  <select class="ui fluid dropdown" id="destination_radic">
                     <option value="">Destino</option>
                     <option value="1">Seleccione un programa</option>
                     <option value="2">Seleccione un programa</option>
                  </select>
               </div>

               <div class="six wide field"> {{-- select del motivo (reason) --}}
                  <label>Motivo</label>
                  <div class="ui menu m-0">
                  <select class="ui fluid dropdown" id="type_reason_radic">
                     <option value="">Tipo</option>
                     <option value="1">Academico</option>
                     <option value="2">Administrativo</option>
                     <option value="3">Otro</option>
                  </select>
                  <select class="ui fluid dropdown" id="reason_radic">
                     <option value="">Motivo</option>
                     <option value="1">Seleccione un programa</option>
                     <option value="2">Seleccione un programa</option>
                  </select>
                  </div>
               </div>
               <div class="six wide field"> {{-- asunto (affair)--}}
                  <label>Asunto</label>
                  <textarea rows="1" name="affair" placeholder="Asunto" spellcheck="false" data-gramm="false"></textarea>
               </div>
            </div>
         </div>

         <div class="field">
            <div class="three fields">
               <div class="field"> {{-- select tipo de atención--}}
                  <label>Atención</label>
                  <select class="ui fluid dropdown" id="atention_radic">
                     <option value="">Tipo de atención</option>
                     <option value="1">Normal</option>
                     <option value="2">Urgende</option>
                  </select>
               </div>
               <div class="field"> {{-- select origen--}}
                  <label>Origen</label>
                  <select class="ui fluid dropdown" id="origin_radic">
                     <option value="">EST - DOC - GEN</option>
                     <option value="2">Normal</option>
                     <option value="1">Urgende</option>
                  </select>
               </div>              
               <div class="field"> {{--carga de documentos--}}
                  <label for="">Cargar Radicado</label>
                  <div class="ui labeled upload_radic input">
                     <input type="text" id="uploadRadic" placeholder="Seleccionar" readonly>
                     <input type="file">
                     <label class="ui label" for="uploadRadic">Cargar</label>
                  </div>
               </div>
            </div>
         </div>
         <div class="ui horizontal divider">Observaciones</div>
         <div class="sixtyn wide field"> {{-- Observaciones--}}
            <textarea rows="3" name="note" placeholder="Nota" spellcheck="false" data-gramm="false"></textarea>
         </div>
         <div class="ui fluid green submit create_radic button">Crear</div>
         <div class="ui error message"></div>
       </form>
   </div>
@endsection