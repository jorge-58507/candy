<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicIdToCandyDrughistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candy_drughistories', function (Blueprint $table) {
            $table->integer('drughistory_ai_medic_id')->after('tx_drughistory_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candy_drughistories', function (Blueprint $table) {
            $table->dropColumn('drughistory_ai_medic_id');
        });
    }
}
