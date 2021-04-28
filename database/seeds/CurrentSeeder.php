<?php

use Illuminate\Database\Seeder;
use App\candy_current;

class CurrentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candy_current = new candy_current;
        $candy_current->current_ai_medic_id = 0;
        $candy_current->tx_current_title = 'Anamnesis Plantilla';
        $candy_current->tx_current_value = 'Paciente _ de _ años de edad que concurre al servicio de _ por un cuadro caracterizado por un episodio de _, refiere _, el paciente tambien refiere que _. Como antecedente de jerarquía el paciente refiere _.';
        $candy_current->tx_current_category = 0;
        $candy_current->created_at = time();
        $candy_current->updated_at = time();
        $candy_current->save();
        
        $candy_current = new candy_current;
        $candy_current->current_ai_medic_id = 0;
        $candy_current->tx_current_title = 'Preoperatorio';
        $candy_current->tx_current_value = 'Paciente _ de _ años de edad que concurre al hospital para el ingreso al preoperatorio por cirugía programada de _. \nComo antecedente de jerarquía la paciente manifiesta _ y estar medicada para _.';
        $candy_current->tx_current_category = 0;
        $candy_current->created_at = time();
        $candy_current->updated_at = time();
        $candy_current->save();

    }
}
