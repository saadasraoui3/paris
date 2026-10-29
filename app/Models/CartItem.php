<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id','product_id','product_color_id',
        'pack_id','pack_items',
        'quantity','price'
    ];

    protected $casts = [
        'pack_items' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

    public function isPack(): bool
    {
        return $this->pack_id !== null;
    }

    // Nom affiché dans le panier / checkout
    public function getDisplayNameAttribute()
    {
        return $this->isPack() ? $this->pack->name : $this->product->name;
    }

    // Couleur du produit, ou détail des produits du pack
    public function getColorLabelAttribute()
    {
        if (!$this->isPack()) {
            return $this->productColor->color->name ?? '';
        }

        return collect($this->pack_items)->map(fn ($i) =>
            $i['product_name'].' ('.$i['color_name'].')'.($i['quantity'] > 1 ? ' ×'.$i['quantity'] : '')
        )->implode(', ');
    }

    // Chemin de l'image dans storage
    public function getImagePathAttribute()
    {
        if ($this->isPack()) {
            return collect($this->pack_items)->pluck('image')->filter()->first();
        }

        $image = $this->productColor->images->where('is_main', 1)->first()
              ?? $this->productColor->images->first();

        return $image?->image;
    }

    // Quantité maximum selon le stock
    public function getMaxStockAttribute()
    {
        if (!$this->isPack()) {
            return $this->productColor->stock;
        }

        $stocks = ProductColor::whereIn('id', collect($this->pack_items)->pluck('product_color_id'))
            ->pluck('stock', 'id');

        return collect($this->pack_items)->map(fn ($i) =>
            intdiv((int) ($stocks[$i['product_color_id']] ?? 0), max(1, $i['quantity']))
        )->min();
    }
}
