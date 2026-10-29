<?php

namespace App\Http\Controllers;

use App\Models\ProductColor;
use App\Models\ProductColorImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductColorImageController extends Controller
{
    public function store(Request $r, ProductColor $productColor)
    {
        $r->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240'
        ]);

        $path = $r->file('image')->store('products','public');

        ProductColorImage::create([
            'product_color_id' => $productColor->id,
            'image' => $path,
            'is_main' => $r->boolean('is_main')
        ]);

        return back()->with('success', 'Image ajoutée');
    }

    public function destroy(ProductColorImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();
        return back();
    }
}
