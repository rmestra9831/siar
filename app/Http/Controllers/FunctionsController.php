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
    protected $permissions;
    public function __construct()
    {
        $this->permissions = Permission::get();
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
        return view('pages.TablePermissions', compact('data', 'rr'));
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
                    <button data-tooltip="Ver" data-position="top center" id="'.$data->id.'" value="'.$data->id.'" class="circular ui icon teal permission button"><i class="icon eye"></i></button>
                    <button data-tooltip="Agregar" data-position="top center" id="'.$data->id.'" value="'.$data->id.'" class="circular ui icon blue add_direct_permission button"><i class="icon plus circle"></i></button>
                    <button href="permission/'.$data->id.'/delete" value="'.$data->id.'" data-tooltip="Eliminar" data-position="top center" id="" class="circular ui icon red delete_direct_permission button"><i class="icon trash"></i></button>';
                 }
            }) 
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
        
        $allP = Permission::select('id')->get()->toArray();
        $PoR = $permissions->toArray();
        
        $arr_PoR = array();     // Aqui se obtiene una matriz con los datos
        $arr_allP = array();    //
        $arr_final_for_find = array(); //Esto guarda los datos finales que se serán pasados a la consulta del metodo ::find()
        
        foreach ($PoR as $datos) {array_push($arr_PoR, $datos['id']);} //recorro los datos de los permisos que contiene el rol
        foreach ($allP as $datos) {array_push($arr_allP, $datos['id']);} //Obtiene Todos los roles y los almacena por separado en el arr_allP
        $arr_permissions_restantes = array_diff ($arr_allP, $arr_PoR);
        foreach ($arr_permissions_restantes as $data) {array_push($arr_final_for_find, $data);} //Obtiene la consulta anterior y agrega por datos al arrat final que será consultado

        $permissions_faltantes = Permission::find($arr_final_for_find);

        return response()->json($permissions_faltantes); 
    }
    public function getAllPermissions(){
        $allPermissions = Permission::get();
        return response()->json($allPermissions);   
    }
    public function deletePermission($id){
        return 'eliminado permiso '. $id;
    }

    // Asignando, eliminando o editando permisos
    public function assingPermissionsOnRole(Request $request){
        if ($request->ajax()) {
            $rol = $request->idRol;
            $permissions = $request->array;
            $role_actual = Role::findOrFail($rol);
            
            $arr_permissions = explode(",",$permissions);

            foreach ($arr_permissions as $permission) {
                $role_actual->givePermissionTo($permission);
            }
            return json_encode($arr_permissions);

        }else{
            return json_encode($request);
        }

    }
    public function DirectPermissionsOnUser($id){
        $user = User::findOrFail($id);
        $permission = $this->permissions;
        $permissions_on_user = $user->getPermissionsViaRoles();
        $permissions_direct = $user->getDirectPermissions();

        $arr_permissions = array();
        $arr_all_permissions_on_user = array();
        $arr_permissions_direct = array();
        $arr_sub_result = array();
        $arr_result = array();

        foreach ($permission as $data) {array_push($arr_permissions, $data['id']);}
        foreach ($permissions_direct as $data) {array_push($arr_permissions_direct, $data['id']);}
        foreach ($permissions_on_user as $data) {array_push($arr_all_permissions_on_user, $data['id']);}
        foreach (array_diff($arr_permissions, $arr_all_permissions_on_user) as $data) { array_push($arr_sub_result, $data);}
        foreach (array_diff($arr_sub_result, $arr_permissions_direct) as $data) { array_push($arr_result, $data);}
        
        $permissions_for_add = Permission::find($arr_result);

            return response()->json($permissions_for_add);
    }

    public function assignDirectPermissionsOnUser(Request $request){
        if ($request->ajax()) {
            $user = User::findOrFail($request->idUser);
            $arr_permissions_select = explode(",", $request->array);

            foreach ($arr_permissions_select as $data) {
                $user->givePermissionTo($data);
            }
            return response()->json($arr_permissions_select);
        }
    }

    public function deleteViewDirectPermissionsOnUser($id){
        $user = User::findOrFail($id)->getDirectPermissions();
        return response()->json($user);
    }
    public function deleteDirectPermissionsOnUser(Request $request){
        if ($request->ajax()) {
            $user = User::findOrFail($request->idUser);
            $arr_delete_permissions = explode(",",$request->array);

            foreach ($arr_delete_permissions as $permissions) {
                $user->revokePermissionTo($permissions);
            }
            return response()->json(true);
        }
    }
    //crear un nuevo rol
    public function createRol(){      
    }
    public function onlyUsers(){
        $users = User::join('programs','programs.id','=','users.program_id')->get();
        return response()->json($users);
    }

}
