@extends('layouts.app')

@section('content')
<style>
    .page-hero {
        background: linear-gradient(135deg, var(--bg-cream) 0%, #f5f1ea 100%);
        padding: 4rem 0;
        text-align: center;
        border-bottom: 1px solid #e5e5e5;
    }

    .page-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem;
        font-weight: 300;
        letter-spacing: 2px;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: var(--text-light);
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 4rem 3rem;
    }

    .faq-categories {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 3rem;
    }

    .category-btn {
        padding: 0.8rem 1.5rem;
        border: 2px solid #e5e5e5;
        background: white;
        color: var(--primary-color);
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .category-btn:hover,
    .category-btn.active {
        border-color: var(--accent-color);
        color: white;
        background: linear-gradient(135deg, var(--accent-color), #d4a574);
    }

    .faq-item {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .faq-question {
        padding: 1.5rem;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, var(--white) 0%, var(--bg-cream) 100%);
        transition: all 0.3s ease;
        font-weight: 600;
        color: var(--primary-color);
    }

    .faq-question:hover {
        background: linear-gradient(135deg, var(--bg-cream) 0%, #f5f1ea 100%);
    }

    .faq-toggle {
        width: 30px;
        height: 30px;
        background: linear-gradient(135deg, var(--accent-color), #d4a574);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .faq-item.active .faq-toggle {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease;
        background: white;
    }

    .faq-item.active .faq-answer {
        max-height: 500px;
    }

    .faq-answer-content {
        padding: 1.5rem;
        color: var(--text-light);
        line-height: 1.8;
        border-top: 1px solid #f0f0f0;
    }

    .faq-answer-content strong {
        color: var(--primary-color);
    }

    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 400;
        letter-spacing: 1px;
        color: var(--primary-color);
        margin: 2.5rem 0 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--accent-color);
    }

    .section-title:first-of-type {
        margin-top: 0;
    }

    .contact-cta {
        background: linear-gradient(135deg, rgba(201, 168, 124, 0.1) 0%, rgba(212, 165, 116, 0.1) 100%);
        padding: 2rem;
        border-radius: 8px;
        text-align: center;
        margin-top: 3rem;
    }

    .contact-cta h3 {
        color: var(--primary-color);
        margin-bottom: 1rem;
        font-size: 1.3rem;
    }

    .contact-cta p {
        color: var(--text-light);
        margin-bottom: 1.5rem;
    }

    .contact-btn {
        display: inline-block;
        padding: 1rem 2.5rem;
        background: linear-gradient(135deg, var(--accent-color), #d4a574);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 500;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .contact-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(201, 168, 124, 0.3);
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .container {
            padding: 2rem 1.5rem;
        }

        .faq-categories {
            grid-template-columns: repeat(2, 1fr);
        }

        .section-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="page-hero">
    <div class="container">
        <h1 class="page-title">{{ __('messages.faq.title') }}</h1>
        <p class="page-subtitle">{{ __('messages.faq.subtitle') }}</p>
    </div>
</div>

<div class="container">
    <!-- Products Section -->
    <h2 class="section-title">{{ __('messages.faq.products_title') }}</h2>

    <div class="faq-item">
        <div class="faq-question">
            <span>{{ __('messages.faq.silk_type_question') }}</span>
            <div class="faq-toggle">+</div>
        </div>
        <div class="faq-answer">
            <div class="faq-answer-content">
                {!! __('messages.faq.silk_type_answer') !!}
            </div>
        </div>
    </div>

    {{-- <div class="faq-item">
        <div class="faq-question">
            <span>Tous les foulards sont-ils faits main ?</span>
            <div class="faq-toggle">+</div>
        </div>
        <div class="faq-answer">
            <div class="faq-answer-content">
                Oui, chaque foulard Clemence Paris est <strong>entièrement fabriqué à la main</strong> par nos artisans marocains qualifiés. Nous respectons les techniques traditionnelles transmises de génération en génération. Cela garantit une qualité exceptionnelle et l'unicité de chaque pièce.
            </div>
        </div>
    </div> --}}

    <div class="faq-item">
        <div class="faq-question">
            <span>{{ __('messages.faq.care_question') }}</span>
            <div class="faq-toggle">+</div>
        </div>
        <div class="faq-answer">
            <div class="faq-answer-content">
                {!! __('messages.faq.care_answer') !!}
            </div>
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">
            <span>{{ __('messages.faq.limited_patterns_question') }}</span>
            <div class="faq-toggle">+</div>
        </div>
        <div class="faq-answer">
            <div class="faq-answer-content">
                {!! __('messages.faq.limited_patterns_answer') !!}
            </div>
        </div>
    </div>

    <!-- Shipping & Returns Section -->
    <h2 class="section-title">{{ __('messages.faq.shipping_title') }}</h2>

    <div class="faq-item">
        <div class="faq-question">
            <span>{{ __('messages.faq.delivery_time_question') }}</span>
            <div class="faq-toggle">+</div>
        </div>
        <div class="faq-answer">
            <div class="faq-answer-content">
                {!! __('messages.faq.delivery_time_answer') !!}
            </div>
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">
            <span>{{ __('messages.faq.shipping_cost_question') }}</span>
            <div class="faq-toggle">+</div>
        </div>
        <div class="faq-answer">
            <div class="faq-answer-content">
                {!! __('messages.faq.shipping_cost_answer') !!}
            </div>
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">
            <span>{{ __('messages.faq.return_policy_question') }}</span>
            <div class="faq-toggle">+</div>
        </div>
        <div class="faq-answer">
            <div class="faq-answer-content">
                {!! __('messages.faq.return_policy_answer') !!}
            </div>
        </div>
    </div>

    <!-- Payment Section -->
    <h2 class="section-title">{{ __('messages.faq.payment_title') }}</h2>

    <div class="faq-item">
        <div class="faq-question">
            <span>{{ __('messages.faq.payment_methods_question') }}</span>
            <div class="faq-toggle">+</div>
        </div>
        <div class="faq-answer">
            <div class="faq-answer-content">
                {!! __('messages.faq.payment_methods_answer') !!}
            </div>
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">
            <span>{{ __('messages.faq.security_question') }}</span>
            <div class="faq-toggle">+</div>
        </div>
        <div class="faq-answer">
            <div class="faq-answer-content">
                {!! __('messages.faq.security_answer') !!}
            </div>
        </div>
    </div>

    <!-- Contact CTA -->
    <div class="contact-cta">
        <h3>{{ __('messages.faq.contact_cta_title') }}</h3>
        <p>{{ __('messages.faq.contact_cta_text') }}</p>
        <a href="{{ route('contact') }}" class="contact-btn">{{ __('messages.faq.contact_cta_button') }}</a>
    </div>
</div>

<script>
    document.querySelectorAll('.faq-item').forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            // Close other items
            document.querySelectorAll('.faq-item').forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            // Toggle current item
            item.classList.toggle('active');
        });
    });
</script>

@endsection
