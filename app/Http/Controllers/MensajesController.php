<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MensajesController extends Controller
{
    protected function insert(Request $request)
    {
        Mensaje::create([
            'idEmisor' => $request->idRemitente,
            'idDestinatario' => $request->idDestinatario,
            'mensaje' => $request->msg,
            'leido' => false,
        ]);
    }

    protected function select(Request $request)
    {
        return Mensaje::select('mensaje', 'created_at')
            ->where('idEmisor', $request->idRemitente)
            ->where('idDestinatario', $request->idDestinatario)
            ->get();
    }

    protected function hashRoom(Request $request)
    {
        return Hash::make($request->idRemitente . $request->idDestinatario);
    }
}
