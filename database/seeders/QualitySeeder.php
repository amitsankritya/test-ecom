<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualitySeeder extends Seeder
{
    const QUALITY = [
        "W-180",
        "W-160",
        "W-120"
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('quality')->truncate();
        for ($i = 0; $i < 5; $i++) {
            DB::table("quality")->insert([
                "name" => $this->getRandomQuality()
            ]);
        }
    }

    private function getRandomQuality(): string {
        return self::QUALITY[rand(0, count(self::QUALITY) -1)];
    }
}
