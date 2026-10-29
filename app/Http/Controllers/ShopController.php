<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShopController extends Controller
{
    public function home() {
        $categories = Category::all();
        // return view('front.home', [
        //     'categories'=>$categories,
        //     'products'=>Product::where('is_active',1)->get()
        // ]);

        // Get first 3 categories with product count
        // $categories = Category::withCount('products')
        //                     ->take(3)
        //                     ->get();

        // Get featured products (latest 6 products)
        $products = Product::with(['productColors.color', 'productColors.images'])
                        //   ->latest()
                          ->limit(6)
                          ->get();

        return view('front.home', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function guide() {
        return view('front.guide-des-tailles');
    }
    public function faq() {
        return view('front.faq');
    }
    public function propos() {
        return view('front.propos');
    }
    public function privacy() {
        return view('front.politique-de-confidentialite');
    }
    public function politique() {
        return view('front.politique-de-confidentialite');
    }
    public function contact() {
        return view('front.contact');
    }
    public function sendContact(Request $request)
{
    $data = $request->validate([
        'first_name' => 'required|string|max:100',
        'last_name'  => 'required|string|max:100',
        'email'      => 'required|email',
        'phone'      => 'nullable|string|max:15',
        'subject'    => 'required|string',
        'message'    => 'required|string',
    ]);

    Mail::to('clemencescarf@gmail.com')
        ->send(new ContactMessageMail($data));

    return redirect()
        ->back()
        ->with('success', 'Message envoyé avec succès ✅');
}

    public function shop() {
        return view('front.shop', [
            'products'=>Product::with('productColors.color')->get()
        ]);
    }

    public function show($slug) {
        $product = Product::whereSlug($slug)
            ->with('productColors.color','productColors.images')
            ->firstOrFail();

        return view('front.product', compact('product'));
    }

    public function index(Request $request)
    {
        // Start with all products
        $query = Product::query()->with(['category', 'productColors.color', 'productColors.images']);

        // Filter by categories
        $categories = $request->get('categories', []);
        if (!empty($categories) && !in_array('', $categories)) {
            $query->whereIn('category_id', $categories);
        }

        // Filter by colors
        $colors = $request->get('colors', []);
        if (!empty($colors)) {
            $query->whereHas('productColors.color', function ($q) use ($colors) {
                $q->whereIn('colors.id', $colors);
            });
        }

        // Filter by price
        $minPrice = $request->get('minPrice', 0);
        $maxPrice = $request->get('maxPrice', 500);
        $query->whereBetween('price', [$minPrice, $maxPrice]);

        // Sorting
        $sort = $request->get('sort', '');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'popular':
                $query->orderBy('is_featured', 'desc')->latest();
                break;
            default:
                $query->latest();
        }

        $products = $query->get();

        // Get all categories and colors for filter sidebar
        $allCategories = Category::all();
        $allColors = Color::all();

        return view('front.shop', [
            'products' => $products,
            'categories' => $allCategories,
            'colors' => $allColors,
        ]);
    }
}
