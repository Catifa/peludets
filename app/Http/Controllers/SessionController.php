<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getSessionData(Request $request)
    {
        return session()->get('name');
    }

    public function storeSessionData(Request $request)
    {
        $request->session()->put('name', 'Jennifer');
        echo 'Data added';
        return $request->session()->get('name');
    }

    public function deleteSessionData(Request $request)
    {
        $request->session()->forget('name');
        echo 'Data delete';
    }
}
