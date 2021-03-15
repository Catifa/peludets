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
use App\Http\Controllers\NotificacionesController;
use App\Http\Controllers\OfertasController;
use App\Http\Controllers\SitiosInteresController;
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

// Mascotas
Route::group(['prefix' => 'mascota'], function () {
    Route::post('add', [MascotasController::class, 'add'])->middleware('auth:sanctum');
    Route::get('all', [MascotasController::class, 'index']);
    Route::post('recuperarMascota', [MascotasController::class, 'recuperarMascota'])->middleware('auth:sanctum');
    Route::post('registerMascota', [MascotasController::class, 'registerMascota'])->middleware('auth:sanctum');
    Route::post('setProfilePhotoMascota', [MascotasController::class, 'setProfilePhotoMascota'])->middleware('auth:sanctum');
    Route::post('deleteMascota', [MascotasController::class, 'deleteMascota'])->middleware('auth:sanctum');
    Route::post('updateMascota', [MascotasController::class, 'updateMascota'])->middleware('auth:sanctum');
});
// Peticiones Valoraciones
Route::group(['prefix' => 'valoraciones'], function () {
    Route::post('recuperarValoraciones', [ValoracionesController::class, 'recuperarValoraciones']);
});

// Especies
Route::group(['prefix' => 'especie'], function () {
    Route::get('getAll', [EspecieController::class, 'getAll']);
});

// Auth Controller
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('adminRegister', [AuthController::class, 'adminRegister']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('adminLogin', [AuthController::class, 'adminLogin']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// Peticiones profesiones
Route::group(['prefix' => 'profesiones'], function () {
    Route::get('getAll', [ProfesionController::class, 'getAll']);
    Route::post('getUserProf', [ProfesionController::class, 'getUserProf']);
    Route::post('insertProf', [ProfesionController::class, 'insertProf']);
});


// Solitudes
Route::group(['prefix' => 'solicitudes'], function () {
    Route::post('enviar', [SolicitudController::class, 'enviarSolicitud'])->middleware('auth:sanctum');
    Route::post('getAll', [SolicitudController::class, 'getAll'])->middleware('auth:sanctum');
});

// Fotos
Route::group(['prefix' => 'files'], function () {
    Route::post('setProfilePhoto', [FileController::class, 'setProfilePhoto'])->middleware('auth:sanctum');
    Route::post('getProfilePhoto', [FileController::class, 'getProfilePhoto'])->middleware('auth:sanctum');
});

// Usuarios
Route::group(['prefix' => 'usuario'], function () {
    Route::get('busquedaProfesionales', [UsuariosController::class, 'buscarProfesionales']);
    Route::post('searchByProf', [UsuariosController::class, 'searchByProf']);
    Route::post('userByProfOnly', [UsuariosController::class, 'userByProfOnly']);
    Route::post('perfil', [UsuariosController::class, 'perfil'])->middleware('auth:sanctum');
    Route::post('app', [UsuariosController::class, 'app']);
    Route::post('editarPerfil', [UsuariosController::class, 'editarPerfil'])->middleware('auth:sanctum');
    Route::post('getProfText', [UsuariosController::class, 'getProfText'])->middleware('auth:sanctum');
    Route::post('setProfText', [UsuariosController::class, 'setProfText'])->middleware('auth:sanctum');
    Route::post('updateUsuario', [UsuariosController::class, 'updateUsuario'])->middleware('auth:sanctum');
    Route::post('setProfilePhotoUser', [UsuariosController::class, 'setProfilePhotoUser'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'explorador'], function () {
    Route::post('getSitiosInteres', [SitiosInteresController::class, 'getSitiosInteres']);
    Route::post('getOfertas', [OfertasController::class, 'getOfertas']);
});

Route::group(['prefix' => 'chat'], function () {
    Route::post('insert', [MensajesController::class, 'insert'])->middleware('auth:sanctum');
    Route::post('select', [MensajesController::class, 'select'])->middleware('auth:sanctum');
    Route::post('hashRoom', [MensajesController::class, 'hashRoom'])->middleware('auth:sanctum');
});

//Mail 
Route::group(['prefix' => 'mail'], function () {
    Route::post('noreply', [MailController::class, 'MailNoreply'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'valoraciones'], function () {
    /*  Route::post('insert',[MensajesController::class,'insert']);
    Route::post('select',[MensajesController::class,'select']);
    Route::post('hashRoom', [MensajesController::class, 'hashRoom']); */
});

Route::group(['prefix' => 'notificaciones'], function () {
    Route::post('add',[NotificacionesController::class,'add'])->middleware('auth:sanctum');
    Route::post('getAll',[NotificacionesController::class,'getAll'])->middleware('auth:sanctum');
    Route::post('delete',[NotificacionesController::class,'delete'])->middleware('auth:sanctum');
});