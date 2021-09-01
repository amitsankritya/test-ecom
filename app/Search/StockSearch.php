<?php
/**
 * Created by PhpStorm.
 * User: amitpandey
 * Date: 01/09/21
 * Time: 3:17 PM
 */

namespace App\Search;

use App\Models\Stock;
use Illuminate\Http\Request;


class StockSearch
{
    /**
     * @param Request $filters
     * @return mixed
     */
    public static function apply(Request $filters) {

        $stock = new Stock();

        if ($filters->input("brand")) {
            $stock = $stock->where("brand", $filters->input("brand"));
        }

        if ($filters->input("quality")) {
            $stock = $stock->where("quality", $filters->input("quality"));
        }

        if ($filters->input("quantity")) {
            $stock = $stock->where("quantity", $filters->input("quantity"));
        }

        if ($filters->input("location")) {

            $location = explode(",", $filters->input("location")); // Value to have Panjim,Goa

            if (!empty($location[0])) { // Search in location [Panjim]
                $stock = $stock->where("location", $location[0]);
            }

            if (!empty($location[1])) { // Search in state [Goa]
                $stock = $stock->where("state", $location[1]);
            }
        }

        // TODO: pagination to be implemented
        return $stock->get();
    }
}