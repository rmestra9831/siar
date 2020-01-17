<?php

use Illuminate\Database\Seeder;

class MotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motivos')->insert(['name'=>'Servicios publicos','type_motivo'=>'1','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Invitaciones','type_motivo'=>'1','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Derecho de petición','type_motivo'=>'1','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Permiso laboral','type_motivo'=>'1','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Certificado laboral','type_motivo'=>'1','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Devolución de documentos','type_motivo'=>'1','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Cuenta de cobro','type_motivo'=>'1','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Hoja de vida','type_motivo'=>'1','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Prueba de suficiencia de ingles','type_motivo'=>'2','sede_id'=> 1]);
        DB::table('motivos')->insert(['name'=>'Cancelacion','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Habilitacion','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Inclusion','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Cambio de horario','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Reintegro o readmision','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Validacion','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Aplazamiento','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Supletorio ','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Traslado de sede','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Homologación','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Curso vacacional','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Cambio de programa','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Excusa de inasistencia','type_motivo'=>'2','sede_id'=> 1]);                
        DB::table('motivos')->insert(['name'=>'Otro','type_motivo'=>'3','sede_id'=> 1]);
    }
}
