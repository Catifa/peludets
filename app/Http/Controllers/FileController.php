<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class FileController extends Controller
{
    protected function setProfilePhoto(Request $request)
    {
        Image::updateOrInsert(
            ['category' => 'profile', 'idUser' => $request->idUser],
            ['image' => $request->img,]
        );
    }

    protected function getProfilePhoto(Request $request)
    {
        return Image::select('image')
            ->where('idUser', '=', $request->idUser)
            ->where('category', '=', 'profile');
    }
}
