<?php

use Illuminate\Database\Seeder;
use App\AssessorEtiqueta;

class AssessorEtiquetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assessor_etiqueta')->delete();

        $etas = [
            ['id' => '1', 'etiqueta_id' => '1', 'assessor_id' => '1'],
            ['id' => '2', 'etiqueta_id' => '1', 'assessor_id' => '2'],
            ['id' => '3', 'etiqueta_id' => '1', 'assessor_id' => '3'],
            ['id' => '4', 'etiqueta_id' => '2', 'assessor_id' => '1'],
            ['id' => '5', 'etiqueta_id' => '2', 'assessor_id' => '2'],
            ['id' => '6', 'etiqueta_id' => '3', 'assessor_id' => '3'],
        ];
        foreach($etas as $etass){
            AssessorEtiqueta::create($etass);
        }
    }
}
