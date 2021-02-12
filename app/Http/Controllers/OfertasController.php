<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;

class OfertasController extends Controller
{
    protected function getOfertas(Request $request)
    {
        return Oferta::get();
    }
}
