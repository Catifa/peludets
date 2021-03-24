<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Models\Trabajos;
use Illuminate\Http\Request;

class TrabajosController extends Controller
{
    protected function get(Request $request)    //Get trabajos por remitente
    {
        return Trabajo::where('id_remitente', $request->user()->id)->get();
    }

    protected function getByDestinatario(Request $request)  //Get trabajos por destinatario
    {
        return Trabajo::where('id_destinatario', $request->user()->id)->get();
    }

    protected function set(Request $request)    //Set trabajo desde destinatario
    {
        return  Trabajo::insert([
            'id_remitente' =>  $request->idRemitente,
            'id_destinatario' => $request->user()->id,
            'solicitud' => $request->solicitud,
        ]);
    }

    protected function updateRemitente(Request $request)    //Update por remitente
    {
        return Trabajo::where('id_remitente', $request->user()->id)->update([
            'check_remitente' => 'S'
        ]);
    }

    protected function updateDestinatario(Request $request)    //Update por destinatario
    {
        return Trabajo::where('id_destinatario', $request->user()->id)->update([
            'check_desitnatario' => 'S'
        ]);
    }
}
