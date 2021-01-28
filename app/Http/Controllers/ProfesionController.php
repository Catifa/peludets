<?php

namespace App\Http\Controllers;

use App\Models\Profesion;
use Illuminate\Http\Request;

class ProfesionController extends Controller
{
    /**
     * Devuelve todos los registros de Profesiones
     *
     * @return App\Models\Profesion (Array)
     */
    public function getAll()
    {
        $profesiones = Profesion::all()->toArray();
        return array_reverse($profesiones);
    }
}
