<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['id' => '1', 'name' => 'miquel1', 'email' => "castro-miquel@hotmail.com", "password" => '$2y$10$8jhB8Tt/VNgGON0eZRWkCudmJIiL1sj2u2yueitvuhOcDNSIPWVy.', "type" => '1', "sexe" => 'Home', 'naixament' => "2000/11/26"],
            ['id' => '2', 'name' => 'miquel2', 'email' => "castro-miquel2@hotmail.com", "password" => '$2y$10$8jhB8Tt/VNgGON0eZRWkCudmJIiL1sj2u2yueitvuhOcDNSIPWVy.' , "type" => '1', "sexe" => 'Home', 'naixament' => "2000/11/26"],
            ['id' => '3', 'name' => 'miquel3', 'email' => "castro-miquel3@hotmail.com", "password" => '$2y$10$8jhB8Tt/VNgGON0eZRWkCudmJIiL1sj2u2yueitvuhOcDNSIPWVy.', "type" => '2', "sexe" => 'Home', 'naixament' => "2000/11/26"],
            ['id' => '4', 'name' => 'miquel4', 'email' => "castro-miquel4@hotmail.com", "password" => '$2y$10$8jhB8Tt/VNgGON0eZRWkCudmJIiL1sj2u2yueitvuhOcDNSIPWVy.', "type" => '2', "sexe" => 'Home', 'naixament' => "2000/11/26"],
            ['id' => '5', 'name' => 'miquel5', 'email' => "castro-miquel5@hotmail.com", "password" => '$2y$10$8jhB8Tt/VNgGON0eZRWkCudmJIiL1sj2u2yueitvuhOcDNSIPWVy.', "type" => '2', "sexe" => 'Home', 'naixament' => "2000/11/26"],
        ];
        foreach($users as $user){
            User::create($user);
        }
    }
}
