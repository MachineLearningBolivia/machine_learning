<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ProductFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'description' => ['eq'],
        'price' => ['eq', 'neq', 'gt', 'gte', 'lt', 'lte'],
        'stock' => ['eq', 'neq', 'gt', 'gte', 'lt', 'lte'],
        'status' => ['eq', 'neq', 'ne'],
        'categoryId' => ['eq'],
    ];
    protected $columMap = [
        'name' => 'name',
        'description' => 'description',
        'price' => 'price',
        'stock' => 'stock',
        'status' => 'status',
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
