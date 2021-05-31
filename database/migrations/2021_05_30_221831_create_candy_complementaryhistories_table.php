<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandyComplementaryhistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_complementaryhistories', function (Blueprint $table) {
            $table->bigIncrements('ai_complementaryhistory_id');
            $table->integer('complementaryhistory_ai_history_id');
            $table->integer('complementaryhistory_ai_complementary_id');
            $table->string('tx_complementaryhistory_value');
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
        Schema::dropIfExists('candy_complementaryhistories');
    }
}
