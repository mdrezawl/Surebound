@extends('layouts.app')

@section('title', 'Our Story – Independent Insurance Agency | Tampa, FL | Surebound')
@section('meta_description', 'Learn about Surebound Insurance: an independent insurance agency founded in Tampa, FL built on client advocacy, carrier choice, and dependable service.')

@section('content')

    <!-- ==========================================
         HERO SECTION (DYNAMIC CMS)
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/story_hero.jpg') }}" 
                alt="Surebound Insurance Story and Mission" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'OUR STORY &amp; PURPOSE' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Insurance Rooted in<br>Client Advocacy &amp; Integrity' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Surebound Insurance was established in Tampa, FL to deliver independent, client-first insurance advice without compromise. We protect the homes, families, and businesses that make our community thrive.' }}
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('team') }}" class="btn-primary-hero">
                        <span>Meet Our Team</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('coverage') }}" class="btn-outline-hero">
                        <span>Explore Coverage</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Floating Card positioned over the photo in the container -->
            <div class="hero-card-positioner">
                <div class="hero-floating-card">
                    <div class="hero-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">{{ $content['hero_card_sub'] ?? 'Independent Agency' }}</span>
                        <span class="hero-card-label">{{ $content['hero_card_label'] ?? 'Client-first advocacy' }}</span>
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
         CORE VALUES (6 CARDS)
         ========================================== -->
    <section class="coverage-section" id="values">
        <div class="container">
            <p class="section-eyebrow">OUR PRINCIPLES</p>
            <h2 class="section-title">The Foundation of Our Agency</h2>
            <p class="section-subtitle">How we operate every day to ensure policyholders receive clear, honest, and dependable coverage.</p>

            <div class="coverage-cards-grid">
                <!-- 1 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_1_title'] ?? 'Independent Client Advocacy' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_1_desc'] ?? 'We represent you, not a single insurance company. We shop multiple carriers to find policies matching your requirements and budget.' }}</p>
                    </div>
                </div>

                <!-- 2 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_2_title'] ?? 'Florida Insurance Specialization' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_2_desc'] ?? 'Florida’s insurance climate requires local market expertise. We understand wind mitigation credits, hurricane deductibles, and flood zones.' }}</p>
                    </div>
                </div>

                <!-- 3 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_3_title'] ?? 'Transparent Communication' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_3_desc'] ?? 'No confusing jargon or hidden fine print. We break down policy limits, exclusions, and endorsements in plain English.' }}</p>
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
                        <h3 class="coverage-card-title">{{ $content['card_4_title'] ?? 'Comprehensive Portfolio Approach' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_4_desc'] ?? 'From your home and personal vehicles to your business liability and employee benefits, we coordinate total protection.' }}</p>
                    </div>
                </div>

                <!-- 5 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_5_title'] ?? 'Claims Support Advocacy' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_5_desc'] ?? 'When disaster strikes, we don’t disappear. We act as your advocate to ensure your carrier handles your loss promptly and fairly.' }}</p>
                    </div>
                </div>

                <!-- 6 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_6_title'] ?? 'Local Community Dedication' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_6_desc'] ?? 'Headquartered in downtown Tampa, we live and work in the communities we protect, supporting regional business growth.' }}</p>
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
                    <h3 class="value-item-title">{{ $content['value_1_title'] ?? 'Carrier Independence' }}</h3>
                    <p class="value-item-desc">{{ $content['value_1_desc'] ?? 'Access to top-rated national and regional insurers for objective coverage comparison.' }}</p>
                </div>

                <!-- 2 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_2_title'] ?? 'Tampa Presence' }}</h3>
                    <p class="value-item-desc">{{ $content['value_2_desc'] ?? 'Located in downtown Tampa at 100 N Tampa St, accessible for in-person consultations.' }}</p>
                </div>

                <!-- 3 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_3_title'] ?? 'Licensed Advisors' }}</h3>
                    <p class="value-item-desc">{{ $content['value_3_desc'] ?? 'Experienced insurance professionals credentialed across personal and commercial lines.' }}</p>
                </div>

                <!-- 4 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_4_title'] ?? 'Client-First Culture' }}</h3>
                    <p class="value-item-desc">{{ $content['value_4_desc'] ?? 'We focus on long-term relationship building, annual policy reviews, and proactive risk advice.' }}</p>
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
                <div class="simpler-image-frame simpler-image-frame-founder">
                    <picture>
                        <source srcset="{{ asset('images/karry-founder-v2.webp') }}?v={{ file_exists(public_path('images/karry-founder-v2.webp')) ? filemtime(public_path('images/karry-founder-v2.webp')) : time() }}" type="image/webp">
                        <img 
                            src="{{ asset('images/karry-founder-v2.jpg') }}?v={{ file_exists(public_path('images/karry-founder-v2.jpg')) ? filemtime(public_path('images/karry-founder-v2.jpg')) : time() }}" 
                            alt="Karry, Founder of Surebound Insurance" 
                            class="simpler-image"
                            width="472"
                            height="541"
                            loading="lazy"
                        >
                    </picture>
                </div>

                <div class="simpler-content">
                    <p class="simpler-eyebrow">OUR COMMITMENT</p>
                    <h2 class="simpler-title">Why Independent Matters</h2>
                    <p class="simpler-paragraph">
                        Captive insurance agencies are bound to a single insurance brand, offering only the products that company provides. Surebound operates differently: as an independent agency, our loyalties belong to our clients. We scan the market, benchmark premiums, and match your unique property and business profiles with carriers that offer stable coverage and competitive rates.
                    </p>
                    <a href="{{ route('coverage') }}" class="btn-learn-more">
                        <span>Explore Our Coverages</span>
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
                <h2>Ready to experience insurance built around you?</h2>
                <p>Connect with our Tampa team to review your current policies and discover better coverage options.</p>
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
