<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = [
    //     'category_id','name','slug','description',
    //     'price','old_price','is_active','is_featured'
    // ];
 protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'old_price',
        'is_active',
        'is_featured'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors')
                    ->withPivot('stock')
                    ->withTimestamps();
    }
}
