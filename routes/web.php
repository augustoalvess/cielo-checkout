<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

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


Route::group(['checkout'], function () {
    Route::get('/', [CheckoutController::class, 'index']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout/finalizar', [CheckoutController::class, 'checkoutCartaoDeCredito']);
});
