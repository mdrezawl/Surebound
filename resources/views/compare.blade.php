@extends('layouts.app')

@section('title', 'Compare Insurance Policies – Coverage Comparison Guide | Surebound')
@section('meta_description', 'Compare insurance policy types, replacement cost vs ACV, named perils vs all-risk, deductibles, and endorsement options with Surebound Insurance in Tampa, FL.')

@section('content')

    <!-- ==========================================
         HERO SECTION
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/compare_hero.jpg') }}" 
                alt="Compare Insurance Policies" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'POLICY COMPARISON GUIDE' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Compare Policies &amp;<br>Coverage Options Clearly' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Understanding how insurance policies differ in limits, deductibles, and valuations is key to choosing the right protection. Review our comparison guide or request a side-by-side policy review.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#comparison-guide" class="btn-primary-hero">
                        <span>Compare Key Features &darr;</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <a href="javascript:void(0)" onclick="openQuoteModal()" class="btn-outline-hero">
                        <span>Request Side-by-Side Quote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Floating Card -->
            <div class="hero-card-positioner">
                <div class="hero-floating-card">
                    <div class="hero-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52v12.25c0 .668-.426 1.258-1.063 1.464-1.282.416-2.61.684-3.937.806m-6-14.52c-1.01.143-2.01.317-3 .52m3-.52v12.25c0 .668.426 1.258 1.063 1.464 1.282.416 2.61.684 3.937.806" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">Policy Review</span>
                        <span class="hero-card-label">Side-by-side analysis</span>
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
         POLICY COMPARISON DIMENSIONS (6 CARDS)
         ========================================== -->
    <section class="coverage-section" id="comparison-guide">
        <div class="container">
            <p class="section-eyebrow">EVALUATION METRICS</p>
            <h2 class="section-title">Critical Differences Across Insurance Policies</h2>
            <p class="section-subtitle">Evaluating these six factors ensures you choose coverage that performs when a claim occurs.</p>

            <div class="coverage-cards-grid">
                <!-- 1 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Replacement Cost vs. ACV</h3>
                        <p class="coverage-card-desc"><strong>Replacement Cost (RCV)</strong> pays to rebuild or replace property at current prices without depreciation. <strong>Actual Cash Value (ACV)</strong> subtracts depreciation, leaving you with out-of-pocket gaps.</p>
                    </div>
                </div>

                <!-- 2 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Named Perils vs. All-Risk (Open)</h3>
                        <p class="coverage-card-desc"><strong>Named perils</strong> policies cover only disasters explicitly listed (e.g. fire, wind). <strong>Open perils (All-Risk)</strong> policies cover all direct physical losses unless explicitly excluded.</p>
                    </div>
                </div>

                <!-- 3 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Deductible Structures</h3>
                        <p class="coverage-card-desc">Compare standard <strong>flat dollar deductibles</strong> ($500 - $2,500) against Florida <strong>percentage hurricane deductibles</strong> (2%, 3%, 5% of insured value) to avoid unexpected out-of-pocket costs.</p>
                    </div>
                </div>

                <!-- 4 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Occurrence vs. Aggregate Limits</h3>
                        <p class="coverage-card-desc"><strong>Per-occurrence limits</strong> represent the maximum paid for a single claim. <strong>Aggregate limits</strong> cap total payouts across all claims during the policy year.</p>
                    </div>
                </div>

                <!-- 5 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Endorsements &amp; Exclusions</h3>
                        <p class="coverage-card-desc">Standard policies exclude rising flood waters, earth movement, and sewer backup. Review optional riders to close these common Florida coverage gaps.</p>
                    </div>
                </div>

                <!-- 6 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Package (BOP/Bundle) Discounts</h3>
                        <p class="coverage-card-desc">Packaging multiple policies with a single insurer (e.g. Home + Auto, or Property + Liability in a BOP) provides lower rates and eliminates carrier coverage disputes.</p>
                    </div>
                </div>
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
                    <h3 class="value-item-title">Objective Comparison</h3>
                    <p class="value-item-desc">We evaluate carrier terms side-by-side to find the most favorable language for your risk profile.</p>
                </div>

                <!-- 2 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Price vs. Protection</h3>
                    <p class="value-item-desc">We show you where low premiums sacrifice essential coverage so you make informed choices.</p>
                </div>

                <!-- 3 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Florida Specifics</h3>
                    <p class="value-item-desc">Navigating wind mitigation inspection discounts and flood requirements across Tampa Bay.</p>
                </div>

                <!-- 4 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Annual Benchmarking</h3>
                    <p class="value-item-desc">We review your policy renewals annually to verify your rates remain competitive in Florida's market.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SIMPLER SECTION / GUIDANCE
         ========================================== -->
    <section class="simpler-section">
        <div class="container">
            <div class="simpler-grid">
                <div class="simpler-image-frame">
                    <picture>
                        <source srcset="{{ asset('images/advisor-meeting.webp') }}" type="image/webp">
                        <img 
                            src="{{ asset('images/advisor-meeting.png') }}" 
                            alt="Surebound insurance advisors reviewing policy terms in Tampa" 
                            class="simpler-image"
                            loading="lazy"
                        >
                    </picture>
                </div>

                <div class="simpler-content">
                    <p class="simpler-eyebrow">EXPERT REVIEW</p>
                    <h2 class="simpler-title">Free Policy Audit by a Licensed Advisor</h2>
                    <p class="simpler-paragraph">
                        Unsure whether your current policy has adequate limits or contains hidden exclusions? Bring your declarations page to our Tampa office or upload it securely. We will conduct a comprehensive audit identifying gaps, overpayments, and opportunities for discounts.
                    </p>
                    <a href="{{ route('custom-quote') }}" class="btn-learn-more">
                        <span>Request Policy Audit</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
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
                <h2>Want a side-by-side comparison of your coverage?</h2>
                <p>Call our Tampa advisory team at (813) 214-1731 or request a personalized proposal.</p>
            </div>
            <div class="cta-button-group">
                <a href="javascript:void(0)" onclick="openQuoteModal()" class="btn-cta-white">
                    <span>Request a Quote</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="tel:8132141731" class="btn-cta-transparent">
                    <span>Call (813) 214-1731</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

@endsection
