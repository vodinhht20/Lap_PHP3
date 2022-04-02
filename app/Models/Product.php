<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // protected $with = ['news'];
    protected $table = 'products';

    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }

    public function categories()
    {
        return $this->belongsToMany(
            Product::class,
            'category_product',
            'product_id',
            'category_id'
        );
    }

    // public function news()
    // {
    //     return $this->belongsToMany(
    //         News::class,
    //         'new_products',
    //         'product_id',
    //         'new_id'
    //     );
    // }

}
