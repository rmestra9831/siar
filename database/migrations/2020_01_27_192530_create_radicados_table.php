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
            $table->string('atention')->nullable();
            $table->integer('origin_id')->unsigned(); //define el tipo de origen si es EST - DOC - GEN
            $table->integer('destination_id')->unsigned(); //define el tipo de origen si es EST - DOC - GEN
            $table->integer('sede_id')->unsigned();
            $table->integer('program_id')->unsigned()->nullable();
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('origin_correo')->nullable();
            $table->string('origin_cel',14)->nullable();
            $table->string('type_reason')->nullable(); //rason del docuemnto
            $table->integer('reason_id')->unsigned()->nullable(); //rason del docuemnto
            $table->text('affair')->nullable();
            $table->text('notes')->nullable();
            $table->string('file')->nullable();
            $table->string('slug')->unique();
            $table->integer('states_id')->unsigned()->nullable();
            $table->integer('createBy_id')->unsigned()->nullable();
            $table->integer('delegate_id')->unsigned()->nullable();
            $table->integer('answered_id')->unsigned()->nullable();
            $table->string('answer_file')->nullable();
            $table->string('answer_text')->nullable();
            
            //FECHAS
            $table->timestamp('date_creation')->nullable();
            $table->timestamp('date_sent_dir')->nullable();
            $table->timestamp('date_get_dir')->nullable();
            $table->timestamp('date_delegate')->nullable();
            $table->timestamp('date_answered')->nullable();
            $table->timestamp('date_sent_mail')->nullable();
            $table->timestamp('date_delivered')->nullable();


            $table->timestamps();

            // relaciones
            $table->foreign('origin_id')->references('id')->on('origins')->onDelete('cascade');
            $table->foreign('destination_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('states_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('cascade');
            $table->foreign('reason_id')->references('id')->on('motivos')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
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