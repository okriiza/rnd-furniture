<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_product',
        'slug_product',
        'image_product',
        'price_product',
        'stock_product',
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class);
    }
}
