<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyNecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_necks', function (Blueprint $table) {
            $table->increments('ai_neck_id');
            $table->integer('neck_ai_medic_id')->default(0);
            $table->string('tx_neck_value');
            $table->integer('tx_neck_status')->default(1);
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
        Schema::dropIfExists('candy_necks');
    }
}
