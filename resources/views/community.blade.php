@extends('layouts.app')

@section('title', 'Community Engagement – Tampa Bay Giving Back | Surebound')
@section('meta_description', 'Discover how Surebound Insurance supports the Tampa Bay community through disaster preparedness, local business partnerships, and community initiatives.')

@section('content')

    <!-- ==========================================
         HERO SECTION
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/community_hero.jpg') }}" 
                alt="Community Engagement at Surebound Insurance" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'COMMUNITY &amp; OUTREACH' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Rooted in Tampa Bay,<br>Committed to Our Neighbors' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Surebound Insurance is proud to call Tampa home. We believe an agency’s responsibility extends beyond insurance policies into active community service, storm preparedness education, and local small business support.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#initiatives" class="btn-primary-hero">
                        <span>Our Initiatives &darr;</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}" class="btn-outline-hero">
                        <span>Get in Touch</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">Tampa Bay</span>
                        <span class="hero-card-label">Community First</span>
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
         COMMUNITY INITIATIVES (4 CARDS)
         ========================================== -->
    <section class="coverage-section" id="initiatives">
        <div class="container">
            <p class="section-eyebrow">OUR COMMITMENTS</p>
            <h2 class="section-title">How We Support Tampa Bay</h2>
            <p class="section-subtitle">Real programs and community involvement across Hillsborough and Pinellas counties.</p>

            <div class="coverage-cards-grid">
                <!-- 1 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_1_title'] ?? 'Hurricane Preparedness Workshops' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_1_desc'] ?? 'Free annual workshops and digital guides helping Tampa Bay residents protect property, understand wind mitigation, and prepare disaster supply kits before hurricane season.' }}</p>
                    </div>
                </div>

                <!-- 2 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_2_title'] ?? 'Small Business Advisory & Mentorship' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_2_desc'] ?? 'Partnering with local Tampa entrepreneurs, contractor associations, and retail startups to provide complimentary risk reviews and lease liability guidance.' }}</p>
                    </div>
                </div>

                <!-- 3 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_3_title'] ?? 'First-Time Homebuyer Education' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_3_desc'] ?? 'Educational sessions with local real estate professionals explaining escrow requirements, flood insurance zones, and 4-point inspection criteria.' }}</p>
                    </div>
                </div>

                <!-- 4 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_4_title'] ?? 'Emergency Relief & Supply Drives' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_4_desc'] ?? 'Organizing local donation collections and volunteer support for Tampa Bay community food banks and storm recovery efforts.' }}</p>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_1_title'] ?? 'Local Downtown Presence' }}</h3>
                    <p class="value-item-desc">{{ $content['value_1_desc'] ?? 'Headquartered at 100 N Tampa St, actively involved in local civic and business organizations.' }}</p>
                </div>

                <!-- 2 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_2_title'] ?? 'Storm Preparedness' }}</h3>
                    <p class="value-item-desc">{{ $content['value_2_desc'] ?? 'Providing practical checklists and storm mitigation resources before hurricane season begins.' }}</p>
                </div>

                <!-- 3 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_3_title'] ?? 'Small Business Advocacy' }}</h3>
                    <p class="value-item-desc">{{ $content['value_3_desc'] ?? 'Helping local Tampa startups and tradespeople navigate insurance and bonding requirements.' }}</p>
                </div>

                <!-- 4 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_4_title'] ?? 'Neighbor-to-Neighbor' }}</h3>
                    <p class="value-item-desc">{{ $content['value_4_desc'] ?? 'We live, raise families, and work right here in the Tampa Bay community.' }}</p>
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
                            alt="Surebound insurance team meeting with Tampa community partners" 
                            class="simpler-image"
                            loading="lazy"
                        >
                    </picture>
                </div>

                <div class="simpler-content">
                    <p class="simpler-eyebrow">COMMUNITY PARTNERSHIPS</p>
                    <h2 class="simpler-title">Partner with Surebound</h2>
                    <p class="simpler-paragraph">
                        Are you a local Tampa nonprofit, neighborhood association, or chamber of commerce interested in collaborating on educational workshops or community relief drives? We welcome the opportunity to partner with organizations working to keep Tampa strong.
                    </p>
                    <a href="{{ route('contact') }}" class="btn-learn-more">
                        <span>Connect with Our Team</span>
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
                <h2>Want to learn more about our agency?</h2>
                <p>Call our Tampa office directly at (813) 214-1731 or visit us in downtown Tampa.</p>
            </div>
            <div class="cta-button-group">
                <a href="{{ route('contact') }}" class="btn-cta-white">
                    <span>Contact Us</span>
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
