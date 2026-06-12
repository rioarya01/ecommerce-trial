<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function products() // 1 to many relationship with Product model
    {
        return $this->hasMany
        (Product::class, 'product_category_id');
    }
}
