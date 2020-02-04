<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class RadicadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('radicados')->insert([
            'consecutive' => '00001-BCA-04/2/2020',
            'atention' => 'Normal',
            'origin_id' => 1,
            'destination_id' => 1,
            'sede_id' => 2,
            'program_id' => 2,
            'first_name' => 'camilo',
            'last_name' => 'perez',
            'origin_correo' => 'freols@sas.com',
            'origin_cel' => '(341) 345-4784',
            'type_reason' => 'Academico',
            'reason_id' => 10,
            'affair' => 'Cancelación',
            'notes' => null,
            'createBy_id' => 3,           
            'slug' => 'cami_00001_BCA_04_2_2020_eKa3',
            'states_id' => 1,
            'date_creation' => Carbon::now(),
        ]); 

        DB::table('radicados')->insert([
            'consecutive' => '00002-BCA-04/2/2020',
            'atention' => 'Normal',
            'origin_id' => 1,
            'destination_id' => 1,
            'sede_id' => 2,
            'program_id' => 3,
            'first_name' => 'jaun',
            'last_name' => 'casas',
            'origin_correo' => 'lopes@sas.com',
            'origin_cel' => '(315) 845-4384',
            'type_reason' => 'Administrativo',
            'reason_id' => 5,
            'affair' => 'Certificado laboral',
            'notes' => null,
            'createBy_id' => 3,           
            'slug' => 'juan_00002_BCA_04_2_2020_F4s3',
            'states_id' => 2,
            'date_creation' => Carbon::now(),
        ]);

        DB::table('radicados')->insert([
            'consecutive' => '00003-BCA-04/2/2020',
            'atention' => 'Urgente',
            'origin_id' => 3,
            'destination_id' => 1,
            'sede_id' => 2,
            'program_id' => 1,
            'first_name' => 'gabriel',
            'last_name' => 'zosa',
            'origin_correo' => 'gabosoza@aaas.com',
            'origin_cel' => '(313) 347-1384',
            'type_reason' => 'Academico',
            'reason_id' => 12,
            'affair' => 'Inclusion',
            'notes' => null,
            'createBy_id' => 3,           
            'slug' => 'gabr_00003_BCA_04_2_2020_mM3A',
            'states_id' => 1,
            'date_creation' => Carbon::now(),
        ]);

        DB::table('radicados')->insert([
            'consecutive' => '00004-BCA-04/2/2020',
            'atention' => 'Normal',
            'origin_id' => 2,
            'destination_id' => 1,
            'sede_id' => 2,
            'program_id' => 4,
            'first_name' => 'javier',
            'last_name' => 'martinez',
            'origin_correo' => 'javi@sas.com',
            'origin_cel' => '(381) 315-4984',
            'type_reason' => 'Academico',
            'reason_id' => 21,
            'affair' => 'Cambio de programa',
            'notes' => null,
            'createBy_id' => 3,           
            'slug' => 'javi_00004_BCA_04_2_2020_54E5',
            'states_id' => 4,
            'date_creation' => Carbon::now(),
        ]);

        DB::table('radicados')->insert([
            'consecutive' => '00005-BCA-04/2/2020',
            'atention' => 'Urgente',
            'origin_id' => 2,
            'destination_id' => 1,
            'sede_id' => 2,
            'program_id' => 3,
            'first_name' => 'Jhan',
            'last_name' => 'ovalle',
            'origin_correo' => 'dses@sas.com',
            'origin_cel' => '(331) 345-9453',
            'type_reason' => 'Administrativo',
            'reason_id' => 3,
            'affair' => 'Derecho de petición',
            'notes' => null,
            'createBy_id' => 3,           
            'slug' => 'javi_00005_BCA_04_2_2020_vdEa',
            'states_id' => 5,
            'date_creation' => Carbon::now(),
        ]);

        DB::table('radicados')->insert([
            'consecutive' => '00006-BCA-04/2/2020',
            'atention' => 'Urgente',
            'origin_id' => 1,
            'destination_id' => 1,
            'sede_id' => 2,
            'program_id' => 2,
            'first_name' => 'jossy',
            'last_name' => 'narbaez',
            'origin_correo' => 'jossy@sas.com',
            'origin_cel' => '(312) 745-6384',
            'type_reason' => 'Administrativo',
            'reason_id' => 8,
            'affair' => 'Hoja de vida',
            'notes' => null,
            'createBy_id' => 3,           
            'slug' => 'joss_00001_BCA_04_2_2020_7WQ3',
            'states_id' => 6,
            'date_creation' => Carbon::now(),
        ]);

        DB::table('radicados')->insert([
            'consecutive' => '00007-BCA-04/2/2020',
            'atention' => 'Normal',
            'origin_id' => 2,
            'destination_id' => 1,
            'sede_id' => 2,
            'program_id' => 4,
            'first_name' => 'arley',
            'last_name' => 'lache',
            'origin_correo' => 'arley@sas.com',
            'origin_cel' => '(311) 589-1975',
            'type_reason' => 'Academico',
            'reason_id' => 19,
            'affair' => 'Homologación',
            'notes' => null,
            'createBy_id' => 3,           
            'slug' => 'arle_00001_BCA_04_2_2020_4712',
            'states_id' => 7,
            'date_creation' => Carbon::now(),
        ]);


    }
}
