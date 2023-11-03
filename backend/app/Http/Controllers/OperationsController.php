<?php

namespace App\Http\Controllers;

use App\Models\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperationsController extends Controller
{
    public function index()
    {
        $operations = Operations::all();
        return response()->json($operations);
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
                'slug' => 'required',
                'operation_type_id' => 'required|exists:operation_types,id',
                'box_id' => 'required|exists:boxes,id',
                'user' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Crear y guardar la operación
            $operation = Operations::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'operation' => $operation], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna operación'], 400);
        }
    }

    public function show($id)
    {
        $operation = Operations::find($id);

        if ($operation) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'operation' => $operation
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Operación no encontrada'
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
                'slug' => 'required',
                'operation_type_id' => 'required|exists:operation_types,id',
                'box_id' => 'required|exists:boxes,id',
                'user' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Quitar datos no necesarios
            unset($params_array['id']);
            unset($params_array['created_at']);
            unset($params_array['updated_at']);

            // Actualizar operación
            $operation = Operations::where('id', $id)->update($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'operation' => $params_array], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna operación'], 400);
        }
    }
}
