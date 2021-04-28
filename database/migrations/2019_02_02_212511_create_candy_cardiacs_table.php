<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyCardiacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_cardiacs', function (Blueprint $table) {
            $table->increments('ai_cardiac_id');
            $table->integer('cardiac_ai_medic_id')->default(0);
            $table->string('tx_cardiac_value');
            $table->integer('tx_cardiac_status')->default(1);
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
        Schema::dropIfExists('candy_cardiacs');
    }
}
