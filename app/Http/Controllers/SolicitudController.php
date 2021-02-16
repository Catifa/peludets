<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**

 *
 * @OA\Server(url="http://localhost")
 */

class SolicitudController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/solicitudes/enviarSolicitud",
     *     summary="Envia una solicitud al profesional correspondiente",

     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Cuando rellenas el formulario de solicitudes envia informacion a la base de datos del usuario"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */


    protected function enviarSolicitud(Request $request)
    {
        $request->validate([
            'nombre_trabajo' => 'required|string|max:255',
            'descripcion_trabajo' => 'required|string|max:255',
            'id_remitente' => 'required',
            'id_destinatario' => 'required',
        ]);

        Solicitud::insert([
            'nombre_trabajo' => $request->nombre_trabajo,
            'descripcion_trabajo' => $request->descripcion_trabajo,
            'id_remitente' => $request->id_remitente,
            'id_destinatario' => $request->id_destinatario,
        ]);
    }

/**
     * @OA\Post(
     *     path="/api/solicitudes/recuperar",
     *     summary="Almacena solicitudes de los usuarios",
     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Almacena solicitudes de los usuarios"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */

    protected function recuperar(Request $request)
    {
        return Solicitud::select('nombre_trabajo', 'descripcion_trabajo')
            ->where('id_destinatario', '=', $request->user()->id)->get();
    }
}
//si la primera solicitud no sale bien que la segunda no se faci