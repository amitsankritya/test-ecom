<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            BrandSeeder::class,
            CitySeeder::class,
            QualitySeeder::class,
            StocksSeeder::class,
            ProductCitySeeder::class
        ]);
    }
}
