<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramSedeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_sede', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('program_id')->nullable()->unsigned();
            $table->integer('sede_id')->nullable()->unsigned();
            $table->timestamps();

            // // relaciones
            // $table->foreign('program_id')->references('id')->on('programs');
            // $table->foreign('sede_id')->references('id')->on('sedes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_sede');
    }
}
