<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductCollection;
use App\Filters\ProductFilter;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $filter = new ProductFilter();
            $queryItems = $filter->transform($request);
            $relations = ['category'];

            $products = Product::where($queryItems);

            foreach ($relations as $relation) {
                if ($request->query('include' . ucfirst($relation))) {
                    $products->with(strtolower($relation));
                }
            }

            return new ProductCollection($products->paginate()->appends($request->query()));
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
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'slug' => 'required',
                'image' => 'required',
                'status' => 'required|boolean',
                'category_id' => 'required|exists:categories,id',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json(['status' => 'error', 'message' => 'Error de validación', 'errors' => $validator->errors()], 400);
                //return response()->json($validator->errors(), 400);
            }

            // Crear y guardar el producto
            $product = Product::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'product' => $product], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ningún producto', 'json' => $json, 'request' => $request], 400);
        }
    }

    public function show($id)
    {
        $product = Product::find($id);

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
        $params_array = json_decode($request->input('json', null), true);

        if (!empty($params_array)) {
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
                return response()->json($validator->errors(), 400);
            }

            $box = Product::find($id);

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
