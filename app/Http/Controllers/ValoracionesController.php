<?php

namespace App\Http\Controllers;

use App\Models\valoraciones;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ValoracionesController extends Controller
{

    protected function recuperarValoraciones1(Request $request)
    {

      DB::select('select u2.id, u1.name, u1.lastname, u1.photo, v.valoraciones v.puntuacion from users u1 join valoraciones v on (u1.id = v.id_usuario_remitente) join users u2 on (u2.id = v.id_usuario)');
 
   }

    protected function recuperarValoraciones(Request $request)
    {
        return User::select('*')
        ->join ('valoraciones',  'users.id', '=', 'valoraciones.id_usuario')
        ->get(); 
   }

    protected function recuperarValoraciones2(Request $request)
    {
        return valoraciones::get();
    }
}
