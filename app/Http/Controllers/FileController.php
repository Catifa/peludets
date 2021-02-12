<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected function setProfilePhoto(Request $request)
    {
        User::where('id', $request->user()->id)
            ->update(['photo' => $request->img,]);
    }

    protected function getProfilePhoto(Request $request)
    {
        return User::select('photo')
            ->where('id', '=', $request->user()->id)
            ->get();
    }

    protected function uploadImgae(Request $request)
    {
        Image::insert([
            'idUser' => $request->idUser,
            'category' => $request->category,
            'image' => $request->img,
        ]);
    }

    protected function getImage(Request $request)
    {
        return Image::select('image')
            ->where('idUser', '=', $request->idUser)
            ->where('category', '=', $request->category);
    }
}
