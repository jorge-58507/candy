<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyRespiratoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_respiratories', function (Blueprint $table) {
            $table->increments('ai_respiratory_id');
            $table->integer('respiratory_ai_medic_id')->default(0);
            $table->string('tx_respiratory_value');
            $table->integer('tx_respiratory_status')->default(1);
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
        Schema::dropIfExists('candy_respiratories');
    }
}
