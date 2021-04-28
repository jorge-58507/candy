<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyAntecedentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_antecedents', function (Blueprint $table) {
          $table->increments('ai_antecedent_id');
          $table->integer('antecedent_ai_medic_id')->default(0);
          $table->string('tx_antecedent_value');
          $table->string('tx_antecedent_category');
          $table->string('tx_antecedent_status')->default(1);
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
        Schema::dropIfExists('candy_antecedents');
    }
}
