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
        switch ($request->solicitud) {
            case 'Paseador' || 'Peluquero':
                $request->validate([
                    'idDestinatario' => 'required|integer|max:255',
                    'idRemitente' => 'required|integer|max:255',
                    'fecha' => 'required|string',
                    'hora' => 'required|string',
                    'nombre' => 'required|string',
                    'especie' => 'required|string',
                    'peso' => 'required|string',
                    'cp' => 'required|string'
                ]);

                Solicitud::create([
                    'solicitud' => $request->getContent(),
                    'id_usuario_solicitado' => $request->idDestinatario
                ]);
            break;

            case 'Alojamiento':
                $request->validate([
                    'idDestinatario' => 'required|integer|max:255',
                    'idRemitente' => 'required|integer|max:255',
                    'fechaInicio' => 'required|string',
                    'fechaFinal' => 'required|string',
                    'horaManana' => 'required|string',
                    'horaTarde' => 'required|string',
                    'horaNoche' => 'required|string',
                    'nombre' => 'required|string',
                    'especie' => 'required|string',
                    'peso' => 'required|string',
                    'cp' => 'required|string'
                ]);

                Solicitud::create([
                    'solicitud' => $request->getContent(),
                    'id_usuario_solicitado' => $request->idDestinatario
                ]);
            break;

            case 'Entrenador':
                $request->validate([
                    'idDestinatario' => 'required|integer|max:255',
                    'idRemitente' => 'required|integer|max:255',
                    'fecha' => 'required|string',
                    'hora' => 'required|string',
                    'nombre' => 'required|string',
                    'especie' => 'required|string',
                    'peso' => 'required|string',
                    'entreno' => 'required|string',
                    'cp' => 'required|string'
                ]);

                Solicitud::create([
                    'solicitud' => $request->getContent(),
                    'id_usuario_solicitado' => $request->idDestinatario
                ]);
            break;

            case 'Psicologo':
                $request->validate([
                    'idDestinatario' => 'required|integer|max:255',
                    'idRemitente' => 'required|integer|max:255',
                    'fecha' => 'required|string',
                    'hora' => 'required|string',
                    'nombre' => 'required|string',
                    'especie' => 'required|string',
                    'peso' => 'required|string',
                    'textoAdicional' => 'required|string',
                    'entreno' => 'required|string',
                    'cp' => 'required|string'
                ]);

                Solicitud::create([
                    'solicitud' => $request->getContent(),
                    'id_usuario_solicitado' => $request->idDestinatario
                ]);
            break;

            default:
            break;
        }
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