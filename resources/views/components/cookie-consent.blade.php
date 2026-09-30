{{-- Cookie Consent Banner Component --}}
{{-- Place this in: resources/views/components/cookie-consent.blade.php --}}

<style>
    .cookie-consent-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 9998;
    }

    .cookie-consent-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .cookie-consent-banner {
        position: fixed;
        bottom: -100%;
        left: 50%;
        transform: translateX(-50%);
        max-width: 600px;
        width: calc(100% - 2rem);
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        padding: 2rem;
        z-index: 9999;
        transition: bottom 0.4s ease;
    }

    .cookie-consent-banner.show {
        bottom: 2rem;
    }

    .cookie-icon {
        font-size: 3rem;
        text-align: center;
        margin-bottom: 1rem;
    }

    .cookie-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 500;
        color: var(--primary-color);
        text-align: center;
        margin-bottom: 1rem;
    }

    .cookie-description {
        color: #666;
        line-height: 1.8;
        font-size: 0.95rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .cookie-description a {
        color: var(--accent-color);
        text-decoration: underline;
        transition: color 0.3s ease;
    }

    .cookie-description a:hover {
        color: #b89568;
    }

    .cookie-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .cookie-btn {
        padding: 0.9rem 2rem;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        font-family: 'Montserrat', sans-serif;
    }

    .cookie-btn-accept {
        background-color: var(--accent-color);
        color: white;
        flex: 1;
    }

    .cookie-btn-accept:hover {
        background-color: #b89568;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 168, 124, 0.3);
    }

    .cookie-btn-decline {
        background-color: white;
        color: var(--primary-color);
        border: 1px solid #e5e5e5;
        flex: 1;
    }

    .cookie-btn-decline:hover {
        border-color: var(--primary-color);
        background-color: #fafafa;
    }

    .cookie-btn-settings {
        background-color: white;
        color: var(--accent-color);
        border: 1px solid var(--accent-color);
        padding: 0.9rem 1.5rem;
    }

    .cookie-btn-settings:hover {
        background-color: var(--bg-cream);
    }

    /* Cookie Settings Modal */
    .cookie-settings-modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.9);
        max-width: 600px;
        width: calc(100% - 2rem);
        max-height: 80vh;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        padding: 2rem;
        z-index: 10000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        overflow-y: auto;
    }

    .cookie-settings-modal.show {
        opacity: 1;
        visibility: visible;
        transform: translate(-50%, -50%) scale(1);
    }

    .cookie-settings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e5e5;
    }

    .cookie-settings-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 500;
        color: var(--primary-color);
    }

    .close-modal-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #666;
        cursor: pointer;
        transition: color 0.3s ease;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-modal-btn:hover {
        color: var(--accent-color);
    }

    .cookie-category {
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        background-color: #fafafa;
        border-radius: 8px;
        border: 1px solid #e5e5e5;
    }

    .cookie-category-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
    }

    .cookie-category-title {
        font-weight: 600;
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    .cookie-category-description {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .cookie-toggle {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }

    .cookie-toggle input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.3s;
        border-radius: 26px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.3s;
        border-radius: 50%;
    }

    input:checked + .toggle-slider {
        background-color: var(--accent-color);
    }

    input:checked + .toggle-slider:before {
        transform: translateX(24px);
    }

    input:disabled + .toggle-slider {
        background-color: #b89568;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .required-badge {
        display: inline-block;
        background-color: var(--accent-color);
        color: white;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.7rem;
        margin-left: 0.5rem;
        font-weight: 500;
    }

    .modal-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e5e5;
    }

    /* @media (max-width: 640px) {
        .cookie-consent-banner {
            bottom: 0;
            border-radius: 16px 16px 0 0;
            max-width: 100%;
            width: 100%;
        }

        .cookie-consent-banner.show {
            bottom: 0;
        }

        .cookie-buttons {
            flex-direction: column;
        }

        .cookie-settings-modal {
            max-width: 100%;
            width: 100%;
            border-radius: 16px 16px 0 0;
            top: auto;
            bottom: 0;
            transform: translate(-50%, 100%);
            max-height: 90vh;
        }

        .cookie-settings-modal.show {
            transform: translate(-50%, 0);
        }
    } */
</style>

<!-- Cookie Consent Banner -->
<div class="cookie-consent-overlay" id="cookieOverlay"></div>

<div class="cookie-consent-banner" id="cookieBanner">
    <div class="cookie-icon">🍪</div>
    <h3 class="cookie-title">Nous utilisons des cookies</h3>
    <p class="cookie-description">
        Nous utilisons des cookies pour améliorer votre expérience de navigation, analyser le trafic du site
        et personnaliser le contenu. En cliquant sur "Accepter tout", vous consentez à notre utilisation des cookies.
        <a href="/privacy-policy">En savoir plus</a>
    </p>
    <div class="cookie-buttons">
        <button class="cookie-btn cookie-btn-decline" onclick="cookieConsent.decline()">
            Refuser
        </button>
        {{-- <button class="cookie-btn cookie-btn-settings" onclick="cookieConsent.showSettings()">
            Personnaliser
        </button> --}}
        <button class="cookie-btn cookie-btn-accept" onclick="cookieConsent.acceptAll()">
            Accepter tout
        </button>
    </div>
</div>

<!-- Cookie Settings Modal -->
<div class="cookie-settings-modal" id="cookieSettingsModal">
    <div class="cookie-settings-header">
        <h3 class="cookie-settings-title">Paramètres des cookies</h3>
        <button class="close-modal-btn" onclick="cookieConsent.hideSettings()">✕</button>
    </div>

    <div class="cookie-category">
        <div class="cookie-category-header">
            <div>
                <span class="cookie-category-title">Cookies nécessaires</span>
                <span class="required-badge">Requis</span>
            </div>
            <label class="cookie-toggle">
                <input type="checkbox" checked disabled>
                <span class="toggle-slider"></span>
            </label>
        </div>
        <p class="cookie-category-description">
            Ces cookies sont essentiels au fonctionnement du site et ne peuvent pas être désactivés.
            Ils sont nécessaires pour la navigation, la sécurité et l'accès aux fonctionnalités de base.
        </p>
    </div>

    <div class="cookie-category">
        <div class="cookie-category-header">
            <span class="cookie-category-title">Cookies analytiques</span>
            <label class="cookie-toggle">
                <input type="checkbox" id="analyticsToggle">
                <span class="toggle-slider"></span>
            </label>
        </div>
        <p class="cookie-category-description">
            Ces cookies nous permettent de comprendre comment les visiteurs interagissent avec notre site
            en collectant des informations anonymes sur les pages visitées et le comportement de navigation.
        </p>
    </div>

    <div class="cookie-category">
        <div class="cookie-category-header">
            <span class="cookie-category-title">Cookies marketing</span>
            <label class="cookie-toggle">
                <input type="checkbox" id="marketingToggle">
                <span class="toggle-slider"></span>
            </label>
        </div>
        <p class="cookie-category-description">
            Ces cookies sont utilisés pour personnaliser les publicités que vous voyez et mesurer
            l'efficacité de nos campagnes marketing.
        </p>
    </div>

    <div class="cookie-category">
        <div class="cookie-category-header">
            <span class="cookie-category-title">Cookies de préférence</span>
            <label class="cookie-toggle">
                <input type="checkbox" id="preferenceToggle">
                <span class="toggle-slider"></span>
            </label>
        </div>
        <p class="cookie-category-description">
            Ces cookies permettent au site de mémoriser vos préférences (langue, région, etc.)
            pour offrir une expérience personnalisée.
        </p>
    </div>

    <div class="modal-actions">
        <button class="cookie-btn cookie-btn-decline" onclick="cookieConsent.savePreferences()">
            Enregistrer les préférences
        </button>
        <button class="cookie-btn cookie-btn-accept" onclick="cookieConsent.acceptAll()">
            Accepter tout
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    if (window.cookieConsentInitialized) return;
    window.cookieConsentInitialized = true;

    const cookieConsent = {

        init() {
            const consent = this.getConsent();

            if (!consent) {
                setTimeout(() => this.showBanner(), 500);
            } else {
                this.applyConsent(consent);
                this.hideBanner(); // 🔥 مهم باش مايبقاش يبان
            }

            const overlay = document.getElementById('cookieOverlay');
            if (overlay) {
                overlay.addEventListener('click', () => {
                    this.hideSettings();
                });
            }
        },

        showBanner() {
            document.getElementById('cookieBanner')?.classList.add('show');
            document.getElementById('cookieOverlay')?.classList.add('active');
        },

        hideBanner() {
            document.getElementById('cookieBanner')?.classList.remove('show');
            document.getElementById('cookieOverlay')?.classList.remove('active');
        },

        showSettings() {
            document.getElementById('cookieSettingsModal')?.classList.add('show');
            document.getElementById('cookieOverlay')?.classList.add('active');
            this.loadPreferences();
        },

        hideSettings() {
            document.getElementById('cookieSettingsModal')?.classList.remove('show');
        },

        acceptAll() {
            const consent = {
                necessary: true,
                analytics: true,
                marketing: true,
                preference: true,
                timestamp: Date.now()
            };

            this.saveConsent(consent);
            this.applyConsent(consent);
            this.hideBanner();
            this.hideSettings();
        },

        decline() {
            const consent = {
                necessary: true,
                analytics: false,
                marketing: false,
                preference: false,
                timestamp: Date.now()
            };

            this.saveConsent(consent);
            this.applyConsent(consent);
            this.hideBanner();
        },

        savePreferences() {
            const consent = {
                necessary: true,
                analytics: document.getElementById('analyticsToggle')?.checked ?? false,
                marketing: document.getElementById('marketingToggle')?.checked ?? false,
                preference: document.getElementById('preferenceToggle')?.checked ?? false,
                timestamp: Date.now()
            };

            this.saveConsent(consent);
            this.applyConsent(consent);
            this.hideBanner();
            this.hideSettings();
        },

        loadPreferences() {
            const consent = this.getConsent();
            if (!consent) return;

            document.getElementById('analyticsToggle').checked = consent.analytics;
            document.getElementById('marketingToggle').checked = consent.marketing;
            document.getElementById('preferenceToggle').checked = consent.preference;
        },

        saveConsent(consent) {
            localStorage.setItem('cookieConsent', JSON.stringify(consent));
            // ❌ حذفنا fetch باش مايبقاش 404
        },

        getConsent() {
            try {
                return JSON.parse(localStorage.getItem('cookieConsent'));
            } catch {
                return null;
            }
        },

        applyConsent(consent) {

            if (typeof gtag === 'function') {
                gtag('consent', 'update', {
                    analytics_storage: consent.analytics ? 'granted' : 'denied',
                    ad_storage: consent.marketing ? 'granted' : 'denied'
                });
            }

            console.log('Cookie consent applied:', consent);
        }
    };

    window.cookieConsent = cookieConsent;
    cookieConsent.init();
});
</script>
