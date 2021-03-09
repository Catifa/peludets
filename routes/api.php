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

Route::group(['middleware' => ['cors']], function () {
    //Rutas a las que se permitirá acceso

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authentication', function (Request $request) {
    return true;
});

// Peticiones Mascotas
Route::group(['prefix' => 'mascota'], function () {
    Route::post('add', [MascotasController::class, 'add']);
    Route::get('all', [MascotasController::class, 'index']);
    Route::post('recuperarMascota', [MascotasController::class, 'recuperarMascota']);
    Route::post('registerMascota', [MascotasController::class, 'registerMascota']);
    Route::post('setProfilePhotoMascota', [MascotasController::class, 'setProfilePhotoMascota']);
    Route::post('deleteMascota', [MascotasController::class, 'deleteMascota']);
    Route::post('updateMascota', [MascotasController::class, 'updateMascota']);


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
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('check', [AuthController::class, 'check']);
});

// Peticiones profesiones
Route::group(['prefix' => 'profesiones'], function() {
    Route::get('getAll', [ProfesionController::class, 'getAll']);
    Route::post('getUserProf', [ProfesionController::class, 'getUserProf']);
});


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
    Route::post('updateUsuario', [UsuariosController::class, 'updateUsuario']);
    
});

Route::group(['prefix' => 'explorador'], function () {
    Route::post('getSitiosInteres', [SitiosInteresController::class, 'getSitiosInteres']);
    Route::post('getOfertas', [OfertasController::class, 'getOfertas']);
});

Route::group(['prefix' => 'chat'], function(){
    Route::post('insert',[MensajesController::class,'insert']);
    Route::post('select',[MensajesController::class,'select']);
    Route::post('hashRoom', [MensajesController::class, 'hashRoom']);
});

//Mail 
Route::group(['prefix'=> 'mail'], function() {
    Route::post('noreply',[MailController::class,'MailNoreply']);

});

Route::get('solicitud', function() {
    $correo = [
        'title' => 'Tienes una nueva solicitud',
        'body' => 'PAYASO'
    ];
    Mail::to('aciegoe@gmail.com')->send(new \App\Mail\solicitud($correo));

    return 'Correo enviado';

});


Route::group(['prefix' => 'valoraciones'], function(){
    Route::post('insert',[MensajesController::class,'insert']);
    Route::post('select',[MensajesController::class,'select']);
    Route::post('hashRoom', [MensajesController::class, 'hashRoom']);
});



});
