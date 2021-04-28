<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyAuscultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_auscultations', function (Blueprint $table) {
            $table->increments('ai_auscultation_id');
            $table->integer('auscultation_ai_medic_id')->default(0);
            $table->string('tx_auscultation_value');
            $table->integer('tx_auscultation_status')->default(1);
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
        Schema::dropIfExists('candy_auscultations');
    }
}
