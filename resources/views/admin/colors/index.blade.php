@extends('admin.layouts.app')

@section('content')
<style>
    .admin-container {
        max-width: 1200px;
        margin: auto;
        padding: 2rem;
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
        transition: .3s;
    }

    .add-btn:hover {
        background: #b89568;
        box-shadow: 0 4px 12px rgba(201,168,124,.3);
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

    .color-preview {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid #ddd;
        display: inline-block;
    }

    .color-name {
        font-weight: 600;
    }

    .color-code {
        font-size: 0.8rem;
        color: #777;
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
        <h1 class="admin-title">Colors</h1>
        <a href="{{ route('admin.colors.create') }}" class="add-btn">
            ➕ Add Color
        </a>
    </div>

    <!-- Colors Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Color</th>
                    <th>Code</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($colors as $color)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:1rem;">
                                <span class="color-preview"
                                      style="background: {{ $color->code }}"></span>
                                <span class="color-name">
                                    {{ $color->name }}
                                </span>
                            </div>
                        </td>

                        <td class="color-code">
                            {{ $color->code }}
                        </td>

                        <td>
                            <a href="{{ route('admin.colors.edit', $color) }}"
                               class="action-btn edit-btn">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.colors.destroy', $color) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="action-btn delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this color?');">
                                    🗑️ Delete
                                </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($colors->hasPages())
<div class="pagination-container mt-6 flex flex-wrap justify-center items-center gap-2">
    {{-- Previous --}}
    @if ($colors->onFirstPage())
        <span class="pagination-btn disabled">« Previous</span>
    @else
        <a href="{{ $colors->previousPageUrl() }}" class="pagination-btn">« Previous</a>
    @endif

    {{-- Page numbers --}}
    @foreach ($colors->getUrlRange(1, $colors->lastPage()) as $page => $url)
        @if ($page == $colors->currentPage())
            <span class="pagination-btn active">{{ $page }}</span>
        @else
            <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
        @endif
    @endforeach

    {{-- Next --}}
    @if ($colors->hasMorePages())
        <a href="{{ $colors->nextPageUrl() }}" class="pagination-btn">Next »</a>
    @else
        <span class="pagination-btn disabled">Next »</span>
    @endif
</div>
@endif

    </div>

</div>
@endsection
