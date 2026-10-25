@extends('layouts.app')

@section('title', 'Personal Coverage – Umbrella Liability & Asset Protection | Surebound')

@section('content')

    <!-- ==========================================
         HERO SECTION (DYNAMIC CMS REPLICA FOR PERSONAL COVERAGE)
         ========================================== -->
    <section class="hero-section">
        <!-- Right side full bleed photo with seamless alpha mask & right royal blue gradient -->
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/hero-personal.jpg') }}" 
                alt="Comprehensive Personal Coverage & Asset Protection" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'PERSONAL &amp; LIABILITY COVERAGE' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Comprehensive Security for<br>Everything You Value Most' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Extend your financial protection beyond standard policy limits. From excess liability umbrella guards to high-value personal asset protection, Surebound secures your lifestyle.' }}
                </p>
                <div class="hero-buttons">
                    <a href="javascript:void(0)" onclick="openQuoteModal('Personal Coverage')" class="btn-primary-hero">
                        <span>Get Personal Quote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="#coverage-options" class="btn-outline-hero">
                        <span>Explore Solutions</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.285Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">{{ $content['hero_card_sub'] ?? 'Umbrella Protection' }}</span>
                        <span class="hero-card-label">{{ $content['hero_card_label'] ?? 'Up to $5,000,000 in excess liability guard' }}</span>
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
         PERSONAL COVERAGE OPTIONS SECTION (6 CARDS)
         ========================================== -->
    <section class="coverage-section" id="coverage-options">
        <div class="container">
            <p class="section-eyebrow">PERSONAL RISK SOLUTIONS</p>
            <h2 class="section-title">Comprehensive Protection for Your Assets &amp; Estate</h2>
            <p class="section-subtitle">Tailored personal risk insurance so you stay fully protected against major lawsuits, cyber threats, and high-value losses.</p>

            <div class="coverage-cards-grid">
                <!-- 1. Personal Umbrella Liability -->
                <div class="coverage-card" onclick="openQuoteModal('Personal Coverage')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.285Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_1_title'] ?? 'Personal Umbrella Liability' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_1_desc'] ?? 'Provides an additional layer of $1M to $5M+ liability protection above your standard home and auto policy coverage limits.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 2. High-Value Property & Valuables -->
                <div class="coverage-card" onclick="openQuoteModal('Personal Coverage')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m-17.432 0A8.959 8.959 0 0 1 3 12c0-.778.099-1.533.284-2.253" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_2_title'] ?? 'High-Value Property & Valuables' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_2_desc'] ?? 'Specialized scheduling for fine jewelry, luxury watches, artwork, antiques, and high-end electronics with zero deductible.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 3. Personal Cyber & Identity Theft -->
                <div class="coverage-card" onclick="openQuoteModal('Personal Coverage')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_3_title'] ?? 'Personal Cyber & Identity Theft' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_3_desc'] ?? 'Reimburses financial losses, legal fees, and data restoration costs resulting from identity theft, ransomware, or online fraud.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 4. Worldwide Personal Liability -->
                <div class="coverage-card" onclick="openQuoteModal('Personal Coverage')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_4_title'] ?? 'Worldwide Personal Liability' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_4_desc'] ?? 'Global liability protection covering accidental injury or property damage claims caused anywhere in the world.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 5. Watercraft & Recreational Craft -->
                <div class="coverage-card" onclick="openQuoteModal('Personal Coverage')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_5_title'] ?? 'Watercraft & Recreational Craft' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_5_desc'] ?? 'Comprehensive hull, engine, liability, and passenger coverage for boats, yachts, jet skis, and recreational vehicles.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 6. Domestic Employee Protection -->
                <div class="coverage-card" onclick="openQuoteModal('Personal Coverage')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_6_title'] ?? 'Domestic Employee Protection' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_6_desc'] ?? 'Employment liability and workers\' compensation coverage for nannies, housekeepers, private chefs, and estate staff.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         DARK NAVY VALUE PROPOSITION BAR (4 PILLARS)
         ========================================== -->
    <section class="value-bar-section">
        <div class="container">
            <div class="value-bar-grid">
                <!-- 1. Up to $5M Excess Limits -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.285Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_1_title'] ?? 'Up to $5M Excess Limits' }}</h3>
                    <p class="value-item-desc">{{ $content['value_1_desc'] ?? 'Robust umbrella liability protection designed to shield total wealth against major lawsuits.' }}</p>
                </div>

                <!-- 2. Zero Deductible Schedules -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_2_title'] ?? 'Zero Deductible Schedules' }}</h3>
                    <p class="value-item-desc">{{ $content['value_2_desc'] ?? 'Full replacement cost coverage for high-value scheduled items without out-of-pocket deductibles.' }}</p>
                </div>

                <!-- 3. Worldwide Coverage -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_3_title'] ?? 'Worldwide Coverage' }}</h3>
                    <p class="value-item-desc">{{ $content['value_3_desc'] ?? 'Protection follows you across international travel, global rentals, and offshore watercraft.' }}</p>
                </div>

                <!-- 4. Private Client Concierge -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_4_title'] ?? 'Private Client Concierge' }}</h3>
                    <p class="value-item-desc">{{ $content['value_4_desc'] ?? 'Dedicated risk advisors offering bespoke insurance portfolio evaluations and discreet claims support.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         PERSONAL PROTECTION MADE SIMPLER SECTION
         ========================================== -->
    <section class="simpler-section">
        <div class="container">
            <div class="simpler-grid">
                <!-- Left: Luxury portfolio photo -->
                <div class="simpler-image-frame">
                    <img 
                        src="{{ asset('images/article-personal-hires.jpg') }}" 
                        alt="Sophisticated personal asset portfolio and high-value coverage by Surebound" 
                        class="simpler-image"
                    >
                </div>

                <!-- Right: Content -->
                <div class="simpler-content">
                    <p class="simpler-eyebrow">{!! $content['guidance_eyebrow'] ?? 'HOLISTIC PERSONAL RISK MANAGEMENT' !!}</p>
                    <h2 class="simpler-title">{!! $content['guidance_title'] ?? 'Personal Risk Protection Tailored to Your Estate' !!}</h2>
                    <p class="simpler-paragraph">
                        {{ $content['guidance_text'] ?? 'Standard homeowners and auto policies have strict coverage caps. Surebound\'s Personal Coverage solutions fill critical gaps, shielding your family assets, high-value collections, and personal reputation from unexpected legal claims, cyber threats, and high-severity loss events.' }}
                    </p>
                    <a href="javascript:void(0)" onclick="openQuoteModal('Personal Coverage')" class="btn-learn-more">
                        <span>Speak with a Risk Officer</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         WHY CHOOSE SUREBOUND FOR PERSONAL COVERAGE
         ========================================== -->
    <section class="why-section">
        <div class="container">
            <p class="section-eyebrow">THE SUREBOUND ADVANTAGE</p>
            <h2 class="section-title">Why High-Net-Worth Clients Choose Surebound</h2>

            <div class="why-grid">
                <!-- 1 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.285Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_1_title'] ?? 'Bespoke Portfolio Review' }}</h3>
                    <p class="why-card-desc">{{ $content['why_1_desc'] ?? 'Our senior risk officers conduct a detailed asset review to eliminate dangerous liability gaps.' }}</p>
                </div>

                <!-- 2 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_2_title'] ?? 'Seamless Policy Bundling' }}</h3>
                    <p class="why-card-desc">{{ $content['why_2_desc'] ?? 'Unify home, auto, umbrella, and valuable collections under one consolidated billing statement.' }}</p>
                </div>

                <!-- 3 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_3_title'] ?? 'Agreed Value Protection' }}</h3>
                    <p class="why-card-desc">{{ $content['why_3_desc'] ?? 'Lock in agreed cash values for rare artwork and luxury items before a loss ever occurs.' }}</p>
                </div>

                <!-- 4 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_4_title'] ?? '24/7 Confidential Claims' }}</h3>
                    <p class="why-card-desc">{{ $content['why_4_desc'] ?? 'White-glove claims handling with expedited payouts and direct access to legal specialists.' }}</p>
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
            <h2 class="section-title" style="text-align: center;">Personal Coverage FAQ</h2>
            <p class="section-subtitle" style="text-align: center;">Clear, honest answers about umbrella liability, luxury valuables, and estate protection.</p>

            <div class="faq-accordion">
                <!-- Q1 -->
                <div class="faq-item active">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_1_question'] ?? 'Why do I need a Personal Umbrella policy if I already have Home and Auto insurance?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_1_answer'] ?? 'Standard homeowners and auto insurance policies have maximum liability limits (typically $300k to $500k). If you are found liable for a major accident or lawsuit exceeding those limits, your personal savings, home equity, and future wages could be seized. An Umbrella policy kicks in where your underlying limits stop, providing an extra $1M to $5M+ in protection.' }}
                    </div>
                </div>

                <!-- Q2 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_2_question'] ?? 'How are luxury items like jewelry, watches, or art covered under Personal Coverage?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_2_answer'] ?? 'Standard home policies cap luxury item payouts (often around $1,500 to $2,500). Through scheduled personal property floaters, each valuable item is appraised and insured for its full agreed replacement value with zero deductible and coverage for accidental loss or breakage worldwide.' }}
                    </div>
                </div>

                <!-- Q3 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_3_question'] ?? 'What does Personal Cyber Insurance protect against?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_3_answer'] ?? 'Personal Cyber protection covers expenses related to cyber extortion (ransomware), identity theft restoration, fraudulent online wire transfers, cyberbullying legal defense, and data recovery for home computer systems.' }}
                    </div>
                </div>

                <!-- Q4 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_4_question'] ?? 'Does Personal Coverage apply when I am traveling outside the country?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_4_answer'] ?? 'Yes! Our Personal Umbrella and Scheduled Property endorsements provide 24/7 worldwide coverage, protecting you against legal liability, lost valuables, or emergency incidents anywhere across the globe.' }}
                    </div>
                </div>

                <!-- Q5 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_5_question'] ?? 'How much does a Personal Umbrella insurance policy typically cost?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_5_answer'] ?? 'Personal Umbrella insurance is exceptionally cost-effective. A $1,000,000 umbrella policy typically costs between $150 and $300 per year, making it one of the most affordable ways to protect your overall financial future.' }}
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
                <h2>{!! $content['cta_title'] ?? 'Shield your assets and peace of mind today.' !!}</h2>
                <p>{{ $content['cta_subtitle'] ?? 'Speak with a senior risk advisor or request a confidential personal insurance proposal in under 2 minutes.' }}</p>
            </div>
            <div class="cta-button-group">
                <a href="javascript:void(0)" onclick="openQuoteModal('Personal Coverage')" class="btn-cta-white">
                    <span>Request Personal Proposal</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="tel:+18132141731" class="btn-cta-transparent">
                    <span>Talk to a Risk Specialist</span>
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
