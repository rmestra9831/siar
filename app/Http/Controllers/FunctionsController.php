<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Sede;
use App\Models\Program;
use App\User;
use DataTables;
class FunctionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->sedes = Sede::get(); 
        $this->programas = Program::all(); 
    }
    //funciones de administrador
    // vistas previas de configuración
    public function settingUser(){
        $er = User::get();

        $ex = $er;
        return view('pages.settingsUsers', compact('ex'));
    }
    // USUARIOS
    public function getUser(){
        return datatables()->eloquent(User::query())
            ->addColumn('sede', function($data){
                return $data->sede->name;
            })
            ->addColumn('program', function($data){ //MOTRANDO NOMBRE DE LA SEDE A LA QUE PERTENCE
                if (!$data->program_id) {
                    return 'Null';
                }else{
                    return $data->program->name;
                }
            })
            ->addColumn('rol', function($data){ //MOSTRANDO NOMBRE DE LOS ROLES DEL USUARIO
                $name = $data->getRoleNames();
                $char_delete = array('[', '"' , ']');
                $data_format = str_replace($char_delete, "", $name);
                return $data_format;
            })
            ->addColumn('permissions', 'buttons.BtnShowPermissions')
            ->addColumn('action', 'buttons.BtnsActionsUser')
            ->rawColumns(['action','permissions'])
            ->toJson();
    } 
    public function editUser(){}
    public function deleteUser(){}
    // PROGRAMAS
    public function settingsProgram(){
        $program = $this->programas;
        return view('pages.settingsPrograms', compact('program'));
    }
    public function editProgram($id){

    }
    public function deleteProgram($id){

    }
    public function getProgram(){
        return datatables()->eloquent(Program::query())
            ->addColumn('sede', function($data){
                return $data->sedes->name;
            })
            ->addColumn('action', 'buttons.BtnsActionsProgram')
            ->rawColumns(['action'])
            ->toJson();
    }
    // MOTIVOS
    public function settingsMotivo(){
        return view('pages.settingsMotivos');
    }

    // SEDES
    public function settingsSede(){
        $sede = Sede::all();
        return view('pages.settingsSedes', compact('sede'));
    }
    public function getSede(){
        return datatables()->eloquent(Sede::query())
            ->addColumn('action', 'buttons.BtnsActionsSede')
            ->rawColumns(['action'])
            ->toJson();
    }
    
}
