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
            'ident'=>'DIR',
            'sede_id'=>'2',
            'slug'=>'direccion',
            'password'=> bcrypt('123456789'),
            'program_id'=>1
        ]);
        DB::table('users')->insert([
            'name'=>'admissions',
            'email'=>'a@yopmail.com',
            'sede_id'=>'2',
            'ident'=>'SIC',
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
        DB::table('users')->insert([
            'name'=>'Edwin',
            'email'=>'electronica@yopmail.com',
            'ident'=>'ELEC',
            'sede_id'=>'2',
            'slug'=>'edwin_admon',
            'password'=> bcrypt('123456789'),
            'program_id'=>4
        ]);
        DB::table('users')->insert([
            'name'=>'Admon Lombana',
            'email'=>'admon@yopmail.com',
            'ident'=>'ADM',
            'sede_id'=>'2',
            'slug'=>'Admon_electronica',
            'password'=> bcrypt('123456789'),
            'program_id'=>5
        ]);
        DB::table('users')->insert([
            'name'=>'Sergio Lombana',
            'email'=>'industrial@yopmail.com',
            'ident'=>'ADM',
            'sede_id'=>'2',
            'slug'=>'Sergio_industrial',
            'password'=> bcrypt('123456789'),
            'program_id'=>6
        ]);
        DB::table('users')->insert([
            'name'=>'Luis Gabreil',
            'email'=>'diseño@yopmail.com',
            'ident'=>'DIS',
            'sede_id'=>'2',
            'slug'=>'Sergio_industrial',
            'password'=> bcrypt('123456789'),
            'program_id'=>7
        ]);
        //directivos
            DB::table('users')->insert([
                'name'=>'Ori',
                'email'=>'ori@yopmail.com',
                'ident'=>'ORI',
                'sede_id'=>'1',
                'slug'=>'ori',
                'password'=> bcrypt('123456789'),
                'executive'=>1,
                'program_id'=>null
            ]);
            DB::table('users')->insert([
                'name'=>'Extensiones',
                'email'=>'c.extensiones@yopmail.com',
                'ident'=>'EXT',
                'sede_id'=>'1',
                'slug'=>'extensiones',
                'password'=> bcrypt('123456789'),
                'executive'=>1,
                'program_id'=>null
            ]);
            DB::table('users')->insert([
                'name'=>'vicerectoria',
                'email'=>'vice.administrativa@yopmail.com',
                'ident'=>'VAD',
                'sede_id'=>'1',
                'slug'=>'vice_admin',
                'password'=> bcrypt('123456789'),
                'executive'=>1,
                'program_id'=>null
            ]);
    }
}
