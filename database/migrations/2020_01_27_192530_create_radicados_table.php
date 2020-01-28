<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadicadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radicados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('consecutive')->nullable();
            // $table->string('radic_year')->nullable();
            $table->string('atention')->nullable();
            $table->integer('origin_id')->unsigned(); //define el tipo de origen si es EST - DOC - GEN
            $table->integer('sede_id')->unsigned();
            $table->integer('program_id')->unsigned()->nullable();
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('origin_correo')->nullable();
            $table->string('origin_cel',14)->nullable();
            $table->integer('reason_id')->unsigned()->nullable();
            $table->text('affair')->nullable();
            $table->integer('states_id')->unsigned()->nullable();
            $table->integer('createBy_id')->unsigned()->nullable();
            $table->integer('delegate_id')->unsigned()->nullable();
            $table->integer('answered_id')->unsigned()->nullable();
            $table->string('answer_file')->nullable();
            $table->string('answer_text')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // relaciones
            $table->foreign('origin_id')->references('id')->on('origins')->onDelete('cascade');
            $table->foreign('states_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('cascade');
            $table->foreign('createBy_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('delegate_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('answered_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radicados');
    }
}