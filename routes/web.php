<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarneController;

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

Route::controller(CarneController::class)->group(function () {
    Route::post('send-form', 'sendFormFrontEnd')->name('send');
    Route::get('show-carne/{id}', 'showCarne')->name('showCarne');
    Route::get('lista-carnes', "listagem")->name('listagem');
});

Route::get('/', function () {
    return view('index');
})->name('home');
