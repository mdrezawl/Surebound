@extends('layouts.app')

@section('title', 'Request a Custom Insurance Quote | Tampa, FL | Surebound')
@section('meta_description', 'Request a tailored insurance quote from Surebound Insurance in Tampa, FL. Compare rates across top carriers for home, auto, commercial liability, and business coverage.')

@section('content')

    <!-- ==========================================
         HERO SECTION
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/custom_quote_hero.jpg') }}" 
                alt="Request a Custom Insurance Quote" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'TAILORED COVERAGE' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Request a Custom Quote<br>Built Around You' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Tell us about your coverage requirements. Our licensed Tampa advisors compare options across leading carriers to build a customized policy proposal.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#quote-form" class="btn-primary-hero">
                        <span>Complete Quote Form &darr;</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <a href="tel:8132141731" class="btn-outline-hero">
                        <span>Call (813) 214-1731</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Floating Card -->
            <div class="hero-card-positioner">
                <div class="hero-floating-card">
                    <div class="hero-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">Multiple Carriers</span>
                        <span class="hero-card-label">Tailored Proposals</span>
                    </div>
                    <div class="hero-card-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         QUOTE REQUEST FORM SECTION
         ========================================== -->
    <section class="coverage-section" id="quote-form">
        <div class="container" style="max-width: 900px;">
            <p class="section-eyebrow" style="text-align: center;">ONLINE QUOTE REQUEST</p>
            <h2 class="section-title" style="text-align: center;">Tell Us What You Need Covered</h2>
            <p class="section-subtitle" style="text-align: center; margin-bottom: 32px;">Fill out this quick form and a licensed Tampa advisor will contact you with carrier options.</p>

            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 36px; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
                <!-- Status Message Banner -->
                <div id="quoteFormStatus" style="display: none; padding: 16px 20px; border-radius: 8px; margin-bottom: 24px; font-size: 14.5px; line-height: 1.5;"></div>

                <form id="customQuotePageForm" action="{{ route('quotes.store') }}" method="POST" onsubmit="handleCustomQuoteSubmit(event)">
                    @csrf
                    <input type="hidden" name="source_page" value="custom-quote">

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 14px; color: #1e293b; margin-bottom: 6px;">Full Name *</label>
                            <input type="text" name="name" required placeholder="Jane Doe" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; color: #0f172a;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 14px; color: #1e293b; margin-bottom: 6px;">Email Address *</label>
                            <input type="email" name="email" required placeholder="jane@example.com" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; color: #0f172a;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 14px; color: #1e293b; margin-bottom: 6px;">Phone Number *</label>
                            <input type="tel" name="phone" required placeholder="(813) 555-0123" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; color: #0f172a;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 14px; color: #1e293b; margin-bottom: 6px;">ZIP Code *</label>
                            <input type="text" name="zip" required placeholder="33602" maxlength="10" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; color: #0f172a;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 14px; color: #1e293b; margin-bottom: 6px;">Primary Coverage Needed *</label>
                            <select name="type" required style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; color: #0f172a; background: #fff;">
                                <option value="home">Homeowners Insurance</option>
                                <option value="auto">Auto Insurance</option>
                                <option value="bop">Business Owner Policy (BOP)</option>
                                <option value="general_liability">Commercial General Liability</option>
                                <option value="commercial_property">Commercial Property Insurance</option>
                                <option value="workers_comp">Workers' Compensation</option>
                                <option value="commercial_auto">Commercial Auto &amp; Fleet</option>
                                <option value="surety_bond">Surety Bond</option>
                                <option value="group_benefits">Group Employee Benefits</option>
                                <option value="life">Life Insurance</option>
                                <option value="health">Health Insurance</option>
                                <option value="umbrella">Personal Umbrella Liability</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 14px; color: #1e293b; margin-bottom: 6px;">Estimated Property / Limit</label>
                            <input type="text" name="coverage_amount" placeholder="e.g. $500,000 dwelling or $1M liability" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; color: #0f172a;">
                        </div>
                    </div>

                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 600; font-size: 14px; color: #1e293b; margin-bottom: 6px;">Additional Details or Current Carrier</label>
                        <textarea name="notes" rows="3" placeholder="Tell us about your home, vehicle, business operations, or current renewal date..." style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; color: #0f172a; resize: vertical;"></textarea>
                    </div>

                    <div style="margin-bottom: 24px; font-size: 13px; color: #64748b; line-height: 1.5;">
                        <label style="display: flex; align-items: flex-start; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="consent" id="quoteConsentCheck" style="margin-top: 3px;">
                            <span>I agree that Surebound Insurance may contact me via phone or email regarding this quote request in accordance with the <a href="{{ route('privacy') }}" target="_blank" style="color: #1e3a8a; text-decoration: underline;">Privacy Policy</a>.</span>
                        </label>
                    </div>

                    <button type="submit" id="quoteSubmitBtn" style="width: 100%; padding: 14px 20px; background-color: #1e3a8a; color: #ffffff; border: none; border-radius: 6px; font-size: 16px; font-weight: 700; cursor: pointer; transition: background 0.2s;">
                        Submit Quote Request &rarr;
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- ==========================================
         DARK NAVY VALUE PROPOSITION BAR
         ========================================== -->
    <section class="value-bar-section">
        <div class="container">
            <div class="value-bar-grid">
                <!-- 1 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Multiple Carriers</h3>
                    <p class="value-item-desc">We shop your coverage across leading national and regional Florida insurers.</p>
                </div>

                <!-- 2 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Bundle Discounts</h3>
                    <p class="value-item-desc">Unlock savings by bundling personal lines or combining commercial property and liability.</p>
                </div>

                <!-- 3 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Local Tampa Office</h3>
                    <p class="value-item-desc">Direct access to licensed advisors at 100 N Tampa St, Suite 2500.</p>
                </div>

                <!-- 4 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">No-Obligation Quotes</h3>
                    <p class="value-item-desc">Clear, objective policy comparisons with zero sales pressure.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         BOTTOM CTA BANNER
         ========================================== -->
    <section class="cta-banner-section">
        <div class="container">
            <div class="cta-text-wrap">
                <h2>Prefer to discuss your quote over the phone?</h2>
                <p>Call our licensed Tampa advisors directly at (813) 214-1731.</p>
            </div>
            <div class="cta-button-group">
                <a href="tel:8132141731" class="btn-cta-white">
                    <span>Call (813) 214-1731</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="{{ route('coverage') }}" class="btn-cta-transparent">
                    <span>Explore Coverages</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        function handleCustomQuoteSubmit(event) {
            event.preventDefault();
            const form = document.getElementById('customQuotePageForm');
            const statusDiv = document.getElementById('quoteFormStatus');
            const submitBtn = document.getElementById('quoteSubmitBtn');
            const consent = document.getElementById('quoteConsentCheck');

            if (consent && !consent.checked) {
                statusDiv.style.display = 'block';
                statusDiv.style.backgroundColor = '#fef2f2';
                statusDiv.style.border = '1px solid #f87171';
                statusDiv.style.color = '#991b1b';
                statusDiv.innerHTML = '<strong>Consent required:</strong> Please confirm you agree to be contacted regarding this quote request.';
                return;
            }

            const formData = new FormData(form);
            const payload = Object.fromEntries(formData.entries());

            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting Quote Request...';
            statusDiv.style.display = 'none';

            fetch('{{ route("quotes.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json().then(data => ({ status: res.status, ok: res.ok, data: data })))
            .then(res => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Quote Request \u2192';

                if (res.ok && res.data.success) {
                    statusDiv.style.display = 'block';
                    statusDiv.style.backgroundColor = '#f0fdf4';
                    statusDiv.style.border = '1px solid #86efac';
                    statusDiv.style.color = '#166534';
                    statusDiv.innerHTML = `<strong>Quote Request Received!</strong> Ref: <strong>${res.data.quote_ref || res.data.quote_id || 'Submitted'}</strong>. A licensed Tampa advisor is reviewing your request and will follow up with carrier options.`;
                    form.reset();

                    if (typeof gtag === 'function') {
                        gtag('event', 'generate_lead', {
                            event_category: 'engagement',
                            event_label: payload.type || 'custom_quote'
                        });
                    }
                } else {
                    statusDiv.style.display = 'block';
                    statusDiv.style.backgroundColor = '#fef2f2';
                    statusDiv.style.border = '1px solid #f87171';
                    statusDiv.style.color = '#991b1b';
                    statusDiv.innerHTML = `<strong>Error submitting request:</strong> ${res.data.message || 'Please check your inputs and try again, or call us at (813) 214-1731.'}`;
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Quote Request \u2192';
                statusDiv.style.display = 'block';
                statusDiv.style.backgroundColor = '#fef2f2';
                statusDiv.style.border = '1px solid #f87171';
                statusDiv.style.color = '#991b1b';
                statusDiv.innerHTML = '<strong>Connection Error:</strong> Could not reach the server. Please call our Tampa office directly at <a href="tel:8132141731" style="color: #991b1b; text-decoration: underline;">(813) 214-1731</a>.';
            });
        }
    </script>
@endsection
