<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactosController extends Controller
{
    protected function get(Request $request)
    {
        return Contacto::join('users', 'users.id', '=', 'contactos.idUserTwo')
            ->select('users.id', 'users.name', 'users.lastname')
            ->where('contactos.idUserOne',$request->user()->id)
            ->get();
    }

    protected function set(Request $request)
    {
        return Contacto::insert([
            'idUserOne' => $request->user()->id,
            'idUserTwo' => $request->idUserTwo,
        ]);
    }

    protected function remove(Request $request)
    {
        return Contacto::where('idUserOne', $request->user()->id)
            ->where('idUserTwo', $request->idUserTwo)
            ->delete();
    }
}
