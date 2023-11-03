<?php

namespace App\Http\Controllers;

use App\Models\OperationTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperationTypesController extends Controller
{
    public function index()
    {
        $operationTypes = OperationTypes::all();
        return response()->json($operationTypes);
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

            // Crear y guardar el tipo de operación
            $operationType = OperationTypes::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'operationType' => $operationType], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ningún tipo de operación'], 400);
        }
    }

    public function show($id)
    {
        $operationType = OperationTypes::find($id);

        if ($operationType) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'operationType' => $operationType
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Tipo de operación no encontrado'
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

            // Actualizar tipo de operación
            $operationType = OperationTypes::where('id', $id)->update($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'operationType' => $params_array], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ningún tipo de operación'], 400);
        }
    }
}
