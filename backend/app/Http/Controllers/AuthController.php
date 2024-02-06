<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if (!Auth::attempt($params_array)) {
            $validator = Validator::make($params_array, [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

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

    public function updateProfile(Request $request)
    {
        $params_array = json_decode($request->input('json', null), true);

        if (!empty($params_array)) {
            $validator = Validator::make($params_array, [
                'name' => 'required',
                'surname' => 'required',
                'role' => 'required',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required',
                'avatar' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $user = Auth::user();

            if ($user) {
                $user->update($params_array);
                return response()->json([
                    'status' => 'success',
                    'user' => $user
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Usuario no encontrado'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No se envió ningún usuario'
            ], 400);
        }
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}
