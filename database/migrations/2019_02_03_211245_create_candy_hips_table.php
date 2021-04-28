<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyHipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_hips', function (Blueprint $table) {
            $table->increments('ai_hip_id');
            $table->integer('hip_ai_medic_id')->default(0);
            $table->string('tx_hip_value');
            $table->integer('tx_hip_status')->default(1);
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
        Schema::dropIfExists('candy_hips');
    }
}
