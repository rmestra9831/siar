<?php

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert(['radic_id'=>1, 'start'=>true]);
        DB::table('states')->insert(['radic_id'=>2, 'start'=>true]);

        DB::table('states')->insert(['radic_id'=>3, 'start'=>true]);

        DB::table('states')->insert(['radic_id'=>4, 'start'=>true]);

        DB::table('states')->insert(['radic_id'=>5, 'start'=>true]);

        DB::table('states')->insert(['radic_id'=>6, 'start'=>true]);

        DB::table('states')->insert(['radic_id'=>7, 'start'=>true]);

    }
}
