<?php

use Illuminate\Database\Seeder;

class OriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('origins')->insert(['origin_name'=>'GEN','description'=>'Radicados recibidos generales']);
        DB::table('origins')->insert(['origin_name'=>'EST','description'=>'Radicados recibidos de estudiantes']);
        DB::table('origins')->insert(['origin_name'=>'DOC','description'=>'Radicados recibidos de docentes']);
    }
}
