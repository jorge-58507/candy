<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiagnosticLevelToCandyDiagnostics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candy_diagnostics', function (Blueprint $table) {
            $table->integer('tx_diagnostic_level')->after('tx_diagnostic_status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candy_diagnostics', function (Blueprint $table) {
            $table->dropColumn('tx_diagnostic_level');
        });
    }
}
