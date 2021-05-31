<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandyDiagnosticthistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_diagnosticthistories', function (Blueprint $table) {
            $table->bigIncrements('ai_diagnostichistory_id');
            $table->integer('diagnostichistory_ai_history_id');
            $table->integer('diagnostichistory_ai_diagnostic_id');
            $table->string('tx_diagnostichistory_value');
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
        Schema::dropIfExists('candy_diagnosticthistories');
    }
}
