<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'totalPrice',
        'date',
        'slug',
        'product_id',
        'person_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
