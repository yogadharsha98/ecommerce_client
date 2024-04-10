<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    public function productImages()
    {
        // Assuming the Orders table has a product_id column
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }
    public function product()
    {
        // Assuming the Orders table has a product_id column
        return $this->belongsTo(Product::class, 'product_id');
    }
}
