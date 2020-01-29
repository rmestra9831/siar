<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RadicadoController extends Controller
{
    
    public function __constructor(){
    
    }

    public function index(){
        $number = str_pad(auth()->user()->sede->cont_radic, 5, "0", STR_PAD_LEFT); //agregando ceros al numero traido de la db
        $name_sede = substr(auth()->user()->sede->name, 0, 3); //obteniendo la sede donde se crea el radicado
        $year = date("d/m/Y"); //obteniendo año
        if($name_sede == 'bar'){$name_sede = 'BCA';}; if($name_sede == 'bar'){$name_sede = 'BCA';}; //formateando a BCA
        return view('pages.createRadicado.viewForm',compact('number','name_sede','year'));
    }
}
