<?php

use Illuminate\Database\Seeder;

class ProgramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->insert(['name'=>'Dirección','sede_id'=>2,'slug'=>'direccion']);        
        DB::table('programs')->insert(['name'=>'Sistemas','sede_id'=>2,'slug'=>'p_sistemas']);        
        DB::table('programs')->insert(['name'=>'Psicologia','sede_id'=>2,'slug'=>'p_psicologia']);        
        DB::table('programs')->insert(['name'=>'Electronica','sede_id'=>2,'slug'=>'p_electronica']);        
        DB::table('programs')->insert(['name'=>'Administración','sede_id'=>2,'slug'=>'p_admon']);        
        DB::table('programs')->insert(['name'=>'Industrial','sede_id'=>2,'slug'=>'p_industrial']);        
        DB::table('programs')->insert(['name'=>'Diseño Grafico','sede_id'=>2,'slug'=>'p_diseño']);        
    }
}
