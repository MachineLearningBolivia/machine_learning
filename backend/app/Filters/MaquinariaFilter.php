<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class MaquinariaFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'description' => ['eq'],
        'fichaTecnica' => ['eq'],
        'capacidad' => ['eq'],
        'categoriaId' => ['eq'],
    ];
    protected $columnMap = [
        'name' => 'name',
        'description' => 'description',
        'fichaTecnica' => 'fichaTecnica',
        'capacidad' => 'capacidad',
        'categoryId' => 'category_id',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'neq' => '<>',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
        'ne' => '!=',
    ];
}