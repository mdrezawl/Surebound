@extends('layouts.app')

@section('title', 'Florida Workers Compensation Insurance | Tampa, FL | Surebound')
@section('meta_description', 'Mandatory statutory workers compensation insurance for Florida employers under Florida Statute 440. Protect injured workers, optimize MOD ratings, and avoid state stop-work penalties in Tampa, FL.')

@section('content')

    <!-- ==========================================
         HERO SECTION (DYNAMIC CMS)
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/workers_comp_hero.jpg') }}" 
                alt="Florida Workers Compensation Insurance" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'FLORIDA WORKERS COMPENSATION' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Protect Your Employees &amp;<br>Comply with Florida Law' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Mandatory statutory workers compensation coverage for Florida employers. Meet state requirements under Florida Statute 440, shield against liability, and protect injured workers.' }}
                </p>
                <div class="hero-buttons">
                    <a href="javascript:void(0)" onclick="openQuoteModal('Workers Compensation')" class="btn-primary-hero">
                        <span>Get a Workers\' Comp Quote</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">{{ $content['hero_card_sub'] ?? 'Florida Statutory Compliance' }}</span>
                        <span class="hero-card-label">{{ $content['hero_card_label'] ?? 'Florida Statute 440' }}</span>
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
         WORKERS COMP COVERAGE (6 CARDS)
         ========================================== -->
    <section class="coverage-section" id="coverage-options">
        <div class="container">
            <p class="section-eyebrow">STATUTORY WORKERS COMPENSATION</p>
            <h2 class="section-title">Complete Coverage for Florida Workplaces</h2>
            <p class="section-subtitle">Full compliance with Florida Statute 440, protecting your workforce and insulating your enterprise from workplace liability.</p>

            <div class="coverage-cards-grid">
                <!-- 1. Medical Care -->
                <div class="coverage-card" onclick="openQuoteModal('Workers Compensation')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_1_title'] ?? 'Medical Care & Hospitalization' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_1_desc'] ?? 'Covers emergency room treatment, doctor visits, hospital stays, physical therapy, and required prescription medications for injured employees.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 2. Wage Replacement -->
                <div class="coverage-card" onclick="openQuoteModal('Workers Compensation')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_2_title'] ?? 'Temporary & Permanent Wage Replacement' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_2_desc'] ?? 'Provides statutory income replacement (TTD, TPD, PTD) while employees recover from workplace injuries, based on Florida state guidelines.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 3. Vocational Rehab -->
                <div class="coverage-card" onclick="openQuoteModal('Workers Compensation')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_3_title'] ?? 'Vocational Rehabilitation' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_3_desc'] ?? 'Retraining and job-placement assistance for workers whose injuries prevent them from returning to their prior position.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 4. Employer Liability -->
                <div class="coverage-card" onclick="openQuoteModal('Workers Compensation')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_4_title'] ?? 'Employer Liability (Part Two)' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_4_desc'] ?? 'Protects against employee lawsuits claiming gross negligence, third-party over-actions, loss of consortium, and dual-capacity claims.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 5. Class Codes -->
                <div class="coverage-card" onclick="openQuoteModal('Workers Compensation')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-6-15B2.25 2.25 0 0 0 7.5 6v12.75A2.25 2.25 0 0 0 9.75 21h6a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H9.75Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_5_title'] ?? 'Class Code & Payroll Audits' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_5_desc'] ?? 'Precise NCCI class code classification and payroll guidance so you avoid costly post-policy year-end premium surprise audits.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 6. MOD Management -->
                <div class="coverage-card" onclick="openQuoteModal('Workers Compensation')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_6_title'] ?? 'Experience Modification (MOD) Management' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_6_desc'] ?? 'Proactive claims monitoring and return-to-work protocols designed to keep your experience modifier below 1.0.' }}</p>
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
                    <h3 class="value-item-title">{{ $content['value_1_title'] ?? 'Statutory Compliance' }}</h3>
                    <p class="value-item-desc">{{ $content['value_1_desc'] ?? 'Guarantee full compliance with Florida Division of Workers\' Compensation rules to avoid stop-work orders.' }}</p>
                </div>

                <!-- 2 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_2_title'] ?? 'Pay-As-You-Go Billing' }}</h3>
                    <p class="value-item-desc">{{ $content['value_2_desc'] ?? 'Calculate premiums on actual monthly payroll to eliminate large upfront deposits and end-of-year audit surprises.' }}</p>
                </div>

                <!-- 3 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_3_title'] ?? 'Safety Credit Programs' }}</h3>
                    <p class="value-item-desc">{{ $content['value_3_desc'] ?? 'Florida 5% Drug-Free Workplace and 2% Workplace Safety program credits to legally reduce your premium rates.' }}</p>
                </div>

                <!-- 4 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_4_title'] ?? 'Rapid Claims Resolution' }}</h3>
                    <p class="value-item-desc">{{ $content['value_4_desc'] ?? 'Fast medical provider network access and structured return-to-work protocols to resolve claims cleanly.' }}</p>
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
                        alt="Workplace safety and team compliance in Tampa" 
                        class="simpler-image"
                    >
                </div>

                <div class="simpler-content">
                    <p class="simpler-eyebrow">{!! $content['guidance_eyebrow'] ?? 'FLORIDA STATUTORY EXPERTISE' !!}</p>
                    <h2 class="simpler-title">{!! $content['guidance_title'] ?? 'Workers Compensation Made Simple for Florida Businesses' !!}</h2>
                    <p class="simpler-paragraph">
                        {{ $content['guidance_text'] ?? 'Surebound helps Tampa Bay and Florida employers navigate Florida Statute 440 with precision. We ensure accurate NCCI class code classification, coordinate payroll reporting, and implement certified drug-free workplace programs to lower your premiums.' }}
                    </p>
                    <a href="javascript:void(0)" onclick="openQuoteModal('Workers Compensation')" class="btn-learn-more">
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
            <h2 class="section-title">Why Florida Employers Choose Surebound</h2>

            <div class="why-grid">
                <!-- 1 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_1_title'] ?? 'Florida Class Code Precision' }}</h3>
                    <p class="why-card-desc">{{ $content['why_1_desc'] ?? 'Accurate classification across office, sales, trade, and construction roles so you never overpay per $100 of payroll.' }}</p>
                </div>

                <!-- 2 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_2_title'] ?? 'Payroll Integration' }}</h3>
                    <p class="why-card-desc">{{ $content['why_2_desc'] ?? 'Sync directly with major payroll providers (Gusto, ADP, QuickBooks, Paychex) to automate exact monthly billing.' }}</p>
                </div>

                <!-- 3 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_3_title'] ?? 'Drug-Free & Safety Credits' }}</h3>
                    <p class="why-card-desc">{{ $content['why_3_desc'] ?? 'We help you file state certificates to unlock standard 5% and 2% statutory discounts on your annual bill.' }}</p>
                </div>

                <!-- 4 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_4_title'] ?? 'Local Audit Defense' }}</h3>
                    <p class="why-card-desc">{{ $content['why_4_desc'] ?? 'Our Tampa advisors represent you during annual carrier payroll audits to ensure subcontracted labor is treated fairly.' }}</p>
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
            <h2 class="section-title" style="text-align: center;">Florida Workers\' Comp FAQ</h2>
            <p class="section-subtitle" style="text-align: center;">Clear answers about Florida Statute 440 requirements, exemptions, and audit guidelines.</p>

            <div class="faq-accordion">
                <!-- Q1 -->
                <div class="faq-item active">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_1_question'] ?? 'Who is required to carry Workers\' Compensation in Florida?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_1_answer'] ?? 'Under Florida Statute 440, non-construction employers with 4 or more employees (full or part-time) must carry workers compensation. Construction employers with 1 or more employees (including corporate officers) and agricultural employers with 6 or more regular employees must also maintain coverage.' }}
                    </div>
                </div>

                <!-- Q2 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_2_question'] ?? 'Can Florida corporate officers or LLC members exempt themselves?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_2_answer'] ?? 'Yes. Eligible corporate officers and LLC members who own at least 10% of the company can file an official Notice of Election to be Exempt (Form DWC-250) with the Florida Division of Workers\' Compensation. Construction businesses allow up to 3 officers per entity to exempt.' }}
                    </div>
                </div>

                <!-- Q3 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_3_question'] ?? 'What is an Experience Modification Factor (MOD)?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_3_answer'] ?? 'An Experience Modification Factor (MOD) compares your company’s claims history to the average for your industry class codes. A MOD below 1.0 earns a premium discount, while a MOD above 1.0 results in a surcharge. Surebound helps clients maintain safe records to keep MOD rates low.' }}
                    </div>
                </div>

                <!-- Q4 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_4_question'] ?? 'What happens if a Florida employer operates without Workers\' Comp?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_4_answer'] ?? 'Operating without mandatory workers compensation in Florida carries severe penalties, including an immediate Stop-Work Order issued by the state and a civil penalty equal to 2 times the amount the employer would have paid in premium over the preceding two years.' }}
                    </div>
                </div>

                <!-- Q5 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_5_question'] ?? 'How do I get a Workers\' Compensation quote in Tampa?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_5_answer'] ?? 'Provide our team with your business FEIN, payroll estimates by employee role (NCCI class codes), and your prior loss runs (claims history). We compare rates across top carriers to find the best rate.' }}
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
                <h2>{!! $content['cta_title'] ?? 'Ready to protect your workers and comply with Florida law?' !!}</h2>
                <p>{{ $content['cta_subtitle'] ?? 'Get a fast, accurate workers compensation quote from our Tampa business insurance team.' }}</p>
            </div>
            <div class="cta-button-group">
                <a href="javascript:void(0)" onclick="openQuoteModal('Workers Compensation')" class="btn-cta-white">
                    <span>Request a Workers\' Comp Quote</span>
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

