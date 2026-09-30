@extends('admin.layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 3rem 4rem;
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
        font-size: 2.4rem;
        font-weight: 400;
        color: var(--primary-color);
    }

    .back-btn {
        text-decoration: none;
        padding: 0.6rem 1.2rem;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        color: var(--primary-color);
        transition: .3s;
    }

    .back-btn:hover {
        border-color: var(--accent-color);
        color: var(--accent-color);
    }

    .form-card {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 14px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 0.4rem;
        color: var(--primary-color);
    }

    .form-label.required::after {
        content: '*';
        color: #dc3545;
        margin-left: 0.3rem;
    }

    .form-input {
        width: 100%;
        padding: 0.8rem 1rem;
        border-radius: 8px;
        border: 1px solid #e5e5e5;
        font-size: 0.95rem;
        transition: .3s;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(201,168,124,.1);
    }

    textarea.form-input {
        min-height: 120px;
        resize: vertical;
    }

    .image-preview {
        width: 140px;
        height: 140px;
        border-radius: 12px;
        border: 2px dashed #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        margin-top: .7rem;
        overflow: hidden;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .current-image {
        margin-top: .5rem;
        font-size: 0.8rem;
        color: #666;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e5e5e5;
    }

    .btn {
        padding: 0.8rem 2rem;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
        transition: .3s;
    }

    .btn-primary {
        background: var(--accent-color);
        color: white;
    }

    .btn-primary:hover {
        background: #b89568;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201,168,124,.3);
    }

    .btn-secondary {
        background: white;
        border: 1px solid #e5e5e5;
        color: var(--primary-color);
    }

    .btn-secondary:hover {
        border-color: var(--accent-color);
        color: var(--accent-color);
    }

    @media(max-width:768px){
        .form-container { padding: 1.5rem; }
        .form-actions { flex-direction: column-reverse; }
        .btn { width: 100%; }
    }
</style>

<div class="form-container">

    <!-- Header -->
    <div class="form-header">
        <h1 class="form-title">Edit Category</h1>
        <a href="{{ route('admin.categories.index') }}" class="back-btn">
            ← Back to Categories
        </a>
    </div>

    <form method="POST"
          action="{{ route('admin.categories.update', $category) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Category Info -->
        <div class="form-card">
            <h2 class="card-title">📁 Category Information</h2>

            <div class="form-group">
                <label class="form-label required">Name</label>
                <input
                    type="text"
                    name="name"
                    class="form-input"
                    value="{{ $category->name }}"
                    required
                    id="catName"
                >
            </div>

            <div class="form-group">
                <label class="form-label required">Slug</label>
                <input
                    type="text"
                    name="slug"
                    class="form-input"
                    value="{{ $category->slug }}"
                    required
                    id="catSlug"
                >
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea
                    name="description"
                    class="form-input"
                >{{ $category->description }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Image</label>
                <input
                    type="file"
                    name="image"
                    class="form-input"
                    accept="image/*"
                    onchange="previewImage(event)"
                >

                <div class="image-preview" id="imagePreview">
                    @if($category->image)
                        <img src="{{ asset('storage/'.$category->image) }}">
                    @else
                        Image preview
                    @endif
                </div>

                @if($category->image)
                    <div class="current-image">
                        Current image displayed above
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                💾 Update Category
            </button>
        </div>
    </form>
</div>

<script>
const nameInput = document.getElementById('catName');
const slugInput = document.getElementById('catSlug');

nameInput.addEventListener('input', () => {
    slugInput.value = nameInput.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
});

function previewImage(e){
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    const img = document.createElement('img');
    img.src = URL.createObjectURL(e.target.files[0]);
    preview.appendChild(img);
}
</script>
@endsection
