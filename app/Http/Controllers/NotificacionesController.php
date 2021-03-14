<?php

namespace App\Http\Controllers;

use App\Models\Notificaciones;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NotificacionesController extends Controller
{
    protected function add(Request $request)
    {
        $request->validate([
            'idDestinatario' => 'required',
            'categoria' => 'required',
            'contenido' => 'required',
        ]);

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);

        switch ($request->categoria) {
            case 'Chat':
                Notificaciones::create([
                    'idRemitente' => $request->user()->id,
                    'idDestinatario' => $request->idDestinatario,
                    'categoria' => 'Chat',
                    'contenido' => $request->contenido,
                ]);
                break;
            case 'Solicitud':
                Notificaciones::create([
                    'idRemitente' => $request->user()->id,
                    'idDestinatario' => $request->idDestinatario,
                    'categoria' => 'Solicitud',
                    'contenido' => $request->contenido,
                ]);
                break;
            default:
                return false;
                break;
        }
    }

    protected function getAll(Request $request)
    {
        return Notificaciones::where('idDestinatario',$request->user()->id)->get();
    }
}
