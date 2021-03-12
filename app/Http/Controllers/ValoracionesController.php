<?php

namespace App\Http\Controllers;

use App\Models\valoraciones;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ValoracionesController extends Controller
{
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
