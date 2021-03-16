<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;


/**

 *
 * @OA\Server(url="http://localhost")
 */

class MascotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/mascotas/index",
     *     summary="Devuelve todos los registros de mascotas",

     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Devuelve todos los registros de mascotas"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */

    public function index()
    {
        $mascotas = Mascota::all()->toArray();
        return array_reverse($mascotas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * @OA\Post(
     *     path="/api/mascotas/add",
     *     summary="Añadir Mascotas",

     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Añadir mascotas"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */



    public function add(Request $request)
    {
        $mascota = new Mascota([
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'raza' => $request->raza,
            'edad' => $request->edad,
            'peso' => $request->peso
        ]);
        $mascota->save();
    }
    protected function recuperarMascota(Request $request)
    {
        return Mascota::where('id_usuario', '=', $request->user()->id)->get();
    }
    public function registerMascota(Request $request)
    {
        Mascota::create([
            'id_usuario' => $request->userId,
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'raza' => $request->raza,
            'edad' => $request->edad,
            'peso' => $request->peso,
            'photo' => $request->photo
        ]);
    }

    public function deleteMascota(Request $request)
    {
        echo $request->id;
        Mascota::where('id', '=', $request->id)->delete();
    }

    public function updateMascota(Request $request)
    {
        Mascota::where('id', '=', $request->id)->update([
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'raza' => $request->raza,
            'edad' => $request->edad,
            'peso' => $request->peso,
            'photo' => $request->img
        ]);
    }


    protected function setProfilePhotoMascota(Request $request)
    {
        Mascota::where('id', $request->mascota()->id)
            ->update(['photo' => $request->img,]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function show(Mascota $mascotas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function edit(Mascota $mascotas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mascota $mascotas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mascota $mascotas)
    {
        //
    }
}
