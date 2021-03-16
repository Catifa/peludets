<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    /**
     * Devolver todos los registros de especies
     * 
     * @return Array
     */
    protected function getAll() {
        return Especie::all()->toArray();
    }
}
