<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SaleCollection;
use App\Filters\SaleFilter;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        try {
            $filter = new SaleFilter();
            $queryItems = $filter->transform($request);
            $relations = ['product', 'person'];

            $sales = Sale::where($queryItems);

            foreach ($relations as $relation) {
                if ($request->query('include' . ucfirst($relation))) {
                    $sales->with(strtolower($relation));
                }
            }

            return new SaleCollection($sales->paginate()->appends($request->query()));
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
            $sale = Sale::create($params_array);

            // Devolver respuesta
            return response()->json(['status' => 'success', 'sale' => $sale], 201);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se envió ninguna venta'], 400);
        }
    }

    public function show($id)
    {
        $sale = Sale::find($id);

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
        $params_array = json_decode($request->input('json', null), true);

        if (!empty($params_array)) {
            $validator = Validator::make($params_array, [
                'quantity' => 'required|integer',
                'totalPrice' => 'required|numeric',
                'date' => 'required|date',
                'slug' => 'required',
                'product_id' => 'required|exists:products,id',
                'person_id' => 'required|exists:people,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $box = Sale::find($id);

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
