<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_reasons', function (Blueprint $table) {
            $table->bigIncrements('ai_reason_id');
            $table->integer('tx_reason_status')->default(1);
            $table->string('tx_reason_value');
            $table->integer('reason_ai_medic_id')->default(0);
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
        Schema::dropIfExists('candy_reasons');
    }
}
