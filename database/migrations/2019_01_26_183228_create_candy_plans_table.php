<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_plans', function (Blueprint $table) {
          $table->increments('ai_plan_id');
          $table->integer('plan_ai_medic_id');
          $table->string('tx_plan_title');
          $table->longText('tx_plan_drug');
          $table->longText('tx_plan_value');
          $table->string('tx_plan_category');
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
        Schema::dropIfExists('candy_plans');
    }
}
