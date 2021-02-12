<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

/**

 *
 * @OA\Server(url="http://localhost")
 */

class FileController extends Controller
{

             /**
     * @OA\Post(
     *     path="/api/files/setProfilePhoto",
     *     summary="Metodo para subir fotos",

     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Metodo para subir fotos"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */


    protected function setProfilePhoto(Request $request)
    {
        Image::updateOrInsert(
            ['category' => 'profile', 'idUser' => $request->user()->id],
            ['image' => $request->img,]
        );
    }

    
             /**
     * @OA\Post(
     *     path="/api/files/getProfilePhoto",
     *     summary="Devuelve las imagenes de los usuarios",

     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Devuelve las imagenes de los usuarios"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */


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
