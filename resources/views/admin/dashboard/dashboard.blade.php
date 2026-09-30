@extends('admin.layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #2c2c2c;
        --accent-color: #c9a87c;
        --bg-cream: #faf8f3;
        --text-light: #666;
    }

    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 3rem;
        background: white;
    }

    .dashboard-header {
        margin-bottom: 3rem;
        border-bottom: 2px solid var(--accent-color);
        padding-bottom: 2rem;
    }

    h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem;
        font-weight: 300;
        letter-spacing: 2px;
        color: var(--primary-color);
        margin: 0;
    }

    .dashboard-subtitle {
        color: var(--text-light);
        margin-top: 0.5rem;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }

    /* ===== Dashboard Stats ===== */
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: linear-gradient(135deg, var(--bg-cream) 0%, #f5f1ea 100%);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: all 0.4s ease;
        border: 1px solid rgba(201, 168, 124, 0.2);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-color), #d4a574);
    }

    .stat-card:hover {
        box-shadow: 0 8px 25px rgba(201, 168, 124, 0.15);
        transform: translateY(-4px);
    }

    .stat-card h5 {
        font-size: 0.85rem;
        color: var(--text-light);
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .stat-card p {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        font-weight: 300;
        color: var(--accent-color);
        margin: 0;
        letter-spacing: 1px;
    }

    .stat-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        opacity: 0.7;
    }

    /* ===== Section Titles ===== */
    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 300;
        letter-spacing: 2px;
        margin: 2.5rem 0 1.5rem 0;
        color: var(--primary-color);
        border-bottom: 1px solid #e8e8e8;
        padding-bottom: 1rem;
    }

    /* ===== Recent Orders Cards ===== */
    .recent-orders {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .order-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid #e8e8e8;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .order-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--accent-color), #d4a574);
    }

    .order-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        transform: translateY(-3px);
    }

    .order-card h4 {
        margin: 0 0 1rem 0;
        font-size: 1.1rem;
        color: var(--primary-color);
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .order-card p {
        margin: 0.6rem 0;
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .order-card strong {
        color: var(--primary-color);
        font-weight: 600;
    }

    .order-info {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #f0f0f0;
    }

    .order-amount {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem;
        color: var(--accent-color);
        font-weight: 400;
    }

    .status {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
        letter-spacing: 0.5px;
    }

    .status.pending {
        background: linear-gradient(135deg, #ffc107, #ffb300);
    }
    .status.processing {
        background: linear-gradient(135deg, #17a2b8, #138496);
    }
    .status.shipped {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    .status.delivered {
        background: linear-gradient(135deg, #28a745, #1e7e34);
    }
    .status.cancelled {
        background: linear-gradient(135deg, #dc3545, #bd2130);
    }

    /* ===== Sales Chart ===== */
    .sales-chart-card {
        background: linear-gradient(135deg, var(--bg-cream) 0%, #f5f1ea 100%);
        border-radius: 12px;
        padding: 2rem;
        border: 1px solid rgba(201, 168, 124, 0.2);
    }

    .sales-chart-card h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 300;
        letter-spacing: 1.5px;
        margin-bottom: 2rem;
        color: var(--primary-color);
    }

    /* Chart.js Customization */
    canvas {
        max-height: 350px;
    }

    /* ===== Responsive ===== */
    @media (max-width: 1024px) {
        .dashboard-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .admin-container {
            padding: 1.5rem;
        }

        h1 {
            font-size: 2rem;
        }

        .dashboard-stats {
            grid-template-columns: 1fr;
        }

        .recent-orders {
            grid-template-columns: 1fr;
        }

        .section-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="admin-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1>Dashboard Admin</h1>
        <p class="dashboard-subtitle">Bienvenue dans votre espace de gestion Clemence Paris</p>
    </div>

    <!-- ===== Dashboard Stats ===== -->
    <div class="dashboard-stats">
        <div class="stat-card">
            {{-- <div class="stat-icon">📦</div> --}}
            <h5>Produits</h5>
            <p>{{ $products->count() }}</p>
        </div>
        <div class="stat-card">
            {{-- <div class="stat-icon">🛒</div> --}}
            <h5>Commandes</h5>
            <p>{{ $orders->count() }}</p>
        </div>
        <div class="stat-card">
            {{-- <div class="stat-icon">💰</div> --}}
            <h5>Revenue</h5>
            <p>{{ number_format($orders->sum('total'), 0, ',', ' ') }}<span style="font-size: 1rem;">DH</span></p>
        </div>
    </div>

    <!-- ===== Recent Orders ===== -->
    <h2 class="section-title">Commandes Récentes</h2>
    <div class="recent-orders">
        @foreach($orders->take(6) as $order)
        <div class="order-card">
            <h4>Commande #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h4>
            <p><strong>Client:</strong> {{ $order->full_name ?? 'Guest' }}</p>
            <p><strong>Email:</strong> {{ $order->email ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y') }}</p>

            <div class="order-info">
                <span class="order-amount">{{ number_format($order->total, 2, ',', ' ') }} DH</span>
                <span class="status {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- ===== Sales Chart ===== -->
    <h2 class="section-title">Ventes du Mois</h2>
    <div class="sales-chart-card">
        <canvas id="salesChart" width="400" height="150"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('salesChart').getContext('2d');
const gradient = ctx.createLinearGradient(0, 0, 0, 200);
gradient.addColorStop(0, 'rgba(201, 168, 124, 0.4)');
gradient.addColorStop(1, 'rgba(201, 168, 124, 0.05)');

const salesChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($salesData['months']) !!},
        datasets: [{
            label: 'Total Ventes (DH)',
            data: {!! json_encode($salesData['totals']) !!},
            backgroundColor: gradient,
            borderColor: 'rgba(201, 168, 124, 1)',
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: true,
                labels: {
                    color: '#2c2c2c',
                    font: { size: 12, family: "'Segoe UI', sans-serif" }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: '#999' },
                grid: { color: 'rgba(0,0,0,0.05)' }
            },
            x: {
                ticks: { color: '#999' },
                grid: { display: false }
            }
        }
    }
});
</script>
@endsection
