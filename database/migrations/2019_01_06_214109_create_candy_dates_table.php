<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_dates', function (Blueprint $table) {
            $table->bigIncrements('ai_date_id');
            $table->integer('date_ai_medic_id');
            $table->integer('date_ai_patient_id');
            $table->integer('date_ai_reason_id');
            $table->date('tx_date_date');
            $table->time('tx_date_time');
            $table->integer('tx_date_status')->default(1);
            $table->string('tx_date_slug');
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
        Schema::dropIfExists('candy_dates');
    }
}
