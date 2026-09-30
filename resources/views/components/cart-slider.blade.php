<div id="cartSlider"
     style="
     position:fixed;
     top:0; right:-400px;
     width:400px;
     height:100%;
     background:#fff;
     border-left:1px solid #e5e5e5;
     padding:0;
     transition:.4s ease;
     z-index:9999;
     overflow-y:auto;
     display:flex;
     flex-direction:column;
     font-family: 'Montserrat', sans-serif;
">
    <!-- Header -->
    <div style="
        padding:2rem;
        border-bottom:1px solid #e5e5e5;
        display:flex;
        justify-content:space-between;
        align-items:center;
        background:#fff;
        position:sticky;
        top:0;
        z-index:10;
    ">
        <h3 style="
            margin:0;
            font-family:'Cormorant Garamond', serif;
            font-size:1.5rem;
            font-weight:400;
            letter-spacing:1px;
            color:#1a1a1a;
        ">{{ __('messages.cart.shopping_cart') }}</h3>
        <button onclick="closeCart()" style="
            background:none;
            border:none;
            font-size:1.5rem;
            cursor:pointer;
            color:#666;
            transition:color 0.3s ease;
            padding:0;
            line-height:1;
        " onmouseover="this.style.color='#d1d1cf'" onmouseout="this.style.color='#666'">
            ✕
        </button>
    </div>

    @php
        $cart = \App\Models\Cart::where('session_id',session()->getId())
            ->with('items.product','items.productColor.color','items.productColor.images')
            ->first();
    @endphp

    @if(!$cart || $cart->items->isEmpty())
        <div style="
            text-align:center;
            padding:4rem 2rem;
            color:#999;
            flex:1;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        ">
            <div style="font-size:4rem; margin-bottom:1rem; opacity:0.3;">🛒</div>
            <p style="
                font-size:1rem;
                color:#666;
                margin:0;
            ">{{ __('messages.cart.empty') }}</p>
        </div>
    @else
        <!-- Cart Items -->
        <div style="flex:1; overflow-y:auto; padding:1.5rem;">
            @foreach($cart->items as $item)
                <div style="
                    display:flex;
                    gap:1rem;
                    margin-bottom:1.5rem;
                    padding-bottom:1.5rem;
                    border-bottom:1px solid #f0f0f0;
                ">
                    {{-- Image --}}
                    <div style="width:80px; height:80px; flex-shrink:0;">
                        @php
                            $image = $item->productColor->images->where('is_main', 1)->first()
                                  ?? $item->productColor->images->first();
                        @endphp
                        @if($image)
                            <img src="{{ asset('storage/'.$image->image) }}"
                                 style="
                                    width:100%;
                                    height:100%;
                                    object-fit:cover;
                                    border-radius:8px;
                                    border:1px solid #f0f0f0;
                                 "
                                 alt="{{ $item->product->name }}">
                        @else
                            <div style="
                                width:100%;
                                height:100%;
                                background:linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
                                border-radius:8px;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                font-size:0.7rem;
                                color:#999;
                            ">
                                {{ __('messages.cart.no_image') }}
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div style="flex:1; min-width:0; display:flex; flex-direction:column; gap:0.3rem;">
                        <div style="
                            font-weight:500;
                            font-size:0.95rem;
                            color:#1a1a1a;
                            overflow:hidden;
                            text-overflow:ellipsis;
                            white-space:nowrap;
                        ">
                            {{ $item->product->name }}
                        </div>
                        <div style="font-size:0.8rem; color:#999;">
                            {{ $item->productColor->color->name }}
                        </div>
                        <div style="
                            font-size:1rem;
                            color:#d1d1cf;
                            font-weight:600;
                            margin-top:0.2rem;
                        ">
                            {{ number_format($item->price, 2) }} DH
                        </div>

                        {{-- Quantity & Remove --}}
                        <div style="
                            display:flex;
                            justify-content:space-between;
                            align-items:center;
                            margin-top:0.5rem;
                        ">
                            <form method="POST"
                                  action="{{ route('cart.updateQuantity', $item) }}"
                                  style="display:flex; align-items:center; gap:0.3rem;"
                                  class="cart-quantity-form">
                                @csrf
                                @method('PATCH')

                                <button
                                    type="button"
                                    class="qty-btn-slider decrease-qty-slider"
                                    data-item-id="{{ $item->id }}"
                                    style="
                                        background:#f8f8f8;
                                        border:1px solid #e5e5e5;
                                        width:28px;
                                        height:28px;
                                        border-radius:6px;
                                        cursor:pointer;
                                        font-weight:bold;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        color:#666;
                                        font-size:0.9rem;
                                        transition:all 0.2s ease;
                                    "
                                >−</button>

                                <input
                                    type="number"
                                    name="quantity"
                                    value="{{ $item->quantity }}"
                                    min="1"
                                    max="{{ $item->productColor->stock }}"
                                    class="quantity-input-slider"
                                    data-item-id="{{ $item->id }}"
                                    data-initial-value="{{ $item->quantity }}"
                                    style="
                                        width:45px;
                                        text-align:center;
                                        border:1px solid #e5e5e5;
                                        border-radius:6px;
                                        padding:0.3rem;
                                        font-size:0.9rem;
                                        font-weight:500;
                                        color:#1a1a1a;
                                    "
                                >

                                <button
                                    type="button"
                                    class="qty-btn-slider increase-qty-slider"
                                    data-item-id="{{ $item->id }}"
                                    data-stock="{{ $item->productColor->stock }}"
                                    style="
                                        background:#f8f8f8;
                                        border:1px solid #e5e5e5;
                                        width:28px;
                                        height:28px;
                                        border-radius:6px;
                                        cursor:pointer;
                                        font-weight:bold;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        color:#666;
                                        font-size:0.9rem;
                                        transition:all 0.2s ease;
                                    "
                                >+</button>

                                <button
                                    type="submit"
                                    class="update-qty-btn-slider"
                                    data-item-id="{{ $item->id }}"
                                    style="
                                        background:#d1d1cf;
                                        color:white;
                                        border:none;
                                        width:28px;
                                        height:28px;
                                        border-radius:6px;
                                        cursor:pointer;
                                        font-size:0.8rem;
                                        display:none;
                                        align-items:center;
                                        justify-content:center;
                                        transition:all 0.2s ease;
                                    "
                                >✓</button>
                            </form>

                            <form method="POST" action="{{ route('cart.remove', $item) }}">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    onclick="return confirm('{{ __('messages.cart.remove_confirm') }}')"
                                    style="
                                        background:none;
                                        border:none;
                                        color:#999;
                                        cursor:pointer;
                                        font-size:0.85rem;
                                        padding:0;
                                        text-decoration:underline;
                                        transition:color 0.2s ease;
                                    "
                                    onmouseover="this.style.color='#ef4444'"
                                    onmouseout="this.style.color='#999'"
                                >{{ __('messages.cart.remove') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Summary & Actions --}}
        <div style="
            padding:1.5rem;
            border-top:1px solid #e5e5e5;
            background:#fff;
            position:sticky;
            bottom:0;
        ">
            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:1.5rem;
            ">
                <span style="
                    font-size:1rem;
                    font-weight:500;
                    color:#666;
                ">{{ __('messages.cart.subtotal') }}</span>
                <span style="
                    font-size:1.3rem;
                    font-weight:600;
                    color:#1a1a1a;
                    font-family:'Cormorant Garamond', serif;
                ">
                    {{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity), 2) }} DH
                </span>
            </div>

            <a href="{{ route('checkout') }}"
               style="
                   display:block;
                   text-align:center;
                   background:#c9a87c;
                   color:white;
                   padding:1rem;
                   border-radius:8px;
                   text-decoration:none;
                   margin-bottom:0.8rem;
                   font-weight:500;
                   font-size:0.95rem;
                   letter-spacing:0.5px;
                   text-transform:uppercase;
                   transition:all 0.3s ease;
               "
               onmouseover="this.style.background='#b8b8b6'"
               onmouseout="this.style.background='#d1d1cf'">
                {{ __('messages.cart.checkout') }}
            </a>

            <a href="{{ route('shop.index') }}"
               onclick="closeCart()"
               style="
                   display:block;
                   text-align:center;
                   background:#fff;
                   color:#8d8d8d;
                   padding:1rem;
                   border-radius:8px;
                   text-decoration:none;
                   font-weight:500;
                   font-size:0.95rem;
                   border:1px solid #e5e5e5;
                   transition:all 0.3s ease;
               "
               onmouseover="this.style.borderColor='#d1d1cf'; this.style.color='#d1d1cf'"
               onmouseout="this.style.borderColor='#e5e5e5'; this.style.color='#8d8d8d'">
                {{ __('messages.cart.continue_shopping') }}
            </a>
        </div>
    @endif
</div>

<style>
.qty-btn-slider:hover {
    background: #e8e8e8 !important;
    border-color: #d1d1cf !important;
}

.update-qty-btn-slider:hover {
    background: #b89568 !important;
}

.quantity-input-slider::-webkit-inner-spin-button,
.quantity-input-slider::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.quantity-input-slider {
    -moz-appearance: textfield;
}

.quantity-input-slider:focus {
    outline: none;
    border-color: #d1d1cf;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Decrease quantity in slider
    document.querySelectorAll('.decrease-qty-slider').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            const input = document.querySelector(`.quantity-input-slider[data-item-id="${itemId}"]`);
            const updateBtn = document.querySelector(`.update-qty-btn-slider[data-item-id="${itemId}"]`);
            let val = parseInt(input.value);
            if (val > 1) {
                input.value = val - 1;
                updateBtn.style.display = 'flex';
            }
        });
    });

    // Increase quantity in slider
    document.querySelectorAll('.increase-qty-slider').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            const stock = parseInt(this.dataset.stock);
            const input = document.querySelector(`.quantity-input-slider[data-item-id="${itemId}"]`);
            const updateBtn = document.querySelector(`.update-qty-btn-slider[data-item-id="${itemId}"]`);
            let val = parseInt(input.value);
            if (val < stock) {
                input.value = val + 1;
                updateBtn.style.display = 'flex';
            }
        });
    });

    // Show update button on manual input change
    document.querySelectorAll('.quantity-input-slider').forEach(input => {
        input.addEventListener('input', function() {
            const itemId = this.dataset.itemId;
            const updateBtn = document.querySelector(`.update-qty-btn-slider[data-item-id="${itemId}"]`);
            const initialValue = parseInt(this.dataset.initialValue);
            let val = parseInt(this.value);
            const max = parseInt(this.max);

            if (val < 1) this.value = 1;
            if (val > max) this.value = max;

            // Show button only if value changed
            if (parseInt(this.value) !== initialValue) {
                updateBtn.style.display = 'flex';
            } else {
                updateBtn.style.display = 'none';
            }
        });
    });
});
</script>
