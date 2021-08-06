<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDrugInfoToCandyDrughistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candy_drughistories', function (Blueprint $table) {
            $table->string('tx_drughistory_duration')->after('tx_drughistory_value')->nullable();
            $table->float('tx_drughistory_frecuency',8,2)->after('tx_drughistory_duration');
            $table->integer('tx_drughistory_interval')->after('tx_drughistory_frecuency')->nullable();
            $table->string('tx_drughistory_presentation')->after('tx_drughistory_interval');
            $table->integer('tx_drughistory_quantity')->after('tx_drughistory_presentation');
            $table->string('tx_drughistory_dose')->after('tx_drughistory_quantity');
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
            $table->dropColumn('tx_drughistory_duration');
            $table->dropColumn('tx_drughistory_frecuency');
            $table->dropColumn('tx_drughistory_interval');
            $table->dropColumn('tx_drughistory_presentation');
            $table->dropColumn('tx_drughistory_quantity');
            $table->dropColumn('tx_drughistory_dose');
        });
    }
}
