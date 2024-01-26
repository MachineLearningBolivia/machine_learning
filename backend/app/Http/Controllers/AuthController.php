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
        // Recoger datos POST
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if (!Auth::attempt($params_array)) {
            // Validar datos
            $validator = Validator::make($params_array, [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Devolver si son credenciales incorrectas
            return response()->json([
                'status' => false,
                'errors' => ['Credenciales incorrectas. Por favor, verifica tu usuario y contraseña.']
            ], 401);
        }

        // Obtener usuario autenticado
        $user = Auth::user();

        // Crear token de autorización
        $token = $user->createToken('token')->plainTextToken;

        // Crear Cookie para el token
        $cookie = cookie('jwt', $token, 60 * 24);

        // Devolver inicio de sesión
        return response()->json([
            'status' => true,
            'message' => '¡Bienvenido de nuevo! Inicio de sesión exitoso',
            'data' => $user,
            'token' => $token
        ], 200)->withCookie($cookie);
    }

    public function verify(Request $request)
    {
        // Obtener token de headers
        $token = $request->bearerToken();

        // Verificar si el token fue enviado
        if (!$token) {
            return response()->json([
                'status' => false,
                'errors' => ['No autorizado']
            ], 401);
        }

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Devolver al usuario autenticado
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

    public function updateProfile(Request $request)
    {
        $params_array = json_decode($request->input('json', null), true);

        if (!empty($params_array)) {
            $validator = Validator::make($params_array, [
                'name' => 'required',
                'surname' => 'required',
                'role' => 'required',
                'email' => 'required|email|unique:users,email', // Agregamos la excepción para el usuario actual
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
                return response()->json(['status' => 'success', 'user' => $user], 200);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 404);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ningún usuario'], 400);
        }
    }

    public function logout()
    {
        // Destruir cookie
        $cookie = Cookie::forget('jwt');

        // Devolver mensaje satisfactorio
        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}
