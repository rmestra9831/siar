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
            $table->boolean('radic_id',false);
            $table->boolean('start',false);
            $table->boolean('sent_dir',false);
            $table->boolean('recived_dir',false);
            $table->boolean('delegated',false);
            $table->boolean('answered',false);
            //estados de revisi,falseon
            $table->boolean('redirection',false);
            $table->boolean('answer_redirection',false);
            $table->boolean('sent_to_check',false);
            $table->boolean('aproved',false);

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
