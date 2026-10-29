<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Pack;
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

    public function addPack(Request $r)
    {
        $r->validate([
            'pack_id' => 'required|exists:packs,id',
            'colors' => 'required|array',
            'quantity' => 'required|integer|min:1',
        ]);

        // Prix et produits viennent toujours de la base, jamais du formulaire
        $pack = Pack::where('is_active', true)
            ->with('products.productColors.color', 'products.productColors.images')
            ->findOrFail($r->pack_id);

        $packItems = [];
        foreach ($pack->products as $product) {
            $pc = $product->productColors->firstWhere('id', (int) ($r->colors[$product->id] ?? 0));

            if (!$pc) {
                return back()->with('error', 'Veuillez choisir une couleur pour '.$product->name);
            }

            if ($pc->stock < $product->pivot->quantity * $r->quantity) {
                return back()->with('error', 'Stock insuffisant pour '.$product->name.' ('.$pc->color->name.')');
            }

            $image = $pc->images->where('is_main', 1)->first() ?? $pc->images->first();

            $packItems[] = [
                'product_id' => $product->id,
                'product_color_id' => $pc->id,
                'quantity' => $product->pivot->quantity,
                'product_name' => $product->name,
                'color_name' => $pc->color->name,
                'image' => $image?->image,
            ];
        }

        $cart = Cart::firstOrCreate([
            'session_id' => session()->getId()
        ]);

        // Même pack avec les mêmes couleurs => on augmente la quantité
        $colorIds = collect($packItems)->pluck('product_color_id')->sort()->values()->all();
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('pack_id', $pack->id)
            ->get()
            ->first(fn ($item) => collect($item->pack_items)->pluck('product_color_id')->sort()->values()->all() === $colorIds);

        if ($existingItem) {
            $existingItem->increment('quantity', $r->quantity);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'pack_id' => $pack->id,
                'pack_items' => $packItems,
                'quantity' => $r->quantity,
                'price' => $pack->price
            ]);
        }

        return redirect()->back()->with('openCart', true);
    }

    public function index()
    {
        $cart = Cart::where('session_id', session()->getId())
            ->with('items.product', 'items.productColor.color', 'items.productColor.images', 'items.pack')
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
        if ($r->quantity > $cartItem->max_stock) {
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
