<?php

namespace App\Http\Controllers;

use App\Models\Boxes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoxesController extends Controller
{
    public function index()
    {
        $boxes = Boxes::all();
        return response()->json($boxes);
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
            $box = Boxes::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'box' => $box], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna caja'], 400);
        }
    }

    public function show($id)
    {
        $box = Boxes::find($id);

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

            // Quitar datos no necesarios
            unset($params_array['id']);
            unset($params_array['created_at']);
            unset($params_array['updated_at']);
            unset($params_array['deleted_at']);

            // Actualizar box
            $box = Boxes::where('id', $id)->update($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'box' => $params_array], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna caja'], 400);
        }
    }
}
