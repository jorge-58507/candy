<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandyAntecedenthistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_antecedenthistories', function (Blueprint $table) {
            $table->bigIncrements('ai_antecedenthistory_id');
            $table->integer('antecedenthistory_ai_history_id');
            $table->integer('antecedenthistory_ai_antecedent_id');
            $table->string('tx_antecedenthistory_value');
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
        Schema::dropIfExists('candy_antecedenthistories');
    }
}
