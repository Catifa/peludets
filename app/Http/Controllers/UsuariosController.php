<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Usuario;

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
            /*
        $query = DB::table('usuarios')
        ->join('usuarios_profesiones', 'usuarios.id', '=', 'usuarios_profesiones.id_usuario')
        ->join('profesiones', 'profesiones.id', '=', 'usuarios_profesiones.id_profesion')
        ->where('');*/;
    }

    /**
     * 
     * Busqueda de profesionales solo por profesion, cuando vienen por el formulario del Home
     * 
     * @param object $profesion
     * 
     * @return \App\Models\UserUser
     */
    protected function searchByProf(Request $request) {
        return $request->input('obj');
    }
}
