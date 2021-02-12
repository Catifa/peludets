<?php

namespace App\Http\Controllers;

use App\Models\Profesion;
use Illuminate\Http\Request;


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
    public function getAll()
    {
        $profesiones = Profesion::all()->toArray();
        return array_reverse($profesiones);
    }
}
