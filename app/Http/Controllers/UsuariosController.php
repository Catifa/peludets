<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
    protected function userByProfOnly(Request $request) {

        return User::select('users.id', 'users.name', 'users.lastname')->
        join('usuarios_profesiones', 'id_usuario', '=', 'users.id')-> 
        join('profesiones', 'profesiones.id', '=', 'usuarios_profesiones.id_profesion')-> 
        where('profesiones.nombre_profesion', '=', $request->input('nombre'))->get();

    }

    /**
     * 
     * Busqueda de profesionales solo por profesion, cuando vienen por el formulario del Home
     * 
     * @param Request $request
     * 
     * @return \App\Models\UserUser
     */
    protected function searchByProf(Request $request) {

        $prof = $request->input('profesionales');
        $disp = $request->input('disponibilidad');
        $titu = $request->input('titulacion');

        return User::

        select('users.id', 'users.name', 'users.lastname') 
        -> join('usuarios_profesiones', 'id_usuario', '=', 'users.id')
        -> join('profesiones', 'profesiones.id', '=', 'usuarios_profesiones.id_profesion')
        -> where('nombre_profesion.profesiones', '=', $prof)
        -> where('usuarios_profesiones.disponibilidad', '=', $disp) 
        -> where('usuarios_profesiones.titulacion', '=', $titu) ->get();

    }

    
    protected function perfil(Request $request)
    {
        return User::where('id', '=', $request->input('id'))->get();
    }

    /** 
    *
    * Guarda la parte del perfil editable
    * 
    * @param Request $request
    */
    protected function editarPerfil(Request $request) {

        $texto = $request->input('val');

        DB::table('users')->
        insert([
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
    protected function getProfText(Request $request) {

        $id = $request->input('id');

        $query = User::select('textoPerfil')->
        where('id', '=', $id);

        return json_encode($query->get());
    }

    /**
     * 
     * Actualizar el texto que tenga el usuario en su perfil
     * 
     * @param Request $request
     */
    protected function setProfText(Request $request) {
        
        $id = $request->input('id');
        $texto = $request->input('val');

        User::where('id', $id)->
        update(['textoPerfil' => $texto]);

    }

}
