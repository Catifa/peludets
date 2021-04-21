<?php

namespace App\Http\Controllers;

use App\Models\valoraciones;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ValoracionesController extends Controller
{

   /**
    * Undocumented function
    *
    * @param Request $request
    * @return void
    */ 
   protected function recuperarValoraciones(Request $request)
    {
      return valoraciones::select('u2.id', 'u1.name', 'u1.lastname', 'u1.photo', 'valoraciones.valoraciones', 'valoraciones.puntuacion')
      ->join('users AS u1', 'valoraciones.id_usuario_remitente','=', 'u1.id')
      ->join('users AS u2', 'valoraciones.id_usuario','=', 'u2.id')
      ->where('u2.id', '=', $request->id)->get();  
   }

   /**
    * Insertar Valoración
    */
    protected function insert(Request $request)
    {
       Valoraciones::create([
          'id_usuario' => 1,
          'id_usuario_remitente' => $request->user()->id,
          'nombre_id_usuario' => $request->user()->name,
          'valoraciones' => $request->texto,
          'puntuacion' => 5
       ]);
    }

}
