<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Clemence Paris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Segoe+UI:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2c2c2c;
            --accent-color: #c9a87c;
            --bg-cream: #faf8f3;
            --text-light: #666;
            --border-light: #e8e8e8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            font-family: 'Segoe UI', sans-serif;
            background: var(--bg-cream);
            color: var(--primary-color);
        }

        /* ===== Sidebar ===== */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--primary-color) 0%, #1a1a1a 100%);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
        }

        .sidebar h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 300;
            letter-spacing: 2px;
            padding: 2rem 1.5rem;
            margin: 0;
            border-bottom: 2px solid var(--accent-color);
            text-align: center;
        }

        .sidebar h3 span {
            color: var(--accent-color);
        }

        .sidebar-menu {
            flex: 1;
            padding: 1.5rem 0;
        }

        .sidebar a {
            color: #ccc;
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        .sidebar a:hover {
            background: rgba(201, 168, 124, 0.1);
            color: var(--accent-color);
            border-left-color: var(--accent-color);
            padding-left: 2rem;
        }

        .sidebar a.active {
            background: rgba(201, 168, 124, 0.15);
            color: var(--accent-color);
            border-left-color: var(--accent-color);
        }

        .sidebar-icon {
            margin-right: 0.8rem;
            font-size: 1.1rem;
        }

        .sidebar-logout {
            padding: 1.5rem;
            border-top: 1px solid rgba(201, 168, 124, 0.2);
            margin-top: auto;
        }

        .sidebar-logout a {
            justify-content: center;
            background: linear-gradient(135deg, var(--accent-color), #d4a574);
            color: white;
            border-radius: 8px;
            margin: 0 0.5rem;
            padding: 0.8rem 1.5rem;
            border: none;
        }

        .sidebar-logout a:hover {
            background: linear-gradient(135deg, #d4a574, var(--accent-color));
            border-left: 3px solid transparent;
            padding-left: 1.5rem;
        }

        /* ===== Content ===== */
        .content-wrapper {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Header Bar */
        .admin-header {
            background: white;
            padding: 1.5rem 2.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid var(--border-light);
        }

        .admin-header h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 300;
            letter-spacing: 1.5px;
            margin: 0;
            color: var(--primary-color);
        }

        .admin-header p {
            margin: 0.3rem 0 0 0;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Content */
        .content {
            flex: 1;
            padding: 2.5rem;
            overflow-y: auto;
        }

        /* ===== Cards ===== */
        .card {
            border: 1px solid var(--border-light);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            background: white;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }

        /* ===== Tables ===== */
        .table {
            color: var(--primary-color);
        }

        .table thead {
            background: var(--bg-cream);
            border-bottom: 2px solid var(--accent-color);
        }

        .table thead th {
            color: var(--primary-color);
            font-weight: 600;
            border: none;
            padding: 1rem;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            border-color: var(--border-light);
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: rgba(201, 168, 124, 0.05);
        }

        /* ===== Buttons ===== */
        .btn-primary {
            background: linear-gradient(135deg, var(--accent-color), #d4a574);
            border: none;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #d4a574, var(--accent-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(201, 168, 124, 0.3);
        }

        .btn-secondary {
            background: var(--border-light);
            color: var(--primary-color);
            border: none;
            font-weight: 500;
        }

        .btn-secondary:hover {
            background: #ddd;
        }

        /* ===== Forms ===== */
        .form-control, .form-select {
            border: 1px solid var(--border-light);
            border-radius: 8px;
            padding: 0.7rem 1rem;
            font-family: inherit;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(201, 168, 124, 0.1);
        }

        .form-label {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        /* ===== Responsive ===== */
        @media (max-width: 992px) {
            .sidebar {
                width: 240px;
            }

            .content-wrapper {
                margin-left: 240px;
            }

            .content {
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
                position: static;
                flex-direction: row;
                padding: 0;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            }

            .sidebar h3 {
                padding: 1rem 1.5rem;
                margin: 0;
                border-bottom: none;
                border-right: 2px solid var(--accent-color);
            }

            .sidebar-menu {
                display: flex;
                flex: 1;
                padding: 0;
                gap: 0;
            }

            .sidebar a {
                padding: 1rem;
                flex: 1;
                text-align: center;
                border-left: none;
                border-bottom: 3px solid transparent;
            }

            .sidebar a:hover {
                border-left: none;
                border-bottom-color: var(--accent-color);
            }

            .sidebar a.active {
                border-left: none;
                border-bottom-color: var(--accent-color);
            }

            .sidebar-logout {
                display: none;
            }

            .content-wrapper {
                margin-left: 0;
            }

            .admin-header h1 {
                font-size: 1.5rem;
            }

            .content {
                padding: 1.5rem;
            }
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--accent-color);
            border-radius: 3px;
        }
        .logout-btn {
    width: 100%;
    background: linear-gradient(135deg, var(--accent-color), #d4a574);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0.8rem 1.5rem;
    margin: 0 0.5rem;
    cursor: pointer;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.8rem;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.logout-btn:hover {
    background: linear-gradient(135deg, #d4a574, var(--accent-color));
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(201, 168, 124, 0.3);
}

.logout-btn:active {
    transform: translateY(0);
}
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Clemence <span>Paris</span></h3>

        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                {{-- <span class="sidebar-icon">📊</span> --}}
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                {{-- <span class="sidebar-icon">📦</span> --}}
                <span>Produits</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                {{-- <span class="sidebar-icon">🛒</span> --}}
                <span>Commandes</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                {{-- <span class="sidebar-icon">📂</span> --}}
                <span>Catégories</span>
            </a>
            <a href="{{ route('admin.colors.index') }}" class="{{ request()->routeIs('admin.colors.*') ? 'active' : '' }}">
                {{-- <span class="sidebar-icon">🎨</span> --}}
                <span>Couleurs</span>
            </a>
        </div>

        <div class="sidebar-logout">
            <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="logout-btn">
        {{-- <span class="sidebar-icon">🚪</span> --}}
        <span>Déconnexion</span>
    </button>
</form>
        </div>
    </div>

    <!-- Content -->
    <div class="content-wrapper">
        <div class="admin-header">
            <h1>@yield('page-title', 'Dashboard')</h1>
            @yield('page-subtitle')
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
