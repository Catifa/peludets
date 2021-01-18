<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SessionController;


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

Route::get('mascotas', 'MascotasController@index');

Route::group(['prefix' => 'mascota'], function() {
    Route::post('add', 'MascotasController@add');
});

Route::group(['prefix' => 'usuario'], function() {
    Route::post('add', [RegisterController::class, 'add']);
});

Route::group(['prefix' => 'session'], function () {
    Route::post('get',[SessionController::class,'getSessionData']);
    Route::post('set',[SessionController::class,'storeSessionData']);
    Route::get('remove',[SessionController::class,'deleteSessionData']);
});

