<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColorImage extends Model
{
    protected $fillable = ['product_color_id','image','is_main'];

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class);
    }
}
