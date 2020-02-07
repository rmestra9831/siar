<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                // creando permisos
                Permission::create(['name' => 'settings user']);
                Permission::create(['name' => 'create user']);
                Permission::create(['name' => 'delete user']);
                Permission::create(['name' => 'edit user']);
        
                Permission::create(['name' => 'settings program']);
                Permission::create(['name' => 'create program']);
                Permission::create(['name' => 'delete program']);
                Permission::create(['name' => 'edit program']);
        
                Permission::create(['name' => 'settings motivo']);
                Permission::create(['name' => 'create motivo']);
                Permission::create(['name' => 'delete motivo']);
                Permission::create(['name' => 'edit motivo']);
        
                Permission::create(['name' => 'settings sede']);
                Permission::create(['name' => 'create sede']);
                Permission::create(['name' => 'delete sede']);
                Permission::create(['name' => 'edit sede']);
        
                Permission::create(['name' => 'assign delegate']);
                Permission::create(['name' => 'check response']);

                //permisos de creados
                Permission::create(['name' => 'create radicado']);
        
                // creando roles
                $role_superadmin = Role::create(['name' => 'Super Admin']);
                $role_direction = Role::create(['name' => 'Direccion']);
                $role_admissions = Role::create(['name' => 'Admisiones']);
                $role_program_boss = Role::create(['name' => 'Jef Programa']);
                $role_direction_aux = Role::create(['name' => 'Aux Direción']);
                $role_direction_secretary = Role::create(['name' => 'Secretaria de Dirección']);
        
                // dando los permisos
                $role_superadmin->givePermissionTo(['settings user','settings program','settings motivo','settings sede','create user', 'delete user','edit user','create program','delete program','edit program','create motivo','edit motivo','create sede','delete sede','edit sede']); 
                $role_admissions->givePermissionTo(['create radicado','check response']);
                $role_direction->givePermissionTo(['assign delegate','check response']);

                $user_admin = User::where('id',1)->first();
                $user_admin->assignRole('Super Admin');

                $user_direction = User::where('id',2)->first();
                $user_direction->assignRole('Direccion');
                
                $user_admissions = User::where('id',3)->first();
                $user_admissions->assignRole('Admisiones');
                
                $user_jef_sis = User::where('id',4)->first();
                $user_jef_sis->assignRole('Jef Programa');
                
                $user_jef_psi = User::where('id',5)->first();
                $user_jef_psi->assignRole('Jef Programa');
            }
}
