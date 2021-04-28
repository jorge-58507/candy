<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRelUserMedic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('candy_rel_medic_users', function (Blueprint $table) {
          $table->increments('ai_rel_medic_user_id');
          $table->string('medic_user_ai_user_id');
          $table->string('medic_user_ai_medic_id');
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
      Schema::dropIfExists('candy_rel_medic_users');
    }
}
