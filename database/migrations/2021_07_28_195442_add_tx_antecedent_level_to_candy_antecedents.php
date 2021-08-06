<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTxAntecedentLevelToCandyAntecedents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candy_antecedents', function (Blueprint $table) {
            $table->integer('tx_antecedent_level')->after('tx_antecedent_status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candy_antecedents', function (Blueprint $table) {
            $table->dropColumn('tx_antecedent_level');
        });
    }
}
