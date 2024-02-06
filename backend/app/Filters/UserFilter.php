<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class UserFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'surname' => ['eq'],
        'role' => ['eq'],
        'email' => ['eq'],
        'phone' => ['eq'],
        'status' => ['eq', 'ne'],
    ];
    protected $columnMap = [
        'name' => 'name',
        'surname' => 'surname',
        'role' => 'role',
        'email' => 'email',
        'phone' => 'phone',
        'status' => 'status',
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