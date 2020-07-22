<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/Color/listing', 'ColorController@listing');

/**
 * Route responsible for receiving a product, in text format and returning the data related to it.
 * 
 * @see <http:/127.0.0.1:8000/api/Product/SomeProduct>
 */
Route::get('/Product/{name}', function (string $name) {
    return response()->json([
        'id' => 64,
        'name' => $name,
        'stock-location'=> [

        ],
        'category' => 'Some Category',
    ], 200, [
        'Content-Type' => 'application/json',
    ]);
})->where('name', '[A-Za-z\d\!]+');
