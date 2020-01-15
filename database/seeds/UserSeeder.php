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
            'id_sede'=>'2',
            'password'=> bcrypt('123123123'),
            'id_program'=>null
        ]);
        DB::table('users')->insert([
            'name'=>'dirección',
            'email'=>'d@d.d',
            'id_sede'=>'2',
            'password'=> bcrypt('123456789'),
            'id_program'=>null
        ]);
        DB::table('users')->insert([
            'name'=>'admissions',
            'email'=>'a@a.a',
            'id_sede'=>'2',
            'password'=> bcrypt('123456789'),
            'id_program'=>null
        ]);
    }
}
