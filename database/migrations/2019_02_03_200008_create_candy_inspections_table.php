<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_inspections', function (Blueprint $table) {
            $table->increments('ai_inspection_id');
            $table->integer('inspection_ai_medic_id')->default(0);
            $table->string('tx_inspection_value');
            $table->integer('tx_inspection_status')->default(1);
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
        Schema::dropIfExists('candy_inspections');
    }
}
