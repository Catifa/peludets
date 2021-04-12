<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


/**
 * @OA\Info(title="API Peludets", version="1.0")
 *
 * @OA\Server(url="http://localhost")
 */

class UsuariosController extends Controller
{

    /**
     * 
     * Busqueda de profesionales solo por profesion, cuando vienen por el formulario del Home
     * 
     * @param Request $request
     * 
     * @return \App\Models\UserUser
     */


    /**
     * @OA\Post(
     *     path="/api/usuario/userByProfOnly",
     *     summary="Busqueda de profesionales solo por profesion, cuando vienen por el formulario del Home",
     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="String",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Busqueda de profesionales solo por profesion, cuando vienen por el formulario del Home"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    protected function userByProfOnly(Request $request)
    {

        return User::select('users.id', 'users.name', 'users.lastname', 'users.photo')
            ->join('usuarios_profesiones', 'id_usuario', '=', 'users.id')
            ->join('profesiones', 'profesiones.id', '=', 'usuarios_profesiones.id_profesion')
            ->where('profesiones.nombre_profesion', '=', $request->input('nombre'))->get();
    }

    /**
     * 
     * Busqueda de profesionales por todos los campos
     * 
     * @param Request $request
     * 
     * @return \App\Models\UserUser
     */

    /**
     * @OA\Post(
     *     path="/api/usuario/searchByProf",
     *     summary="Busqueda de profesionales solo por profesion",
     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Busqueda de profesionales solo por profesion, cuando vienen por el formulario del Home"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */


    protected function searchByProf(Request $request)
    {
        if ($request->disponibilidad === "P" || $request->disponibilidad === "O") {
            return User::select('users.id', 'users.name', 'users.lastname', 'users.photo')
                ->join('usuarios_profesiones', 'id_usuario', '=', 'users.id')
                ->join('profesiones', 'profesiones.id', '=', 'usuarios_profesiones.id_profesion')
                ->where('profesiones.nombre_profesion', '=', $request->servicio)
                ->where('usuarios_profesiones.disponibilidad', '=', $request->disponibilidad)
                ->where('usuarios_profesiones.titulacion', '=', $request->titulacion)
                ->orWhere(function ($query) use ($request) {
                    $query->where('usuarios_profesiones.disponibilidad', '=', "PO")
                        ->where('profesiones.nombre_profesion', '=', $request->servicio)
                        ->where('usuarios_profesiones.titulacion', '=', $request->titulacion);
                })
                ->get();
        }

        return User::select('users.id', 'users.name', 'users.lastname', 'users.photo')
            ->join('usuarios_profesiones', 'id_usuario', '=', 'users.id')
            ->join('profesiones', 'profesiones.id', '=', 'usuarios_profesiones.id_profesion')
            ->where('profesiones.nombre_profesion', '=', $request->servicio)
            ->where('usuarios_profesiones.disponibilidad', '=', "PO")
            ->where('usuarios_profesiones.titulacion', '=', $request->titulacion)
            ->orWhere(function ($query) use ($request) {
                $query->where('usuarios_profesiones.disponibilidad', '=', "P")
                    ->where('profesiones.nombre_profesion', '=', $request->servicio)
                    ->where('usuarios_profesiones.titulacion', '=', $request->titulacion);
            })
            ->orWhere(function ($query) use ($request) {
                $query->where('usuarios_profesiones.disponibilidad', '=', "O")
                    ->where('profesiones.nombre_profesion', '=', $request->servicio)
                    ->where('usuarios_profesiones.titulacion', '=', $request->titulacion);
            })
            ->get();
    }

    /**
     * @OA\Post(
     *     path="/api/usuario/perfil",
     *     summary="Recupera el id del usuario para mostrar el perfil que estas visitando",
     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Recupera el id del usuario para mostrar el perfil que estas visitando"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */


    protected function perfil(Request $request)
    {
        return User::where('id', '=', $request->id)->get();
    }

    /** 
     *
     * Guarda la parte del perfil editable
     * 
     * @param Request $request
     */

    /**
     * @OA\Post(
     *     path="/api/usuario/editarPerfil",
     *     summary="Guarda la parte del perfil editable",
     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="texto",
     *     )),      
     *      @OA\Response(
     *         response=200,
     *         description="Guarda la parte del perfil editable, en la base de datos del propio usuario"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */

    protected function editarPerfil(Request $request)
    {

        $texto = $request->val;

        DB::table('users')->insert([
            'textoPerfil' => $texto, 'id' => '1'
        ]);
    }

    /**
     * 
     * Recuperar el texto que tenga el usuario guardado en su perfil
     * 
     * @param Request $request
     * 
     * @return json
     */

    /**
     * @OA\Post(
     *     path="/api/usuario/getProfText",
     *     summary="Recuperar lo guardado por el usuario en su perfil",
     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="Id",
     *     )),  
     * 
     *     @OA\Response(
     *         response=200,
     *         description="Recuperar el texto que tenga el usuario guardado en su perfil."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    protected function getProfText(Request $request)
    {

        $id = $request->id;

        $query = User::select('textoPerfil')->where('id', '=', $id);

        return json_encode($query->get());
    }

    /**
     * 
     * Actualizar el texto que tenga el usuario en su perfil
     * 
     * @param Request $request
     */


    /**
     * @OA\Post(
     *     path="/api/usuario/setProfText",
     *     summary=" Actualizar el diseño  perfil del usuario",
     * 
     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),  
     * 
     *     @OA\Response(
     *         response=200,
     *         description=" Actualizar el diseño  que tenga el usuario en su perfil, que previamente modifique"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    protected function setProfText(Request $request)
    {

        $id = $request->id;
        $texto = $request->val;

        User::where('id', $id)->update(['textoPerfil' => $texto]);
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    protected function setProfilePhotoUser(Request $request)
    {
        User::where('id', $request->user()->id)
            ->update(['photo' => $request->img,]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function updateUsuario(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'dni' => 'required|string|max:9',
        ]);


        User::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'dni' => $request->dni,
            'email' => $request->email,
            'photo' => $request->img
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function recuperarUser(Request $request)
    {
        return User::where('id', '=', $request->id)->get();
    }
}
