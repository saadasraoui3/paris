@extends('admin.layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 3rem 5rem;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #e5e5e5;
    }

    .form-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        font-weight: 400;
        letter-spacing: 1px;
        color: var(--primary-color);
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        padding: 0.6rem 1.2rem;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        border-color: var(--accent-color);
        color: var(--accent-color);
    }

    .form-card {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 1.5rem;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 500;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .form-label.required::after {
        content: '*';
        color: #dc3545;
        margin-left: 0.3rem;
    }

    .form-input {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: 'Montserrat', sans-serif;
        color: var(--primary-color);
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(201, 168, 124, 0.1);
    }

    .form-input::placeholder {
        color: #999;
    }

    textarea.form-input {
        min-height: 120px;
        resize: vertical;
    }

    .form-select {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: 'Montserrat', sans-serif;
        color: var(--primary-color);
        background-color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(201, 168, 124, 0.1);
    }

    .colors-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .color-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        padding: 1rem;
        border: 2px solid #e5e5e5;
        border-radius: 8px;
        background-color: #fafafa;
        transition: all 0.3s ease;
    }

    .color-item:focus-within {
        border-color: var(--accent-color);
        background-color: white;
    }

    .color-label {
        font-weight: 500;
        color: var(--primary-color);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .color-preview {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #ddd;
    }

    .color-stock-input {
        padding: 0.6rem 0.8rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: border-color 0.3s ease;
    }

    .color-stock-input:focus {
        outline: none;
        border-color: var(--accent-color);
    }

    .helper-text {
        font-size: 0.8rem;
        color: #666;
        margin-top: 0.3rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding-top: 1.5rem;
        border-top: 2px solid #e5e5e5;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.9rem 2rem;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background-color: var(--accent-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: #b89568;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 168, 124, 0.3);
    }

    .btn-secondary {
        background-color: white;
        color: var(--primary-color);
        border: 1px solid #e5e5e5;
    }

    .btn-secondary:hover {
        border-color: var(--accent-color);
        color: var(--accent-color);
    }

    .slug-preview {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        padding: 0.6rem 1rem;
        background-color: #f8f8f8;
        border-radius: 6px;
        font-size: 0.85rem;
        color: #666;
    }

    .slug-preview-link {
        color: var(--accent-color);
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .colors-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="form-container">
    <!-- Header -->
    <div class="form-header">
        <h1 class="form-title">Create Product</h1>
        <a href="{{ route('admin.products.index') }}" class="back-btn">
            ← Back to Products
        </a>
    </div>

    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf

        <!-- Basic Information -->
        <div class="form-card">
            <h2 class="card-title">📝 Basic Information</h2>

            <div class="form-group">
                <label class="form-label required">Product Name</label>
                <input
                    type="text"
                    name="name"
                    class="form-input"
                    placeholder="e.g., Moroccan Sunset Scarf"
                    required
                    id="productName"
                >
                <p class="helper-text">Enter a clear and descriptive product name</p>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">Slug</label>
                    <input
                        type="text"
                        name="slug"
                        class="form-input"
                        placeholder="moroccan-sunset-scarf"
                        required
                        id="productSlug"
                    >
                    <div class="slug-preview">
                        <span>URL:</span>
                        <span class="slug-preview-link" id="slugPreview">/products/moroccan-sunset-scarf</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label required">SKU</label>
                    <input
                        type="text"
                        name="sku"
                        class="form-input"
                        placeholder="PRD-001"
                        required
                    >
                    <p class="helper-text">Stock Keeping Unit for inventory</p>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea
                    name="description"
                    class="form-input"
                    placeholder="Enter a detailed product description..."
                ></textarea>
                <p class="helper-text">Describe the product features, materials, and benefits</p>
            </div>
        </div>

        <!-- Pricing -->
        <div class="form-card">
            <h2 class="card-title">💰 Pricing</h2>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">Price (DH)</label>
                    <input
                        type="number"
                        name="price"
                        class="form-input"
                        placeholder="225.00"
                        step="0.01"
                        min="0"
                        required
                    >
                    <p class="helper-text">Current selling price</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Old Price (DH)</label>
                    <input
                        type="number"
                        name="old_price"
                        class="form-input"
                        placeholder="300.00"
                        step="0.01"
                        min="0"
                    >
                    <p class="helper-text">Original price (optional, for showing discounts)</p>
                </div>
            </div>
        </div>

        <!-- Category -->
        <div class="form-card">
            <h2 class="card-title">📁 Category</h2>

            <div class="form-group">
                <label class="form-label required">Product Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <p class="helper-text">Choose the category that best fits this product</p>
            </div>
        </div>

        <!-- Colors & Stock -->
        <div class="form-card">
            <h2 class="card-title">🎨 Colors & Stock</h2>
            <p class="helper-text" style="margin-bottom: 1.5rem;">
                Enter the available stock quantity for each color. Leave empty if the color is not available.
            </p>

            <div class="colors-grid">
                @foreach($colors as $color)
                    <div class="color-item">
                        <label class="color-label">
                            <span class="color-preview" style="background-color: {{ $color->code ?? '#ddd' }};"></span>
                            {{ $color->name }}
                        </label>
                        <input
                            type="number"
                            name="colors[{{ $color->id }}]"
                            class="color-stock-input"
                            placeholder="Stock quantity"
                            min="0"
                        >
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                💾 Save Product
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productName = document.getElementById('productName');
    const productSlug = document.getElementById('productSlug');
    const slugPreview = document.getElementById('slugPreview');

    // Auto-generate slug from product name
    productName.addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        productSlug.value = slug;
        slugPreview.textContent = '/products/' + slug;
    });

    // Update slug preview on manual slug change
    productSlug.addEventListener('input', function() {
        slugPreview.textContent = '/products/' + this.value;
    });

    // Color items focus effect
    const colorInputs = document.querySelectorAll('.color-stock-input');
    colorInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.color-item').style.borderColor = '#c9a87c';
        });

        input.addEventListener('blur', function() {
            if (!this.value) {
                this.closest('.color-item').style.borderColor = '#e5e5e5';
            }
        });
    });
});
</script>
@endsection
