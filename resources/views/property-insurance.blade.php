@extends('layouts.app')

@section('title', 'Commercial Property Insurance | Tampa, FL | Surebound')
@section('meta_description', 'Safeguard your commercial buildings, business personal property, equipment, and operating income with tailored commercial property insurance in Tampa, FL.')

@section('content')

    <!-- ==========================================
         HERO SECTION (DYNAMIC CMS)
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/hero-business.jpg') }}" 
                alt="Commercial Property Insurance in Tampa" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'COMMERCIAL PROPERTY INSURANCE' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Protect Your Commercial<br>Buildings &amp; Assets' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Comprehensive commercial property insurance engineered to safeguard your buildings, business personal property, inventory, and operating income in Tampa, FL.' }}
                </p>
                <div class="hero-buttons">
                    <a href="javascript:void(0)" onclick="openQuoteModal('Commercial Property')" class="btn-primary-hero">
                        <span>Request a Property Quote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="#coverage-options" class="btn-outline-hero">
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.75c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">{{ $content['hero_card_sub'] ?? 'Commercial Asset Protection' }}</span>
                        <span class="hero-card-label">{{ $content['hero_card_label'] ?? 'Tailored property limits' }}</span>
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
         COMMERCIAL PROPERTY COVERAGE (6 CARDS)
         ========================================== -->
    <section class="coverage-section" id="coverage-options">
        <div class="container">
            <p class="section-eyebrow">COMMERCIAL PROPERTY SOLUTIONS</p>
            <h2 class="section-title">Complete Protection for Real Estate &amp; Business Assets</h2>
            <p class="section-subtitle">From physical structures and machinery to lost business income, protect every layer of your business.</p>

            <div class="coverage-cards-grid">
                <!-- 1. Commercial Building -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Property')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.75c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_1_title'] ?? 'Commercial Building Coverage' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_1_desc'] ?? 'Protects owned commercial real estate, offices, warehouses, and structural improvements against fire, windstorm, and covered perils.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 2. BPP -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Property')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_2_title'] ?? 'Business Personal Property (BPP)' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_2_desc'] ?? 'Safeguards business equipment, machinery, computer networks, furniture, tools, and inventory stored on-premises.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 3. Business Income -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Property')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_3_title'] ?? 'Business Income & Interruption' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_3_desc'] ?? 'Replaces lost operational net income and ongoing payroll, rent, and mortgage expenses when covered perils force a temporary shutdown.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 4. Equipment Breakdown -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Property')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.32l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.32 4.486c.091.75-.027 1.503-.38 2.148" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_4_title'] ?? 'Equipment Breakdown Coverage' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_4_desc'] ?? 'Covers mechanical breakdown, electrical arcing, HVAC failure, boiler rupture, and refrigeration loss.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 5. Tenant Improvements -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Property')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_5_title'] ?? 'Tenant Improvements & Betterments' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_5_desc'] ?? 'Protects permanent fixtures, alterations, lighting, flooring, and custom build-outs added to leased commercial spaces.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 6. Windstorm Endorsement -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Property')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_6_title'] ?? 'Windstorm & Hurricane Endorsements' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_6_desc'] ?? 'Critical Florida commercial coverage addressing named-storm hurricane deductibles, wind-driven rain, and hail damage.' }}</p>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_1_title'] ?? 'Commercial Replacement Cost' }}</h3>
                    <p class="value-item-desc">{{ $content['value_1_desc'] ?? 'Rebuilding valuations backed by current commercial construction data with zero hidden depreciation.' }}</p>
                </div>

                <!-- 2 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_2_title'] ?? 'Business Interruption Shield' }}</h3>
                    <p class="value-item-desc">{{ $content['value_2_desc'] ?? 'Protection for operational cash flow, payroll, and fixed overhead while repairs take place.' }}</p>
                </div>

                <!-- 3 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_3_title'] ?? 'Florida Hurricane Protection' }}</h3>
                    <p class="value-item-desc">{{ $content['value_3_desc'] ?? 'Tailored named-storm options and deductible structures built for coastal and inland Florida facilities.' }}</p>
                </div>

                <!-- 4 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_4_title'] ?? 'Commercial Ordinance & Law' }}</h3>
                    <p class="value-item-desc">{{ $content['value_4_desc'] ?? 'Coverage for mandatory building code upgrades, demolition, and increased construction costs.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         GUIDANCE / MADE SIMPLER SECTION
         ========================================== -->
    <section class="simpler-section">
        <div class="container">
            <div class="simpler-grid">
                <div class="simpler-image-frame">
                    <img 
                        src="{{ asset('images/article-office-hires.jpg') }}" 
                        alt="Commercial office building protected by Surebound Insurance in Tampa" 
                        class="simpler-image"
                    >
                </div>

                <div class="simpler-content">
                    <p class="simpler-eyebrow">{!! $content['guidance_eyebrow'] ?? 'OUR EXPERTISE' !!}</p>
                    <h2 class="simpler-title">{!! $content['guidance_title'] ?? 'Commercial Property Protection Made Simpler' !!}</h2>
                    <p class="simpler-paragraph">
                        {{ $content['guidance_text'] ?? 'Whether you own retail plazas, multi-family units, medical offices, or light industrial buildings in Tampa Bay, Surebound eliminates guesswork. We accurately assess replacement costs and coordinate hurricane endorsements so your investments remain safe and fully solvent after any loss.' }}
                    </p>
                    <a href="javascript:void(0)" onclick="openQuoteModal('Commercial Property')" class="btn-learn-more">
                        <span>Request a Quote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         WHY CHOOSE SUREBOUND
         ========================================== -->
    <section class="why-section">
        <div class="container">
            <p class="section-eyebrow">THE SUREBOUND ADVANTAGE</p>
            <h2 class="section-title">Why Property Owners Choose Surebound</h2>

            <div class="why-grid">
                <!-- 1 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_1_title'] ?? 'Accurate Risk Engineering' }}</h3>
                    <p class="why-card-desc">{{ $content['why_1_desc'] ?? 'On-site risk assessments and replacement cost modeling to prevent dangerous underinsurance penalties (coinsurance).' }}</p>
                </div>

                <!-- 2 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_2_title'] ?? 'Rapid Property Adjusters' }}</h3>
                    <p class="why-card-desc">{{ $content['why_2_desc'] ?? 'Direct connections to dedicated commercial loss adjusters who prioritize immediate mitigation and emergency repairs.' }}</p>
                </div>

                <!-- 3 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 18H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 12h11.25" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_3_title'] ?? 'Flexible Wind Deductibles' }}</h3>
                    <p class="why-card-desc">{{ $content['why_3_desc'] ?? 'Options for percentage-based or flat dollar hurricane deductibles to maintain predictable disaster budgets.' }}</p>
                </div>

                <!-- 4 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_4_title'] ?? 'Florida Code Compliance' }}</h3>
                    <p class="why-card-desc">{{ $content['why_4_desc'] ?? 'Ordinance or Law coverage options that pay for required Florida Building Code upgrades during post-storm reconstruction.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         FAQ ACCORDION
         ========================================== -->
    <section class="faq-section" id="faqs">
        <div class="container faq-container">
            <p class="section-eyebrow" style="text-align: center;">GOT QUESTIONS?</p>
            <h2 class="section-title" style="text-align: center;">Commercial Property Insurance FAQ</h2>
            <p class="section-subtitle" style="text-align: center;">Clear answers about building replacement costs, hurricane deductibles, and business income.</p>

            <div class="faq-accordion">
                <!-- Q1 -->
                <div class="faq-item active">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_1_question'] ?? 'What is covered under Commercial Property Insurance?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_1_answer'] ?? 'Commercial property insurance covers your physical building, tenant improvements, inventory, machinery, furniture, and equipment against risks like fire, lightning, windstorm, explosion, vandalism, and theft.' }}
                    </div>
                </div>

                <!-- Q2 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_2_question'] ?? 'What is the difference between Replacement Cost and Actual Cash Value (ACV)?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_2_answer'] ?? 'Replacement Cost pays to repair or replace damaged property with new materials of like kind and quality without deduction for depreciation. Actual Cash Value (ACV) deducts depreciation based on the age and condition of the item at the time of loss.' }}
                    </div>
                </div>

                <!-- Q3 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_3_question'] ?? 'How does a Florida hurricane deductible work for commercial buildings?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_3_answer'] ?? 'In Florida, commercial hurricane deductibles are typically expressed as a percentage (e.g., 2%, 3%, or 5%) of the total insured building value rather than a flat dollar amount. For example, a 3% deductible on a $2M building equals $60,000 for covered named-storm damage.' }}
                    </div>
                </div>

                <!-- Q4 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_4_question'] ?? 'Does commercial property insurance include flood damage?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_4_answer'] ?? 'Standard commercial property policies exclude damage caused by rising exterior floodwaters or storm surge. Commercial flood coverage must be secured separately through FEMA\'s National Flood Insurance Program (NFIP) or private commercial flood markets.' }}
                    </div>
                </div>

                <!-- Q5 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_5_question'] ?? 'How is Business Interruption coverage calculated?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_5_answer'] ?? 'Business interruption (Business Income) replaces your net profit and covers normal continuing operating expenses (including payroll, rent, taxes, and debt service) based on your historical financial records during the period of restoration.' }}
                    </div>
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
                <h2>{!! $content['cta_title'] ?? 'Ready to protect your commercial properties with confidence?' !!}</h2>
                <p>{{ $content['cta_subtitle'] ?? 'Get a tailored commercial property insurance proposal from our Tampa commercial lines team.' }}</p>
            </div>
            <div class="cta-button-group">
                <a href="javascript:void(0)" onclick="openQuoteModal('Commercial Property')" class="btn-cta-white">
                    <span>Request a Property Quote</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="tel:+18132141731" class="btn-cta-transparent">
                    <span>Call (813) 214-1731</span>
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
            
            document.querySelectorAll('.faq-item').forEach(el => {
                el.classList.remove('active');
            });

            if (!wasActive) {
                item.classList.add('active');
            }
        }
    </script>
@endsection
