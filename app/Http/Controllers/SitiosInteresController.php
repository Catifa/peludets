<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SitiosInteres;


/**

 *
 * @OA\Server(url="http://localhost")
 */

class SitiosInteresController extends Controller
{

        /**
     * @OA\Post(
     *     path="/api/explorador/getSitiosInteres",
     *     summary="Recupera sitios de interes",

     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Recupera de la base de datos los sitios de interes que los usuarios registran y almacenan"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    protected function getSitiosInteres(Request $request)
    {
        return SitiosInteres::get();
    }
}
