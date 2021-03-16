<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;


/**

 *
 * @OA\Server(url="http://localhost")
 */

class AuthController extends Controller
{

                 /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Registro de usuarios",

     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Registro de usuarios"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'dni' => 'required|string|max:9|unique:users',
            'password' => 'required|string|min:5'
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'dni' => $request->dni,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            return response()->json(['user' => Auth::user(), 'token' => $user->createToken('api_token')->plainTextToken], 200);
        }
        
        return response()->json(Auth::user(), 200);
        
    }

    public function adminRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:5'
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(Auth::guard('admin')->user(), 200);
        }
        
        return response()->json(Auth::guard('admin')->user(), 200);
        
    }

                     /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Login de usuarios",

     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Login de usuarios"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        return response()->json(['user' => $user, 'token' => $user->createToken('api_token')->plainTextToken], 200);
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return response()->json(Auth::guard('admin')->user(), 200);
        }
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorect.']
        ]);
    }

                     /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Metodo para obtener la autorizacion",

     *     @OA\Parameter(
     *          name="",
     *          in="path",
     * 
     *     @OA\Schema(
     *         type="id",
     *     )),      
     *     @OA\Response(
     *         response=200,
     *         description="Metodo para obtener la autorizacion"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */

    public function logout(Request $request)
    {
        return $request->user()->tokens()->delete();
    }
}
