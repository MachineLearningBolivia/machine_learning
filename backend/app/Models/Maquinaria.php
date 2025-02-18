<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'fichaTecnica',
        'capacidad'.
        'slug',
        'image',
        'categoria_id'
    ];

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
