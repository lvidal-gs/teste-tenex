<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarneController;

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

Route::controller(CarneController::class)->group(function () {
    Route::post('envio-carne', 'receberDadosCarne')->name('sendCarneData');
    Route::get('get-carne/{id}', "getDadosCarne")->name('getCarneById');
});



