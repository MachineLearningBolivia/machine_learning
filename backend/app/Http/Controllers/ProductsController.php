<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return response()->json($products);
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
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'slug' => 'required',
                'image' => 'required',
                'status' => 'required|boolean',
                'category_id' => 'required|exists:categories,id',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Crear y guardar el producto
            $product = Products::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'product' => $product], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ningún producto'], 400);
        }
    }

    public function show($id)
    {
        $product = Products::find($id);

        if ($product) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'product' => $product
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Producto no encontrado'
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
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'slug' => 'required',
                'image' => 'required',
                'status' => 'required|boolean',
                'category_id' => 'required|exists:categories,id',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Quitar datos no necesarios
            unset($params_array['id']);
            unset($params_array['created_at']);
            unset($params_array['updated_at']);

            // Actualizar producto
            $product = Products::where('id', $id)->update($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'product' => $params_array], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ningún producto'], 400);
        }
    }
}
