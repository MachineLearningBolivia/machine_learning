<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeopleController extends Controller
{
    public function index()
    {
        $people = People::all();
        return response()->json($people);
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
            $person = People::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'person' => $person], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna persona'], 400);
        }
    }

    public function show($id)
    {
        $person = People::find($id);

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

            // Quitar datos no necesarios
            unset($params_array['id']);
            unset($params_array['created_at']);
            unset($params_array['updated_at']);

            // Actualizar persona
            $person = People::where('id', $id)->update($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'person' => $params_array], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna persona'], 400);
        }
    }
}
