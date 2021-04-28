<?php

use Illuminate\Database\Seeder;
use App\candy_neck;
class NeckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candy_neck = new candy_neck; $candy_neck->neck_ai_medic_id = 0; $candy_neck->tx_neck_value = 'Adenopatía'; $candy_neck->tx_neck_status = 1; $candy_neck->created_at = time(); $candy_neck->updated_at = time(); $candy_neck->save();

        $candy_neck = new candy_neck; $candy_neck->neck_ai_medic_id = 0; $candy_neck->tx_neck_value = 'Agrandamiento carotídeo'; $candy_neck->tx_neck_status = 1; $candy_neck->created_at = time(); $candy_neck->updated_at = time(); $candy_neck->save();

        $candy_neck = new candy_neck; $candy_neck->neck_ai_medic_id = 0; $candy_neck->tx_neck_value = 'Bocio'; $candy_neck->tx_neck_status = 1; $candy_neck->created_at = time(); $candy_neck->updated_at = time(); $candy_neck->save();

        $candy_neck = new candy_neck; $candy_neck->neck_ai_medic_id = 0; $candy_neck->tx_neck_value = 'Desviación de la traquea'; $candy_neck->tx_neck_status = 1; $candy_neck->created_at = time(); $candy_neck->updated_at = time(); $candy_neck->save();

        $candy_neck = new candy_neck; $candy_neck->neck_ai_medic_id = 0; $candy_neck->tx_neck_value = 'Espasmo muscular'; $candy_neck->tx_neck_status = 1; $candy_neck->created_at = time(); $candy_neck->updated_at = time(); $candy_neck->save();

        $candy_neck = new candy_neck; $candy_neck->neck_ai_medic_id = 0; $candy_neck->tx_neck_value = 'Ingurgitación venosa'; $candy_neck->tx_neck_status = 1; $candy_neck->created_at = time(); $candy_neck->updated_at = time(); $candy_neck->save();

        $candy_neck = new candy_neck; $candy_neck->neck_ai_medic_id = 0; $candy_neck->tx_neck_value = 'Masa Ganglionar'; $candy_neck->tx_neck_status = 1; $candy_neck->created_at = time(); $candy_neck->updated_at = time(); $candy_neck->save();

        $candy_neck = new candy_neck; $candy_neck->neck_ai_medic_id = 0; $candy_neck->tx_neck_value = 'Soplo carotídeo'; $candy_neck->tx_neck_status = 1; $candy_neck->created_at = time(); $candy_neck->updated_at = time(); $candy_neck->save();

        $candy_neck = new candy_neck; $candy_neck->neck_ai_medic_id = 0; $candy_neck->tx_neck_value = 'Soplo tiroideo'; $candy_neck->tx_neck_status = 1; $candy_neck->created_at = time(); $candy_neck->updated_at = time(); $candy_neck->save();
    }
}
