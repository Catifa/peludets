<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    /* public function getSessionData(Request $request)
    {
        //error_log("getSession");
        return $request->session()->All();
    }

    public function storeSessionData(Request $request)
    {
        //error_log(print_r($request));
        $user = json_decode($request->data);
        $request->session()->put('name', $user->nombre);
        error_log(print_r($request, true));
        return $request;
    }

    public function deleteSessionData(Request $request)
    {
        $request->session()->forget('name');
    } */
}
