@extends('layouts.app')

@section('content')
<style>
    /* Hero Section */
    .hero-section {
        position: relative;
        min-height: 85vh;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--bg-cream) 0%, #f5f1ea 100%);
        padding: 4rem 0;
        text-align: center;
    }
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.45);
    }
    .hero-content {
        position: relative;
        text-align: center;
        color: #fff;
        max-width: 800px;
        padding: 2rem;
    }
    .hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem;
        font-weight: bold;
        letter-spacing: 2px;
        margin-bottom: 1rem;
        color: #d1d1cf;
    }
    .hero-subtitle {
        color: #fff;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 2rem;
        line-height: 1.8;
    }
    .hero-btn {
        display: inline-block;
        padding: 1rem 3rem;
        border-radius: 50px;
        background: linear-gradient(135deg, var(--accent-color), #8d8d8d);
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        letter-spacing: .5px;
        transition: .3s;
    }
    .hero-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,.25);
    }

    /* Sections */
    .section-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 4rem 3rem;
    }
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        font-weight: 300;
        letter-spacing: 2px;
        margin-bottom: 1rem;
        color: var(--primary-color);
    }
    .section-description {
        color: var(--text-light);
        font-size: 1rem;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.8;
    }

    /* Collections Grid */
    .collections-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 2rem;
        margin-bottom: 5rem;
    }
    .collection-card {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        cursor: pointer;
        height: 400px;
        background-color: #f8f8f8;
    }
    .collection-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .collection-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.6s ease;
    }
    .collection-card:hover .collection-image {
        transform: scale(1.08);
    }
    .collection-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e8e8e8 0%, #d5d5d5 100%);
        font-size: 4rem;
    }
    .collection-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
        padding: 2.5rem 1.5rem 1.5rem;
        color: white;
        transition: all 0.3s ease;
    }
    .collection-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 400;
        margin-bottom: 0.5rem;
        letter-spacing: 1px;
    }
    .collection-link {
        display: inline-block;
        margin-top: 0.8rem;
        color: white;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        border-bottom: 2px solid var(--accent-color);
        padding-bottom: 2px;
        transition: all 0.3s ease;
    }
    .collection-link:hover {
        padding-bottom: 4px;
    }

    /* Products Grid */
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
        height: 350px;
        overflow: hidden;
        background-color: #f8f8f8;
    }
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
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
        font-size: 1.3rem;
        font-weight: 400;
        margin-bottom: 0.5rem;
        color: var(--primary-color);
        letter-spacing: 0.5px;
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
    .view-more-btn {
        display: inline-block;
        background: linear-gradient(135deg, var(--accent-color) 0%, #8d8d8d 100%);
        color: white;
        padding: 1rem 3rem;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(201,168,124,0.3);
        border: none;
        cursor: pointer;
    }
    .view-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(209,209,207,0.4);
        background: linear-gradient(135deg, #8d8d8d 0%, var(--accent-color) 100%);
    }
    @media (max-width:1024px) {
        .collections-grid { grid-template-columns: repeat(2, 1fr); }
        .products-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width:640px) {
        .hero-title { font-size: 2rem; }
        .section-title { font-size: 1.8rem; }
        .collections-grid, .products-grid { grid-template-columns: 1fr; gap:1.5rem; }
        .section-container { padding: 3rem 1.5rem; }
        .collection-image, .product-image-container { height: 300px; }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <img src="{{ asset('images/hero.jpg') }}" alt="Hero" style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; z-index:0;">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title">CLEMENCE PARIS</h1>
        <p class="hero-subtitle">{{ __('messages.storyHome') }}</p>
        <a href="{{ route('shop.index') }}" class="hero-btn">{{ __('messages.discoverCollection') }}</a>
    </div>
</section>

<!-- Shop by Collection -->
<div class="section-container">
    <div class="section-header">
        <h2 class="section-title">{{ __('messages.shopByCollection') }}</h2>
        <p class="section-description">{{ __('messages.shopByCollectionDescription') }}</p>
    </div>
    <div class="collections-grid">
        @forelse($categories->take(5) as $category)
            <div class="collection-card">
                @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="collection-image">
                @else
                    <div class="collection-placeholder">📦</div>
                @endif
                <div class="collection-overlay">
                    <h3 class="collection-name">{{ $category->name }}</h3>
                    <a href="{{ route('shop.index', ['categories[]' => $category->id]) }}" class="collection-link">{{ __('messages.seeProduct') }}</a>
                </div>
            </div>
        @empty
            <div style="grid-column:1/-1; text-align:center; padding:3rem; color:var(--text-light);">
                <p>{{ __('messages.imageNotAvailable') }}</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Featured Collection -->
<div class="section-container" style="background-color: var(--bg-cream); margin:0; max-width:100%;">
    <div style="max-width:1400px; margin:0 auto; padding:0 3rem;">
        <div class="section-header">
            <h2 class="section-title">{{ __('messages.featuredCollection') }}</h2>
            <p class="section-description">{{ __('messages.featuredCollectionDescription') }}</p>
        </div>
        <div class="products-grid">
            @foreach ($products as $product)
                @php
                    $mainImage = null;
                    $badge = null;
                    if ($product->productColors->count() > 0) {
                        $color = $product->productColors->first();
                        $mainImage = $color->images->where('is_main',1)->first() ?? $color->images->first();
                    }
                    if ($product->created_at->gt(now()->subDays(7))) $badge = __('messages.new');
                    elseif(rand(0,2)==0) $badge = __('messages.popular');
                @endphp
                <div class="product-card">
                    <div class="product-image-container">
                        @if($badge)
                            <span class="product-badge">{{ $badge }}</span>
                        @endif
                        @if($mainImage)
                            <img src="{{ asset('storage/' . $mainImage->image) }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            <div class="product-no-image">{{ __('messages.imageNotAvailable') }}</div>
                        @endif
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-price">{{ number_format($product->price,2) }} DH</p>
                        <a href="{{ route('product.show', $product->slug) }}" class="product-link">{{ __('messages.seeProduct') }}</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="text-align:center; margin-top:3rem;">
            <a href="{{ route('shop.index') }}" class="view-more-btn">{{ __('messages.seeMoreProducts') }}</a>
        </div>
    </div>
</div>

<!-- Trust Badges -->
<div class="section-container">
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:3rem; text-align:center; padding:2rem 0;">
        <div>
            <div style="font-size:2.5rem; margin-bottom:1rem;">🔒</div>
            <h4>{{ __('messages.authenticSilk') }}</h4>
            <p>{{ __('messages.authenticSilkDescription') }}</p>
        </div>
        <div>
            <div style="font-size:2.5rem; margin-bottom:1rem;">🚚</div>
            <h4>{{ __('messages.craftsmanship') }}</h4>
            <p>{{ __('messages.craftsmanshipDescription') }}</p>
        </div>
        <div>
            <div style="font-size:2.5rem; margin-bottom:1rem;">🛍️</div>
            <h4>{{ __('messages.cashOnDelivery') }}</h4>
            <p>{{ __('messages.cashOnDeliveryDescription') }}</p>
        </div>
    </div>
</div>
@endsection
