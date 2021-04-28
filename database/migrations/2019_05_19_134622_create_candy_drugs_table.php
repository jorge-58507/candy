<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_drugs', function (Blueprint $table) {
            $table->increments('ai_drug_id');
            $table->integer('drug_ai_medic_id')->default(0);
            $table->string('tx_drug_generic');
            $table->string('tx_drug_comertial');
            $table->string('tx_drug_category');
            $table->longText('tx_drug_dose');
            $table->longText('tx_drug_frecuency');
            $table->integer('tx_drug_status')->default(1);
            $table->string('tx_drug_slug');
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
        Schema::dropIfExists('candy_drugs');
    }
}
