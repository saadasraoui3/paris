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
        border-bottom: 2px solid #eee;
        padding-bottom: 1rem;
    }

    .admin-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.2rem;
        color: var(--primary-color);
    }

    .back-btn {
        padding: 0.5rem 1.2rem;
        border-radius: 8px;
        text-decoration: none;
        border: 1px solid var(--accent-color);
        color: var(--accent-color);
        font-size: 0.85rem;
        transition: .2s;
    }

    .back-btn:hover {
        background: var(--accent-color);
        color: white;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-card {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 14px;
        padding: 1.5rem;
    }

    .info-title {
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #777;
        margin-bottom: 0.4rem;
    }

    .info-value {
        font-weight: 600;
        font-size: 1rem;
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

    .products-card {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 14px;
        overflow: hidden;
    }

    .products-header {
        padding: 1.2rem 1.5rem;
        background: #fafafa;
        border-bottom: 1px solid #eee;
        font-weight: 600;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
    }

    .products-table th {
        padding: 1rem 1.5rem;
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #777;
        text-align: left;
        background: #fafafa;
        border-bottom: 2px solid #eee;
    }

    .products-table td {
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid #f1f1f1;
    }

    .total-box {
        text-align: right;
        padding: 1.5rem;
        font-size: 1.1rem;
        font-weight: 600;
    }

    @media(max-width:768px){
        .info-grid {
            grid-template-columns: 1fr;
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
        <h1 class="admin-title">
            Order #{{ $order->order_number }}
        </h1>

        <a href="{{ route('admin.orders.index') }}" class="back-btn">
            ← Back to Orders
        </a>
    </div>

    <!-- Order Info -->
    <div class="info-grid">
        <div class="info-card">
            <div class="info-title">Client</div>
            <div class="info-value">
                {{ $order->user?->name ?? $order->full_name ?? 'Guest' }}
            </div>
        </div>

        <div class="info-card">
            <div class="info-title">Phone</div>
            <div class="info-value">{{ $order->phone }}</div>
        </div>

        <div class="info-card">
            <div class="info-title">Shipping Address</div>
            <div class="info-value">{{ $order->shipping_address }}</div>
        </div>

        <div class="info-card">
            <div class="info-title">Status</div>
            <div class="info-value">
                <span class="status-badge status-{{ $order->status }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="products-card">
        <div class="products-header">
            Products
        </div>

        <table class="products-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Couleur</th>
                    <th>Prix</th>
                    <th>Qté</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->pack_items ? '🎁 ' : '' }}{{ $item->product_name ?? $item->product->name }}</td>
                        <td>
                            @if($item->pack_items)
                                @foreach($item->pack_items as $packItem)
                                    <div>{{ $packItem['product_name'] }} : {{ $packItem['color_name'] }}{{ $packItem['quantity'] > 1 ? ' ×'.$packItem['quantity'] : '' }}</div>
                                @endforeach
                            @else
                                {{ $item->productColor->color->name ?? '-' }}
                            @endif
                        </td>
                        <td>{{ number_format($item->price, 2) }} DH</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            {{ number_format($item->price * $item->quantity, 2) }} DH
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-box">
            Total : {{ number_format($order->total, 2) }} DH
        </div>
    </div>

</div>
@endsection
