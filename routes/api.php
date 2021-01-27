<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Http\Request;


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
Route::middleware('auth:sanctum')->get('/user',function (Request $request){
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authentication',function (Request $request){
    return true;
});

Route::get('mascotas', 'MascotasController@index');

Route::group(['prefix' => 'mascota'], function() {
    Route::post('add', 'MascotasController@add');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('check',[AuthController::class,'check']);
});

Route::group(['prefix'=>'usuario'], function(){
    Route::get('busquedaProfesionales',[UsuariosController::class,'buscarProfesionales']);
});