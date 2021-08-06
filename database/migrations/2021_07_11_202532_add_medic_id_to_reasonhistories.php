<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicIdToReasonhistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candy_reasonhistories', function (Blueprint $table) {
            $table->integer('reasonhistory_ai_medic_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candy_reasonhistories', function (Blueprint $table) {
            $table->dropColumn('reasonhistory_ai_medic_id');
        });
    }
}
