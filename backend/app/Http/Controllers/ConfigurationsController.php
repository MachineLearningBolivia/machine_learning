<?php

namespace App\Http\Controllers;

use App\Models\Configurations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigurationsController extends Controller
{
    public function index()
    {
        $configurations = Configurations::all();
        return response()->json($configurations);
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
                'value' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Crear y guardar la configuración
            $configuration = Configurations::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'configuration' => $configuration], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna configuración'], 400);
        }
    }

    public function show($id)
    {
        $configuration = Configurations::find($id);

        if ($configuration) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'configuration' => $configuration
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Configuración no encontrada'
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
                'value' => 'required',
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

            // Actualizar configuración
            $configuration = Configurations::where('id', $id)->update($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'configuration' => $params_array], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna configuración'], 400);
        }
    }
}
