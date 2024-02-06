<?php

namespace App\Http\Controllers;

use App\Filters\PersonFilter;
use App\Http\Resources\PersonCollection;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        try {
            $filter = new PersonFilter();
            $queryItems = $filter->transform($request);

            $people = Person::where($queryItems);
            return new PersonCollection($people->paginate()->appends($request->query()));
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
                'city' => 'required',
                'country' => 'required',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Crear y guardar la persona
            $person = Person::create($params_array);

            // Devolver respuesta
            return response()->json([
                'status' => 'success',
                'person' => $person
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No se envió ninguna persona'
            ], 400);
        }
    }

    public function show($id)
    {
        $person = Person::find($id);

        if ($person) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'person' => $person
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Persona no encontrada'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $params_array = json_decode($request->input('json', null), true);

        if (!empty($params_array)) {
            $validator = Validator::make($params_array, [
                'name' => 'required',
                'city' => 'required',
                'country' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $box = Person::find($id);

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
