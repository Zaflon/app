<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/**
 * Todas as rotas estão inseridas no /app
 */
Route::middleware(App\Http\Middleware\IsUserLogged::class)->prefix('/app')->group(function () {
    /**
     * Returns the homepage of our application.
     * 
     * @see http://127.0.0.1:8000/app
     */
    Route::get('/', function () {
        return redirect()->route(\App\Helpers\Utils::HOMEPAGE);
    })->name('app');

    /**
     * Color Route.
     */
    Route::resource('Color', 'ColorController');

    /**
     * Coupon Route.
     */
    Route::resource('Coupon', 'CouponController');

    /**
     * User Route.
     */
    Route::resource('User', 'UserController');

    /**
     * Brand Route.
     */
    Route::resource('Brand', 'BrandController');

    /**
     * Product Route.
     */
    Route::resource('Product', 'ProductController');

    /**
     * Generic PDF Report Route.
     */
    Route::resource('GenericPDFReport', 'GenericPDFReportController');

    /**
     * Generic CSV Report Route.
     */
    Route::resource('GenericCSVReport', 'GenericCSVReportController');

    /**
     * Generic XML Report Route.
     */
    Route::resource('GenericXMLReport', 'GenericXMLReportController');

    /**
     * Generic Chart Report Route.
     */
    Route::resource('GenericChartReport', 'GenericChartReportController');
});

/** Log Out Route */
Route::get('/logout', 'UserController@logout')->name('logout');

/** Route responsible for returning the login page */
Route::get('/login', 'UserController@login')->name('login');

/** User authentication route, when logging in to the system's home page */
Route::post('/autenticate', 'UserController@autenticate')->name('autenticate');
