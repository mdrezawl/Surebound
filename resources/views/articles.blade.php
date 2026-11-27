@extends('layouts.app')

@section('title', 'Insurance Articles & Insights | Tampa, FL | Surebound')
@section('meta_description', 'Read helpful insurance articles and practical insights for Florida homeowners, drivers, and business owners from Surebound Insurance in Tampa, FL.')

@section('content')

    <!-- ==========================================
         HERO SECTION
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/articles_hero.jpg') }}" 
                alt="Insurance Articles and Resources" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'INSIGHTS &amp; EDUCATION' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Florida Insurance Articles<br>&amp; Practical Insights' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Clear, straightforward guidance to help you navigate Florida insurance requirements, understand coverage options, and protect what matters most.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#article-directory" class="btn-primary-hero">
                        <span>Browse Articles &darr;</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <a href="{{ route('guides') }}" class="btn-outline-hero">
                        <span>View Buyer Guides</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">Resource Hub</span>
                        <span class="hero-card-label">Florida Risk Insights</span>
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
         ARTICLES DIRECTORY GRID
         ========================================== -->
    <section class="coverage-section" id="article-directory">
        <div class="container">
            <p class="section-eyebrow">PUBLISHED INSIGHTS</p>
            <h2 class="section-title">Featured Insurance Articles</h2>
            <p class="section-subtitle">Practical advice from our licensed advisors on managing risk in Florida.</p>

            <div class="coverage-cards-grid">
                <!-- Article 1 -->
                <div class="coverage-card" style="cursor: pointer;" onclick="openQuoteModal('Commercial Property')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6h1.5m-1.5 3h1.5m-1.5 3h1.5M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                        </div>
                        <p style="font-size: 11px; font-weight: 700; color: #1e3a8a; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 6px;">COMMERCIAL PROPERTY</p>
                        <h3 class="coverage-card-title">{{ $content['card_1_title'] ?? 'Florida Commercial Property Deductibles & Wind Mitigation Credits' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_1_desc'] ?? 'Learn how percentage-based named-storm deductibles function for commercial buildings under Florida law and how certified wind mitigation inspections lower premiums.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- Article 2 -->
                <div class="coverage-card" style="cursor: pointer;" onclick="openQuoteModal('Business Owner Policy')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <p style="font-size: 11px; font-weight: 700; color: #1e3a8a; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 6px;">COMMERCIAL LINES</p>
                        <h3 class="coverage-card-title">{{ $content['card_2_title'] ?? 'What is a Business Owner Policy (BOP)?' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_2_desc'] ?? 'Understand how combining general liability and commercial property into a bundled BOP protects small businesses and reduces premium costs.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- Article 3 -->
                <div class="coverage-card" style="cursor: pointer;" onclick="openQuoteModal('General Liability')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <p style="font-size: 11px; font-weight: 700; color: #1e3a8a; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 6px;">LIABILITY</p>
                        <h3 class="coverage-card-title">{{ $content['card_3_title'] ?? 'Commercial General Liability: How Much Coverage Do You Need?' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_3_desc'] ?? 'A breakdown of $1M/$2M standard liability limits, landlord lease requirements, and when excess commercial liability is critical.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- Article 4 -->
                <div class="coverage-card" style="cursor: pointer;" onclick="openQuoteModal('Workers Compensation')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <p style="font-size: 11px; font-weight: 700; color: #1e3a8a; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 6px;">COMPLIANCE</p>
                        <h3 class="coverage-card-title">{{ $content['card_4_title'] ?? 'Florida Workers\' Comp Law: Employer Requirements Under Statute 440' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_4_desc'] ?? 'Employee thresholds for construction vs. non-construction businesses, corporate exemptions (DWC-250), and penalties.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- Article 5 -->
                <div class="coverage-card" style="cursor: pointer;" onclick="openQuoteModal('Life Insurance')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <p style="font-size: 11px; font-weight: 700; color: #1e3a8a; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 6px;">BUSINESS &amp; LIFE</p>
                        <h3 class="coverage-card-title">{{ $content['card_5_title'] ?? 'Key-Person & Commercial Life Insurance in Florida' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_5_desc'] ?? 'Why commercial lenders and partners require key-person life insurance, how buy-sell agreements are funded, and term vs permanent life coverage.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- Article 6 -->
                <div class="coverage-card" style="cursor: pointer;" onclick="openQuoteModal('Commercial Auto')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <p style="font-size: 11px; font-weight: 700; color: #1e3a8a; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 6px;">AUTO &amp; FLEET</p>
                        <h3 class="coverage-card-title">{{ $content['card_6_title'] ?? 'Commercial Auto vs. Personal Auto: Protecting Business Driving' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_6_desc'] ?? 'When personal auto policies deny business driving claims, and how hired &amp; non-owned auto (HNOA) closes liability risks.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
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
                    <h3 class="value-item-title">{{ $content['value_1_title'] ?? 'Florida-Focused Knowledge' }}</h3>
                    <p class="value-item-desc">{{ $content['value_1_desc'] ?? 'Educational insights addressing specific state regulations, building codes, and weather perils.' }}</p>
                </div>

                <!-- 2 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_2_title'] ?? 'Plain English Explanations' }}</h3>
                    <p class="value-item-desc">{{ $content['value_2_desc'] ?? 'No complex legalese. Clear guidance so you understand exactly what is covered and what is excluded.' }}</p>
                </div>

                <!-- 3 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_3_title'] ?? 'Licensed Contributor Team' }}</h3>
                    <p class="value-item-desc">{{ $content['value_3_desc'] ?? 'Authored and reviewed by licensed Florida insurance agents and risk specialists.' }}</p>
                </div>

                <!-- 4 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_4_title'] ?? 'Direct Advisor Access' }}</h3>
                    <p class="value-item-desc">{{ $content['value_4_desc'] ?? 'Have questions about an article topic? Contact our Tampa advisors directly at (813) 214-1731.' }}</p>
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
                            alt="Surebound insurance advisors providing educational consultations in Tampa" 
                            class="simpler-image"
                            loading="lazy"
                        >
                    </picture>
                </div>

                <div class="simpler-content">
                    <p class="simpler-eyebrow">INSURANCE GUIDANCE</p>
                    <h2 class="simpler-title">Knowledge That Protects You</h2>
                    <p class="simpler-paragraph">
                        Insurance should never be a mystery until a claim happens. Our articles and guides are written to empower Tampa individuals, families, and business owners with the actionable facts needed to protect their livelihood.
                    </p>
                    <a href="{{ route('guides') }}" class="btn-learn-more">
                        <span>Explore Buyer Guides</span>
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
                <h2>Have questions about your insurance coverage?</h2>
                <p>Call our licensed Tampa advisors directly at (813) 214-1731 or request a personalized quote.</p>
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
