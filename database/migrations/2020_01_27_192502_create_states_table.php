<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id',false);
            $table->boolean('radic_id',false)->nullable();
            $table->boolean('start',false)->nullable();
            $table->boolean('sent_dir',false)->nullable();
            $table->boolean('recived_dir',false)->nullable();
            $table->boolean('delegated',false)->nullable();
            $table->boolean('answered',false)->nullable();
            $table->boolean('answerCheck',false)->nullable();
            $table->boolean('sentAdmissions',false)->nullable();
            //estados de revisi,falseo->nullable()n
            $table->boolean('redirection',false)->nullable();
            $table->boolean('aproved',false)->nullable();

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
        Schema::dropIfExists('states');
    }
}
