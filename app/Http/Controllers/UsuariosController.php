<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Usuario;

class UsuariosController extends Controller
{

    /***************************************
     *  Funciones para gestionar Usuarios  *
     ***************************************/

    /**
     * Validación de los datos que llegan por Request y registro.
     * 
     * @param array $request
     * @return \App\Models\Usuario
     */
    protected function add(Request $request)
    {
        // Validacion de los datos que llegar por request
        $datosValidos = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios|max:255',
            'dni' => 'required|string|max:9|unique:usuarios',
            'contrasena' => 'required|string|min:5'
        ]);

        if ($datosValidos->fails()) {
            return back()->withErrors([
                'nombre' => 'Nombre incorrecto',
                'apellido' => 'Apellido incorrecto',
                'email' => 'Email incorrecto',
                'dni' => 'DNI incorrecto',
                'contrasena' => 'Contraseña incorrecta'
            ]);
        } else {

            // Creacion usuario en la base de datos
            return Usuario::create([
                'nombre' => $request->input('nombre'),
                'apellido' => $request->input('apellido'),
                'dni' => $request->input('dni'),
                'email' => $request->input('email'),
                'contrasena' => Hash::make($request->input('contrasena'))
            ]);
        }
    }

    /**
     * Login.
     * 
     * @param array $request
     * @param \App\Models\Usuario $usuario 
     * @return \App\Models\Usuario
     */
    protected function login(Request $request)
    {
        $credenciales = $request('email', 'contrasena');

        // Verificacion del login
        if (Auth::attempt($credenciales)) {
            // Aquí tendría que devolver cookie
            //return $request->session()->regenerate();
        } else {
            return back()->withErrors([
                'email' => 'Email Incorrecto',
                'contrasena' => 'Contraseña Incorrecta'
            ]);
        }
    }

    /**
     * Update.
     * 
     * @param array $request
     * @return \App\Models\Usuario
     */
    protected function update(Request $request, Usuario $usuario)
    {
        $datosValidos = Validator::make($request->all(), [
            'nombre' => 'required|string|email|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|unique:usuarios|max:255'
        ]);
        
        if ($datosValidos->fails()) {
            return back()->withErrors([
                'nombre' => 'Nombre incorrecto',
                'apellido' => 'Apellido incorrecto'
            ]);
        } else {
            $usuario->update($request->all());
            return response()->json('succes', 'Datos actualizados correctamente');
        }
    }

    /**
     * Busqueda Profesionales (Profesiones, Disponibilidad, Titulacion)
     * 
     * @param string $profesion
     * @param string $disponibilidad
     * @param string $tiulacion
     * @return array \App\Models\Usuario
     */
    protected function buscarProfesionales($profesion, $disponibilidad, $titulacion)
    {
        $query = DB::table('usuarios')
        ->join('usuarios_profesiones', 'usuarios.id', '=', 'usuarios_profesiones.id_usuario')
        ->join('profesiones', 'profesiones.id', '=', 'usuarios_profesiones.id_profesion')
        ->where('');
    }
}
