<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductColorImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', [ShopController::class,'home'])->name('home');
Route::get('/product/{slug}', [ShopController::class,'show'])->name('product.show');
Route::get('/guide', [ShopController::class,'guide'])->name('guide');
Route::get('/faq', [ShopController::class,'faq'])->name('faq');
Route::get('/propos', [ShopController::class,'propos'])->name('propos');
Route::get('/privacy', [ShopController::class,'privacy'])->name('privacy');
Route::get('/contact', [ShopController::class,'contact'])->name('contact');
Route::post('/contact', [ShopController::class, 'sendContact'])
    ->name('contact.send');

Route::post('/cart/add',[CartController::class,'add'])->name('cart.add');
Route::get('/cart',[CartController::class,'index'])->name('cart.index');

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::resource('categories',CategoryController::class);
    Route::resource('products',ProductController::class);
    Route::resource('colors',ColorController::class);
    Route::resource('product-colors',ProductColorController::class);
    Route::resource('product-color-images',ProductColorImageController::class);
    Route::resource('orders',OrderController::class);
    Route::resource('order-items',OrderItemController::class);

    Route::put('orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.status');
    Route::post('product-color/{productColor}/images', [ProductColorImageController::class, 'store'])
        ->name('product-color.images.store');
    Route::delete('product-color/images/{image}', [ProductColorImageController::class, 'destroy'])
        ->name('product-color.images.destroy');
});

Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');
Route::post('/checkout',[CheckoutController::class,'store'])->name('checkout.store');

Route::patch('/cart/{cartItem}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

// صفحة تسجيل الدخول
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
// معالجة تسجيل الدخول
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


Route::middleware(['auth:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


// Route::get('/locale/{locale}', function ($locale) {
//     if (in_array($locale, config('app.supported_locales'))) {
//         session(['locale' => $locale]);
//     }
//     return redirect()->back();
// })->name('change.language');
// Route::get('/locale/{locale}', function ($locale) {
//     dd($locale, session()->all());
// });
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'ar'])) {
        session()->put('locale', $locale);
    }

    return redirect()->intended('/');
})->name('change.language');

// Route::get('/change-language/{lang}', function ($lang) {
//     if (in_array($lang, ['fr', 'ar'])) {
//         Session::put('locale', $lang);
//     }
//     return redirect()->back();
// })->name('change.language');
// Route::get('/locale/{locale}', [LocaleController::class, 'changeLocale'])->name('locale.change');
// Route::get('/locale/{locale}', [LocaleController::class, 'changeLocale'])
//     ->name('change.language');
