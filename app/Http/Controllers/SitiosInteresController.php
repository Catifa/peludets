<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SitiosInteres;

class SitiosInteresController extends Controller
{
    protected function getSitiosInteres(Request $request)
    {
        return SitiosInteres::get();
    }
}
