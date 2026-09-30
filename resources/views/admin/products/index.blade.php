@extends('admin.layouts.app')

@section('content')
<style>
    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 3rem;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #e5e5e5;
    }

    .admin-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        font-weight: 400;
        letter-spacing: 1px;
        color: var(--primary-color);
    }

.pagination-container {
    flex-wrap: wrap;
    margin-top: 2rem;
}

.pagination-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    border: 1px solid #e5e5e5;
    background-color: white;
    color: var(--primary-color);
    font-weight: 500;
    transition: all 0.2s ease;
    text-decoration: none;
    min-width: 40px;
    text-align: center;
}

.pagination-btn:hover {
    background-color: var(--accent-color);
    color: white;
    border-color: var(--accent-color);
}

.pagination-btn.active {
    background-color: var(--accent-color);
    color: white;
    border-color: var(--accent-color);
}

.pagination-btn.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

@media (max-width: 768px) {
    .pagination-container {
        gap: 0.3rem;
    }
    .pagination-btn {
        padding: 0.4rem 0.7rem;
        min-width: 35px;
    }
}


    .add-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background-color: var(--accent-color);
        color: white;
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .add-btn:hover {
        background-color: #b89568;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 168, 124, 0.3);
    }

    .products-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }

    .stat-label {
        font-size: 0.85rem;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 600;
        color: var(--accent-color);
    }

    .products-table-container {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-header {
        padding: 1.5rem;
        background-color: var(--bg-cream);
        border-bottom: 1px solid #e5e5e5;
    }

    .search-filter {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .search-input {
        flex: 1;
        padding: 0.7rem 1rem;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--accent-color);
    }

    .filter-select {
        padding: 0.7rem 1rem;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        font-size: 0.9rem;
        background: white;
        cursor: pointer;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
    }

    .products-table thead {
        background-color: #fafafa;
        border-bottom: 2px solid #e5e5e5;
    }

    .products-table th {
        text-align: left;
        padding: 1rem 1.5rem;
        font-weight: 500;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #666;
    }

    .products-table td {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .products-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .products-table tbody tr:hover {
        background-color: #fafafa;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .product-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #e5e5e5;
    }

    .product-no-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        color: #999;
        border: 1px solid #e5e5e5;
    }

    .product-details {
        flex: 1;
    }

    .product-name {
        font-weight: 500;
        color: var(--primary-color);
        margin-bottom: 0.2rem;
    }

    .product-meta {
        font-size: 0.85rem;
        color: #666;
    }

    .product-price {
        font-weight: 600;
        color: var(--accent-color);
        font-size: 1rem;
    }

    .product-stock {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .stock-in {
        background-color: #d4edda;
        color: #155724;
    }

    .stock-low {
        background-color: #fff3cd;
        color: #856404;
    }

    .stock-out {
        background-color: #f8d7da;
        color: #721c24;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border: 1px solid;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .edit-btn {
        background-color: white;
        color: var(--accent-color);
        border-color: var(--accent-color);
    }

    .edit-btn:hover {
        background-color: var(--accent-color);
        color: white;
    }

    .delete-btn {
        background-color: white;
        color: #dc3545;
        border-color: #dc3545;
    }

    .delete-btn:hover {
        background-color: #dc3545;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #666;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .empty-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: var(--primary-color);
    }

    @media (max-width: 1024px) {
        .products-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .admin-container {
            padding: 1.5rem;
        }

        .admin-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .products-stats {
            grid-template-columns: 1fr;
        }

        .search-filter {
            flex-direction: column;
        }

        .products-table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<div class="admin-container">
    <!-- Header -->
    <div class="admin-header">
        <h1 class="admin-title">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="add-btn">
            <span>➕</span>
            <span>Add Product</span>
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="products-stats">
        <div class="stat-card">
            <div class="stat-label">Total Products</div>
            <div class="stat-value">{{ $products->count() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">In Stock</div>
            <div class="stat-value">
                {{ $products->filter(function($p) {
                    return $p->productColors->sum('stock') > 0;
                })->count() }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Low Stock</div>
            <div class="stat-value">
                {{ $products->filter(function($p) {
                    $stock = $p->productColors->sum('stock');
                    return $stock > 0 && $stock <= 5;
                })->count() }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total Value</div>
            <div class="stat-value">{{ number_format($products->sum('price'), 0) }} DH</div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="products-table-container">
        <div class="table-header">
            <div class="search-filter">
                {{-- <input
                    type="text"
                    class="search-input"
                    placeholder="🔍 Search products..."
                    id="searchInput"
                > --}}
                <select class="filter-select" id="categoryFilter">
    <option value="">All Categories</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select>

            </div>
        </div>

        @if($products->count() > 0)
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Colors</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>


                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr data-category-id="{{ $product->category_id }}">
                            <td>
                                <div class="product-info">
                                    @php
                                        $mainImage = null;
                                        if($product->productColors->count() > 0){
                                            $color = $product->productColors->first();
                                            $mainImage = $color->images->where('is_main', 1)->first()
                                                      ?? $color->images->first();
                                        }
                                    @endphp

                                    @if($mainImage)
                                        <img
                                            src="{{ asset('storage/'.$mainImage->image) }}"
                                            alt="{{ $product->name }}"
                                            class="product-image"
                                        >
                                    @else
                                        <div class="product-no-image">No image</div>
                                    @endif

                                    <div class="product-details">
                                        <div class="product-name">{{ $product->name }}</div>
                                        <div class="product-meta">SKU: {{ $product->slug }}</div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="product-price">{{ number_format($product->price, 2) }} DH</span>
                            </td>

                            <td>
                                @php
                                    $totalStock = $product->productColors->sum('stock');
                                @endphp
                                <strong>{{ $totalStock }}</strong> units
                            </td>

                            <td>
                                {{ $product->productColors->count() }} color{{ $product->productColors->count() > 1 ? 's' : '' }}
                            </td>

                            <td>
                                @php
                                    $totalStock = $product->productColors->sum('stock');
                                @endphp

                            0    @if($totalStock > 5)
                                    <span class="product-stock stock-in">In Stock</span>
                                @elseif($totalStock > 0)
                                    <span class="product-stock stock-low">Low Stock</span>
                                @else
                                    <span class="product-stock stock-out">Out of Stock</span>
                                @endif
                            </td>

                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="action-btn edit-btn">
                                        ✏️ Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            onclick="return confirm('Are you sure you want to delete this product?')"
                                        >
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($products->hasPages())
<div class="pagination-container mt-6 flex flex-wrap justify-center items-center gap-2">
    {{-- Previous --}}
    @if ($products->onFirstPage())
        <span class="pagination-btn disabled">« Previous</span>
    @else
        <a href="{{ $products->previousPageUrl() }}" class="pagination-btn">« Previous</a>
    @endif

    {{-- Page numbers --}}
    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
        @if ($page == $products->currentPage())
            <span class="pagination-btn active">{{ $page }}</span>
        @else
            <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
        @endif
    @endforeach

    {{-- Next --}}
    @if ($products->hasMorePages())
        <a href="{{ $products->nextPageUrl() }}" class="pagination-btn">Next »</a>
    @else
        <span class="pagination-btn disabled">Next »</span>
    @endif
</div>
@endif


        @else
            <div class="empty-state">
                <div class="empty-icon">📦</div>
                <h3 class="empty-title">No Products Yet</h3>
                <p>Start by adding your first product to the inventory.</p>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('.products-table tbody tr');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        tableRows.forEach(row => {
            const productName = row.querySelector('.product-name').textContent.toLowerCase();
            const productMeta = row.querySelector('.product-meta').textContent.toLowerCase();

            if (productName.includes(searchTerm) || productMeta.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
<script>
   document.getElementById('categoryFilter').addEventListener('change', function() {
    const selectedCategory = this.value;
    const tableRows = document.querySelectorAll('.products-table tbody tr');

    tableRows.forEach(row => {
        const productCategoryId = row.getAttribute('data-category-id');

        if (selectedCategory === '' || productCategoryId === selectedCategory) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

</script>
@endsection
