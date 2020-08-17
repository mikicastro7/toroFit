<?php

use Illuminate\Database\Seeder;
use App\Assessor;

class AssessorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assessors')->delete();

        $assessors = [
            ['id' => '1', 'description' => "Sóc un noi jove amb moltes ganes d'ajudar a millorar a la gent confieu amb mi i amb les ganes dels dos obtindrem bons resultats", 'user_id' => '3'],
            ['id' => '2', 'description' => "Sóc un noi jove amb moltes ganes d'ajudar a millorar a la gent confieu amb mi i amb les ganes dels dos obtindrem bons resultats", 'user_id' => '4'],
            ['id' => '3', 'description' => "Sóc un noi jove amb moltes ganes d'ajudar a millorar a la gent confieu amb mi i amb les ganes dels dos obtindrem bons resultats", 'user_id' => '5'],
        ];

        foreach($assessors as $ass){
            Assessor::create($ass);
        }
    }
}
