<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfesionController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\SitiosInteresController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authentication', function (Request $request) {
    return true;
});

Route::get('mascotas', [MascotasController::class, 'index']);

Route::group(['prefix' => 'mascota'], function () {
    Route::post('add', [MascotasController::class, 'add']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('check', [AuthController::class, 'check']);
});

// Recoger las profesiones
Route::get('profesiones', [ProfesionController::class, 'getAll']);

//Solitudes
Route::group(['prefix' => 'solicitudes'], function () {
    Route::post('enviar', [SolicitudController::class, 'enviarSolicitud']);
    Route::post('recuperar', [SolicitudController::class, 'recuperar']);

});

Route::group(['prefix' => 'files'], function () {
    Route::post('setProfilePhoto', [FileController::class, 'setProfilePhoto']);
    Route::post('getProfilePhoto', [FileController::class, 'getProfilePhoto']);
});

Route::group(['prefix' => 'usuario'], function () {
    Route::get('busquedaProfesionales', [UsuariosController::class, 'buscarProfesionales']);
    Route::post('userByProf', [UsuariosController::class, 'searchByProf']);
    Route::post('userByProfOnly', [UsuariosController::class, 'userByProfOnly']);
    Route::post('perfil', [UsuariosController::class, 'perfil']);
    Route::post('app', [UsuariosController::class, 'app']);
    Route::post('editarPerfil', [UsuariosController::class, 'editarPerfil']);
    Route::post('getProfText', [UsuariosController::class, 'getProfText']);
    Route::post('setProfText', [UsuariosController::class, 'setProfText']);
});

Route::group(['prefix' => 'explorador'], function () {
    Route::post('getSitiosInteres', [SitiosInteresController::class, 'getSitiosInteres']);
});
