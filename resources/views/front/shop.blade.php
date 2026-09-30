@extends('layouts.app')

@section('content')
<style>
    .shop-hero {
        background: linear-gradient(135deg, var(--bg-cream) 0%, #f5f1ea 100%);
        padding: 3rem 0;
        text-align: center;
        border-bottom: 1px solid #e5e5e5;
    }

    .shop-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        font-weight: 300;
        letter-spacing: 2px;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .shop-hero-subtitle {
        color: var(--text-light);
        font-size: 1rem;
    }

    .shop-main {
        display: flex;
        max-width: 1400px;
        margin: 0 auto;
        padding: 3rem;
        gap: 3rem;
    }

    .shop-sidebar {
        flex: 0 0 220px;
    }

    .filter-section {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e5e5e5;
    }

    .filter-section:last-child {
        border-bottom: none;
    }

    .filter-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.3rem;
        font-weight: 400;
        color: var(--primary-color);
        margin-bottom: 1.2rem;
        letter-spacing: 0.5px;
    }

    .filter-option {
        display: flex;
        align-items: center;
        margin-bottom: 0.8rem;
        cursor: pointer;
    }

    .filter-checkbox {
        width: 18px;
        height: 18px;
        margin-right: 0.8rem;
        cursor: pointer;
        accent-color: var(--accent-color);
    }

    .filter-label {
        font-size: 0.95rem;
        color: var(--text-color);
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .filter-option:hover .filter-label {
        color: var(--accent-color);
    }

    .color-swatch {
        position: relative;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .color-swatch input {
        display: none;
    }

    .color-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        position: relative;
        border: 2px solid #ddd;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .color-swatch:hover .color-circle {
        transform: scale(1.15);
        border-color: var(--primary-color);
    }

    .color-swatch input:checked + .color-circle {
        border-color: var(--primary-color);
        border-width: 3px;
        box-shadow: 0 0 0 2px white, 0 0 0 4px var(--accent-color);
    }

    .color-swatch input:checked + .color-circle::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
        text-shadow: 0 0 3px rgba(0,0,0,0.5);
    }

    .price-range-container {
        padding: 0 0.5rem;
    }

    .price-input {
        width: 100%;
        height: 4px;
        border-radius: 2px;
        background: #ddd;
        outline: none;
        -webkit-appearance: none;
        margin-bottom: 0.5rem;
    }

    .price-input::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--accent-color);
        cursor: pointer;
    }

    .price-input::-moz-range-thumb {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--accent-color);
        cursor: pointer;
        border: none;
    }

    .price-display {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .shop-content {
        flex: 1;
    }

    .shop-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e5e5e5;
    }

    .shop-count {
        color: var(--text-light);
        font-size: 0.95rem;
    }

    .sort-select {
        padding: 0.6rem 1rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9rem;
        color: var(--primary-color);
        background-color: white;
        cursor: pointer;
        transition: border-color 0.3s ease;
    }

    .sort-select:focus {
        outline: none;
        border-color: var(--accent-color);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2.5rem;
    }

    .product-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .product-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background-color: var(--accent-color);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        z-index: 10;
    }

    .product-image-container {
        position: relative;
        width: 100%;
        height: 280px;
        overflow: hidden;
        background-color: #f8f8f8;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.1);
    }

    .product-no-image {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .product-info {
        padding: 1.5rem;
    }

    .product-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.2rem;
        font-weight: 400;
        margin-bottom: 0.5rem;
        color: var(--primary-color);
        letter-spacing: 0.5px;
    }

    .product-colors {
        display: flex;
        gap: 0.6rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .product-color-dot {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 1px solid #ddd;
    }

    .product-price {
        color: var(--accent-color);
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .product-link {
        display: inline-block;
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--accent-color);
        padding-bottom: 2px;
        transition: all 0.3s ease;
    }

    .product-link:hover {
        color: var(--accent-color);
        padding-bottom: 4px;
    }

    .no-products {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-light);
    }

    .no-products-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .no-products-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        color: var(--primary-color);
    }

    @media (max-width: 1024px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .shop-main {
            flex-direction: column;
            gap: 2rem;
        }

        .shop-sidebar {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
    }

    @media (max-width: 640px) {
        .shop-hero-title {
            font-size: 1.8rem;
        }

        .shop-main {
            padding: 2rem 1.5rem;
            flex-direction: column;
        }

        .shop-sidebar {
            grid-template-columns: 1fr;
        }

        .shop-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .products-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .product-image-container {
            height: 250px;
        }
    }
</style>

<!-- Hero Section -->
<div class="shop-hero">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 3rem;">
        <h1 class="shop-hero-title">{{ __('messages.front.shop.hero_title') }}</h1>
        <p class="shop-hero-subtitle">{{ __('messages.front.shop.hero_description') }}</p>
    </div>
</div>

<!-- Main Shop Section -->
<div class="shop-main">
    <!-- Sidebar Filters -->
    <aside class="shop-sidebar">
        <form id="filterForm" method="GET" action="{{ route('shop.index') }}">
            <!-- Categories Filter from Database -->
            @if($categories->count() > 0)
                <div class="filter-section">
                    <h3 class="filter-title">{{ __('messages.front.shop.categories') }}</h3>
                    @foreach($categories as $category)
                        <div class="filter-option">
                            <input type="checkbox"
                                   id="cat-{{ $category->id }}"
                                   name="categories[]"
                                   value="{{ $category->id }}"
                                   class="filter-checkbox"
                                   {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                   onchange="filterProducts()">
                            <label for="cat-{{ $category->id }}" class="filter-label">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Colors Filter from Database -->
            @if($colors->count() > 0)
                <div class="filter-section">
                    <h3 class="filter-title">{{ __('messages.front.shop.colors') }}</h3>
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.2rem;">
                        @foreach($colors as $color)
                            <label class="color-swatch" title="{{ $color->name }}">
                                <input type="checkbox"
                                       name="colors[]"
                                       value="{{ $color->id }}"
                                       class="color-checkbox"
                                       {{ in_array($color->id, request('colors', [])) ? 'checked' : '' }}
                                       onchange="filterProducts()">
                                <div class="color-circle" style="background-color: {{ $color->code }};"></div>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Price Filter -->
            <div class="filter-section">
                <h3 class="filter-title">{{ __('messages.front.shop.price') }}</h3>
                <div class="price-display">
                    <span><span id="minPrice">0</span> DH</span>
                    <span><span id="maxPrice">500</span> DH</span>
                </div>
                <div class="price-range-container">
                    <input type="range"
                           name="minPrice"
                           min="0"
                           max="500"
                           value="{{ request('minPrice', 0) }}"
                           class="price-input"
                           id="minPriceInput"
                           onchange="filterProducts()">
                    <input type="range"
                           name="maxPrice"
                           min="0"
                           max="500"
                           value="{{ request('maxPrice', 500) }}"
                           class="price-input"
                           id="maxPriceInput"
                           onchange="filterProducts()">
                </div>
            </div>
        </form>
    </aside>

    <!-- Shop Content -->
    <div class="shop-content">
        <!-- Shop Header with Sort -->
        <div class="shop-header">
            <div class="shop-count">
                <strong>{{ $products->count() }}</strong> {{ __('messages.front.shop.product') }}{{ $products->count() > 1 ? 's' : '' }}
            </div>

            <select class="sort-select" onchange="sortProducts(this.value)">
                <option value="">{{ __('messages.front.shop.trier') }}</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>{{ __('messages.front.shop.price_croissant') }}</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>{{ __('messages.front.shop.price_decroissant') }}</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('messages.front.shop.newest') }}</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>{{ __('messages.front.shop.popular') }}</option>
            </select>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        @php
                            $mainImage = null;
                            $badge = null;
                            $colors = [];

                            if($product->productColors->count() > 0){
                                $color = $product->productColors->first();
                                $mainImage = $color->images->where('is_main', 1)->first();

                                if(!$mainImage && $color->images->count() > 0){
                                    $mainImage = $color->images->first();
                                }

                                // Collect colors
                                foreach($product->productColors as $pc) {
                                    $colors[] = $pc->color;
                                }
                            }

                            if($product->created_at->gt(now()->subDays(7))){
                                $badge = 'Nouveau';
                            }
                        @endphp

                        <div class="product-image-container">
                            @if($badge)
                                <span class="product-badge">{{ $badge }}</span>
                            @endif

                            @if($mainImage)
                                <img src="{{ asset('storage/'.$mainImage->image) }}"
                                     alt="{{ $product->name }}"
                                     class="product-image">
                            @else
                                <div class="product-no-image">
                                    Image non disponible
                                </div>
                            @endif
                        </div>

                        <div class="product-info">
                            <h3 class="product-name">{{ $product->name }}</h3>

                            @if(count($colors) > 0)
                                <div class="product-colors">
                                    @foreach($colors as $color)
                                        <div class="product-color-dot"
                                             style="background-color: {{ $color->code ?? '#ccc' }};"
                                             title="{{ $color->name ?? 'Color' }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <p class="product-price">{{ number_format($product->price, 2) }} DH</p>
                            <a href="{{ route('product.show', $product->slug) }}" class="product-link">
                                {{ __('messages.seeProduct') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <div class="no-products-icon">🛍️</div>
                <h3 class="no-products-title">{{ __('messages.no_products_found') }}Aucun produit trouvé</h3>
                <p>{{ __('messages.front.shop.no_products_found') }}Nous n'avons pas encore de produits disponibles pour le moment.</p>
            </div>
        @endif
    </div>
</div>

<script>
    // Update price display
    document.getElementById('minPriceInput').addEventListener('input', function() {
        document.getElementById('minPrice').textContent = this.value;
    });

    document.getElementById('maxPriceInput').addEventListener('input', function() {
        document.getElementById('maxPrice').textContent = this.value;
    });

    function filterProducts() {
        document.getElementById('filterForm').submit();
    }

    function sortProducts(value) {
        const url = new URL(window.location);
        if (value) {
            url.searchParams.set('sort', value);
        } else {
            url.searchParams.delete('sort');
        }
        window.location = url.toString();
    }
</script>
@endsection
