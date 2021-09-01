<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    const BRANDS = [
        "Vedaka",
        "Nurture Tree Crunchy Cashews",
        "Looms And Weaves",
        "Kothari's Royal Organic Cashews"
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('brand')->truncate();
        for ($i = 0; $i < 4; $i++) {
            DB::table("brand")->insert([
                "name" => $this->getRandomBrand()
            ]);
        }
    }

    private function getRandomBrand(): string {
        return self::BRANDS[rand(0, count(self::BRANDS) - 1)];
    }
}
