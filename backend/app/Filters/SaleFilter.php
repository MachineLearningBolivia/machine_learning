<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class SaleFilter extends ApiFilter
{
    protected $safeParams = [
        'quantity' => ['eq', 'neq', 'gt', 'gte', 'lt', 'lte'],
        'totalPrice' => ['eq', 'neq', 'gt', 'gte', 'lt', 'lte'],
        'date' => ['eq'],
        'productId' => ['eq'],
        'personId' => ['eq'],
    ];
    protected $columnMap = [
        'quantity' => 'quantity',
        'totalPrice' => 'total_price',
        'date' => 'date',
        'productId' => 'product_id',
        'personId' => 'person_id',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'neq' => '<>',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<='
    ];
}