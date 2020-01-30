<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Motivo;
use App\Models\Origin;
use Carbon\Carbon;

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
        $select_destino = Program::where('name','Direccion');
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
}
