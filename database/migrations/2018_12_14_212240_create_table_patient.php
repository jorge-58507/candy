<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('candy_patients', function (Blueprint $table) {
          $table->bigIncrements('ai_patient_id');
          $table->string('tx_patient_history');
          $table->string('tx_patient_name');
          $table->string('tx_patient_identification');
          $table->string('tx_patient_gender');
          $table->string('tx_patient_birthday');
          $table->string('tx_patient_telephone')->default('0000-0000');
          $table->string('tx_patient_direction');
          $table->string('tx_patient_avatar');
          $table->string('tx_patient_slug');
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
      Schema::dropIfExists('candy_patients');
    }
}
