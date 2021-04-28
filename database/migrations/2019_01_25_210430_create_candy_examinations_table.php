<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_examinations', function (Blueprint $table) {
          $table->increments('ai_examination_id');
          $table->integer('examination_ai_medic_id');
          $table->string('tx_examination_title');
          $table->string('tx_examination_value');
          $table->string('tx_examination_category');            
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
        Schema::dropIfExists('candy_examinations');
    }
}
