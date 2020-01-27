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
            $table->string('name',100);
            $table->string('last_name',100);
            $table->string('origen_correo')->nullable();
            $table->string('origen_cel',14)->nullable();
            $table->integer('motivo_id')->unsigned()->nullable();
            $table->string('asunto')->nullable();
            $table->integer('createBy_id')->unsigned()->nullable();
            $table->integer('delegate_id')->unsigned()->nullable();
            $table->integer('respon_id')->unsigned()->nullable();
            $table->string('respuesta_file')->nullable();
            $table->string('respuesta_text')->nullable();
            $table->text('obs')->nullable();
            $table->boolean('send_temp_admin')->nullable();
            $table->boolean('redirection')->nullable();
            $table->string('answer_redirection')->nullable();
            $table->boolean('revisar')->nullable();
            $table->boolean('openAdm')->nullable();
            

            $table->date('created');
            $table->date('send_to_direction')->nullable();
            $table->date('recive_on_direction')->nullable();
            $table->date('delegated')->nullable();
            $table->date('answered')->nullable();
            $table->string('aproved')->nullable();
            $table->timestamps();

            // relaciones
            $table->foreign('origin_id')->references('id')->on('origins')->onDelete('cascade');
            $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('cascade');
            $table->foreign('createBy_id')->references('id')->on('users')->onDelete('cascade');
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