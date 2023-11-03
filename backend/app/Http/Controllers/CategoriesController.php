<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return response()->json($categories);
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
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Crear y guardar la categoría
            $category = Categories::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'category' => $category], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna categoría'], 400);
        }
    }

    public function show($id)
    {
        $category = Categories::find($id);

        if ($category) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'category' => $category
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Categoría no encontrada'
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

            // Actualizar categoría
            $category = Categories::where('id', $id)->update($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'category' => $params_array], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna categoría'], 400);
        }
    }
}
