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
        DB::table('programs')->insert(['name'=>'Sistemas','id_sede'=>2]);        
        DB::table('programs')->insert(['name'=>'Psicologia','id_sede'=>2]);        
        DB::table('programs')->insert(['name'=>'Electronica','id_sede'=>2]);        
    }
}
