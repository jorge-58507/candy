<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_orders', function (Blueprint $table) {
            $table->increments('ai_order_id');
            $table->integer('order_ai_medic_id')->default(0);
            $table->string('tx_order_value');
            $table->string('tx_order_type');
            $table->integer('tx_order_status')->default(1);
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
        Schema::dropIfExists('candy_orders');
    }
}
