<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;

class CitySeeder extends Seeder
{

    const CITIES = [
        "Goa" => "Panjim",
        "Maharashtra" => "Mumbai",
        "West Bengal" => "Kolkata",
        "Haryana" => "Gurgaon",
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('city')->truncate();

        foreach (self::CITIES as $k => $v) {
            DB::table("city")->insert([
                "name" => $v,
                "state" => $k,
                "pincode" => $this->getRandomPinCode()
            ]);
        }
    }

    private function getRandomPinCode(): int {
        return 1200 . rand(20, 40);
    }
}
