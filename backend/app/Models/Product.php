<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'price',
        'stock',
        'image',
        'status',
        'category_id'
    ];

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
