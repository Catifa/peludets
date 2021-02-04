<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudController extends Controller
{
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
    protected function recuperar(Request $request)
    {
        return Solicitud::select('nombre_trabajo', 'descripcion_trabajo')
            ->where('id_destinatario', '=', $request->id)->get();
    }
}
//si la primera solicitud no sale bien que la segunda no se faci