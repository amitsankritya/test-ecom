<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    const CITIES = [
        "Panjim"
    ];

    const STATES = [
        "Goa"
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('city')->truncate();
        for ($i = 0; $i < 5; $i++) {
            DB::table("city")->insert([
                "name" => $this->getRandomCity(),
                "states" => $this->getRandomState(),
                "pincode" => $this->getRandomPinCode()
            ]);
        }
    }

    private function getRandomCity(): string {
        return self::CITIES[rand(0, count(self::CITIES) - 1)];
    }

    private function getRandomState():string {
        return self::STATES[rand(0, count(self::STATES) - 1)];
    }

    private function getRandomPinCode(): int {
        return 1200 . rand(20, 40);
    }
}
