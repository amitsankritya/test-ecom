<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\StockController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function () {

    Route::group([
        "prefix" => "auth"
    ], function () {
        Route::post('login', [ApiAuthController::class, 'login']);
        Route::post('logout', [ApiAuthController::class, 'logout']);
        Route::post('refresh', [ApiAuthController::class, 'refresh']);
    });

    Route::get("search", [StockController::class, 'fetch']);

    Route::post("add", [StockController::class, 'add']);
    Route::put("edit/{id}", [StockController::class, 'edit']);
});
