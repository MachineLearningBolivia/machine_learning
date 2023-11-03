<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::all();
        return response()->json($sales);
    }

    public function store(Request $request)
    {
        // Recoger datos POST
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if (!empty($params_array)) {
            // Validar datos
            $validator = Validator::make($params_array, [
                'quantity' => 'required|integer',
                'totalPrice' => 'required|numeric',
                'date' => 'required|date',
                'slug' => 'required',
                'product_id' => 'required|exists:products,id',
                'person_id' => 'required|exists:people,id',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Crear y guardar la venta
            $sale = Sales::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'sale' => $sale], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna venta'], 400);
        }
    }

    public function show($id)
    {
        $sale = Sales::find($id);

        if ($sale) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'sale' => $sale
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Venta no encontrada'
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
                'quantity' => 'required|integer',
                'totalPrice' => 'required|numeric',
                'date' => 'required|date',
                'slug' => 'required',
                'product_id' => 'required|exists:products,id',
                'person_id' => 'required|exists:people,id',
            ]);

            if ($validator->fails()) {
                // Devolver error de validación
                return response()->json($validator->errors(), 400);
            }

            // Quitar datos no necesarios
            unset($params_array['id']);
            unset($params_array['created_at']);
            unset($params_array['updated_at']);

            // Actualizar venta
            $sale = Sales::where('id', $id)->update($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'sale' => $params_array], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna venta'], 400);
        }
    }
}
