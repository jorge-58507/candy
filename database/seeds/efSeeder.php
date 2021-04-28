<?php

use Illuminate\Database\Seeder;
use App\candy_ef;

class efSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candy_ef = new candy_ef;
        $candy_ef->tx_ef_title = 'condiciones';
        $candy_ef->tx_ef_value = '["Rs Cs Gs","Bs Cs Gs","Es Cs Gs","Is Cs Gs","Ms Cs Gs"]';
        $candy_ef->created_at = time();
        $candy_ef->updated_at = time();
        $candy_ef->save();

        $candy_ef = new candy_ef;
        $candy_ef->tx_ef_title = 'respiracion';
        $candy_ef->tx_ef_value = '["Eupneico","Taquipneico","Bradipneico"]';
        $candy_ef->created_at = time();
        $candy_ef->updated_at = time();
        $candy_ef->save();

        $candy_ef = new candy_ef;
        $candy_ef->tx_ef_title = 'hidratacion';
        $candy_ef->tx_ef_value = '["Hidratado","Deshidratado"]';
        $candy_ef->created_at = time();
        $candy_ef->updated_at = time();
        $candy_ef->save();

        $candy_ef = new candy_ef;
        $candy_ef->tx_ef_title = 'fiebre';
        $candy_ef->tx_ef_value = '["Afebril","Febril"]';
        $candy_ef->created_at = time();
        $candy_ef->updated_at = time();
        $candy_ef->save();

        $candy_ef = new candy_ef;
        $candy_ef->tx_ef_title = 'pupilas';
        $candy_ef->tx_ef_value = '["Pupilas Isocoricas","Pupilas Anisocoricas","Pupilas Discoricas","Pupilas Mioticas","Pupilas Midriaticas"]';
        $candy_ef->created_at = time();
        $candy_ef->updated_at = time();
        $candy_ef->save();

    }
}
