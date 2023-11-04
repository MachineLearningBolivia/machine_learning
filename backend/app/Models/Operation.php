<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'operation_type_id', 'box_id', 'user'];

    public function box()
    {
        return $this->belongsTo(Box::class);
    }

    public function operation_type()
    {
        return $this->belongsTo(OperationType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
