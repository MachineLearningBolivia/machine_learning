<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ConfigurationFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'value' => ['eq'],
        'description' => ['eq']
    ];
    protected $columMap = [
        'name' => 'name',
        'value' => 'value',
        'description' => 'description'
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
