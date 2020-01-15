<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;
use App\Models\Program;
use DataTables;
class FunctionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->sedes = Sede::get(); 
        $this->programas = Program::get(); 
    }
    //funciones de administrador
    // vistas previas de configuración
    public function settingUser(){
        return view('pages.settingsUsers');
    }
    public function settingsProgram(){
        $program = $this->programas;
        return view('pages.settingsPrograms', compact('program'));
    }
    public function settingsMotivo(){
        return view('pages.settingsMotivos');
    }
    public function settingsSede(){
        $sede = $this->sedes;
        return view('pages.settingsSedes', compact('sedes'));
    }

    public function getProgram(){

        $programs = Program::select(['name','id_sede']);

        return DataTables::of($programs)->make(true);
    }
    
}
