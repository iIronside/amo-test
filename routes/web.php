<?php

use App\Http\Controllers\AmoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AmoController::class)->prefix('amo')->name('amo.')->group(function () {
    Route::get('/', 'getForm')->name('get-form');
    Route::post('/send-form', 'sendForm')->name('send-form');
});
