@extends('layouts.app')

@section('content')
@php
    $saving = $pack->products_total - $pack->price;
@endphp
<style>
    .product-detail-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 3rem 3rem 5rem;
    }

    .product-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
    }

    /* Image Gallery Section */
    .product-gallery {
        position: sticky;
        top: 120px;
        height: fit-content;
    }

    .main-image-container {
        width: 100%;
        height: 600px;
        background-color: #f8f8f8;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
        color: var(--text-light);
        font-size: 3rem;
    }

    .thumbnail-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 0.8rem;
    }

    .thumbnail {
        height: 90px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        background: #f8f8f8;
        transition: border-color 0.3s ease;
    }

    .thumbnail.active,
    .thumbnail:hover {
        border-color: var(--accent-color);
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-info-section {
        padding-top: 1rem;
    }

    .product-badge {
        display: inline-block;
        background-color: var(--accent-color);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .product-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        font-weight: 400;
        letter-spacing: 1px;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .product-price {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        color: var(--accent-color);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .pack-old-price {
        color: #999;
        font-size: 1.2rem;
        font-weight: 400;
        margin-left: 0.75rem;
    }

    .pack-saving {
        color: #2e7d32;
        font-size: 0.95rem;
        margin-bottom: 2rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--primary-color);
        margin-bottom: 1rem;
        display: block;
        font-size: 0.95rem;
    }

    .pack-product {
        display: flex;
        gap: 1rem;
        padding: 1.2rem;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        margin-bottom: 1rem;
        background: white;
    }

    .pack-product-image {
        width: 90px;
        height: 90px;
        border-radius: 8px;
        object-fit: cover;
        background: #f0f0f0;
        flex-shrink: 0;
    }

    .pack-product-body {
        flex: 1;
        min-width: 0;
    }

    .pack-product-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.25rem;
        color: var(--primary-color);
        text-decoration: none;
    }

    .pack-product-name:hover {
        color: var(--accent-color);
    }

    .pack-product-meta {
        font-size: 0.85rem;
        color: var(--text-light);
        margin: 0.2rem 0 0.7rem;
    }

    .color-options {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
    }

    .color-option {
        cursor: pointer;
        padding: 0.3rem;
        border: 2px solid #e5e5e5;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .color-option input[type="radio"] {
        display: none;
    }

    .color-option.selected {
        border-color: var(--accent-color);
        box-shadow: 0 0 8px rgba(201, 168, 124, 0.3);
    }

    .color-option.disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }

    .color-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1px solid #ddd;
    }

    .selected-color-name {
        font-size: 0.8rem;
        color: var(--text-light);
        margin-top: 0.4rem;
    }

    .quantity-controls {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: 2px solid #e5e5e5;
        border-radius: 8px;
        padding: 0.5rem;
    }

    .qty-btn {
        background-color: var(--bg-cream);
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--primary-color);
        transition: all 0.3s ease;
    }

    .qty-btn:hover {
        background-color: var(--accent-color);
        color: white;
    }

    .qty-input {
        width: 60px;
        text-align: center;
        border: none;
        font-size: 1rem;
        font-weight: 500;
        color: var(--primary-color);
    }

    .qty-input:focus {
        outline: none;
    }

    .add-to-cart-btn {
        width: 100%;
        background-color: var(--accent-color);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .add-to-cart-btn:hover:not(:disabled) {
        background-color: #b89568;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 168, 124, 0.3);
    }

    .add-to-cart-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .pack-error {
        background: #fdecea;
        color: #b71c1c;
        padding: 0.8rem 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .product-features {
        margin-top: 2rem;
        display: grid;
        gap: 0.8rem;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .feature-icon {
        color: var(--accent-color);
        font-weight: bold;
    }

    @media (max-width: 968px) {
        .product-detail-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .product-gallery {
            position: static;
        }

        .main-image-container {
            height: 400px;
        }
    }

    @media (max-width: 640px) {
        .product-detail-container {
            padding: 1.5rem 1rem 3rem;
        }

        .main-image-container {
            height: 320px;
        }

        .product-title {
            font-size: 2rem;
        }
    }
</style>

<div class="product-detail-container">
    <div class="product-detail-grid">
        <!-- Image Gallery: une image par produit du pack -->
        <div class="product-gallery">
            <div class="main-image-container">
                <img src="" class="main-image" alt="{{ $pack->name }}" id="mainImage" style="display:none">
                <div class="no-image-placeholder" id="noImage">🎁</div>
            </div>

            <div class="thumbnail-gallery">
                @foreach($pack->products as $product)
                    <div class="thumbnail" data-product-id="{{ $product->id }}" style="display:none">
                        <img src="" alt="{{ $product->name }}">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pack Info -->
        <div class="product-info-section">
            <span class="product-badge">{{ __('messages.front.pack.badge') }}</span>

            <h1 class="product-title">{{ $pack->name }}</h1>

            <div class="product-price">
                {{ number_format($pack->price, 2) }} DH
                @if($saving > 0)
                    <s class="pack-old-price">{{ number_format($pack->products_total, 2) }} DH</s>
                @endif
            </div>

            @if($saving > 0)
                <p class="pack-saving">{{ __('messages.front.shop.pack_save') }} {{ number_format($saving, 2) }} DH</p>
            @else
                <div style="margin-bottom: 2rem;"></div>
            @endif

            @if(session('error'))
                <div class="pack-error">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('cart.addPack') }}" id="addToCartForm">
                @csrf
                <input type="hidden" name="pack_id" value="{{ $pack->id }}">

                <!-- Produits du pack + choix de couleur -->
                <div class="form-section">
                    <label class="form-label">{{ __('messages.front.pack.choose_colors') }}</label>

                    @foreach($pack->products as $product)
                        @php
                            $firstAvailable = $product->productColors->first(fn ($pc) => $pc->stock >= $product->pivot->quantity);
                        @endphp
                        <div class="pack-product" data-product-id="{{ $product->id }}" data-qty="{{ $product->pivot->quantity }}">
                            <img src="" alt="{{ $product->name }}" class="pack-product-image">

                            <div class="pack-product-body">
                                <a href="{{ route('product.show', $product->slug) }}" class="pack-product-name">{{ $product->name }}</a>
                                <div class="pack-product-meta">
                                    {{ __('messages.front.product.quantity') }} : {{ $product->pivot->quantity }}
                                </div>

                                <div class="color-options">
                                    @foreach($product->productColors as $pc)
                                        @php
                                            $available = $pc->stock >= $product->pivot->quantity;
                                            $pcImage = $pc->images->where('is_main', 1)->first() ?? $pc->images->first();
                                        @endphp
                                        <label class="color-option {{ $available ? '' : 'disabled' }}" title="{{ $pc->color->name }}">
                                            <input
                                                type="radio"
                                                name="colors[{{ $product->id }}]"
                                                value="{{ $pc->id }}"
                                                data-stock="{{ $pc->stock }}"
                                                data-color-name="{{ $pc->color->name }}"
                                                data-image="{{ $pcImage ? asset('storage/'.$pcImage->image) : '' }}"
                                                {{ $available ? '' : 'disabled' }}
                                                {{ $firstAvailable && $firstAvailable->id === $pc->id ? 'checked' : '' }}
                                                required
                                            >
                                            <div class="color-circle" style="background-color: {{ $pc->color->code ?? '#ccc' }};"></div>
                                        </label>
                                    @endforeach
                                </div>
                                <div class="selected-color-name"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Quantity Selection -->
                <div class="form-section">
                    <label class="form-label">{{ __('messages.front.product.quantity') }}</label>
                    <div class="quantity-controls">
                        <button type="button" id="decreaseQty" class="qty-btn">−</button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" class="qty-input" required>
                        <button type="button" id="increaseQty" class="qty-btn">+</button>
                    </div>
                </div>

                <button type="submit" class="add-to-cart-btn" id="addToCartBtn">
                    {{ __('messages.front.product.add_to_cart') }}
                </button>
            </form>

            <!-- Features -->
            <div class="product-features">
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span>{{ __('messages.front.product.free_shipping') }}</span>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span>{{ __('messages.front.product.handmade_premium') }}</span>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span>{{ __('messages.front.product.return_policy') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const packProducts = document.querySelectorAll('.pack-product');
    const mainImage = document.getElementById('mainImage');
    const noImage = document.getElementById('noImage');
    const quantityInput = document.getElementById('quantity');
    const addBtn = document.getElementById('addToCartBtn');
    let maxQty = 1;

    function setMainImage(src) {
        mainImage.style.display = src ? 'block' : 'none';
        noImage.style.display = src ? 'none' : 'flex';
        if (src) mainImage.src = src;
    }

    // Met à jour image + nom de couleur + quantité max
    function refresh() {
        maxQty = Infinity;
        let firstImage = '';

        packProducts.forEach(block => {
            const productId = block.dataset.productId;
            const needed = parseInt(block.dataset.qty);
            const checked = block.querySelector('input[type="radio"]:checked');
            const thumb = document.querySelector(`.thumbnail[data-product-id="${productId}"]`);

            block.querySelectorAll('.color-option').forEach(opt => {
                opt.classList.toggle('selected', opt.querySelector('input').checked);
            });

            if (!checked) {
                maxQty = 0;
                block.querySelector('.selected-color-name').textContent = '';
                block.querySelector('.pack-product-image').removeAttribute('src');
                thumb.style.display = 'none';
                return;
            }

            const image = checked.dataset.image;
            block.querySelector('.selected-color-name').textContent = checked.dataset.colorName;
            block.querySelector('.pack-product-image').src = image || '';
            thumb.style.display = image ? '' : 'none';
            thumb.querySelector('img').src = image || '';
            if (!firstImage && image) firstImage = image;

            maxQty = Math.min(maxQty, Math.floor(parseInt(checked.dataset.stock) / needed));
        });

        if (maxQty === Infinity) maxQty = 0;

        quantityInput.max = Math.max(maxQty, 1);
        if (parseInt(quantityInput.value) > maxQty) quantityInput.value = Math.max(maxQty, 1);
        addBtn.disabled = maxQty < 1;

        if (!document.querySelector('.thumbnail.active') || document.querySelector('.thumbnail.active').style.display === 'none') {
            setMainImage(firstImage);
        } else {
            setMainImage(document.querySelector('.thumbnail.active img').src);
        }
    }

    document.querySelectorAll('.pack-product input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function () {
            // L'image principale suit le dernier produit modifié
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            const productId = this.closest('.pack-product').dataset.productId;
            document.querySelector(`.thumbnail[data-product-id="${productId}"]`).classList.add('active');
            refresh();
        });
    });

    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.addEventListener('click', function () {
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            setMainImage(this.querySelector('img').src);
        });
    });

    document.getElementById('decreaseQty').addEventListener('click', function () {
        const val = parseInt(quantityInput.value);
        if (val > 1) quantityInput.value = val - 1;
    });

    document.getElementById('increaseQty').addEventListener('click', function () {
        const val = parseInt(quantityInput.value);
        if (val < maxQty) quantityInput.value = val + 1;
    });

    quantityInput.addEventListener('input', function () {
        const val = parseInt(this.value);
        if (val < 1) this.value = 1;
        if (val > maxQty) this.value = Math.max(maxQty, 1);
    });

    refresh();
});
</script>
@endsection
