<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // protected $fillable = [
    //     'order_id','product_id',
    //     'product_color_id','quantity','price'
    // ];
     protected $fillable = [
        'order_id',
        'product_id',
        'product_color_id',
        'pack_id',
        'pack_items',
        'product_name',
        'quantity',
        'price',
        'subtotal'
    ];

    protected $casts = [
        'pack_items' => 'array'
    ];

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

     public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class);
    }
}
