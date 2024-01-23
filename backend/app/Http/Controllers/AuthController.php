<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{

    // public function register(Request $request)
    // {
    //     return User::create([
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'password' => Hash::make($request->input('password'))
    //     ]);

    // }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {

            return response()->json([
                'status' => false,
                'errors' => ['Credenciales incorrectas. Por favor, verifica tu usuario y contraseña.']
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24);

        return response()->json([
            'status' => true,
            'message' => '¡Bienvenido de nuevo! Inicio de sesión exitoso',
            'data' => $user,
            'token' => $token
        ], 200)->withCookie($cookie);
    }

    public function verify(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'status' => false,
                'errors' => ['No autorizado']
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'status' => true,
            'message' => '¡Autorizado!',
            'data' => $user,
        ], 200);
    }

    public function user()
    {
        return Auth::user();
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}
