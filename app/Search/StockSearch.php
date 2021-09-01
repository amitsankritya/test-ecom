<?php
/**
 * Created by PhpStorm.
 * User: amitpandey
 * Date: 01/09/21
 * Time: 3:17 PM
 */

namespace App\Search;

use App\Models\Brand;
use App\Models\City;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StockSearch
{
    /**
     * @param Request $filters
     * @return mixed
     */
    public static function apply(Request $filters) {

        $data = (new Brand());

        if ($filters->input("brand")) {
            $data = $data->where("name", "=", $filters->input("brand"));
        }

        if ($filters->input("quality")) {
            $data = $data->whereHas("Stock.Quality", function ($q) use ($filters) {
                return $q->where("name", "=", $filters->input("quality"));
            });
        }

        if ($filters->input("location")) {
            $cityIds = City::select("id")->where("name", "=", $filters->input("location"))->get()->pluck("id")->toArray();
            if (!empty($cityIds)) {
                $data = $data->whereHas("Stock.Stock_City", function ($q) use ($cityIds) {
                    return $q->whereIn("stock_city.city_id", $cityIds);
                });
            }
        }

        return $data->with("Stock", "Stock.Quality", "Stock.Stock_City", "Stock.Stock_City.City")->get();
    }
}