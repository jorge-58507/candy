<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandyLaboratoryhistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_laboratoryhistories', function (Blueprint $table) {
            $table->bigIncrements('ai_laboratoryhistory_id');
            $table->integer('laboratoryhistory_ai_history_id');
            $table->integer('laboratoryhistory_ai_laboratory_id');
            $table->string('tx_laboratoryhistory_value');
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
        Schema::dropIfExists('candy_laboratoryhistories');
    }
}
