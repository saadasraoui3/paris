@extends('layouts.app')

@section('content')
<style>

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
        max-width: 1200px;
        margin: 0 auto;
        padding: 4rem 3rem;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        margin-bottom: 4rem;
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
    }

    .info-section {
        background: linear-gradient(135deg, var(--bg-cream) 0%, #f5f1ea 100%);
        padding: 2rem;
        border-radius: 8px;
        border-left: 4px solid var(--accent-color);
    }

    .info-icon {
        font-size: 2rem;
        margin-bottom: 0.8rem;
    }

    .info-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.3rem;
        font-weight: 400;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .info-content {
        color: var(--text-light);
        line-height: 1.8;
    }

    .info-content a {
        color: var(--accent-color);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .info-content a:hover {
        text-decoration: underline;
    }

    /* .social-icons {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 2px solid var(--accent-color);
        background: white;
        color: var(--accent-color);
        cursor: pointer;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .social-btn:hover {
        background: linear-gradient(135deg, var(--accent-color), #d4a574);
        color: white;
        border-color: transparent;
        transform: translateY(-3px);
    } */

    .contact-form {
        background: white;
        padding: 2.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 0.8rem;
        letter-spacing: 0.5px;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        color: var(--primary-color);
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(201, 168, 124, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .submit-btn {
        width: 100%;
        padding: 1.2rem;
        background: linear-gradient(135deg, var(--accent-color), #d4a574);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(201, 168, 124, 0.3);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .privacy-checkbox {
        margin-bottom: 1.5rem;
    }

    .privacy-checkbox label {
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: var(--text-light);
        line-height: 1.5;
        cursor: pointer;
    }

    .privacy-checkbox input[type="checkbox"] {
        margin-top: 0.2rem;
        min-width: 16px;
        height: 16px;
        accent-color: var(--accent-color);
    }

    .privacy-checkbox a {
        color: var(--accent-color);
        text-decoration: none;
        font-weight: 500;
    }

    .privacy-checkbox a:hover {
        text-decoration: underline;
    }

    .map-section {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        height: 400px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 3rem;
    }

    .map-section iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .response-message {
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1.5rem;
        display: none;
    }

    .response-message.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        display: block;
    }

    .response-message.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        display: block;
    }

    @media (max-width: 968px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .page-title {
            font-size: 2rem;
        }

        .container {
            padding: 2rem 1.5rem;
        }

        .map-section {
            height: 300px;
        }
    }
</style>

<div class="page-hero">
    <div class="container">
        <h1 class="page-title">{{ __('messages.contact.title') }}</h1>
        <p class="page-subtitle">{{ __('messages.contact.subtitle') }}</p>
    </div>
</div>

<div class="container">
    <!-- Contact Information and Form -->
    <div class="contact-grid">
        <!-- Contact Information -->
        <div class="contact-info">
            <div class="info-section">
                {{-- <div class="info-icon">📍</div> --}}
                <h3 class="info-title">{{ __('messages.contact.address') }}</h3>
                <div class="info-content">
                    Clemence Paris<br>
                    44 rue Ahmed Sebbagh<br>
                    Derb sultan, Casablanca<br>
                    Maroc
                </div>
            </div>

            <div class="info-section">
                {{-- <div class="info-icon">📞</div> --}}
                <h3 class="info-title">{{ __('messages.contact.phone') }}</h3>
                <div class="info-content">
                    <a href="tel:+212123456789">+212 (0) 698 591 475</a><br>
                    <small>Lundi - Samedi : 8h - 18h (GMT+1)</small>
                </div>
            </div>

            <div class="info-section">
                {{-- <div class="info-icon">📧</div> --}}
                <h3 class="info-title">{{ __('messages.contact.email') }}</h3>
                <div class="info-content">
                    <a href="mailto:clemencescarf@gmail.com">clemencescarf@gmail.com</a><br>
                    <a href="mailto:bennaneanas05@gmail.com">bennaneanas05@gmail.com</a>
                </div>
            </div>

            <div class="info-section">
                {{-- <div class="info-icon">⏰</div> --}}
                <h3 class="info-title">{{ __('messages.contact.hours') }}</h3>
                <div class="info-content">
                    <strong>Lundi - Samedi :</strong> 8h00 - 18h00<br>
                    <strong>Vendredi :</strong> 8h00 - 12h00<br>
                    <strong>Dimanche :</strong> Fermé
                </div>
            </div>

            <div class="info-section">
                {{-- <div class="info-icon">💬</div> --}}
                <h3 class="info-title">{{ __('messages.contact.social_media') }}</h3>
                <div class="info-content">
                    {{ __('messages.contact.social_description') }}
                </div><br>
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
        </div>

        <!-- Contact Form -->
        <div>
            @if(session('success'))
    <div class="response-message success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="response-message error">
        {{ $errors->first() }}
    </div>
@endif

            <form class="contact-form" method="POST" action="{{ route('contact.send') }}" id="contactForm">
                @csrf
                <div class="response-message" id="responseMessage"></div>

                <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 1.8rem; color: var(--primary-color); margin-bottom: 2rem;">{{ __('messages.contact.form_title') }}</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">{{ __('messages.contact.first_name') }}</label>
                        <input type="text" class="form-input" name="first_name" required placeholder="{{ __('messages.contact.first_name_placeholder') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ __('messages.contact.last_name') }}</label>
                        <input type="text" class="form-input" name="last_name" required placeholder="{{ __('messages.contact.last_name_placeholder') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('messages.contact.email') }}</label>
                    <input type="email" class="form-input" name="email" required placeholder="{{ __('messages.contact.email_placeholder') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('messages.contact.phone_optional') }}</label>
                    <input type="tel" class="form-input" name="phone" placeholder="{{ __('messages.contact.phone_placeholder') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('messages.contact.subject') }}</label>
                    <input type="text" class="form-input" name="subject" required placeholder="{{ __('messages.contact.subject_placeholder') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('messages.contact.message') }}</label>
                    <textarea class="form-textarea" name="message" required placeholder="{{ __('messages.contact.message_placeholder') }}"></textarea>
                </div>

                <div class="privacy-checkbox">
                    <label>
                        <input type="checkbox" name="privacy_policy" required>
                        <span>{{ __('messages.contact.privacy_policy_text') }} <a href="{{ route('privacy') }}" target="_blank">{{ __('messages.contact.privacy_policy_link') }}</a></span>
                    </label>
                </div>

                <button type="submit" class="submit-btn">{{ __('messages.contact.send_button') }}</button>
            </form>
        </div>
    </div>

    <!-- Map -->
    <div class="map-section">
        <iframe src="https://www.google.com/maps?q=33.5738627,-7.5974602&hl=fr&z=16&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>



@endsection
