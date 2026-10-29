<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $r)
    {
        $r->validate([
            'product_id' => 'required|exists:products,id',
            'product_color_id' => 'required|exists:product_colors,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Price always comes from the database, never from the form
        $product = Product::findOrFail($r->product_id);
        ProductColor::where('product_id', $product->id)->findOrFail($r->product_color_id);

        $cart = Cart::firstOrCreate([
            'session_id' => session()->getId()
        ]);

        // Check if item already exists in cart
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $r->product_id)
            ->where('product_color_id', $r->product_color_id)
            ->first();

        if ($existingItem) {
            // Update quantity
            $existingItem->increment('quantity', $r->quantity);
        } else {
            // Create new cart item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $r->product_id,
                'product_color_id' => $r->product_color_id,
                'quantity' => $r->quantity,
                'price' => $product->price
            ]);
        }

        return redirect()->back()->with('openCart', true);
    }

    public function index()
    {
        $cart = Cart::where('session_id', session()->getId())
            ->with('items.product', 'items.productColor.color')
            ->first();

        return view('front.cart', compact('cart'));
    }

    public function updateQuantity(Request $r, CartItem $cartItem)
    {
        $this->authorizeItem($cartItem);

        $r->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Check stock availability
        if ($r->quantity > $cartItem->productColor->stock) {
            return back()->with('error', 'Stock insuffisant');
        }

        $cartItem->update(['quantity' => $r->quantity]);

        return back()->with('success', 'Quantité mise à jour');
    }

    public function remove(CartItem $cartItem)
    {
        $this->authorizeItem($cartItem);

        $cartItem->delete();
        return back()->with('success', 'Produit supprimé du panier');
    }

    // Make sure the item belongs to the visitor's own cart
    private function authorizeItem(CartItem $cartItem): void
    {
        $cart = Cart::where('session_id', session()->getId())->first();

        abort_unless($cart && (int) $cartItem->cart_id === (int) $cart->id, 403);
    }
}
