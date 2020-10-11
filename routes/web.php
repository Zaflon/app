<?php

use Illuminate\Support\Facades\Route;

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
});

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
    Route::resource('Color', \App\Http\Controllers\ColorController::class);

    /**
     * Coupon Route.
     */
    Route::resource('Coupon', \App\Http\Controllers\CouponController::class);

    /**
     * User Route.
     */
    Route::resource('User', \App\Http\Controllers\UserController::class);

    /**
     * Brand Route.
     */
    Route::resource('Brand', \App\Http\Controllers\BrandController::class);

    /**
     * Product Route.
     */
    Route::resource('Product', \App\Http\Controllers\ProductController::class);

    /**
     * Download Image.
     */
    Route::get('User/{user}/download', [\App\Http\Controllers\UserController::class, 'download'])->name('User.download');

    /**
     * Generic PDF Report Route.
     */
    Route::resource('GenericPDFReport', \App\Http\Controllers\GenericPDFReportController::class);

    /**
     * Generic CSV Report Route.
     */
    Route::resource('GenericCSVReport', \App\Http\Controllers\GenericCSVReportController::class);

    /**
     * Generic XML Report Route.
     */
    Route::resource('GenericXMLReport', \App\Http\Controllers\GenericXMLReportController::class);

    /**
     * Generic Chart Report Route.
     */
    Route::resource('GenericChartReport', \App\Http\Controllers\GenericChartReportController::class);
});

/** Log Out Route */
Route::get('/logout',  [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');

/** Route responsible for returning the login page */
Route::get('/login',  [\App\Http\Controllers\UserController::class, 'login'])->name('login');

/** User authentication route, when logging in to the system's home page */
Route::post('/autenticate',  [\App\Http\Controllers\UserController::class, 'autenticate'])->name('autenticate');
