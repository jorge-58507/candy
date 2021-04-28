<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMedicPatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('candy_rel_medic_patients', function (Blueprint $table) {
          $table->bigIncrements('ai_rel_medic_patient_id');
          $table->string('medic_patient_ai_medic_id');
          $table->string('medic_patient_ai_patient_id');
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
      Schema::dropIfExists('candy_rel_medic_patients');
    }
}
