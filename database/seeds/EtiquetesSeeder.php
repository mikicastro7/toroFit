<?php

use Illuminate\Database\Seeder;
use App\Etiqueta;

class EtiquetesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etiquetas')->delete();

        $etiquetas = [
            [
                'id' => 1,
                'name' => "Homes"    
            ],
            [
                'id' => 2,
                'name' => "Dones"    
            ],
            [
                'id' => 3,
                'name' => "Men's physique"    
            ],
            [
                'id' => 4,
                'name' => "Powerlifting"    
            ],
            [
                'id' => 5,
                'name' => "Strongman"    
            ],
            [
                'id' => 6,
                'name' => "gym + dieta"    
            ],
            [
                'id' => 7,
                'name' => "gym"    
            ],
            [
                'id' => 8,
                'name' => "dieta"    
            ],
        ];
        foreach($etiquetas as $etiqueta){
            Etiqueta::create($etiqueta);
        }
    }
}
