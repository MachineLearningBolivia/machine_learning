<?php

namespace App\Http\Controllers;

use App\Models\OperationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OperationTypeCollection;
use App\Filters\OperationTypeFilter;

class OperationTypesController extends Controller
{
    public function index(Request $request)
    {
        try {
            $filter = new OperationTypeFilter();
            $queryItems = $filter->transform($request);

            $operationTypes = OperationType::where($queryItems);
            return new OperationTypeCollection($operationTypes->paginate()->appends($request->query()));
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
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Crear y guardar el tipo de operación
            $operationType = OperationType::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'operationType' => $operationType], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ningún tipo de operación'], 400);
        }
    }

    public function show($id)
    {
        $operationType = OperationType::find($id);

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
        $params_array = json_decode($request->input('json', null), true);

        if (!empty($params_array)) {
            $validator = Validator::make($params_array, [
                'name' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $box = OperationType::find($id);

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
