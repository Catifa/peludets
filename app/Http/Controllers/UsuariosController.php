<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsuariosController extends Controller
{



    /**
     * Busqueda Profesionales (Profesiones, Disponibilidad, Titulacion)
     * 
     * @param string $profesion
     * @param string $disponibilidad
     * @param string $tiulacion
     * @return array \App\Models\Usuario
     */
    protected function buscarProfesionales(Request $request)
    {

        return $request->input('profesiones');
            
        /*$query = DB::table('usuarios')
        ->join('usuarios_profesiones', 'usuarios.id', '=', 'usuarios_profesiones.id_usuario')
        ->join('profesiones', 'profesiones.id', '=', 'usuarios_profesiones.id_profesion')
        ->where('');*/
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

        $prof = $request->input('nombre');

        $query = DB::table('users')->
        join('usuarios_profesiones', 'id_usuario', '=', 'users.id')->
        join('profesiones', 'profesiones.id', '=', 'usuarios_profesiones.id_profesion')->
        where('profesiones.nombre_profesion', '=', $prof);

        return $query->addSelect('users.id', 'users.name', 'users.lastname')->get();

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

        echo $request->input('id');
        
        $id = $request->input('id');

        $query = DB::table('users')->
        select('textoPerfil')->
        where('id', '=', $id);

        return $query->get();
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

        DB::table('users')->
        where('id', $id)->
        update(['textoPerfil->texto' => $texto]);

    }

}
