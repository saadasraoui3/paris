<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $categories = Category::all();
        $products = Product::with('category')->paginate(10);
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create() {
        return view('admin.products.create', [
            'categories'=>Category::all(),
            'colors'=>Color::all()
        ]);
    }

    public function store(Request $r) {
        // $product = Product::create($r->only([
        //     'name','slug','price','category_id','description'
        // ]));
        $product = Product::create($r->only([
    'name',
    'slug',
    'sku',
    'price',
    'old_price',
    'category_id',
    'description'
]));


        foreach ($r->colors as $color_id => $stock) {
            if ($stock > 0) {
                ProductColor::create([
                    'product_id'=>$product->id,
                    'color_id'=>$color_id,
                    'stock'=>$stock
                ]);
            }
        }
        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product) {
        return view('admin.products.edit', [
            'product'=>$product,
            'categories'=>Category::all(),
            'colors'=>Color::all()
        ]);
    }

    public function update(Request $request, Product $product)
{
    // Validation
    // $data = $request->validate([
    //     'name' => 'required|string',
    //     'slug' => 'required|string|unique:products,slug,' . $product->id,
    //     'price' => 'required|numeric',
    //     'category_id' => 'required|exists:categories,id',
    //     'description' => 'nullable|string',
    // ]);

    // $product->update($data);

    // // Update stock for colors
    // if ($request->has('colors')) {
    //     foreach ($request->colors as $color_id => $stock) {
    //         $pc = $product->productColors()->where('color_id', $color_id)->first();
    //         if ($pc) {
    //             $pc->update(['stock' => $stock]);
    //         } else {
    //             if ($stock > 0) {
    //                 $product->productColors()->create([
    //                     'color_id' => $color_id,
    //                     'stock' => $stock
    //                 ]);
    //             }
    //         }
    //     }
    // }

    // return redirect()->route('admin.products.index')
    //                  ->with('success','Product updated');
    $validated = $request->validate([
        'name' => 'required|string',
        'slug' => 'required|string|unique:products,slug,' . $product->id,
        'sku' => 'nullable|string',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'old_price' => 'nullable|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Update product
    $product->update($validated);

    // Update stock for colors
    if ($request->has('colors')) {
        foreach ($request->colors as $color_id => $stock) {
            // تخطي فقط إذا كان null (ما دخلت قيمة أصلا)
            if ($stock === null) {
                continue;
            }

            $pc = $product->productColors()->where('color_id', $color_id)->first();

            if ($pc) {
                // تحدث حتى لو 0 أو فارغ
                $pc->update(['stock' => (int)$stock]);
            } else {
                // إنشاء جديد إذا كان الـ stock > 0
                if ($stock > 0) {
                    $product->productColors()->create([
                        'color_id' => $color_id,
                        'stock' => (int)$stock
                    ]);
                }
            }
        }
    }

    return redirect()->route('admin.products.index')
        ->with('success', 'Product updated successfully');
}


    public function destroy(Product $product) {
        $product->delete();
        return back();
    }
}
