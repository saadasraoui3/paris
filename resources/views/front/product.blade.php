@extends('layouts.app')

@section('content')
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
        position: relative;
    }

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        cursor: zoom-in;
        transition: transform 0.3s ease;
    }

    .no-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
        color: var(--text-light);
        font-size: 1rem;
    }

    .thumbnail-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 0.8rem;
    }

    .thumbnail {
        width: 100%;
        aspect-ratio: 1;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .thumbnail:hover {
        border-color: var(--accent-color);
        transform: scale(1.05);
    }

    .thumbnail.active {
        border-color: var(--accent-color);
        box-shadow: 0 0 8px rgba(201, 168, 124, 0.4);
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Product Info Section */
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

    .product-reviews {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .stars {
        color: #fbbf24;
        font-size: 1.1rem;
    }

    .review-count {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .product-price {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        color: var(--accent-color);
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .product-description {
        color: var(--text-light);
        line-height: 1.8;
        margin-bottom: 2rem;
        font-size: 0.95rem;
    }

    .product-specs {
        display: grid;
        gap: 1rem;
        padding: 1.5rem;
        background-color: var(--bg-cream);
        border-radius: 8px;
        margin-bottom: 2rem;
    }

    .spec-row {
        display: flex;
        justify-content: space-between;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e5e5;
    }

    .spec-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .spec-label {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .spec-value {
        font-weight: 500;
        color: var(--primary-color);
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

    .color-options {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .color-option {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        padding: 1rem;
        border: 2px solid #e5e5e5;
        border-radius: 12px;
        transition: all 0.3s ease;
        min-width: 100px;
    }

    .color-option:hover {
        border-color: var(--accent-color);
        background-color: #fafafa;
    }

    .color-option input[type="radio"] {
        display: none;
    }

    .color-option.selected {
        border-color: var(--accent-color);
        background-color: var(--bg-cream);
        box-shadow: 0 0 8px rgba(201, 168, 124, 0.3);
    }

    .color-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 2px solid #ddd;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .color-option:hover .color-circle {
        transform: scale(1.1);
    }

    .color-name {
        font-weight: 500;
        font-size: 0.9rem;
        text-align: center;
    }

    .stock-info {
        color: var(--text-light);
        font-size: 0.8rem;
        text-align: center;
    }

    .quantity-section {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .quantity-controls {
        display: flex;
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
        display: flex;
        align-items: center;
        justify-content: center;
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

    .max-stock {
        color: var(--text-light);
        font-size: 0.85rem;
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
        margin-top: 2rem;
    }

    .add-to-cart-btn:hover {
        background-color: #b89568;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 168, 124, 0.3);
    }

    .product-features {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e5e5;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 0.8rem;
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .feature-icon {
        color: var(--accent-color);
        font-size: 1.1rem;
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

        .product-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 640px) {
        .product-detail-container {
            padding: 2rem 1.5rem 3rem;
        }

        .main-image-container {
            height: 300px;
        }

        .color-options {
            flex-direction: column;
        }

        .color-option {
            width: 100%;
            flex-direction: row;
            min-width: unset;
        }

        .color-circle {
            flex-shrink: 0;
        }
    }
</style>

<div class="product-detail-container">
    <div class="product-detail-grid">
        <!-- Image Gallery -->
        <div class="product-gallery">
            <div class="main-image-container">
                @foreach($product->productColors as $pc)
                    <div class="color-images" data-color-id="{{ $pc->id }}" style="display:none">
                        @if($pc->images->count())
                            <img
src="{{ asset('storage/'.$pc->images->first()->image) }}"
                                class="main-image"
                                alt="{{ $product->name }}"
                                id="mainImage-{{ $pc->id }}"
                            >
                        @else
                            <div class="no-image-placeholder">
                                <span>{{ __('messages.front.product.image_not_available') }}</span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Thumbnails -->
            <div class="thumbnail-gallery" id="thumbnailGallery">
                @if($product->productColors->first())
                    @foreach($product->productColors->first()->images as $index => $image)
                        <div class="thumbnail {{ $index == 0 ? 'active' : '' }}"
                             data-color-id="{{ $product->productColors->first()->id }}"
                             data-image-id="{{ $image->id }}">
                            <img src="{{ asset('storage/'.$image->image) }}" alt="Thumbnail {{ $index + 1 }}">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div class="product-info-section">
            <span class="product-badge">{{ __('messages.front.product.best_seller') }}</span>

            <h1 class="product-title">{{ $product->name }}</h1>

            {{-- <div class="product-reviews">
                <div class="stars">★★★★★</div>
                <span class="review-count">(48 reviews)</span>
            </div> --}}

            <div class="product-price">{{ number_format($product->price, 2) }} DH</div>

            <p class="product-description">
                {{ $product->description ?? 'Motifs vibrants rappelant les couchers de soleil marocains, tissés à la main avec des techniques traditionnelles transmises de génération en génération.' }}
            </p>

            {{-- <div class="product-specs">
                <div class="spec-row">
                    <span class="spec-label">Matériau</span>
                    <span class="spec-value">100% Soie Premium</span>
                </div>
                <div class="spec-row">
                    <span class="spec-label">Dimensions</span>
                    <span class="spec-value">180cm × 90cm</span>
                </div>
            </div> --}}

            <form method="POST" action="{{ route('cart.add') }}" id="addToCartForm">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="price" value="{{ $product->price }}">

                <!-- Color Selection with Color Circles -->
                <div class="form-section">
                    <label class="form-label">{{ __('messages.front.product.choose_color') }}</label>
                    <div class="color-options">
                        @foreach($product->productColors as $pc)
                            <label class="color-option {{ $loop->first ? 'selected' : '' }}">
                                <input
                                    type="radio"
                                    name="product_color_id"
                                    value="{{ $pc->id }}"
                                    data-stock="{{ $pc->stock }}"
                                    data-color-id="{{ $pc->id }}"
                                    {{ $loop->first ? 'checked' : '' }}
                                    required
                                >
                                <div class="color-circle" style="background-color: {{ $pc->color->code ?? '#ccc' }};"></div>
                                {{-- <span class="color-name">{{ $pc->color->name }}</span>
                                <span class="stock-info">(Stock: {{ $pc->stock }})</span> --}}
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Quantity Selection -->
                <div class="form-section">
                    <label class="form-label">{{ __('messages.front.product.quantity') }}</label>
                    <div class="quantity-section">
                        <div class="quantity-controls">
                            <button type="button" id="decreaseQty" class="qty-btn">−</button>
                            <input
                                type="number"
                                name="quantity"
                                id="quantity"
                                value="1"
                                min="1"
                                max="1"
                                class="qty-input"
                                required
                            >
                            <button type="button" id="increaseQty" class="qty-btn">+</button>
                        </div>
                        {{-- <span id="stockInfo" class="max-stock"></span> --}}
                    </div>
                </div>

                <button type="submit" class="add-to-cart-btn">
                    {{ __('messages.front.product.add_to_cart') }}
                </button>
            </form>

            <!-- Product Features -->
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
    const radios = document.querySelectorAll('input[name="product_color_id"]');
    const colorImages = document.querySelectorAll('.color-images');
    const colorOptions = document.querySelectorAll('.color-option');
    const thumbnailGallery = document.getElementById('thumbnailGallery');
    const quantityInput = document.getElementById('quantity');
    const decreaseBtn = document.getElementById('decreaseQty');
    const increaseBtn = document.getElementById('increaseQty');
    const stockInfo = document.getElementById('stockInfo');

    let currentStock = 1;
    let allProductColors = @json($product->productColors);

    function updateThumbnails(colorId) {
        thumbnailGallery.innerHTML = '';

        const color = allProductColors.find(pc => pc.id == colorId);
        if (color && color.images) {
            color.images.forEach((image, index) => {
                const thumb = document.createElement('div');
                thumb.className = `thumbnail ${index === 0 ? 'active' : ''}`;
                thumb.setAttribute('data-color-id', colorId);
                thumb.setAttribute('data-image-id', image.id);
                thumb.innerHTML = `<img src="{{ asset('storage') }}/${image.image}" alt="Thumbnail ${index + 1}">`;

                thumb.addEventListener('click', function() {
                    document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const mainImage = document.querySelector(`#mainImage-${colorId}`);
                    if (mainImage) {
                        mainImage.src = `{{ asset('storage') }}/${image.image}`;
                    }
                });

                thumbnailGallery.appendChild(thumb);
            });
        }
    }

    function showColorImages(colorId) {
        colorImages.forEach(div => div.style.display = 'none');

        const target = document.querySelector(
            `.color-images[data-color-id="${colorId}"]`
        );

        if (target) {
            target.style.display = 'block';
        }

        updateThumbnails(colorId);
    }

    function updateStock() {
        const selectedRadio = document.querySelector('input[name="product_color_id"]:checked');
        if (selectedRadio) {
            currentStock = parseInt(selectedRadio.dataset.stock);
            quantityInput.max = currentStock;

            if (parseInt(quantityInput.value) > currentStock) {
                quantityInput.value = currentStock;
            }

            stockInfo.textContent = `Maximum: ${currentStock}`;
        }
    }

    // Handle color selection
    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            colorOptions.forEach(opt => opt.classList.remove('selected'));
            this.closest('.color-option').classList.add('selected');

            showColorImages(this.value);
            updateStock();
        });
    });

    // Quantity buttons
    decreaseBtn.addEventListener('click', function () {
        let val = parseInt(quantityInput.value);
        if (val > 1) {
            quantityInput.value = val - 1;
        }
    });

    increaseBtn.addEventListener('click', function () {
        let val = parseInt(quantityInput.value);
        if (val < currentStock) {
            quantityInput.value = val + 1;
        }
    });

    quantityInput.addEventListener('input', function () {
        let val = parseInt(this.value);
        if (val < 1) this.value = 1;
        if (val > currentStock) this.value = currentStock;
    });

    // Initialize
    if (radios.length > 0) {
        radios[0].checked = true;
        colorOptions[0].classList.add('selected');
        showColorImages(radios[0].value);
        updateStock();
    }
});
</script>
@endsection
