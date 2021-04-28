<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandySkinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_skins', function (Blueprint $table) {
            $table->increments('ai_skin_id');
            $table->integer('skin_ai_medic_id')->default(0);
            $table->string('tx_skin_value');
            $table->integer('tx_skin_status')->default(1);
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
        Schema::dropIfExists('candy_skins');
    }
}
