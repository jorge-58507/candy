<?php

use Illuminate\Database\Seeder;
use App\candy_auscultation;

class AuscultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candy_auscultation = new candy_auscultation;
        $candy_auscultation->auscultation_ai_medic_id = 0;
        $candy_auscultation->tx_auscultation_value = 'Rs Hs Ps';
        $candy_auscultation->created_at = time();
        $candy_auscultation->updated_at = time();
        $candy_auscultation->save();

        $candy_auscultation = new candy_auscultation;
        $candy_auscultation->auscultation_ai_medic_id = 0;
        $candy_auscultation->tx_auscultation_value = 'Rs Hs As';
        $candy_auscultation->created_at = time();
        $candy_auscultation->updated_at = time();
        $candy_auscultation->save();

        $candy_auscultation = new candy_auscultation; $candy_auscultation->auscultation_ai_medic_id = 0; $candy_auscultation->tx_auscultation_value = 'Ruidos Peristálticos Aumentados'; $candy_auscultation->tx_auscultation_status = 1; $candy_auscultation->created_at = time(); $candy_auscultation->updated_at = time(); $candy_auscultation->save();

        $candy_auscultation = new candy_auscultation; $candy_auscultation->auscultation_ai_medic_id = 0; $candy_auscultation->tx_auscultation_value = 'Ruidos Peristálticos Disminuidos'; $candy_auscultation->tx_auscultation_status = 1; $candy_auscultation->created_at = time(); $candy_auscultation->updated_at = time(); $candy_auscultation->save();

        $candy_auscultation = new candy_auscultation; $candy_auscultation->auscultation_ai_medic_id = 0; $candy_auscultation->tx_auscultation_value = 'Ruidos Peristálticos Ausentes'; $candy_auscultation->tx_auscultation_status = 1; $candy_auscultation->created_at = time(); $candy_auscultation->updated_at = time(); $candy_auscultation->save();

        $candy_auscultation = new candy_auscultation; $candy_auscultation->auscultation_ai_medic_id = 0; $candy_auscultation->tx_auscultation_value = 'Soplo Venoso'; $candy_auscultation->tx_auscultation_status = 1; $candy_auscultation->created_at = time(); $candy_auscultation->updated_at = time(); $candy_auscultation->save();

    }
}
