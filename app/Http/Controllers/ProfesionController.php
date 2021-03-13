<?php

namespace App\Http\Controllers;

use App\Models\Profesion;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



/**

 *
 * @OA\Server(url="http://localhost")
 */


class ProfesionController extends Controller
{
    /**
     * Devuelve todos los registros de Profesiones
     *
     * @return App\Models\Profesion (Array)
     */


             /**
     * @OA\Get(
     *     path="/api/profesiones/getAll",
     *     summary="Devuelve todos los registros de Profesiones",

     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Devuelve todos los registros de Profesiones"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    protected function getAll()
    {
        return Profesion::all()->toArray();
    }

    /**
     *  Obtener todas las profesiones de un usuario
     * 
     *  @return Array
     */
    protected function getUserProf(Request $request) {
        
        return Profesion::select('profesiones.id', 'profesiones.nombre_profesion')
        ->join('usuarios_profesiones', 'id_profesion', '=', 'profesiones.id')
        ->where('usuarios_profesiones.id_usuario', '=', $request->id)->get();
    }

    protected function insertProf(Request $request){
        DB::insert('insert into usuarios_profesiones (id_usuario, id_profesion,titulacion,disponibilidad) values (?, ?,?,?)', [200, 400, 'S', 'presencial']);

    }


}
