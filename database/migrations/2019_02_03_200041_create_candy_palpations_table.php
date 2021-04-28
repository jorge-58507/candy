<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyPalpationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_palpations', function (Blueprint $table) {
            $table->increments('ai_palpation_id');
            $table->integer('palpation_ai_medic_id')->default(0);
            $table->string('tx_palpation_value');
            $table->integer('tx_palpation_status')->default(1);
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
        Schema::dropIfExists('candy_palpations');
    }
}
