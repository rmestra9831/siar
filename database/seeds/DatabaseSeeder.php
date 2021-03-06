<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(OriginSeeder::class);
        $this->call(SedeSeeder::class);
        $this->call(ProgramaSeeder::class);
        $this->call(MotivoSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        // $this->call(StateSeeder::class);
        // $this->call(RadicadoSeeder::class);
    }
}
