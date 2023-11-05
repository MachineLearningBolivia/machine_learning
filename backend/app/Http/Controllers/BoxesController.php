<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BoxCollection;

class BoxesController extends Controller
{
    public function index()
    {
        $boxes = Box::all();
        return new BoxCollection($boxes);
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
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Crear y guardar la categoría
            $box = Box::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'box' => $box], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna caja'], 400);
        }
    }

    public function show($id)
    {
        $box = Box::find($id);

        if ($box) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'box' => $box
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Caja no encontrada'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $params_array = json_decode($request->input('json', null), true);

        if (!empty($params_array)) {
            $validator = Validator::make($params_array, [
                'name' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $box = Box::find($id);

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
