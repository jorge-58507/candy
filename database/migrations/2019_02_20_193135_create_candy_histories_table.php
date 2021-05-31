<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandyHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candy_histories', function (Blueprint $table) {
            $table->increments('ai_history_id');
            $table->integer('history_ai_user_id');
            $table->integer('history_ai_date_id');
            $table->string('tx_history_date');
            // $table->longText('tx_history_value');
            // $table->longText('tx_history_document');
            $table->longtext('tx_pe_skin');
            $table->longtext('tx_pe_head');
            $table->longtext('tx_pe_orl');
            $table->longtext('tx_pe_neck');
            $table->longtext('tx_pe_respiratory');
            $table->longtext('tx_pe_cardiac');
            $table->longtext('tx_pe_auscultation');
            $table->longtext('tx_pe_inspection');
            $table->longtext('tx_pe_palpation');
            $table->longtext('tx_pe_hip');
            $table->longtext('tx_pe_condition');
            $table->longtext('tx_pe_breathing');
            $table->longtext('tx_pe_hydration');
            $table->longtext('tx_pe_fever');
            $table->longtext('tx_pe_pupils');
            // $table->longtext('tx_history_reason');
            $table->longtext('tx_history_current');
            $table->longtext('tx_history_antecedent');
            $table->longtext('tx_history_examination');
            // $table->longtext('tx_history_diagnostic');
            $table->longtext('tx_history_comment');
            $table->longtext('tx_history_plan');
            $table->longtext('tx_history_vitalsign');
            $table->varchar('tx_lab_hemoglobin');
            $table->varchar('tx_lab_hematocrit');
            $table->varchar('tx_lab_platelet');
            $table->varchar('tx_lab_redbloodcell');
            $table->varchar('tx_lab_urea');
            $table->varchar('tx_lab_creatinine');
            $table->varchar('tx_lab_whitebloodcell');
            $table->varchar('tx_lab_lymphocytes');
            $table->varchar('tx_lab_neutrophils');
            $table->varchar('tx_lab_monocytes');
            $table->varchar('tx_lab_basophils');
            $table->varchar('tx_lab_eosinophils');
            $table->varchar('tx_lab_result');

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
        Schema::dropIfExists('candy_histories');
    }
}
