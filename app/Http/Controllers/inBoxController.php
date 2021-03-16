<?php

namespace App\Http\Controllers;

use App\Models\InBox;
use App\Models\User;
use Illuminate\Http\Request;

class inBoxController extends Controller
{
    public function select(Request $request)
    {
        return InBox::where('idUser', $request->user()->id)->get();
    }

    public function insert(Request $request)
    {
        InBox::create([
            'idUser' => $request->user()->id,
        ]);
    }
}
