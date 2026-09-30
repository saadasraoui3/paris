<form method="POST" action="{{ route('admin.login') }}" class="login-form">
    @csrf

    <div class="login-container">
        <div class="login-header">
            <h1 class="login-title">Clemence <span>Paris</span></h1>
            <p class="login-subtitle">Admin Dashboard</p>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="votre@email.com"
                required
                class="form-input">
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
                class="form-input">
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="login-btn">Connexion</button>

        <div class="login-footer">
            <p>© 2025 Clemence Paris</p>
        </div>
    </div>
</form>

<style>
    :root {
        --primary-color: #2c2c2c;
        --accent-color: #c9a87c;
        --bg-cream: #faf8f3;
        --text-light: #666;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, var(--bg-cream) 0%, #f5f1ea 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-form {
        width: 100%;
        max-width: 450px;
        padding: 0 1.5rem;
    }

    .login-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        padding: 3.5rem 2.5rem;
        animation: slideUp 0.6s ease;
        border: 1px solid rgba(201, 168, 124, 0.1);
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .login-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.2rem;
        font-weight: 300;
        letter-spacing: 2px;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .login-title span {
        color: var(--accent-color);
    }

    .login-subtitle {
        color: var(--text-light);
        font-size: 0.95rem;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .form-group {
        margin-bottom: 1.8rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.7rem;
        color: var(--primary-color);
        font-weight: 500;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }

    .form-input {
        width: 100%;
        padding: 1rem 1.2rem;
        border: 2px solid #e8e8e8;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: var(--bg-cream);
        color: var(--primary-color);
    }

    .form-input:focus {
        outline: none;
        border-color: var(--accent-color);
        background: white;
        box-shadow: 0 0 0 3px rgba(201, 168, 124, 0.1);
    }

    .form-input::placeholder {
        color: #bbb;
    }

    .error-message {
        display: block;
        color: #d9534f;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .login-btn {
        width: 100%;
        padding: 1.1rem;
        background: linear-gradient(135deg, var(--accent-color), #d4a574);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1.5rem;
        box-shadow: 0 4px 15px rgba(201, 168, 124, 0.2);
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(201, 168, 124, 0.3);
        background: linear-gradient(135deg, #d4a574, var(--accent-color));
    }

    .login-btn:active {
        transform: translateY(0);
    }

    .login-footer {
        text-align: center;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e8e8e8;
        color: var(--text-light);
        font-size: 0.85rem;
    }

    @media (max-width: 480px) {
        .login-container {
            padding: 2.5rem 1.5rem;
        }

        .login-title {
            font-size: 1.8rem;
        }

        .form-input {
            padding: 0.9rem 1rem;
        }
    }
</style>
