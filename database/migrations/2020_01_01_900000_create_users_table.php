<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('ident')->nullable();
            $table->integer('sede_id')->nullable()->unsigned();
            $table->boolean('executive')->nullable()->unsigned();
            $table->integer('program_id')->default(0)->nullable()->unsigned();
            $table->integer('origin_est')->default(0)->nullable()->unsigned();  // asignando el consecutivo individaul de respuesta
            $table->integer('origin_doc')->default(0)->nullable()->unsigned();  // asignando el consecutivo individaul de respuesta
            $table->integer('origin_gen')->default(0)->nullable()->unsigned();  // asignando el consecutivo individaul de respuesta
            $table->string('slug');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // relaciones
            $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}