@extends('layouts.app')

@section('content')
<style>
    .policy-hero {
        background: linear-gradient(135deg, var(--bg-cream) 0%, #f5f1ea 100%);
        padding: 4rem 0;
        text-align: center;
        border-bottom: 1px solid #e5e5e5;
    }

    .policy-hero-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .policy-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem;
        font-weight: 400;
        letter-spacing: 2px;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .policy-hero-date {
        color: #666;
        font-size: 0.95rem;
    }

    .policy-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 4rem 3rem 6rem;
    }

    .policy-intro {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 3rem;
        border-left: 4px solid var(--accent-color);
    }

    .policy-intro-text {
        color: #666;
        line-height: 1.8;
        font-size: 1.05rem;
    }

    .policy-section {
        margin-bottom: 3rem;
    }

    .section-number {
        display: inline-block;
        background-color: var(--accent-color);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 500;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        margin-top: 0.5rem;
    }

    .section-content {
        color: #666;
        line-height: 1.9;
        font-size: 1rem;
    }

    .section-content p {
        margin-bottom: 1.2rem;
    }

    .section-content ul {
        margin: 1.5rem 0;
        padding-left: 0;
        list-style: none;
    }

    .section-content ul li {
        position: relative;
        padding-left: 2rem;
        margin-bottom: 1rem;
        line-height: 1.8;
    }

    .section-content ul li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--accent-color);
        font-weight: bold;
        font-size: 1.2rem;
    }

    .section-content strong {
        color: var(--primary-color);
        font-weight: 600;
    }

    .highlight-box {
        background-color: var(--bg-cream);
        border-left: 3px solid var(--accent-color);
        padding: 1.5rem;
        border-radius: 8px;
        margin: 2rem 0;
    }

    .highlight-box p {
        margin: 0;
        color: var(--primary-color);
        font-weight: 500;
    }

    .contact-section {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        color: white;
        padding: 3rem;
        border-radius: 12px;
        margin-top: 4rem;
        text-align: center;
    }

    .contact-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 400;
        margin-bottom: 1rem;
        color: var(--accent-color);
    }

    .contact-text {
        opacity: 0.9;
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .contact-email {
        display: inline-block;
        color: var(--accent-color);
        text-decoration: none;
        font-weight: 500;
        font-size: 1.1rem;
        padding: 0.8rem 2rem;
        border: 2px solid var(--accent-color);
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .contact-email:hover {
        background-color: var(--accent-color);
        color: white;
    }

    .divider {
        height: 1px;
        background: linear-gradient(to right, transparent, #e5e5e5, transparent);
        margin: 3rem 0;
    }

    @media (max-width: 768px) {
        .policy-container {
            padding: 3rem 1.5rem 4rem;
        }

        .policy-hero-title {
            font-size: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .policy-intro,
        .contact-section {
            padding: 1.5rem;
        }
    }
</style>

<!-- Hero Section -->
<div class="policy-hero">
    <div class="policy-hero-content">
        <h1 class="policy-hero-title">{{ __('messages.privacy.title') }}</h1>
        <p class="policy-hero-date">{{ __('messages.privacy.last_updated') }} {{ date('d F Y') }}</p>
    </div>
</div>

<div class="policy-container">
    <!-- Introduction -->
    <div class="policy-intro">
        <p class="policy-intro-text">
            {!! __('messages.privacy.intro') !!}
        </p>
    </div>

    <!-- Section 1 -->
    <div class="policy-section">
        <div class="section-number">1</div>
        <h2 class="section-title">{{ __('messages.privacy.section1_title') }}</h2>
        <div class="section-content">
            <p>
                {{ __('messages.privacy.section1_intro') }}
            </p>

            <ul>
                <li><strong>{{ __('messages.privacy.section1_personal_info') }}</strong></li>
                <li><strong>{{ __('messages.privacy.section1_order_info') }}</strong></li>
                <li><strong>{{ __('messages.privacy.section1_navigation_data') }}</strong></li>
                <li><strong>{{ __('messages.privacy.section1_cookies') }}</strong></li>
            </ul>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Section 2 -->
    <div class="policy-section">
        <div class="section-number">2</div>
        <h2 class="section-title">{{ __('messages.privacy.section2_title') }}</h2>
        <div class="section-content">
            <p>
                {{ __('messages.privacy.section2_intro') }}
            </p>

            <ul>
                <li>{{ __('messages.privacy.section2_process_orders') }}</li>
                <li>{{ __('messages.privacy.section2_communicate') }}</li>
                <li>{{ __('messages.privacy.section2_improve') }}</li>
                <li>{{ __('messages.privacy.section2_personalize') }}</li>
                <li>{{ __('messages.privacy.section2_marketing') }}</li>
                <li>{{ __('messages.privacy.section2_security') }}</li>
            </ul>

            <div class="highlight-box">
                <p>
                    {{ __('messages.privacy.section2_no_sell') }}
                </p>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Section 3 -->
    <div class="policy-section">
        <div class="section-number">3</div>
        <h2 class="section-title">{{ __('messages.privacy.section3_title') }}</h2>
        <div class="section-content">
            <p>
                {{ __('messages.privacy.section3_intro') }}
            </p>

            <ul>
                <li><strong>{{ __('messages.privacy.section3_providers') }}</strong></li>
                <li><strong>{{ __('messages.privacy.section3_legal') }}</strong></li>
                <li><strong>{{ __('messages.privacy.section3_marketing_partners') }}</strong></li>
            </ul>

            <p>
                {{ __('messages.privacy.section3_confidentiality') }}
            </p>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Section 4 -->
    <div class="policy-section">
        <div class="section-number">4</div>
        <h2 class="section-title">{{ __('messages.privacy.section4_title') }}</h2>
        <div class="section-content">
            <p>
                {{ __('messages.privacy.section4_intro') }}
            </p>

            <ul>
                <li>{{ __('messages.privacy.section4_ssl') }}</li>
                <li>{{ __('messages.privacy.section4_access') }}</li>
                <li>{{ __('messages.privacy.section4_servers') }}</li>
                <li>{{ __('messages.privacy.section4_protocols') }}</li>
            </ul>

            <p>
                {{ __('messages.privacy.section4_disclaimer') }}
            </p>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Section 5 -->
    <div class="policy-section">
        <div class="section-number">5</div>
        <h2 class="section-title">{{ __('messages.privacy.section5_title') }}</h2>
        <div class="section-content">
            <p>
                {{ __('messages.privacy.section5_intro') }}
            </p>

            <ul>
                <li><strong>{{ __('messages.privacy.section5_access') }}</strong></li>
                <li><strong>{{ __('messages.privacy.section5_rectification') }}</strong></li>
                <li><strong>{{ __('messages.privacy.section5_erasure') }}</strong></li>
                <li><strong>{{ __('messages.privacy.section5_opposition') }}</strong></li>
                <li><strong>{{ __('messages.privacy.section5_portability') }}</strong></li>
            </ul>

            <p>
                {{ __('messages.privacy.section5_contact') }}
            </p>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Section 6 -->
    <div class="policy-section">
        <div class="section-number">6</div>
        <h2 class="section-title">{{ __('messages.privacy.section6_title') }}</h2>
        <div class="section-content">
            <p>
                {{ __('messages.privacy.section6_intro') }}
            </p>

            <ul>
                <li>{{ __('messages.privacy.section6_preferences') }}</li>
                <li>{{ __('messages.privacy.section6_analytics') }}</li>
                <li>{{ __('messages.privacy.section6_personalization') }}</li>
                <li>{{ __('messages.privacy.section6_checkout') }}</li>
            </ul>

            <p>
                {{ __('messages.privacy.section6_browser') }}
            </p>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Section 7 -->
    <div class="policy-section">
        <div class="section-number">7</div>
        <h2 class="section-title">{{ __('messages.privacy.section7_title') }}</h2>
        <div class="section-content">
            <p>
                {{ __('messages.privacy.section7_intro') }}
            </p>

            <ul>
                <li><strong>{{ __('messages.privacy.section7_order_data') }}</strong></li>
                <li><strong>{{ __('messages.privacy.section7_marketing_data') }}</strong></li>
                <li><strong>{{ __('messages.privacy.section7_navigation_data_retention') }}</strong></li>
            </ul>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Section 8 -->
    <div class="policy-section">
        <div class="section-number">8</div>
        <h2 class="section-title">{{ __('messages.privacy.section8_title') }}</h2>
        <div class="section-content">
            <p>
                {{ __('messages.privacy.section8_intro') }}
            </p>

            <div class="highlight-box">
                <p>
                    {{ __('messages.privacy.section8_acceptance') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-section">
        <h3 class="contact-title">{{ __('messages.privacy.contact_title') }}</h3>
        <p class="contact-text">
            {{ __('messages.privacy.contact_text') }}
        </p>
        <a href="mailto:clemencescarf@gmail.com" class="contact-email">
            clemencescarf@gmail.com
        </a>
    </div>
</div>
@endsection
