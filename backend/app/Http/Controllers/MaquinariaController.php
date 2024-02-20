<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filters\MaquinariaFilter;
use App\Http\Resources\MaquinariaCollection;
use Illuminate\Support\Facades\Validator;
use App\Models\Maquinaria;

class MaquinariaController extends Controller
{
    public function index(Request $request) {
        try {
            $filter = new MaquinariaFilter();
            $queryItems = $filter->transform($request);
            $relations = ['categoria'];

            $maquinaria = Maquinaria::where($queryItems);

            foreach ($relations as $relation) {
                if ($request->query('include' . ucfirst($relation))) {
                    $maquinaria->with(strtolower($relation));
                }
            }

            return new MaquinariaCollection($maquinaria->paginate($maquinaria->count())->appends($request->query()));
        } catch (\Exception $e) {
            return response()->json([
                'error' =>
                    $e->getMessage()
            ], 500);
        }
    }
    public function store(Request $request) {
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);
        if (!empty($params_array)) {
            $validator = Validator::make($params_array, [
                'name' => 'required',
                'description' => 'required',
                'fichaTecnica' => 'required',
                'capacidad' => 'required',
                'slug' => 'required',
                'image' => 'required',
                'categoria_id' => 'required|exists:categorias,id',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            $maquina = Maquinaria::create($params_array);

            return response()->json([
                'status' => 'success',
                'maquina' => $maquina
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No se envio ninguna maquina'
            ], 400);
        }
    }

    public function show($id) {
        $maquina = Maquinaria::find($id);

        if ($maquina) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'maquina' => $maquina
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Maquina no encontrada'
            ], 404);
        }
    }

    public function update(Request $request, $id) {
        $params_array = json_decode($request->input('json', null), true);

        if (!empty($params_array)) {
            $validator = Validator::make($params_array, [
                'name' => 'required',
                'description' => 'required',
                'fichaTecnica' => 'required',
                'capacidad' => 'required',
                'slug' => 'required',
                'image' => 'required',
                'categoria_id' => 'required|exists:categorias,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $box = Maquinaria::find($id);

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
