<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class OperationFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'operationTypeId' => ['eq'],
        'boxId' => ['eq'],
        'userId' => ['eq'],
    ];
    protected $columnMap = [
        'name' => 'name',
        'operationTypeId' => 'operation_type_id',
        'boxId' => 'box_id',
        'userId' => 'user',
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