<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    protected function MailNoreply(Request $request)
    {
        $correo = [
            'title' => 'Tienes una nueva solicitud',
            'body' => 'PAYASO'
        ];
        Mail::to($request->email)->send(new \App\Mail\ContactanosMailable($correo));
      
    
        return 'Correo enviado';
    }
}
