@extends('admin.layouts.app')

@section('content')
<style>
    .admin-container {
        max-width: 1400px;
        margin: auto;
        padding: 2rem;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        border-bottom: 2px solid #eee;
        padding-bottom: 1rem;
    }

    .admin-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.4rem;
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
        background: var(--accent-color);
        color: white;
        padding: 0.6rem 1.4rem;
        border-radius: 10px;
        text-decoration: none;
        font-size: 0.85rem;
        transition: .2s;
    }

    .add-btn:hover {
        background: #b89568;
    }

    .table-container {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 14px;
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #fafafa;
        border-bottom: 2px solid #eee;
    }

    th {
        padding: 1rem 1.5rem;
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #777;
        text-align: left;
    }

    td {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid #f1f1f1;
        vertical-align: middle;
    }

    tbody tr:hover {
        background: #fafafa;
    }

    .category-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .category-img {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #e5e5e5;
    }

    .category-name {
        font-weight: 600;
    }

    .action-btn {
        padding: 0.4rem 1rem;
        border-radius: 8px;
        font-size: 0.8rem;
        text-decoration: none;
        border: 1px solid;
        transition: .2s;
        display: inline-flex;
        align-items: center;
        gap: .3rem;
    }

    .edit-btn {
        color: var(--accent-color);
        border-color: var(--accent-color);
        background: white;
    }

    .edit-btn:hover {
        background: var(--accent-color);
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
    @media(max-width:768px){
        table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<div class="admin-container">

    <!-- Header -->
    <div class="admin-header">
        <h1 class="admin-title">Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="add-btn">
            ➕ Add Category
        </a>
    </div>

    <!-- Categories Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            <div class="category-name">
                                {{ $category->name }}
                            </div>
                        </td>

                        <td>
                            @if($category->image)
                                <img
                                    src="{{ asset('storage/'.$category->image) }}"
                                    class="category-img"
                                    alt="{{ $category->name }}"
                                >
                            @else
                                —
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="action-btn edit-btn">
                                ✏️ Edit
                            </a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            onclick="return confirm('Are you sure you want to delete this category?')"
                                        >
                                            🗑️ Delete
                                        </button>
                                    </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($categories->hasPages())
<div class="pagination-container mt-6 flex flex-wrap justify-center items-center gap-2">
    {{-- Previous --}}
    @if ($categories->onFirstPage())
        <span class="pagination-btn disabled">« Previous</span>
    @else
        <a href="{{ $categories->previousPageUrl() }}" class="pagination-btn">« Previous</a>
    @endif

    {{-- Page numbers --}}
    @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
        @if ($page == $categories->currentPage())
            <span class="pagination-btn active">{{ $page }}</span>
        @else
            <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
        @endif
    @endforeach

    {{-- Next --}}
    @if ($categories->hasMorePages())
        <a href="{{ $categories->nextPageUrl() }}" class="pagination-btn">Next »</a>
    @else
        <span class="pagination-btn disabled">Next »</span>
    @endif
</div>
@endif

    </div>

</div>
@endsection
