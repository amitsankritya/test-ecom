<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StocksSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $quality = [];

    /**
     * @var array
     */
    protected $brands = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $qualities = $this->fetchQuality();
        foreach ($qualities as $quality) {
            $this->quality[] = $quality->id;
        }

        $brands = $this->fetchBrands();
        foreach ($brands as $brand) {
            $this->brands[] = $brand->id;
        }

        DB::table('stock')->truncate();
        for ($i = 0; $i < 5; $i++) {
            DB::table("stock")->insert([
                "name" => Str::random("10"),
                "brand_id" => $this->getRandomBrand(),
                "quality_id" => $this->getRandomQuality(),
                "created_at" => Carbon::now()
            ]);
        }

    }

    /**
     * @return Collection
     */
    private function fetchQuality(): Collection {
        return DB::table("quality")->select("id")->get();
    }

    /**
     * @return Collection
     */
    private function fetchBrands(): Collection {
        return DB::table("brand")->select("id")->get();
    }

    /**
     * @return mixed
     */
    private function getRandomBrand() {
        return $this->brands[rand(0, count($this->brands) - 1)];
    }

    /**
     * @return mixed
     */
    private function getRandomQuality() {
        return $this->quality[rand(0, count($this->quality) - 1)];
    }
}
