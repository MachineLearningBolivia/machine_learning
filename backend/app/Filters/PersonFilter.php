<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class PersonFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'city' => ['eq'],
        'country' => ['eq']
    ];
    protected $columnMap = [
        'name' => 'name',
        'city' => 'city',
        'country' => 'country'
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