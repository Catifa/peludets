<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfesionController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\MensajesController;
use App\Http\Controllers\OfertasController;
use App\Http\Controllers\ValoracionesController;
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

// Peticiones Mascotas
Route::group(['prefix' => 'mascota'], function () {
    Route::post('add', [MascotasController::class, 'add'])->middleware('auth');
    Route::get('all', [MascotasController::class, 'index']);
    Route::post('recuperarMascota', [MascotasController::class, 'recuperarMascota']);
    Route::post('registerMascota', [MascotasController::class, 'registerMascota'])->middleware('auth');
    Route::post('setProfilePhotoMascota', [MascotasController::class, 'setProfilePhotoMascota'])->middleware('auth');
    Route::post('deleteMascota', [MascotasController::class, 'deleteMascota'])->middleware('auth');
    Route::post('updateMascota', [MascotasController::class, 'updateMascota'])->middleware('auth');
});
// Peticiones Valoraciones
Route::group(['prefix' => 'valoraciones'], function () {
    Route::post('recuperarValoraciones', [ValoracionesController::class, 'recuperarValoraciones']);

});

// Peticiones Especies
Route::group(['prefix' => 'especie'], function () {
    Route::get('getAll', [EspecieController::class, 'getAll']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('adminRegister', [AuthController::class, 'adminRegister']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('adminLogin', [AuthController::class, 'adminLogin']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');
    Route::post('check', [AuthController::class, 'check']);
});

// Peticiones profesiones
Route::group(['prefix' => 'profesiones'], function() {
    Route::get('getAll', [ProfesionController::class, 'getAll']);
    Route::post('getUserProf', [ProfesionController::class, 'getUserProf']);
});


//Solitudes
Route::group(['prefix' => 'solicitudes'], function () {
    Route::post('enviar', [SolicitudController::class, 'enviarSolicitud'])->middleware('auth');
});

Route::group(['prefix' => 'files'], function () {
    Route::post('setProfilePhoto', [FileController::class, 'setProfilePhoto'])->middleware('auth');
    Route::post('getProfilePhoto', [FileController::class, 'getProfilePhoto'])->middleware('auth');
});

Route::group(['prefix' => 'usuario'], function () {
    Route::get('busquedaProfesionales', [UsuariosController::class, 'buscarProfesionales']);
    Route::post('searchByProf', [UsuariosController::class, 'searchByProf']);
    Route::post('userByProfOnly', [UsuariosController::class, 'userByProfOnly']);
    Route::post('perfil', [UsuariosController::class, 'perfil']);
    Route::post('app', [UsuariosController::class, 'app']);
    Route::post('editarPerfil', [UsuariosController::class, 'editarPerfil'])->middleware('auth');
    Route::post('getProfText', [UsuariosController::class, 'getProfText'])->middleware('auth');
    Route::post('setProfText', [UsuariosController::class, 'setProfText'])->middleware('auth');
    Route::post('updateUsuario', [UsuariosController::class, 'updateUsuario'])->middleware('auth');
});

Route::group(['prefix' => 'explorador'], function () {
    Route::post('getSitiosInteres', [SitiosInteresController::class, 'getSitiosInteres']);
    Route::post('getOfertas', [OfertasController::class, 'getOfertas']);
});

Route::group(['prefix' => 'chat'], function(){
    Route::post('insert',[MensajesController::class,'insert'])->middleware('auth');
    Route::post('select',[MensajesController::class,'select'])->middleware('auth');
    Route::post('hashRoom', [MensajesController::class, 'hashRoom'])->middleware('auth');
});

//Mail 
Route::group(['prefix'=> 'mail'], function() {
    Route::post('noreply',[MailController::class,'MailNoreply'])->middleware('auth');
});

Route::group(['prefix' => 'valoraciones'], function(){
   /*  Route::post('insert',[MensajesController::class,'insert']);
    Route::post('select',[MensajesController::class,'select']);
    Route::post('hashRoom', [MensajesController::class, 'hashRoom']); */
});


