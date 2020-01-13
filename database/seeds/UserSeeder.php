<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'superadmin',
            'email'=>'r@r.r',
            'id_sede'=>'1',
            'password'=> bcrypt('123123123'),
            'id_program'=>null
        ]);
    }
}
