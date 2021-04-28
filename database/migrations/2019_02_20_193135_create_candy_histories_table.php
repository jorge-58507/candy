<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_histories', function (Blueprint $table) {
            $table->increments('ai_history_id');
            $table->integer('history_ai_user_id');
            $table->integer('history_ai_date_id');
            $table->string('tx_history_date');
            $table->longText('tx_history_value');
            $table->longText('tx_history_document');
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
        Schema::dropIfExists('candy_histories');
    }
}
