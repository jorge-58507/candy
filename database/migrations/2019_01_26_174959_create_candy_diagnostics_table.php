<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyDiagnosticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_diagnostics', function (Blueprint $table) {
          $table->increments('ai_diagnostic_id');
          $table->integer('diagnostic_ai_medic_id')->default(0);
          $table->string('tx_diagnostic_value');
          $table->string('tx_diagnostic_category');
          $table->string('tx_diagnostic_status')->default(0);
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
        Schema::dropIfExists('candy_diagnostics');
    }
}
