@extends('layouts.app')

@section('content')
<style>
    .about-hero {
        position: relative;
        height: 400px;
        background: linear-gradient(135deg, var(--bg-cream) 0%, #f5f1ea 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect fill="%23c9a87c" opacity="0.05" width="100" height="100"/></svg>');
        opacity: 0.3;
    }

    .about-hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        padding: 2rem;
    }

    .about-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3.5rem;
        font-weight: 300;
        letter-spacing: 2px;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .about-hero-subtitle {
        font-size: 1.2rem;
        color: var(--accent-color);
        font-weight: 500;
        letter-spacing: 1px;
    }

    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 5rem 3rem;
    }

    .about-section {
        margin-bottom: 5rem;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1rem;
        color: var(--accent-color);
        font-weight: 500;
        letter-spacing: 2px;
        margin-bottom: 0.5rem;
    }

    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        font-weight: 400;
        letter-spacing: 1px;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .section-divider {
        width: 60px;
        height: 2px;
        background-color: var(--accent-color);
        margin: 1.5rem auto;
    }

    .story-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .story-image {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    .story-image img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }

    .story-text {
        line-height: 1.9;
        color: #666;
        font-size: 1.05rem;
    }

    .story-text p {
        margin-bottom: 1.5rem;
    }

    .story-text strong {
        color: var(--primary-color);
        font-weight: 600;
    }

    .highlight-text {
        color: var(--accent-color);
        font-style: italic;
        font-size: 1.15rem;
        margin: 2rem 0;
        padding-left: 2rem;
        border-left: 3px solid var(--accent-color);
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2.5rem;
        margin-top: 3rem;
    }

    .value-card {
        text-align: center;
        padding: 2.5rem 2rem;
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border-color: var(--accent-color);
    }

    .value-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
    }

    .value-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem;
        font-weight: 500;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .value-description {
        color: #666;
        line-height: 1.8;
        font-size: 0.95rem;
    }

    .stats-section {
        background: var(--bg-cream);
        padding: 4rem 3rem;
        border-radius: 12px;
        margin: 4rem 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3.5rem;
        font-weight: 600;
        color: var(--accent-color);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #666;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .quality-section {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        color: white;
        padding: 5rem 3rem;
        margin: 5rem 0;
        border-radius: 12px;
    }

    .quality-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .quality-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        font-weight: 400;
        margin-bottom: 2rem;
        color: var(--accent-color);
    }

    .quality-text {
        line-height: 1.9;
        font-size: 1.05rem;
        opacity: 0.9;
    }

    .materials-list {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 2.5rem;
        flex-wrap: wrap;
    }

    .material-tag {
        padding: 0.8rem 1.5rem;
        background: rgba(201, 168, 124, 0.2);
        border: 1px solid var(--accent-color);
        border-radius: 30px;
        font-size: 0.9rem;
        color: var(--accent-color);
        font-weight: 500;
    }

    .cta-section {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--bg-cream);
        border-radius: 12px;
    }

    .cta-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        font-weight: 400;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }

    .cta-text {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-button {
        display: inline-block;
        background-color: var(--accent-color);
        color: white;
        padding: 1.2rem 3rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        font-size: 1rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }

    .cta-button:hover {
        background-color: #b89568;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(201, 168, 124, 0.3);
    }

    @media (max-width: 968px) {
        .about-hero-title {
            font-size: 2.5rem;
        }

        .story-content {
            grid-template-columns: 1fr;
        }

        .values-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .about-container {
            padding: 3rem 1.5rem;
        }

        .about-hero {
            height: 300px;
        }

        .about-hero-title {
            font-size: 2rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .materials-list {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<!-- Hero Section -->
<div class="about-hero">
    <div class="about-hero-content">
        <h1 class="about-hero-title">Clémence Paris</h1>
        <p class="about-hero-subtitle">{{ __('messages.front.about.hero_subtitle') }}</p>

    </div>
</div>

<div class="about-container">
    <!-- Notre Histoire -->
    <div class="about-section">
        <div class="section-header">
            <div class="section-number">01</div>
            <h2 class="section-title">{{ __('messages.front.about.story_title') }}</h2>
            <div class="section-divider"></div>
        </div>

        <div class="story-content">
            <div class="story-image">
                <img src="{{ asset('storage/images/propos.jpeg') }}" alt="Clémence Paris Histoire">
            </div>

            <div class="story-text">
                    {!! __('messages.front.about.story_paragraph1') !!}

                    {!! __('messages.front.about.story_paragraph2') !!}

                <div class="highlight-text">
                    "{{ __('messages.front.about.story_quote') }}"
                </div>

                    {!! __('messages.front.about.story_paragraph3') !!}
            </div>
        </div>
    </div>

    <!-- Stats -->
    {{-- <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">30+</div>
                <div class="stat-label">Années d'expérience</div>
            </div> 
            <div class="stat-item">
                <div class="stat-number">1000+</div>
                <div class="stat-label">Clients satisfaits</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">500+</div>
                <div class="stat-label">Modèles disponibles</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100%</div>
                <div class="stat-label">Qualité garantie</div>
            </div>
        </div>
    </div> --}}

    <!-- Nos Valeurs -->
    <div class="about-section">
        <div class="section-header">
            <div class="section-number">02</div>
            <h2 class="section-title">{{ __('messages.front.about.values_title') }}</h2>
            <div class="section-divider"></div>
        </div>

        <div class="values-grid">
            <div class="value-card">
                {{-- <div class="value-icon">✨</div> --}}
                <h3 class="value-title">{{ __('messages.front.about.excellence_title') }}</h3>
                <p class="value-description">
                    {{ __('messages.front.about.excellence_description') }}
                </p>
            </div>

            <div class="value-card">
                {{-- <div class="value-icon">🎨</div> --}}
                <h3 class="value-title">{{ __('messages.front.about.creativity_title') }}</h3>
                <p class="value-description">
                    {{ __('messages.front.about.creativity_description') }}
                </p>
            </div>

            <div class="value-card">
                {{-- <div class="value-icon">🤝</div> --}}
                <h3 class="value-title">{{ __('messages.front.about.confiance_title') }}</h3>
                <p class="value-description">
                    {{ __('messages.front.about.confiance_description') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Qualité & Matières -->
    <div class="quality-section">
        <div class="quality-content">
            <h2 class="quality-title">{{ __('messages.front.about.quality_title') }}</h2>
            <p class="quality-text">
                {{ __('messages.front.about.quality_text') }}
            </p>

            <div class="materials-list">
                <span class="material-tag">{{ __('messages.front.about.cotton_premium') }}</span>
                <span class="material-tag">{{ __('messages.front.about.viscose_fine') }}</span>
                <span class="material-tag">{{ __('messages.front.about.laine_noble') }}</span>
                <span class="material-tag">{{ __('messages.front.about.melanges_exclusifs') }}</span>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="cta-section">
        <h2 class="cta-title">{{ __('messages.front.about.cta_title') }}</h2>
        <p class="cta-text">
            {{ __('messages.front.about.cta_text') }}
        </p>
        <a href="{{ route('shop.index') }}" class="cta-button">
            {{ __('messages.front.about.cta_button') }}
        </a>
    </div>
</div>
@endsection
