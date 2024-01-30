<?php

namespace App\Http\Controllers;

use App\Imports\CategoriesImport;
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
}
