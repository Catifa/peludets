<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected function setProfilePhoto(Request $request)
    {
        Image::updateOrInsert(
            ['category' => 'profile', 'idUser' => $request->user()->id],
            ['image' => $request->img,]
        );
    }

    protected function getProfilePhoto(Request $request)
    {
        return Image::select('image')
            ->where('idUser', '=', $request->user()->id)
            ->where('category', '=', 'profile')
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
