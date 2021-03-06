<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEditStockRequest;
use App\Models\Stock;
use App\Models\StockCity;
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

        try {
            return $this->respondWithData(StockSearch::apply($filters), $filters);
        } catch (\Exception $ex) {
            // TODO: Generate an error Log
        }

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

                if (!empty($stock->stock_city)) {
                    foreach ($stock->stock_city as $product_city) {
                        $data[$key]["cities"][] = [
                            "id" => $product_city->city->id,
                            "name" => $product_city->city->name . ", " . $product_city->city->state,
                            "quantity" => $product_city->quantity
                        ];
                    }
                } else {
                    $data[$key]["cities"] = [];
                }
            }
        }
        return new JsonResponse($data, 200);
    }

    /**
     * @param AddEditStockRequest $request
     * @return JsonResponse
     */
    public function add(AddEditStockRequest $request) {
        try {
            $stock = Stock::create([
                'name' => $request->input('name'),
                'brand_id' => $request->input('brand_id'),
                'quality_id' => $request->input('quality_id'),
            ]);

            $stock->stock_city()->create([
                'city_id' => $request->input('city_id'),
                'quantity' => $request->input('quantity')
            ]);

            return new JsonResponse([
                "success" => true,
                "msg" => "Stock Updated Successfully"
            ], 200);
        } catch (\Exception $exception) {
            return new JsonResponse([
                "success" => false,
                "msg" => "Unable to process this request right now. Please try again later"
            ], 500);
        }
    }

    /**
     * @param AddEditStockRequest $request
     * @return JsonResponse
     */
    public function edit(AddEditStockRequest $request, $id) {
        try {
            $stock = Stock::find($id);

            $stock = $stock->update([
                'name' => $request->input('name'),
                'brand_id' => $request->input('brand_id'),
                'quality_id' => $request->input('quality_id'),
            ]);

            $stock->stock_city()->update([
                'city_id' => $request->input('city_id'),
                'quantity' => $request->input('quantity')
            ]);

            return new JsonResponse([
                "success" => true,
                "msg" => "Stock Updated Successfully"
            ], 200);

        } catch (\Exception $exception) {
            return new JsonResponse([
                "success" => false,
                "msg" => "Unable to process this request right now. Please try again later"
            ], 500);
        }
    }
}