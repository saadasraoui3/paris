{{-- @extends('layouts.app')

@section('content')
<h1>Edit product : {{ $product->name }}</h1>

@foreach($product->productColors as $pc)
<h4>{{ $pc->color->name }}</h4>

<form method="POST"
      action="{{ route('admin.product-color.images.store',$pc) }}"
      enctype="multipart/form-data">
@csrf
<input type="file" name="image" required>
<button>Upload</button>
</form>

@foreach($pc->images as $img)
    <img src="{{ asset('storage/'.$img->image) }}" width="80">
@endforeach
<hr>
@endforeach
@endsection --}}
{{-- @extends('layouts.app')

@section('content') --}}

@extends('admin.layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 1200px;
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

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .form-card {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        height: fit-content;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 500;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
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
        grid-template-columns: repeat(2, 1fr);
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

    /* Images Section */
    .images-section {
        position: sticky;
        top: 120px;
    }

    .color-images-card {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .color-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .color-name {
        font-weight: 500;
        color: var(--primary-color);
        font-size: 1rem;
    }

    .upload-area {
        border: 2px dashed #e5e5e5;
        border-radius: 8px;
        padding: 1.5rem;
        text-align: center;
        margin-bottom: 1rem;
        background-color: #fafafa;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        border-color: var(--accent-color);
        background-color: white;
    }

    .file-input-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .file-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .upload-icon {
        font-size: 2rem;
        color: var(--accent-color);
    }

    .upload-text {
        font-size: 0.9rem;
        color: #666;
    }

    .upload-btn {
        margin-top: 0.8rem;
        padding: 0.6rem 1.5rem;
        background-color: var(--accent-color);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-btn:hover {
        background-color: #b89568;
    }

    .images-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.8rem;
    }

    .image-item {
        position: relative;
        aspect-ratio: 1;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid #e5e5e5;
        transition: all 0.3s ease;
    }

    .image-item:hover {
        border-color: var(--accent-color);
        transform: scale(1.02);
    }

    .image-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-badge {
        position: absolute;
        top: 0.5rem;
        left: 0.5rem;
        background-color: var(--accent-color);
        color: white;
        padding: 0.3rem 0.6rem;
        border-radius: 4px;
        font-size: 0.7rem;
        font-weight: 500;
    }

    .delete-image-btn {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        background-color: rgba(220, 53, 69, 0.9);
        color: white;
        border: none;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        opacity: 0;
    }

    .image-item:hover .delete-image-btn {
        opacity: 1;
    }

    .delete-image-btn:hover {
        background-color: #dc3545;
        transform: scale(1.1);
    }

    .no-images {
        text-align: center;
        padding: 2rem;
        color: #999;
        font-size: 0.9rem;
    }

    @media (max-width: 968px) {
        .content-grid {
            grid-template-columns: 1fr;
        }

        .images-section {
            position: static;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .colors-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .form-container {
            padding: 1.5rem;
        }

        .images-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="form-container">
    <!-- Header -->
    <div class="form-header">
        <h1 class="form-title">Edit Product</h1>
        <a href="{{ route('admin.products.index') }}" class="back-btn">
            ← Back to Products
        </a>
    </div>

    <div class="content-grid">
        <!-- Left Column: Product Form -->
        <div>
            <form method="POST" action="{{ route('admin.products.update', $product) }}" id="productForm">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="form-card">
                    <h2 class="card-title">📝 Basic Information</h2>

                    <div class="form-group">
                        <label class="form-label required">Product Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-input"
                            value="{{ $product->name }}"
                            required
                        >
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">Slug</label>
                            <input
                                type="text"
                                name="slug"
                                class="form-input"
                                value="{{ $product->slug }}"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label required">SKU</label>
                            <input
                                type="text"
                                name="sku"
                                class="form-input"
                                value="{{ $product->sku }}"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea
                            name="description"
                            class="form-input"
                        >{{ $product->description }}</textarea>
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
                                value="{{ $product->price }}"
                                step="0.01"
                                min="0"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">Old Price (DH)</label>
                            <input
                                type="number"
                                name="old_price"
                                class="form-input"
                                value="{{ $product->old_price }}"
                                step="0.01"
                                min="0"
                            >
                        </div>
                    </div>
                </div>

                <!-- Category -->
                <div class="form-card">
                    <h2 class="card-title">📁 Category</h2>

                    <div class="form-group">
                        <label class="form-label required">Product Category</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    @if($cat->id == $product->category_id) selected @endif>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Colors & Stock -->
                <div class="form-card">
                    <h2 class="card-title">🎨 Colors & Stock</h2>

                    <div class="colors-grid">
                        @foreach($colors as $color)
                            @php
                                $pc = $product->productColors->where('color_id',$color->id)->first();
                            @endphp
                            <div class="color-item">
                                <label class="color-label">
                                    <span class="color-preview" style="background-color: {{ $color->code ?? '#ddd' }};"></span>
                                    {{ $color->name }}
                                </label>
                                <input
                                    type="number"
                                    name="colors[{{ $color->id }}]"
                                    class="color-stock-input"
                                    value="{{ $pc ? $pc->stock : '' }}"
                                    placeholder="Stock"
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
                        💾 Update Product
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Column: Product Images -->
        <div class="images-section">
            <div class="form-card">
                <h2 class="card-title">🖼️ Product Images</h2>
                <p class="helper-text" style="margin-bottom: 1.5rem;">
                    Upload images for each color variant
                </p>

                @foreach($product->productColors as $pc)
                    <div class="color-images-card">
                        <div class="color-header">
                            <span class="color-preview" style="background-color: {{ $pc->color->code ?? '#ddd' }};"></span>
                            <span class="color-name">{{ $pc->color->name }}</span>
                            <span style="margin-left: auto; font-size: 0.85rem; color: #666;">
                                {{ $pc->images->count() }} image{{ $pc->images->count() != 1 ? 's' : '' }}
                            </span>
                        </div>

                        <!-- Upload Form -->
                        <form method="POST"
                              action="{{ route('admin.product-color.images.store', $pc) }}"
                              enctype="multipart/form-data"
                              class="upload-form">
                            @csrf
                            <div class="upload-area">
                                <div class="file-input-wrapper">
                                    <input
                                        type="file"
                                        name="image"
                                        class="file-input"
                                        accept="image/*"
                                        required
                                        onchange="this.closest('form').querySelector('.upload-text').textContent = this.files[0]?.name || 'Choose an image'"
                                    >
                                    <label class="file-label">
                                        <div class="upload-icon">📁</div>
                                        <div class="upload-text">Choose an image</div>
                                    </label>
                                </div>
                                <button type="submit" class="upload-btn">
                                    ⬆️ Upload Image
                                </button>
                            </div>
                        </form>

                        <!-- Images Grid -->
                        @if($pc->images->count() > 0)
                            <div class="images-grid">
                                @foreach($pc->images as $img)
                                    <div class="image-item">
                                        @if($img->is_main)
                                            <span class="image-badge">Main</span>
                                        @endif
                                        <img src="{{ asset('storage/'.$img->image) }}" alt="Product image">
                                        <form method="POST"
                                              action="{{ route('admin.product-color.images.destroy', $img) }}"
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="delete-image-btn"
                                                onclick="return confirm('Delete this image?')"
                                                title="Delete image"
                                            >✕</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="no-images">
                                No images uploaded yet
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
