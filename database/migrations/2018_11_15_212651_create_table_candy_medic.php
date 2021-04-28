<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCandyMedic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('candy_medics', function (Blueprint $table) {
          $table->increments('ai_medic_id');
          $table->string('tx_medic_pseudonym');
          $table->string('tx_medic_gender');
          $table->string('tx_medic_speciality');
          $table->string('tx_medic_ubication');
          $table->string('tx_medic_telephone');
          $table->longText('tx_medic_print');
          $table->longText('tx_medic_option');
          $table->string('tx_medic_slug');
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
      Schema::dropIfExists('candy_medics');
    }
}
