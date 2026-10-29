@php
    $selected = isset($pack) ? $pack->products->pluck('pivot.quantity', 'id')->all() : [];
    $selected = old('products')
        ? collect(old('products'))->mapWithKeys(fn ($id) => [$id => old('quantities.'.$id, 1)])->all()
        : $selected;
@endphp

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
        color: var(--primary-color);
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(201, 168, 124, 0.1);
    }

    .helper-text {
        font-size: 0.8rem;
        color: #666;
        margin-top: 0.3rem;
    }

    .error-text {
        font-size: 0.85rem;
        color: #dc3545;
        margin-top: 0.3rem;
    }

    .products-pick-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        max-height: 520px;
        overflow-y: auto;
        padding: 0.25rem;
    }

    .pick-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.8rem;
        border: 2px solid #e5e5e5;
        border-radius: 8px;
        background-color: #fafafa;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .pick-item.selected {
        border-color: var(--accent-color);
        background-color: white;
    }

    .pick-item input[type="checkbox"] {
        accent-color: var(--accent-color);
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    .pick-image {
        width: 48px;
        height: 48px;
        border-radius: 6px;
        object-fit: cover;
        background: #eee;
        flex-shrink: 0;
    }

    .pick-info {
        flex: 1;
        min-width: 0;
    }

    .pick-name {
        font-weight: 500;
        font-size: 0.9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .pick-price {
        font-size: 0.8rem;
        color: var(--accent-color);
    }

    .pick-qty {
        width: 60px;
        padding: 0.3rem 0.4rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 0.85rem;
    }

    .pick-qty:disabled {
        opacity: 0.4;
    }

    .pack-summary {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        padding: 1rem 1.2rem;
        background-color: #f8f8f8;
        border-radius: 8px;
        font-size: 0.9rem;
        color: #666;
    }

    .pack-summary strong {
        color: var(--primary-color);
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

    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }

        .form-row,
        .products-pick-grid {
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
        <h1 class="form-title">{{ isset($pack) ? 'Edit Pack' : 'Create Pack' }}</h1>
        <a href="{{ route('admin.products.index') }}" class="back-btn">
            ← Back to Products
        </a>
    </div>

    <form method="POST" action="{{ isset($pack) ? route('admin.packs.update', $pack) : route('admin.packs.store') }}">
        @csrf
        @isset($pack)
            @method('PUT')
        @endisset

        <!-- Basic Information -->
        <div class="form-card">
            <h2 class="card-title">🎁 Pack Information</h2>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">Pack Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-input"
                        placeholder="e.g., Pack Été"
                        value="{{ old('name', $pack->name ?? '') }}"
                        required
                    >
                    @error('name') <p class="error-text">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">Pack Price (DH)</label>
                    <input
                        type="number"
                        name="price"
                        class="form-input"
                        placeholder="499.00"
                        step="0.01"
                        min="0"
                        value="{{ old('price', $pack->price ?? '') }}"
                        required
                        id="packPrice"
                    >
                    @error('price') <p class="error-text">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="form-card">
            <h2 class="card-title">📦 Products in this Pack</h2>

            <div class="form-group">
                <input type="text" class="form-input" placeholder="🔍 Search products..." id="pickSearch">
            </div>

            @error('products') <p class="error-text" style="margin-bottom: 1rem;">{{ $message }}</p> @enderror

            <div class="products-pick-grid">
                @foreach($products as $product)
                    @php
                        $isSelected = array_key_exists($product->id, $selected);
                        $image = null;
                        if ($product->productColors->count() > 0) {
                            $color = $product->productColors->first();
                            $image = $color->images->where('is_main', 1)->first() ?? $color->images->first();
                        }
                    @endphp
                    <label class="pick-item {{ $isSelected ? 'selected' : '' }}" data-name="{{ strtolower($product->name) }}">
                        <input
                            type="checkbox"
                            name="products[]"
                            value="{{ $product->id }}"
                            data-price="{{ $product->price }}"
                            {{ $isSelected ? 'checked' : '' }}
                        >
                        @if($image)
                            <img src="{{ asset('storage/'.$image->image) }}" alt="{{ $product->name }}" class="pick-image">
                        @else
                            <div class="pick-image"></div>
                        @endif
                        <div class="pick-info">
                            <div class="pick-name">{{ $product->name }}</div>
                            <div class="pick-price">{{ number_format($product->price, 2) }} DH</div>
                        </div>
                        <input
                            type="number"
                            name="quantities[{{ $product->id }}]"
                            class="pick-qty"
                            min="1"
                            value="{{ $selected[$product->id] ?? 1 }}"
                            title="Quantity"
                            {{ $isSelected ? '' : 'disabled' }}
                        >
                    </label>
                @endforeach
            </div>

            <div class="pack-summary" style="margin-top: 1.5rem;">
                <span>Selected: <strong id="selectedCount">0</strong> product(s)</span>
                <span>Products total: <strong id="productsTotal">0.00 DH</strong></span>
                <span>Customer saves: <strong id="packSaving">0.00 DH</strong></span>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                💾 Save Pack
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.pick-item');
    const priceInput = document.getElementById('packPrice');

    function refreshSummary() {
        let count = 0;
        let total = 0;

        items.forEach(item => {
            const checkbox = item.querySelector('input[type="checkbox"]');
            const qty = item.querySelector('.pick-qty');

            item.classList.toggle('selected', checkbox.checked);
            qty.disabled = !checkbox.checked;

            if (checkbox.checked) {
                count++;
                total += parseFloat(checkbox.dataset.price) * (parseInt(qty.value) || 1);
            }
        });

        const saving = total - (parseFloat(priceInput.value) || 0);
        document.getElementById('selectedCount').textContent = count;
        document.getElementById('productsTotal').textContent = total.toFixed(2) + ' DH';
        document.getElementById('packSaving').textContent = (saving > 0 ? saving : 0).toFixed(2) + ' DH';
    }

    items.forEach(item => {
        item.querySelector('input[type="checkbox"]').addEventListener('change', refreshSummary);
        item.querySelector('.pick-qty').addEventListener('input', refreshSummary);
    });

    priceInput.addEventListener('input', refreshSummary);

    document.getElementById('pickSearch').addEventListener('input', function() {
        const term = this.value.toLowerCase();
        items.forEach(item => {
            item.style.display = item.dataset.name.includes(term) ? '' : 'none';
        });
    });

    refreshSummary();
});
</script>
