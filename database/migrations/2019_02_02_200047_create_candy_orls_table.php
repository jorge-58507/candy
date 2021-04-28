<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyOrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_orls', function (Blueprint $table) {
            $table->increments('ai_orl_id');
            $table->integer('orl_ai_medic_id')->default(0);
            $table->string('tx_orl_value');
            $table->integer('tx_orl_status')->default(1);
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
        Schema::dropIfExists('candy_orls');
    }
}
