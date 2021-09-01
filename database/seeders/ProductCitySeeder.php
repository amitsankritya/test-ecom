<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductCitySeeder extends Seeder
{
    /**
     * @var array
     */
    protected $products = [];

    /**
     * @var array
     */
    protected $cities = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $cities = $this->fetchCities();
        foreach ($cities as $city) {
            $this->cities[] = $city->id;
        }

        $products = $this->fetchProducts();
        foreach ($products as $product) {
            $this->products[] = $product->id;
        }

        DB::table('product_city')->truncate();
        for ($i = 0; $i < 5; $i++) {
            DB::table("product_city")->insert([
                "product_id" => $this->getRandomProduct(),
                "city_id" => $this->getRandomCity(),
                "quantity" => $this->getRandomQuantity(),
                "created_at" => Carbon::now()
            ]);
        }

    }

    /**
     * @return Collection
     */
    private function fetchCities(): Collection {
        return DB::table("city")->select("id")->get();
    }

    /**
     * @return Collection
     */
    private function fetchProducts(): Collection {
        return DB::table("stock")->select("id")->get();
    }

    /**
     * @return mixed
     */
    private function getRandomProduct() {
        return $this->products[rand(0, count($this->products) - 1)];
    }

    /**
     * @return mixed
     */
    private function getRandomCity() {
        return $this->cities[rand(0, count($this->cities) - 1)];
    }

    /**
     * @return mixed
     */
    private function getRandomQuantity() {
        return rand(100, 200);
    }
}
