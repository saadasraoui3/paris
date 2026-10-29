<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'is_active'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'pack_product')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    // Somme des prix des produits du pack (pour afficher l'économie)
    public function getProductsTotalAttribute()
    {
        return $this->products->sum(fn ($p) => $p->price * $p->pivot->quantity);
    }
}
