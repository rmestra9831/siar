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
            $table->bigIncrements('id');
            $table->string('radic_id')->nullable();
            $table->string('radic_year')->nullable();
            $table->string('atention')->nullable();
            $table->integer('sede')->unsigned();
            $table->integer('program_id')->unsigned()->nullable();
            $table->integer('delegate_id')->unsigned()->nullable();
            $table->string('name',100);
            $table->string('last_name',100);
            $table->string('origen_correo')->nullable();
            $table->string('origen_cel',14)->nullable();
            $table->integer('motivo_id')->unsigned()->nullable();
            $table->string('asunto')->nullable();
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