<?php

namespace App\Http\Controllers;

use App\Imports\CategoriesImport;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function importCategories(Request $request)
    {
        $file = $request->file('import_file');

        Excel::import(new CategoriesImport, $file);

        return response()->json([
            'success' => true,
            'message' => 'Archivo importado exitosamente'
        ], 200);
    }

    public function importProducts(Request $request)
    {
        $file = $request->file('import_file');

        Excel::import(new ProductsImport, $file);

        return response()->json([
            'success' => true,
            'message' => 'Archivo importado exitosamente'
        ], 200);
    }
}
