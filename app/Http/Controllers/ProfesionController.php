<?php

namespace App\Http\Controllers;

use App\Models\Profesion;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;




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
    protected function getUserProf(Request $request)
    {

        return Profesion::select('profesiones.id', 'profesiones.nombre_profesion')
            ->join('usuarios_profesiones', 'id_profesion', '=', 'profesiones.id')
            ->where('usuarios_profesiones.id_usuario', '=', $request->id)->get();
    }

    protected function insertProf(Request $request)
    {
        switch ($request->profesion) {
            case 'Paseador':$id_profesion= 1;break;case 'Alojamiento':$id_profesion= 2;break;case 'Peluquero':$id_profesion= 3;break;case 'Entrenador':$id_profesion= 4;break;case 'Psicologo':$id_profesion= 5;break;case 'Adiestrador':$id_profesion= 6;break;case 'Veterinario':$id_profesion= 7;break;case 'Fotografo':$id_profesion= 8;break;case 'Agility':$id_profesion= 9;break;case 'Etologo':$id_profesion= 10;break;case 'Passejador':$id_profesion= 11;break;case 'Allotjament':$id_profesion= 12;break;case 'Perruquer':$id_profesion= 13;break;case 'Piscòleg':$id_profesion= 15;break;
        }

        DB::insert('insert into usuarios_profesiones (id_usuario, id_profesion,titulacion,disponibilidad) values (?, ?,?,?)', [$request->userId, $id_profesion, $request->titulacion, $request->disponibilidad]);
    }
}
