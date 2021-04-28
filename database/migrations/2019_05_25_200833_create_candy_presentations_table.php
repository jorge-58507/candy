<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyPresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_presentations', function (Blueprint $table) {
            $table->increments('ai_presentation_id');
            $table->integer('presentation_ai_medic_id');
            $table->string('tx_presentation_value');
            $table->string('tx_presentation_active');
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
        Schema::dropIfExists('candy_presentations');
    }
}
