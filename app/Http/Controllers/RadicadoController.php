<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Motivo;
use App\Models\Radicado;
use App\Models\State;
use App\Models\Origin;
use Carbon\Carbon;
use DB;

class RadicadoController extends Controller
{
    
    public function __constructor(){
    
    }

    public function index(){
        $number = str_pad(auth()->user()->sede->cont_radic + 1, 5, "0", STR_PAD_LEFT); //agregando ceros al numero traido de la db
        $name_sede = substr(auth()->user()->sede->name, 0, 3); //obteniendo la sede donde se crea el radicado
        $year = Carbon::now()->isoFormat('D/M/Y'); //obteniendo año
        if($name_sede == 'bar'){$name_sede = 'BCA';}; if($name_sede == 'bar'){$name_sede = 'BCA';}; //formateando a BCA
        return view('pages.createRadicado.viewForm',compact('number','name_sede','year'));
    }

    public function getDataSelects(){
        $select_program = Program::all();
        $select_destino = Program::where('name','Direccion')->get();
        $select_motivo = Motivo::all();
        $select_origen = Origin::get();

        $data = array(
            "select_program"=>$select_program,
            "select_destino"=> $select_destino,
            "select_motivo"=> $select_motivo,
            "select_origen"=> $select_origen,
        );
        return response()->json($data);
    }

    public function store(Request $request){
        if($request->ajax()){
            $number = str_pad(auth()->user()->sede->cont_radic + 1, 5, "0", STR_PAD_LEFT); //agregando ceros al numero traido de la db
            $name_sede = substr(auth()->user()->sede->name, 0, 3); //obteniendo la sede donde se crea el radicado
            $year = Carbon::now()->isoFormat('D/M/Y'); //obteniendo año
            if($name_sede == 'bar'){$name_sede = 'BCA';}; if($name_sede == 'bar'){$name_sede = 'BCA';}; //formateando a BCA

            $radicado =new Radicado();

            if($request->type_reason_radic == 1){$type_reason = 'Administrativo';}else{ $type_reason = 'Academico';} //formatenado tipo de motivo ADM - ACAD


            $radicado->consecutive = ''.$number.'-'.$name_sede.'-'.$year.'';
            $radicado->atention = $request->atention_radic;
            $radicado->origin_id = $request->origin_radic;
            $radicado->sede_id = auth()->user()->sede['id'];
            $radicado->program_id = $request->program_radic;
            $radicado->first_name = $request->firstName;
            $radicado->last_name = $request->lastName;
            $radicado->origin_correo = $request->email;
            $radicado->origin_cel = $request->celphone;
            $radicado->type_reason = $type_reason;
            $radicado->reason_id = $request->reason_radic;
            $radicado->affair = $request->affair;
            $radicado->notes = $request->note;
            $radicado->createBy_id = auth()->user()->id;
            
            $radicado->date_creation = Carbon::now();
        
            $radicado->save();

            //actualizando
            //Estados
            $state = State::create([
                'radic_id' => $radicado->id,
                'start' => true
            ]);
            DB::table('radicados')->where('id', $radicado->id)->update(['states_id'=> $state->id]);
            DB::table('sedes')->where('id', auth()->user()->sede['id'])->increment('cont_radic',1);
            return response()->json($radicado);
        }
    }
    public function getReasons($id){
        $reasons = Motivo::where('type_motivo',$id)->orWhere('type_motivo',3)->get();
        return response()->json($reasons);
    }
}
