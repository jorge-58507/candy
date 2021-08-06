<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicIdToCandyDiagnostics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candy_diagnostichistories', function (Blueprint $table) {
            $table->integer('diagnostichistory_ai_medic_id')->after('tx_diagnostichistory_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candy_diagnostichistories', function (Blueprint $table) {
            $table->dropColumn('diagnostichistory_ai_medic_id');            
        });
    }
}
