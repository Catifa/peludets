<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use Illuminate\Http\Request;

class MensajesController extends Controller
{
    protected function insert(Request $request)
    {
        Mensaje::create([
            'idEmisor' => 1,
            'idRemitente' => 2,
            'mensaje' => $request->msg,
            'leido' => false,
        ]);
    }

    protected function select(Request $request)
    {
        return Mensaje::select('mensaje', 'created_at')
            ->where('idEmisor', $request->idEmisor)
            ->where('idRemitente', 2)
            ->get();
    }
}
