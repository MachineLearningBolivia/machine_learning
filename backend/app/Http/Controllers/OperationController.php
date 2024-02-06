<?php

namespace App\Http\Controllers;

use App\Filters\OperationFilter;
use App\Http\Resources\OperationCollection;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $filter = new OperationFilter();
            $queryItems = $filter->transform($request);
            $relations = ['operationType', 'box', 'user'];

            $operations = Operation::where($queryItems);

            foreach ($relations as $relation) {
                if ($request->query('include' . ucfirst($relation))) {
                    $operations->with(strtolower($relation));
                }
            }

            return new OperationCollection($operations->paginate()->appends($request->query()));
        } catch (\Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                500
            );
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
            $operation = Operation::create($params_array);

            // Devolver respuesta
            return response()->json([
                'status' => 'success',
                'operation' => $operation
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No se envió ninguna operación'
            ], 400);
        }
    }

    public function show($id)
    {
        $operation = Operation::find($id);

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
        $params_array = json_decode($request->input('json', null), true);

        if (!empty($params_array)) {
            $validator = Validator::make($params_array, [
                'name' => 'required',
                'slug' => 'required',
                'operation_type_id' => 'required|exists:operation_types,id',
                'box_id' => 'required|exists:boxes,id',
                'user' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $box = Operation::find($id);

            if ($box) {
                $box->update($params_array);
                return response()->json([
                    'status' => 'success',
                    'box' => $box
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Caja no encontrada'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No se envió ninguna caja'
            ], 400);
        }
    }
}
