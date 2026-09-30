<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLEMENCE PARIS - @yield('title', 'Foulards de Luxe')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #1a1a1a;
            --accent-color: #c9a87c;
            --text-light: #666;
            --bg-cream: #faf8f5;
            --white: #ffffff;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--primary-color);
            background-color: var(--white);
            line-height: 1.6;
        }

        .social-icons {
  display: flex;
  gap: 12px;
}

.social-btn {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  background: #3a0000;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  text-decoration: none;
  transition: 0.3s ease;
}

.social-btn:hover {
  transform: translateY(-3px);
}

/* Colors */
.social-btn.facebook:hover {
  background: #1877f2;
}

.social-btn.instagram:hover {
  background: radial-gradient(circle at 30% 107%,
    #fdf497 0%,
    #fdf497 5%,
    #fd5949 45%,
    #d6249f 60%,
    #285aeb 90%);
}

.social-btn.tiktok:hover {
  background: #000;
}


        /* Header Styles */
        header {
            background-color: var(--white);
            border-bottom: 1px solid #e5e5e5;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.2rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            font-weight: 300;
            letter-spacing: 3px;
            text-decoration: none;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .logo:hover {
            letter-spacing: 4px;
        }

        .logo span {
            color: var(--accent-color);
            font-weight: 400;
        }

        nav ul {
            display: flex;
            gap: 3.5rem;
            list-style: none;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: var(--primary-color);
            font-size: 0.95rem;
            font-weight: 400;
            letter-spacing: 0.8px;
            transition: all 0.3s ease;
            position: relative;
            text-transform: uppercase;
        }

        nav a:hover {
            color: var(--accent-color);
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent-color), transparent);
            transition: width 0.4s cubic-bezier(0.4, 0.0, 0.2, 1);
        }

        nav a:hover::after {
            width: 100%;
        }

        .header-icons {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .icon-btn {
            background: none;
            border: none;
            font-size: 1.4rem;
            cursor: pointer;
            color: var(--primary-color);
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem;
        }

        .icon-btn:hover {
            color: var(--accent-color);
            transform: scale(1.15);
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, var(--accent-color), #d4a574);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(201, 168, 124, 0.3);
        }

        /* Mobile Menu */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle:hover {
            color: var(--accent-color);
        }

        .mobile-nav {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--white);
            border-bottom: 1px solid #e5e5e5;
            padding: 2rem 1.5rem;
            flex-direction: column;
            gap: 1.5rem;
        }

        .mobile-nav.active {
            display: flex;
        }

        .mobile-nav a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 1rem;
            padding: 0.8rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        /* Cart Slider */
        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
            z-index: 1999;
        }

        .cart-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        #cartSlider {
            z-index: 9999 !important;
            box-shadow: -5px 0 30px rgba(0,0,0,0.15);
        }

        #cartSlider h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 400;
            letter-spacing: 2px;
        }

        #cartSlider button[onclick="closeCart()"] {
            transition: color 0.3s ease;
            font-size: 1.5rem;
        }

        #cartSlider button[onclick="closeCart()"]:hover {
            color: var(--accent-color) !important;
        }

        #cartSlider a[href*="cart.index"],
        #cartSlider a[href*="checkout"] {
            font-family: 'Montserrat', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        #cartSlider a[href*="cart.index"] {
            background-color: var(--primary-color) !important;
        }

        #cartSlider a[href*="cart.index"]:hover {
            background-color: var(--accent-color) !important;
            transform: translateY(-2px);
        }

        #cartSlider a[href*="checkout"] {
            background: linear-gradient(135deg, var(--accent-color), #d4a574) !important;
        }

        #cartSlider a[href*="checkout"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(201, 168, 124, 0.3) !important;
        }

        /* Alert Messages */
        .alert {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem 3rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #e8f5e9 100%);
            color: #155724;
            border-left: 4px solid #28a745;
            padding: 1rem 1.5rem;
            border-radius: 4px;
            margin: 1rem 0;
            animation: slideIn 0.3s ease;
            box-shadow: 0 2px 10px rgba(40, 167, 69, 0.1);
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 400px);
        }

        /* Footer */
        footer {
            background: linear-gradient(180deg, var(--bg-cream) 0%, #f5f1ea 100%);
            border-top: 1px solid #e5e5e5;
            margin-top: 5rem;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 4rem 3rem 2rem;
            display: grid;
            grid-template-columns: 2fr 1.2fr 1.2fr;
            gap: 4rem;
        }

        .footer-brand h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 300;
            letter-spacing: 2px;
            margin-bottom: 1rem;
        }

        .footer-brand h3 span {
            color: var(--accent-color);
            font-weight: 400;
        }

        .footer-brand p {
            color: var(--text-light);
            font-size: 0.9rem;
            line-height: 1.8;
        }

        .footer-section h4 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--primary-color);
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.8rem;
        }

        .footer-section a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .footer-section a:hover {
            color: var(--accent-color);
            padding-left: 5px;
        }

        .newsletter-form {
            display: flex;
            margin-top: 1rem;
            border: 1px solid #ddd;
            border-radius: 0;
            overflow: hidden;
        }

        .newsletter-input {
            flex: 1;
            padding: 1rem;
            border: none;
            font-size: 0.9rem;
            font-family: 'Montserrat', sans-serif;
            background: rgba(255,255,255,0.8);
        }

        .newsletter-input:focus {
            outline: none;
            background: white;
        }

        .newsletter-btn {
            background: linear-gradient(135deg, var(--accent-color), #d4a574);
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            font-weight: 500;
        }

        .newsletter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(201, 168, 124, 0.3);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border: 1.5px solid #ddd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .social-icon:hover {
            background: linear-gradient(135deg, var(--accent-color), #d4a574);
            color: white;
            border-color: var(--accent-color);
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(201, 168, 124, 0.3);
        }

        .footer-bottom {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 3rem;
            border-top: 1px solid #ddd;
            text-align: center;
            color: var(--text-light);
            font-size: 0.85rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            nav ul {
                gap: 2rem;
            }

            .header-container {
                padding: 1rem 1.5rem;
            }

            .footer-container {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
                padding: 3rem 1.5rem 1rem;
            }
        }

        @media (max-width: 768px) {
            nav {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .header-icons {
                gap: 1.5rem;
            }

            .footer-container {
                grid-template-columns: 1fr;
            }

            .alert {
                padding: 1rem 1.5rem;
            }

            .section-container {
                padding: 3rem 1.5rem !important;
            }
        }

        @media (max-width: 640px) {
            .logo {
                font-size: 1.5rem;
            }

            .header-container {
                padding: 1rem 1rem;
            }

            .icon-btn {
                font-size: 1.2rem;
            }

            nav a {
                font-size: 0.9rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Cart Overlay -->
    <div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>

    <!-- Cart Slider -->
    @include('components.cart-slider')

    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="{{ route('home') }}" class="logo">Clemence <span>Paris</span></a>

            <nav>
                <ul>
                    <li><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                    <li><a href="{{ route('shop.index') }}">{{ __('messages.shop') }}</a></li>
                    <li><a href="{{ route('propos') }}">{{ __('messages.about') }}</a></li>
                    {{-- <li><a href="{{ route('guide') }}">Guide des Tailles</a></li> --}}
                    <li><a href="{{ route('faq') }}">{{ __('messages.faq') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('messages.contact') }}</a></li>



                </ul>
            </nav>

            <div class="header-icons">
                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">☰</button>
                <button class="icon-btn" onclick="openCart()">
                    {{-- 🛒 --}}
                    <img src="{{ asset('storage/images/shopping-bag.svg') }}" alt="Cart" style="width: 30px; height: 30px;">
                    @php
                        $cart = \App\Models\Cart::where('session_id', session()->getId())
                            ->with('items')
                            ->first();
                        $cartCount = $cart ? $cart->items->count() : 0;
                    @endphp
                    @if($cartCount > 0)
                        <span class="cart-count">{{ $cartCount }}</span>
                    @endif
                </button>
                <a href="{{ route('change.language', 'fr') }}" class="btn btn-sm btn-outline-primary">FR</a>
                <a href="{{ route('change.language', 'ar') }}" class="btn btn-sm btn-outline-success">AR</a>
                



            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="mobile-nav" id="mobileNav">
            <a href="{{ route('home') }}">{{ __('messages.home') }}</a>
<a href="{{ route('shop.index') }}">{{ __('messages.shop') }}</a>
<a href="{{ route('propos') }}">{{ __('messages.about') }}</a>
<a href="{{ route('faq') }}">{{ __('messages.faq') }}</a>
<a href="{{ route('contact') }}">{{ __('messages.contact') }}</a>

        </div>
    </header>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert">
        <div class="alert-success">
            {{ session('success') }}
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-brand">
                <h3>Clemence <span>Paris</span></h3>
                <p>{{__('messages.story')}}</p><br>
                <div class="social-icons">
  <a href="https://www.tiktok.com/@clemence_p0ris?_r=1&_t=ZS-92dYsy58vns"
     class="social-btn tiktok"
     target="_blank"
     aria-label="TikTok">
    <i class="fa-brands fa-tiktok"></i>
  </a>

  <a href="https://www.facebook.com/share/16rqQw4pUT/?mibextid=wwXIfr"
     class="social-btn facebook"
     target="_blank"
     aria-label="Facebook">
    <i class="fa-brands fa-facebook-f"></i>
  </a>

  <a href="https://www.instagram.com/beautyscarf_clemence?igsh=bWdxaHFycmd6MGg%3D&utm_source=qr"
     class="social-btn instagram"
     target="_blank"
     aria-label="Instagram">
    <i class="fa-brands fa-instagram"></i>
  </a>
</div>

            </div>

            <div class="footer-section">
                <h4>Boutique</h4>
                <ul>
                    <li><a href="{{ route('shop.index') }}">{{__('messages.shop')}}</a></li>
                    <li><a href="{{ route('shop.index') }}">{{__('messages.new_collection')}}</a></li>
                    <li><a href="{{ route('shop.index') }}">{{__('messages.best_sellers')}}</a></li>
                    <li><a href="{{ route('shop.index') }}">{{__('messages.sale')}}</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Service</h4>
                <ul>

                    <li><a href="{{ route('propos') }}">{{__('messages.about')}}</a></li>
                    <li><a href="{{ route('faq') }}">{{__('messages.faq')}}</a></li>
                    <li><a href="{{ route('contact') }}">{{__('messages.contact')}}</a></li>
                    {{-- <li><a href="{{ route('politique') }}">Politique de Confidentialité</a></li> --}}


                </ul>
            </div>

            {{-- <div class="footer-section">
                <h4>Newsletter</h4>
                <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">
                    Découvrez nos nouvelles collections et offres exclusives.
                </p>
                <form class="newsletter-form" onsubmit="return false;">
                    <input type="email" class="newsletter-input" placeholder="Votre email" required>
                    <button type="submit" class="newsletter-btn">✉</button>
                </form>
            </div> --}}
        </div>

        <div class="footer-bottom">
        {{__('messages.copyright')}} 2025 Clemence Paris. {{__('messages.all_rights_reserved')}} | {{__('messages.design_development')}}
       
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function openCart() {
            const cartSlider = document.getElementById('cartSlider');
            const overlay = document.getElementById('cartOverlay');

            cartSlider.style.right = '0';
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeCart() {
            const cartSlider = document.getElementById('cartSlider');
            const overlay = document.getElementById('cartOverlay');

            cartSlider.style.right = '-400px';
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function toggleMobileMenu() {
            const mobileNav = document.getElementById('mobileNav');
            mobileNav.classList.toggle('active');
        }

        // Close mobile menu when clicking a link
        document.querySelectorAll('.mobile-nav a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('mobileNav').classList.remove('active');
            });
        });

        @if(session('openCart'))
        document.addEventListener('DOMContentLoaded', function() {
            openCart();
        });
        @endif

        // Auto-hide success messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert-success');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>

    @yield('scripts')
    @include('components.cookie-consent')
</body>
</html>
