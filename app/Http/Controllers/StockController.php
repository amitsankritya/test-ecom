<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StockFiltersRequest;
use App\Search\StockSearch;

class StockController extends Controller
{

    /**
     * @param StockFiltersRequest $filters
     * @return JsonResponse
     */
    public function fetch(StockFiltersRequest $filters): JsonResponse {

        if (!$filters->input("brand") && !$filters->input("location") && !$filters->input("quality")) {
            return new JsonResponse([
                "success" => false,
                "msg" => "At least one filter is required"
            ], 422);
        }

        //
            return $this->respondWithData(StockSearch::apply($filters), $filters);
        /*} catch (\Exception $ex) {
            // TODO: Generate an error Log
        }*/

        return new JsonResponse([
            "success" => false,
            "msg" => "Unable to process this request right now. Please try again later"
        ], 500);

    }

    private function respondWithData($collections): JsonResponse {
        $data = [];
        foreach ($collections as $key => $collection) {

            $data[$key] = [
                "id" => $collection->id,
                "brand_name" => $collection->name
            ];

            foreach ($collection->stock as $stock) {
                $data[$key]["quality"] = $stock->quality->name;

                if (!empty($stock->product_city)) {
                    foreach ($stock->product_city as $product_city) {
                        $data[$key]["cities"][] = [
                            "id" => $product_city->city->id,
                            "name" => $product_city->city->name . ", " . $product_city->city->state
                        ];
                    }
                } else {
                    $data[$key]["cities"] = [];
                }
            }
        }
        return new JsonResponse($data, 200);
    }
}