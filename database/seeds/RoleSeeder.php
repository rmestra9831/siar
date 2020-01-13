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
                Permission::create(['name' => 'create user']);
                Permission::create(['name' => 'delete user']);
                Permission::create(['name' => 'edit user']);
        
                Permission::create(['name' => 'create program']);
                Permission::create(['name' => 'delete program']);
                Permission::create(['name' => 'edit program']);
        
                Permission::create(['name' => 'create motivo']);
                Permission::create(['name' => 'delete motivo']);
                Permission::create(['name' => 'edit motivo']);
        
                Permission::create(['name' => 'create sede']);
                Permission::create(['name' => 'delete sede']);
                Permission::create(['name' => 'edit sede']);
        
                Permission::create(['name' => 'assign delegate']);
                Permission::create(['name' => 'check response']);
        
                // creando roles
                $role_superadmin = Role::create(['name' => 'super admin']);
                $role_direction = Role::create(['name' => 'direction']);
                $role_admissions = Role::create(['name' => 'admissions']);
                $role_program_boss = Role::create(['name' => 'program boss']);
                $role_direction_aux = Role::create(['name' => 'direction aux']);
                $role_direction_secretary = Role::create(['name' => 'direction secretary']);
        
                // dando los permisos
                $role_superadmin->givePermissionTo(['create user', 'delete user','edit user','create program','delete program','edit program','create motivo','edit motivo','create sede','delete sede','edit sede']);        

                $user_admin = User::where('id',1)->first();
                $user_admin->assignRole('super admin');
            }
}
