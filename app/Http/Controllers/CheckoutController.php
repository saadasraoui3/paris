<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('session_id',session()->getId())
            ->with('items.product','items.productColor.color','items.productColor.images','items.pack')
            ->firstOrFail();

        return view('front.checkout', compact('cart'));
    }

    // public function store(Request $r)
    // {
    //     $r->validate([
    //         'phone'=>'required',
    //         'shipping_address'=>'required'
    //     ]);

    //     $cart = Cart::where('session_id',session()->getId())
    //         ->with('items')->firstOrFail();

    //     $total = $cart->items->sum(fn($i)=>$i->price*$i->quantity);

    //     $order = Order::create([
    //         'user_id'=>auth()->id(),
    //         'total'=>$total,
    //         'status'=>'pending',
    //         'payment_method'=>'cod',
    //         'phone'=>$r->phone,
    //         'shipping_address'=>$r->shipping_address
    //     ]);

    //     foreach ($cart->items as $item) {
    //         OrderItem::create([
    //             'order_id'=>$order->id,
    //             'product_id'=>$item->product_id,
    //             'product_color_id'=>$item->product_color_id,
    //             'quantity'=>$item->quantity,
    //             'price'=>$item->price
    //         ]);

    //         // نقص stock
    //         $item->productColor->decrement('stock',$item->quantity);
    //     }

    //     $cart->items()->delete();

    //     return redirect()->route('home')->with('success','Commande envoyée');
    // }

    public function store(Request $r)
{
    $r->validate([
        'phone'=>'required',
        'shipping_address'=>'required'
    ]);

    $cart = Cart::where('session_id',session()->getId())
        ->with('items.product','items.productColor','items.pack')
        ->firstOrFail();

    $total = $cart->items->sum(fn($i)=>$i->price * $i->quantity);

    // $order = Order::create([
    //     'order_number' => 'ORD-'.now()->format('Ymd').'-'.rand(1000,9999),
    //     'user_id' => auth()->id(),
    //     'phone' => $r->phone,
    //     'shipping_address' => $r->shipping_address,
    //     'total' => $total,
    //     'status' => 'pending',
    //     'payment_method' => 'cod',
    //     'payment_status' => 'unpaid'
    // ]);
    $order = Order::create([
    'order_number' => 'ORD-' . now()->format('Ymd') . '-' . rand(1000,9999),
    'user_id' => auth()->id(),

    'full_name' => $r->full_name,
    'email' => $r->email,
    'phone' => $r->phone,
    'city' => $r->city,
    'postal_code' => $r->postal_code,
    'shipping_address' => $r->shipping_address,
    'note' => $r->note,

    'total' => $total,
    'shipping_cost' => 0,
    'status' => 'pending',

    'payment_method' => 'cod',
    'payment_status' => 'unpaid',
    'shipping_method' => $r->shipping_method,
]);


    foreach ($cart->items as $item) {
        if ($item->isPack()) {
            OrderItem::create([
                'order_id' => $order->id,
                'pack_id' => $item->pack_id,
                'pack_items' => $item->pack_items,
                'product_name' => $item->pack->name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->price * $item->quantity
            ]);

            // نقص stock de chaque produit du pack
            foreach ($item->pack_items as $packItem) {
                ProductColor::whereKey($packItem['product_color_id'])
                    ->decrement('stock', $packItem['quantity'] * $item->quantity);
            }

            continue;
        }

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'product_color_id' => $item->product_color_id,
            'product_name' => $item->product->name,
            'quantity' => $item->quantity,
            'price' => $item->price,
            'subtotal' => $item->price * $item->quantity
        ]);

        // نقص stock
        $item->productColor->decrement('stock', $item->quantity);
    }

    $cart->items()->delete();

    return redirect()->route('home')->with('success','Commande envoyée');
}

}
