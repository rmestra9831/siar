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
            'email'=>'sadmin@yopmail.com',
            'sede_id'=>'2',
            'slug'=>'superadmin',
            'password'=> bcrypt('123123123'),
            'program_id'=>null
        ]);
        DB::table('users')->insert([
            'name'=>'dirección',
            'email'=>'d@yopmail.com',
            'sede_id'=>'2',
            'slug'=>'direccion',
            'password'=> bcrypt('123456789'),
            'program_id'=>null
        ]);
        DB::table('users')->insert([
            'name'=>'admissions',
            'email'=>'a@yopmail.com',
            'sede_id'=>'2',
            'slug'=>'admiciones',
            'password'=> bcrypt('123456789'),
            'program_id'=>null
        ]);
        DB::table('users')->insert([
            'name'=>'Paola Arciniegas',
            'email'=>'sistemas@yopmail.com',
            'ident'=>'SIS',
            'sede_id'=>'2',
            'slug'=>'paola_sistemas',
            'password'=> bcrypt('123456789'),
            'program_id'=>2
        ]);
        DB::table('users')->insert([
            'name'=>'Jeniffer Lombana',
            'email'=>'psicologia@yopmail.com',
            'ident'=>'PSI',
            'sede_id'=>'2',
            'slug'=>'jenni_psicologia',
            'password'=> bcrypt('123456789'),
            'program_id'=>3
        ]);
    }
}
