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

Route::get('/Color/listing', [\App\Http\Controllers\ColorController::class, 'listing']);

/**
 * Route responsible for receiving a product, in text format and returning the data related to it.
 * 
 * @see <http:/127.0.0.1:8000/api/Product/SomeProduct>
 */
Route::get('Product/{type}/{name}', [\App\Http\Controllers\ProductController::class, 'name'])->name('Product.name')->where('type', 'info|detail|name')->where('name', '[A-Za-z\d\!]+');
