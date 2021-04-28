<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_treatments', function (Blueprint $table) {
            $table->increments('ai_treatment_id');
            $table->integer('treatment_ai_medic_id');
            $table->string('tx_treatment_title');
            $table->longText('tx_treatment_json');
            $table->string('tx_treatment_slug');
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
        Schema::dropIfExists('candy_treatments');
    }
}
