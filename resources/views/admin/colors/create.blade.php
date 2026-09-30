@extends('admin.layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 600px;
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
        font-size: 2.2rem;
        font-weight: 400;
        color: var(--primary-color);
    }

    .back-btn {
        text-decoration: none;
        padding: 0.5rem 1.2rem;
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

    .form-input, .form-input-color {
        width: 100%;
        padding: 0.7rem 1rem;
        border-radius: 8px;
        border: 1px solid #e5e5e5;
        font-size: 0.95rem;
        transition: .3s;
    }

    .form-input:focus, .form-input-color:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(201,168,124,.1);
    }

    .form-input-color {
        height: 50px;
        padding: 0;
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
        <h1 class="form-title">Create Color</h1>
        <a href="{{ route('admin.colors.index') }}" class="back-btn">
            ← Back to Colors
        </a>
    </div>

    <form method="POST" action="{{ route('admin.colors.store') }}">
        @csrf

        <div class="form-card">
            <h2 class="card-title">🎨 Color Information</h2>

            <div class="form-group">
                <label class="form-label required">Color Name</label>
                <input
                    type="text"
                    name="name"
                    class="form-input"
                    placeholder="e.g., Red"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label required">Color Code</label>
                <input
                    type="color"
                    name="code"
                    class="form-input-color"
                    required
                >
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                💾 Save Color
            </button>
        </div>
    </form>
</div>
@endsection
