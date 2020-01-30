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
    }
}
