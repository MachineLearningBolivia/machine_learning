<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserCollection;
use App\Filters\UserFilter;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $filter = new UserFilter();
            $queryItems = $filter->transform($request);

            $users = User::where($queryItems);
            return new UserCollection($users->paginate()->appends($request->query()));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        // Recoger datos POST
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if (!empty($params_array)) {
            // Validar datos
            $validator = Validator::make($params_array, [
                'name' => 'required',
                'surname' => 'required',
                'role' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'phone' => 'required',
                'avatar' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Crear y guardar el usuario
            $user = User::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'user' => $user], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ningún usuario'], 400);
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Usuario no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $params_array = json_decode($request->input('json', null), true);

        if (!empty($params_array)) {
            $validator = Validator::make($params_array, [
                'name' => 'required',
                'surname' => 'required',
                'role' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'phone' => 'required',
                'avatar' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $box = User::find($id);

            if ($box) {
                $box->update($params_array);
                return response()->json(['status' => 'success', 'box' => $box], 200);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Caja no encontrada'], 404);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna caja'], 400);
        }
    }
}
