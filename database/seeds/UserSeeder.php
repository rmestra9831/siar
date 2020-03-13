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
        DB::table('users')->insert([ //direccion
            'name'=>'Direccion',
            'email'=>'d@yopmail.com',
            'ident'=>'DIR',
            'sede_id'=>'2',
            'slug'=>'direccion',
            'password'=> bcrypt('123456789'),
            'program_id'=>1
        ]);
        DB::table('users')->insert([ //admisiones
            'name'=>'Jossy Javier Gabiria',
            'email'=>'a@yopmail.com',
            'sede_id'=>'2',
            'ident'=>'SIC',
            'slug'=>'admiciones',
            'password'=> bcrypt('123456789'),
            'program_id'=>null
        ]);
        DB::table('users')->insert([ //sistemas
            'name'=>'Paola Andrea Arciniegas Garcia',
            'email'=>'je.sistemasbca@udi.edu.co',
            'ident'=>'SIS',
            'sede_id'=>'2',
            'slug'=>'paola_sistemas',
            'password'=> bcrypt('65780151'),
            'program_id'=>2
        ]);
        DB::table('users')->insert([ //psicologia
            'name'=>'Jeniffer Lombana Herrera',
            'email'=>'je.psicologiabca@udi.edu.co',
            'ident'=>'PSI',
            'sede_id'=>'2',
            'slug'=>'jenni_psicologia',
            'password'=> bcrypt('1096206313'),
            'program_id'=>3
        ]);
        DB::table('users')->insert([ //electronica
            'name'=>'Edwin Giovanni Sepulveda Tellez',
            'email'=>'je.electronicabca@udi.edu.co',
            'ident'=>'ELEC',
            'sede_id'=>'2',
            'slug'=>'edwin_admon',
            'password'=> bcrypt('1098678159'),
            'program_id'=>4
        ]);
        DB::table('users')->insert([ //administracion
            'name'=>'Cesar Augusto Gonzales Serrano',
            'email'=>'je.administrabca@udi.edu.co ',
            'ident'=>'ADM',
            'sede_id'=>'2',
            'slug'=>'Cesar_admon',
            'password'=> bcrypt('91523097'),
            'program_id'=>5
        ]);
        DB::table('users')->insert([ //industrial
            'name'=>'Sergio Andres Santos Rueda',
            'email'=>'je.industrialbca@udi.edu.co',
            'ident'=>'ADM',
            'sede_id'=>'2',
            'slug'=>'Sergio_industrial',
            'password'=> bcrypt('1101683118'),
            'program_id'=>6
        ]);
        DB::table('users')->insert([ //diseño
            'name'=>'Luis Gabreil Uriel',
            'email'=>'je.graficobca@udi.edu.co',
            'ident'=>'DIS',
            'sede_id'=>'2',
            'slug'=>'gabreil_industrial',
            'password'=> bcrypt('10981618408'),
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
