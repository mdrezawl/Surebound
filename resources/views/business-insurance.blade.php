@extends('layouts.app')

@section('title', 'Business Insurance – Commercial Property, Liability & BOP Solutions | Surebound')

@section('content')

    <!-- ==========================================
         HERO SECTION (DYNAMIC CMS REPLICA FOR BUSINESS INSURANCE)
         ========================================== -->
    <section class="hero-section">
        <!-- Right side full bleed photo with seamless alpha mask & right royal blue gradient -->
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/hero-business.jpg') }}" 
                alt="Comprehensive Business & Commercial Insurance Solutions" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'COMMERCIAL &amp; ENTERPRISE PROTECTION' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Securing Your Business,<br>Employees &amp; Future Growth' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Customized commercial insurance policies engineered for small businesses, growing enterprises, and established corporations. Protect your revenue, property, and staff with dependable underwriting.' }}
                </p>
                <div class="hero-buttons">
                    <a href="javascript:void(0)" onclick="openQuoteModal('Business Insurance')" class="btn-primary-hero">
                        <span>Get a Commercial Quote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="#coverage-options" class="btn-outline-hero">
                        <span>Explore Business Lines</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">{{ $content['hero_card_sub'] ?? 'Commercial BOP Savings' }}</span>
                        <span class="hero-card-label">{{ $content['hero_card_label'] ?? 'Save up to 30% bundled commercial plans' }}</span>
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
         BUSINESS COVERAGE OPTIONS SECTION (6 CARDS)
         ========================================== -->
    <section class="coverage-section" id="coverage-options">
        <div class="container">
            <p class="section-eyebrow">COMMERCIAL RISK SOLUTIONS</p>
            <h2 class="section-title">Complete Coverage for Every Enterprise</h2>
            <p class="section-subtitle">Tailored commercial policies designed to safeguard your financial health, physical location, equipment, and workforce.</p>

            <div class="coverage-cards-grid">
                <!-- 1. Commercial General Liability -->
                <div class="coverage-card" onclick="openQuoteModal('Business Insurance')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.285Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_1_title'] ?? 'Commercial General Liability' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_1_desc'] ?? 'Defends against third-party bodily injury, property damage, slip-and-fall claims, and advertising liability lawsuits.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 2. Commercial Property & Building -->
                <div class="coverage-card" onclick="openQuoteModal('Business Insurance')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_2_title'] ?? 'Commercial Property & Structure' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_2_desc'] ?? 'Protects owned or leased business buildings, office furniture, machinery, inventory, and specialized equipment from fire and storm damage.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 3. Business Interruption & Loss of Income -->
                <div class="coverage-card" onclick="openQuoteModal('Business Insurance')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_3_title'] ?? 'Business Interruption & Income' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_3_desc'] ?? 'Replaces lost operating income and covers ongoing payroll, rent, and expenses if covered damage temporarily shuts down operations.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 4. Workers\' Compensation -->
                <div class="coverage-card" onclick="openQuoteModal('Business Insurance')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_4_title'] ?? 'Workers\' Compensation' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_4_desc'] ?? 'Covers employee medical bills, rehabilitation costs, and lost wage benefits for workplace injuries or occupational illnesses.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 5. Professional Liability / E&O -->
                <div class="coverage-card" onclick="openQuoteModal('Business Insurance')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_5_title'] ?? 'Professional Liability (E&amp;O)' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_5_desc'] ?? 'Shields consultants, technology providers, accountants, and advisors against professional negligence or error claims.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 6. Commercial Auto & Fleet -->
                <div class="coverage-card" onclick="openQuoteModal('Business Insurance')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_6_title'] ?? 'Commercial Auto &amp; Fleet' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_6_desc'] ?? 'Comprehensive physical damage and liability protection for company vehicles, delivery vans, trucks, and executive fleets.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         DARK NAVY VALUE PROPOSITION BAR (4 COMMERCIAL PILLARS)
         ========================================== -->
    <section class="value-bar-section">
        <div class="container">
            <div class="value-bar-grid">
                <!-- 1. Customized BOP Bundles -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.285Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_1_title'] ?? 'Custom BOP Bundles' }}</h3>
                    <p class="value-item-desc">{{ $content['value_1_desc'] ?? 'Combine property and general liability into one cost-effective Business Owner Package.' }}</p>
                </div>

                <!-- 2. Fast COI Issuance -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_2_title'] ?? 'Instant COI Issuance' }}</h3>
                    <p class="value-item-desc">{{ $content['value_2_desc'] ?? 'Download Certificates of Insurance in under 15 minutes to satisfy landlord and client contracts.' }}</p>
                </div>

                <!-- 3. Industry-Specific Risk Assessment -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_3_title'] ?? 'Tailored Risk Mapping' }}</h3>
                    <p class="value-item-desc">{{ $content['value_3_desc'] ?? 'Customized policy terms built specifically for retail, manufacturing, tech, and service sectors.' }}</p>
                </div>

                <!-- 4. Dedicated Commercial Claims -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_4_title'] ?? '24/7 Commercial Support' }}</h3>
                    <p class="value-item-desc">{{ $content['value_4_desc'] ?? 'Dedicated business claims team providing rapid emergency funds and business continuity guidance.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         COMMERCIAL RISK MANAGEMENT MADE SIMPLER
         ========================================== -->
    <section class="simpler-section">
        <div class="container">
            <div class="simpler-grid">
                <!-- Left: Corporate boardroom photo -->
                <div class="simpler-image-frame">
                    <img 
                        src="{{ asset('images/article-business-hires.jpg') }}" 
                        alt="Commercial business insurance consultation by Surebound risk officers" 
                        class="simpler-image"
                    >
                </div>

                <!-- Right: Content -->
                <div class="simpler-content">
                    <p class="simpler-eyebrow">{!! $content['guidance_eyebrow'] ?? 'COMMERCIAL GUIDANCE &amp; GROWTH' !!}</p>
                    <h2 class="simpler-title">{!! $content['guidance_title'] ?? 'Commercial Risk Protection Built for Modern Enterprises' !!}</h2>
                    <p class="simpler-paragraph">
                        {{ $content['guidance_text'] ?? 'Navigating commercial insurance shouldn\'t take hours away from growing your business. Surebound simplifies policy underwriting, calculating your precise exposure to property damage, liability suits, and operational delays so you get maximum coverage without overpaying.' }}
                    </p>
                    <a href="javascript:void(0)" onclick="openQuoteModal('Business Insurance')" class="btn-learn-more">
                        <span>Speak with a Commercial Advisor</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         WHY CHOOSE SUREBOUND FOR BUSINESS INSURANCE
         ========================================== -->
    <section class="why-section">
        <div class="container">
            <p class="section-eyebrow">THE SUREBOUND ADVANTAGE</p>
            <h2 class="section-title">Why Business Owners Choose Surebound</h2>

            <div class="why-grid">
                <!-- 1 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_1_title'] ?? 'Fast Digital COI' }}</h3>
                    <p class="why-card-desc">{{ $content['why_1_desc'] ?? 'Generate and email Certificates of Insurance instantly to clients and landlords.' }}</p>
                </div>

                <!-- 2 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_2_title'] ?? 'Scalable BOP Bundles' }}</h3>
                    <p class="why-card-desc">{{ $content['why_2_desc'] ?? 'Seamlessly add coverage lines as your headcount, revenue, and physical footprint expand.' }}</p>
                </div>

                <!-- 3 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.285Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_3_title'] ?? 'Payroll & Audit Support' }}</h3>
                    <p class="why-card-desc">{{ $content['why_3_desc'] ?? 'Integrated workers\' comp reporting aligned with pay-as-you-go payroll systems.' }}</p>
                </div>

                <!-- 4 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_4_title'] ?? 'Commercial Claims Officers' }}</h3>
                    <p class="why-card-desc">{{ $content['why_4_desc'] ?? 'Dedicated business adjusters committed to minimizing operational downtime during a claim.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION)
         ========================================== -->
    <section class="faq-section" id="faqs">
        <div class="container faq-container">
            <p class="section-eyebrow" style="text-align: center;">GOT QUESTIONS?</p>
            <h2 class="section-title" style="text-align: center;">Business Insurance FAQ</h2>
            <p class="section-subtitle" style="text-align: center;">Clear answers about commercial general liability, business owner policies (BOP), workers' comp, and certificates of insurance.</p>

            <div class="faq-accordion">
                <!-- Q1 -->
                <div class="faq-item active">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_1_question'] ?? 'What is a Business Owner Policy (BOP) and why is it recommended?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_1_answer'] ?? 'A Business Owner Policy (BOP) bundles Commercial General Liability and Commercial Property insurance into a single discounted package. It protects small-to-medium businesses against third-party injury claims, property damage, and loss of operating income at a lower cost than buying separate policies.' }}
                    </div>
                </div>

                <!-- Q2 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_2_question'] ?? 'How fast can I get a Certificate of Insurance (COI) for my clients?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_2_answer'] ?? 'With Surebound, Certificates of Insurance (COIs) can be issued digitally in under 15 minutes through our client portal, allowing you to secure new contracts and landlord leases without delay.' }}
                    </div>
                </div>

                <!-- Q3 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_3_question'] ?? 'Is Workers\' Compensation insurance required for my business?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_3_answer'] ?? 'In most states, Workers\' Compensation is legally mandatory as soon as you hire your first employee. It pays for medical bills, disability benefits, and vocational rehabilitation if an employee suffers a workplace injury.' }}
                    </div>
                </div>

                <!-- Q4 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_4_question'] ?? 'What is the difference between General Liability and Professional Liability (E&O)?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_4_answer'] ?? 'General Liability covers physical risks such as bodily injury, property damage, or slip-and-fall accidents on your premises. Professional Liability (Errors & Omissions) covers financial losses resulting from professional advice, negligence, design errors, or service mistakes.' }}
                    </div>
                </div>

                <!-- Q5 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_5_question'] ?? 'How can I lower my annual commercial insurance costs?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_5_answer'] ?? 'You can reduce your commercial premium by bundling property and liability into a BOP, implementing workplace safety protocols, maintaining clean safety records, and customizing your deductible levels.' }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         BOTTOM CTA BANNER WITH MOUNTAIN SILHOUETTE
         ========================================== -->
    <section class="cta-banner-section">
        <div class="container">
            <div class="cta-text-wrap">
                <h2>{!! $content['cta_title'] ?? 'Protect your business &amp; empower your growth today.' !!}</h2>
                <p>{{ $content['cta_subtitle'] ?? 'Get a custom business insurance quote in less than 2 minutes or speak with a commercial risk officer.' }}</p>
            </div>
            <div class="cta-button-group">
                <a href="javascript:void(0)" onclick="openQuoteModal('Business Insurance')" class="btn-cta-white">
                    <span>Get a Commercial Quote</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="tel:+18132141731" class="btn-cta-transparent">
                    <span>Talk to a Commercial Risk Specialist</span>
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
        function toggleFaq(btn) {
            const item = btn.parentElement;
            const wasActive = item.classList.contains('active');
            
            // Close all open items
            document.querySelectorAll('.faq-item').forEach(el => {
                el.classList.remove('active');
            });

            // Toggle current if it wasn't active
            if (!wasActive) {
                item.classList.add('active');
            }
        }
    </script>
@endsection
