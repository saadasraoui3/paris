@extends('layouts.app')

@section('content')
<style>
    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 3rem 5rem;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 450px;
        gap: 3rem;
    }

    .checkout-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 400;
        letter-spacing: 1px;
        color: var(--primary-color);
        margin-bottom: 2rem;
    }

    .checkout-section {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        letter-spacing: 0.5px;
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-label {
        display: block;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: 'Montserrat', sans-serif;
        color: var(--primary-color);
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(201, 168, 124, 0.1);
    }

    .form-input::placeholder {
        color: #999;
    }

    textarea.form-input {
        min-height: 100px;
        resize: vertical;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .radio-group {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .radio-option {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 1rem;
        border: 2px solid #e5e5e5;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .radio-option:hover {
        border-color: var(--accent-color);
        background-color: #fafafa;
    }

    .radio-option input[type="radio"] {
        cursor: pointer;
        width: 18px;
        height: 18px;
        accent-color: var(--accent-color);
    }

    .radio-option.selected {
        border-color: var(--accent-color);
        background-color: var(--bg-cream);
    }

    .shipping-info {
        flex: 1;
    }

    .shipping-name {
        font-weight: 500;
        margin-bottom: 0.3rem;
    }

    .shipping-price {
        font-size: 0.9rem;
        color: var(--accent-color);
        font-weight: 600;
    }

    /* Order Summary */
    .order-summary {
        position: sticky;
        top: 120px;
    }

    .summary-card {
        background: var(--bg-cream);
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 2rem;
    }

    .summary-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem;
        font-weight: 400;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }

    .order-item {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e5e5e5;
    }

    .order-item:last-of-type {
        border-bottom: none;
    }

    .item-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #e5e5e5;
        flex-shrink: 0;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 500;
        font-size: 0.95rem;
        margin-bottom: 0.3rem;
    }

    .item-meta {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 0.3rem;
    }

    .item-price {
        color: var(--accent-color);
        font-weight: 600;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.8rem 0;
        font-size: 0.95rem;
    }

    .summary-label {
        color: #666;
    }

    .summary-value {
        font-weight: 500;
        color: var(--primary-color);
    }

    .summary-divider {
        border-top: 2px solid #e5e5e5;
        margin: 1rem 0;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
    }

    .total-label {
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--primary-color);
    }

    .total-value {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--accent-color);
    }

    .checkout-features {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e5e5;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 0.8rem;
        font-size: 0.85rem;
        color: #666;
    }

    .feature-icon {
        color: var(--accent-color);
    }

    .submit-btn {
        width: 100%;
        background-color: var(--accent-color);
        color: white;
        border: none;
        padding: 1.2rem 2rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1.5rem;
    }

    .submit-btn:hover {
        background-color: #b89568;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 168, 124, 0.3);
    }

    .payment-note {
        text-align: center;
        font-size: 0.85rem;
        color: #666;
        margin-top: 1rem;
    }

    @media (max-width: 968px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }

        .order-summary {
            position: static;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .checkout-container {
            padding: 2rem 1.5rem 3rem;
        }

        .checkout-section {
            padding: 1.5rem;
        }
    }
</style>

<div class="checkout-container">
    <h1 class="checkout-title">{{ __('messages.checkout.title') }}</h1>

    <div class="checkout-grid">
        <!-- Left Column: Checkout Form -->
        <div>
            <form method="POST" action="{{ route('checkout.store') }}" id="checkoutForm">
                @csrf

                <!-- Contact Information -->
                <div class="checkout-section">
                    <h2 class="section-title">{{ __('messages.checkout.contact_information') }}</h2>

                    <div class="form-group">
                        <label class="form-label">{{ __('messages.checkout.email_address') }}</label>
                        <input
                            type="email"
                            name="email"
                            class="form-input"
                            placeholder="{{ __('messages.checkout.email_placeholder') }}"
                            required
                        >
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="checkout-section">
                    <h2 class="section-title">{{ __('messages.checkout.shipping_address') }}</h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">{{ __('messages.checkout.full_name') }}</label>
                            <input
                                type="text"
                                name="full_name"
                                class="form-input"
                                placeholder="{{ __('messages.checkout.full_name_placeholder') }}"
                                required
                            >
                        </div>
                        <div class="form-group">
                        <label class="form-label">{{ __('messages.checkout.phone') }}</label>
                        <input
                            type="tel"
                            name="phone"
                            class="form-input"
                            placeholder="{{ __('messages.checkout.phone_placeholder') }}"
                            required
                        >
                    </div>

                        {{-- <div class="form-group">
                            <label class="form-label">Last name</label>
                            <input
                                type="text"
                                name="last_name"
                                class="form-input"
                                placeholder="Nom"
                                required
                            >
                        </div> --}}
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('messages.checkout.address') }}</label>
                        <input
                            type="text"
                            name="shipping_address"
                            class="form-input"
                            placeholder="{{ __('messages.checkout.address_placeholder') }}"
                            required
                        >
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">{{ __('messages.checkout.city') }}</label>
                            <input
                                type="text"
                                name="city"
                                class="form-input"
                                placeholder="{{ __('messages.checkout.city_placeholder') }}"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('messages.checkout.zip_code') }}</label>
                            <input
                                type="text"
                                name="postal_code"
                                class="form-input"
                                placeholder="{{ __('messages.checkout.zip_code_placeholder') }}"
                                required
                            >
                        </div>
                    </div>


                </div>

                <!-- Shipping Method -->
                {{-- <div class="checkout-section">
                    <h2 class="section-title">{{ __('messages.checkout.shipping_method') }}</h2>

                    <div class="radio-group">
                        <label class="radio-option selected">
                            <input
                                type="radio"
                                name="shipping_method"
                                value="standard"
                                checked
                            >
                            <div class="shipping-info">
                                <div class="shipping-name">{{ __('messages.checkout.standard_shipping') }}</div>
                                <div class="shipping-price">{{ __('messages.checkout.standard_shipping_info') }}</div>
                            </div>
                        </label>

                        <label class="radio-option">
                            <input
                                type="radio"
                                name="shipping_method"
                                value="express"
                            >
                            <div class="shipping-info">
                                <div class="shipping-name">{{ __('messages.checkout.express_shipping') }}</div>
                                <div class="shipping-price">{{ __('messages.checkout.express_shipping_info') }}</div>
                            </div>
                        </label>
                    </div>
                </div> --}}

                <!-- Order Notes -->
                <div class="checkout-section">
                    <h2 class="section-title">{{ __('messages.checkout.order_notes') }}</h2>

                    <div class="form-group">
                        <textarea
                            name="note"
                            class="form-input"
                            placeholder="{{ __('messages.checkout.order_notes_placeholder') }}"
                        ></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="order-summary">
            <div class="summary-card">
                <h2 class="summary-title">{{ __('messages.checkout.order_summary') }}</h2>

                @php $total = 0; @endphp

                <!-- Order Items -->
                @foreach($cart->items as $item)
                    @php
                        $subtotal = $item->price * $item->quantity;
                        $total += $subtotal;

                        $image = $item->image_path;
                    @endphp

                    <div class="order-item">
                        @if($image)
                            <img
                                src="{{ asset('storage/'.$image) }}"
                                alt="{{ $item->display_name }}"
                                class="item-image"
                            >
                        @else
                            <div class="item-image" style="background: #f0f0f0;"></div>
                        @endif

                        <div class="item-details">
                            <div class="item-name">{{ $item->display_name }}</div>
                            <div class="item-meta">
                                {{ $item->color_label }} × {{ $item->quantity }}
                            </div>
                            <div class="item-price">
                                {{ number_format($subtotal, 2) }} DH
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Summary Calculations -->
                <div style="margin-top: 1.5rem;">
                    <div class="summary-row">
                        <span class="summary-label">{{ __('messages.checkout.subtotal') }}</span>
                        <span class="summary-value">{{ number_format($total, 2) }} DH</span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">{{ __('messages.checkout.shipping') }}</span>
                        <span class="summary-value shipping-cost">Gratuit</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-total">
                        <span class="total-label">{{ __('messages.checkout.total') }}</span>
                        <span class="total-value total-amount">{{ number_format($total, 2) }} DH</span>
                    </div>
                </div>

                <!-- Place Order Button -->
                <button type="submit" form="checkoutForm" class="submit-btn">
                    {{ __('messages.checkout.confirm_order') }}
                </button>

                <p class="payment-note">
                    {{ __('messages.checkout.payment_note') }}
                </p>

                <!-- Features -->
                <div class="checkout-features">
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>{{ __('messages.checkout.secure_checkout') }}</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>{{ __('messages.checkout.free_shipping_over') }}</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>{{ __('messages.checkout.return_policy') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle radio option selection visual
    const radioOptions = document.querySelectorAll('.radio-option');
    const shippingRadios = document.querySelectorAll('input[name="shipping_method"]');
    const shippingCostEl = document.querySelector('.shipping-cost');
    const totalAmountEl = document.querySelector('.total-amount');

    const baseTotal = {{ $total }};
    const expressShippingCost = 50.00;

    radioOptions.forEach(option => {
        option.addEventListener('click', function() {
            radioOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            this.querySelector('input[type="radio"]').checked = true;
        });
    });

    // Update shipping cost and total
    shippingRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'express') {
                shippingCostEl.textContent = expressShippingCost.toFixed(2) + ' DH';
                totalAmountEl.textContent = (baseTotal + expressShippingCost).toFixed(2) + ' DH';
            } else {
                shippingCostEl.textContent = '{{ __('messages.checkout.free_shipping') }}';
                totalAmountEl.textContent = baseTotal.toFixed(2) + ' DH';
            }
        });
    });
});
</script>
@endsection
