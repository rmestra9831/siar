<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Program;
use App\Models\Sede;
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

    //TRAYENDO LOS DATOS DE PERMISOS DIRECTOS DE CADA USUARIO
    public function Permissions(){

        //prueba de datos
        $permissions = Permission::leftJoin("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id", 1)
        ->get();
        
        $allP = Permission::select('id')->get()->toArray();
        $PoR = $permissions->toArray();
        
        $arr_PoR = array();     // Aqui se obtiene una matriz con los datos
        $arr_allP = array();    //
        $arr_final_for_find = array();
        
        foreach ($PoR as $datos) {array_push($arr_PoR, $datos['id']);} //recorro los datos de los permisos que contiene el rol
        foreach ($allP as $datos) {array_push($arr_allP, $datos['id']);} //recorro los datos de los permisos que contiene el rol
        $arr_permissions_restantes = array_diff ($arr_allP, $arr_PoR);
        foreach ($arr_permissions_restantes as $data) {array_push($arr_final_for_find, $data);}

        $conver_to_string = implode(',',$arr_permissions_restantes);
        $permissions_faltantes = Permission::find($arr_final_for_find);
        // return $conver_to_string;
        return json_encode($permissions_faltantes);

        // return view('pages.TablePermissions', compact('data', 'rr'));
    }
    public function getUserPermissions(){
        return datatables()->eloquent(User::query())
            ->addColumn('sede', function($data){
                return $data->sede->name;
            })
            ->addColumn('rol', function($data){ //MOSTRANDO NOMBRE DE LOS ROLES DEL USUARIO
                $name = $data->getRoleNames();
                $char_delete = array('[', '"' , ']');
                $data_format = str_replace($char_delete, "", $name);
                return $data_format;
            })
            ->addColumn('permissions', function ($data) {
                if(auth()->user()->can('settings user')){ //BOTO PARA MOSTRAR MODAL
                    return  '
                     <button id="'.$data->id.'" value="'.$data->id.'"  data-tooltip="Ver Permisos" data-position="top center" class="ui basic permission button"><i class="icon eye"></i> Ver </button>';
                 }
            }) 
            // ->addColumn('permissions', 'buttons.BtnShowPermissions')
            ->rawColumns(['permissions'])
            ->toJson();
    }
    public function getPermissions($id){
        $users = User::findOrFail($id);
        $data = [
            'users' => $users->name,
            'permissions' => $users->getDirectPermissions()
        ];
        return response()->json($data);
    }
    public function getPermissionsOnRole($id){ //obteniendo los permisos dados a los roles
        $role = Role::find($id);
        $data = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)
        ->get();
        return datatables()->collection($data)
        ->addColumn('opciones', function ($data) {                
            return  '
            <a href="permission/'.$data->id.'/delete" data-tooltip="Eliminar" data-position="top center" id="" class="circular ui icon red button"><i class="icon trash"></i></a>';
        })  
        ->rawColumns(['opciones'])
        ->toJson();
    }
    public function getRole(){ 
        $roles = Role::get();  
        return response()->json($roles); 
    }
    public function getAddPermissions($id){
        $permissions = Permission::leftJoin("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id", $id)
        ->get();

        $rr = Permission::find([1,2,3]);
        // return json_encode($permissions->except(['name','guard_name','created_at','updated_at','role_id','permissions_id']));
        return response()->json($permissions); 
    }
    public function getAllPermissions(){
        $allPermissions = Permission::get();
        return response()->json($allPermissions);   
    }
    public function deletePermission($id){
        return 'eliminado permiso '. $id;
    }
}
