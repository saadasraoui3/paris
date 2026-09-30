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


    .orders-table-container {
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 14px;
        overflow: hidden;
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
    }

    .orders-table thead {
        background: #fafafa;
        border-bottom: 2px solid #eee;
    }

    .orders-table th {
        padding: 1rem 1.5rem;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #777;
        text-align: left;
    }

    .orders-table td {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid #f1f1f1;
        vertical-align: middle;
    }

    .orders-table tbody tr:hover {
        background: #fafafa;
    }

    .order-id {
        font-weight: 600;
        color: var(--accent-color);
    }

    .order-total {
        font-weight: 600;
    }

    .status-badge {
        padding: 0.35rem 0.9rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: capitalize;
        display: inline-block;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-processing { background: #cce5ff; color: #004085; }
    .status-shipped { background: #d1ecf1; color: #0c5460; }
    .status-delivered { background: #d4edda; color: #155724; }
    .status-cancelled { background: #f8d7da; color: #721c24; }
    .status-refunded { background: #e2e3e5; color: #383d41; }

    .status-select {
        padding: 0.5rem 0.8rem;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 0.85rem;
        cursor: pointer;
    }

    .action-btn {
        padding: 0.45rem 1rem;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        border: 1px solid;
        transition: all .2s ease;
    }

    .show-btn {
        background: white;
        color: var(--accent-color);
        border-color: var(--accent-color);
    }

    .show-btn:hover {
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
        .orders-table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<div class="admin-container">

    <!-- Header -->
    <div class="admin-header">
        <h1 class="admin-title">Orders</h1>
    </div>

    <!-- Orders Table -->
    <div class="orders-table-container">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Change Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="order-id">#{{ $order->id }}</td>

                        <td>
                            {{ $order->user->name ?? 'Guest' }}
                        </td>

                        <td class="order-total">
                            {{ number_format($order->total, 2) }} DH
                        </td>

                        <td>
                            <span class="status-badge status-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td>
                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <select name="status" class="status-select" onchange="this.form.submit()">
                                    @foreach(['pending','processing','shipped','delivered','cancelled','refunded'] as $status)
                                        <option value="{{ $status }}"
                                            {{ $order->status === $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>

                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="action-btn show-btn">
                                👁️ Show
                            </a>

                            <form action="{{ route('admin.orders.destroy', $order) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="action-btn delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this order?');">
                                    🗑️ Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($orders->hasPages())
<div class="pagination-container mt-6 flex flex-wrap justify-center items-center gap-2">
    {{-- Previous --}}
    @if ($orders->onFirstPage())
        <span class="pagination-btn disabled">« Previous</span>
    @else
        <a href="{{ $orders->previousPageUrl() }}" class="pagination-btn">« Previous</a>
    @endif

    {{-- Page numbers --}}
    @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
        @if ($page == $orders->currentPage())
            <span class="pagination-btn active">{{ $page }}</span>
        @else
            <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
        @endif
    @endforeach

    {{-- Next --}}
    @if ($orders->hasMorePages())
        <a href="{{ $orders->nextPageUrl() }}" class="pagination-btn">Next »</a>
    @else
        <span class="pagination-btn disabled">Next »</span>
    @endif
</div>
@endif

    </div>

</div>
@endsection
