<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyCurrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_currents', function (Blueprint $table) {
            $table->increments('ai_current_id');
            $table->integer('current_ai_medic_id')->default(0);
            $table->string('tx_current_title');
            $table->longText('tx_current_value');
            $table->string('tx_current_category');
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
        Schema::dropIfExists('candy_currents');
    }
}
