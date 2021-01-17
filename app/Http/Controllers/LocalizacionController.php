<?php

namespace App\Http\Controllers;

use App\Models\Localizacion;
use Illuminate\Http\Request;

class LocalizacionController extends Controller
{
    public function all() 
    {
        $localizaciones = Localizacion::all()->toArray();
        return array_reverse($localizaciones);
    }
}
