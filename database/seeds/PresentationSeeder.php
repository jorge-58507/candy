<?php

use Illuminate\Database\Seeder;
use App\candy_presentation;
class PresentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candy_presentation = new candy_presentation;
        $candy_presentation->presentation_ai_medic_id = 0; 
        $candy_presentation->tx_presentation_value = 'Parche';
        $candy_presentation->tx_presentation_active = 1;
        $candy_presentation->created_at = time();
        $candy_presentation->updated_at = time(); 
        $candy_presentation->save();

        $candy_presentation = new candy_presentation;
        $candy_presentation->presentation_ai_medic_id = 0; 
        $candy_presentation->tx_presentation_value = 'Pildora';
        $candy_presentation->tx_presentation_active = 1;
        $candy_presentation->created_at = time();
        $candy_presentation->updated_at = time(); 
        $candy_presentation->save();

        $candy_presentation = new candy_presentation;
        $candy_presentation->presentation_ai_medic_id = 0; 
        $candy_presentation->tx_presentation_value = 'Gragea';
        $candy_presentation->tx_presentation_active = 1;
        $candy_presentation->created_at = time();
        $candy_presentation->updated_at = time(); 
        $candy_presentation->save();
        
        $candy_presentation = new candy_presentation;
        $candy_presentation->presentation_ai_medic_id = 0; 
        $candy_presentation->tx_presentation_value = 'Capsula';
        $candy_presentation->tx_presentation_active = 1;
        $candy_presentation->created_at = time();
        $candy_presentation->updated_at = time(); 
        $candy_presentation->save();
        
        $candy_presentation = new candy_presentation;
        $candy_presentation->presentation_ai_medic_id = 0; 
        $candy_presentation->tx_presentation_value = 'Pastilla';
        $candy_presentation->tx_presentation_active = 1;
        $candy_presentation->created_at = time();
        $candy_presentation->updated_at = time(); 
        $candy_presentation->save();
        
        $candy_presentation = new candy_presentation;
        $candy_presentation->presentation_ai_medic_id = 0; 
        $candy_presentation->tx_presentation_value = 'Ampolla';
        $candy_presentation->tx_presentation_active = 1;
        $candy_presentation->created_at = time();
        $candy_presentation->updated_at = time(); 
        $candy_presentation->save();
        
        $candy_presentation = new candy_presentation;
        $candy_presentation->presentation_ai_medic_id = 0; 
        $candy_presentation->tx_presentation_value = 'Liofilizado';
        $candy_presentation->tx_presentation_active = 1;
        $candy_presentation->created_at = time();
        $candy_presentation->updated_at = time(); 
        $candy_presentation->save();
        
        $candy_presentation = new candy_presentation;
        $candy_presentation->presentation_ai_medic_id = 0; 
        $candy_presentation->tx_presentation_value = 'Diluible';
        $candy_presentation->tx_presentation_active = 1;
        $candy_presentation->created_at = time();
        $candy_presentation->updated_at = time(); 
        $candy_presentation->save();
        
        $candy_presentation = new candy_presentation;
        $candy_presentation->presentation_ai_medic_id = 0; 
        $candy_presentation->tx_presentation_value = 'Jarabe';
        $candy_presentation->tx_presentation_active = 1;
        $candy_presentation->created_at = time();
        $candy_presentation->updated_at = time(); 
        $candy_presentation->save();

        $candy_presentation = new candy_presentation;
        $candy_presentation->presentation_ai_medic_id = 0; 
        $candy_presentation->tx_presentation_value = 'Emulsion';
        $candy_presentation->tx_presentation_active = 1;
        $candy_presentation->created_at = time();
        $candy_presentation->updated_at = time(); 
        $candy_presentation->save();
        
        $candy_presentation = new candy_presentation;
        $candy_presentation->presentation_ai_medic_id = 0; 
        $candy_presentation->tx_presentation_value = 'Suspension';
        $candy_presentation->tx_presentation_active = 1;
        $candy_presentation->created_at = time();
        $candy_presentation->updated_at = time(); 
        $candy_presentation->save();

    }
}
