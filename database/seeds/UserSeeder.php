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
            'sede_id'=>'2',
            'slug'=>'superadmin',
            'password'=> bcrypt('123123123'),
            'program_id'=>null
        ]);
        DB::table('users')->insert([
            'name'=>'dirección',
            'email'=>'d@d.d',
            'sede_id'=>'2',
            'slug'=>'direccion',
            'password'=> bcrypt('123456789'),
            'program_id'=>null
        ]);
        DB::table('users')->insert([
            'name'=>'admissions',
            'email'=>'a@a.a',
            'sede_id'=>'2',
            'slug'=>'admiciones',
            'password'=> bcrypt('123456789'),
            'program_id'=>null
        ]);
        DB::table('users')->insert([
            'name'=>'Paola Arciniegas',
            'email'=>'sistemas@udi.com',
            'ident'=>'SIS',
            'sede_id'=>'2',
            'slug'=>'paola_arciniegas',
            'password'=> bcrypt('123456789'),
            'program_id'=>1
        ]);
    }
}
