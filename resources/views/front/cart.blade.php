@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Mon Panier</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($cart && $cart->items->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @foreach($cart->items as $item)
                <div class="flex items-center gap-4 p-4 border-b">
                    {{-- Product Image --}}
                    <div class="w-24 h-24 flex-shrink-0">
                        @php
                            $image = $item->productColor->images->where('is_main', 1)->first()
                                  ?? $item->productColor->images->first();
                        @endphp
                        @if($image)
                            <img src="{{ asset('storage/'.$image->image) }}"
                                 class="w-full h-full object-cover rounded"
                                 alt="{{ $item->product->name }}">
                        @else
                            <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                <span class="text-gray-400 text-xs">No image</span>
                            </div>
                        @endif
                    </div>

                    {{-- Product Info --}}
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg">{{ $item->product->name }}</h3>
                        <p class="text-sm text-gray-500">
                            Couleur: {{ $item->productColor->color->name }}
                        </p>
                        <p class="text-green-600 font-semibold mt-1">
                            {{ $item->price }} DH
                        </p>
                    </div>

                    {{-- Quantity Controls --}}
                    <div class="flex items-center gap-2">
                        <form method="POST" action="{{ route('cart.updateQuantity', $item) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')

                            <button
                                type="button"
                                class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded decrease-qty"
                                data-item-id="{{ $item->id }}"
                            >
                                −
                            </button>

                            <input
                                type="number"
                                name="quantity"
                                value="{{ $item->quantity }}"
                                min="1"
                                max="{{ $item->productColor->stock }}"
                                class="w-16 text-center border border-gray-300 rounded py-1 quantity-input"
                                data-item-id="{{ $item->id }}"
                            >

                            <button
                                type="button"
                                class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded increase-qty"
                                data-item-id="{{ $item->id }}"
                                data-stock="{{ $item->productColor->stock }}"
                            >
                                +
                            </button>

                            <button
                                type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm ml-2"
                            >
                                ✓
                            </button>
                        </form>
                    </div>

                    {{-- Subtotal --}}
                    <div class="text-right w-24">
                        <p class="font-bold">{{ $item->price * $item->quantity }} DH</p>
                    </div>

                    {{-- Remove Button --}}
                    <form method="POST" action="{{ route('cart.remove', $item) }}">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="text-red-500 hover:text-red-700"
                            onclick="return confirm('Supprimer ce produit ?')"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        {{-- Cart Summary --}}
        <div class="mt-6 bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xl font-semibold">Total:</span>
                <span class="text-2xl font-bold text-green-600">
                    {{ $cart->items->sum(fn($i) => $i->price * $i->quantity) }} DH
                </span>
            </div>
            <a href="{{ route('checkout') }}"
               class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg text-lg font-semibold">
                Passer la commande
            </a>
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <p class="text-gray-500 text-lg mb-4">Votre panier est vide</p>
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
                Continuer vos achats
            </a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Decrease quantity
    document.querySelectorAll('.decrease-qty').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
            let val = parseInt(input.value);
            if (val > 1) {
                input.value = val - 1;
            }
        });
    });

    // Increase quantity
    document.querySelectorAll('.increase-qty').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            const stock = parseInt(this.dataset.stock);
            const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
            let val = parseInt(input.value);
            if (val < stock) {
                input.value = val + 1;
            }
        });
    });

    // Prevent manual input beyond limits
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('input', function() {
            let val = parseInt(this.value);
            const max = parseInt(this.max);
            if (val < 1) this.value = 1;
            if (val > max) this.value = max;
        });
    });
});
</script>
@endsection
