@extends('layouts.app')

@section('title', 'Our Team – Licensed Insurance Advisors | Tampa, FL | Surebound')
@section('meta_description', 'Meet Surebound Insurance’s team of licensed Florida insurance agents and client advocates in Tampa, FL, specializing in commercial and personal coverage.')

@section('content')

    <!-- ==========================================
         HERO SECTION (DYNAMIC CMS)
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/team_hero.jpg') }}" 
                alt="Surebound Insurance Advisory Team" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'LEADERSHIP &amp; ADVISORS' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Experienced Insurance<br>Professionals Dedicated to You' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Our licensed advisors, underwriters, and client service specialists bring decades of combined insurance expertise in Florida. We provide consultative guidance designed around your specific risks.' }}
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('contact') }}" class="btn-primary-hero">
                        <span>Schedule a Consultation</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
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

            <!-- Floating Card positioned over the photo in the container -->
            <div class="hero-card-positioner">
                <div class="hero-floating-card">
                    <div class="hero-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">Advisory Team</span>
                        <span class="hero-card-label">Licensed Florida Agents</span>
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
         PRACTICE AREAS & ADVISORY GROUPS (6 CARDS)
         ========================================== -->
    <section class="coverage-section" id="practice-areas">
        <div class="container">
            <p class="section-eyebrow">OUR SPECIALIZATIONS</p>
            <h2 class="section-title">Dedicated Practice Groups</h2>
            <p class="section-subtitle">Specialized teams focusing on distinct facets of risk management and coverage placement.</p>

            <div class="coverage-cards-grid">
                <!-- 1 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.75c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_1_title'] ?? 'Commercial Lines Advisory' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_1_desc'] ?? 'Commercial property, liability, BOP, and contractor risk management for growing Florida enterprises.' }}</p>
                    </div>
                </div>

                <!-- 2 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_2_title'] ?? 'Life & Asset Protection' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_2_desc'] ?? 'Customized life insurance, key-person coverage, business succession funding, and asset protection for business leaders and families.' }}</p>
                    </div>
                </div>

                <!-- 3 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_3_title'] ?? 'Employee Benefits & Group Plans' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_3_desc'] ?? 'Group medical, dental, vision, life, and disability solutions structured for small to mid-sized employers.' }}</p>
                    </div>
                </div>

                <!-- 4 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_4_title'] ?? 'Workers\' Compensation & Compliance' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_4_desc'] ?? 'Florida Statute 440 statutory compliance, payroll audit management, and experience mod reduction.' }}</p>
                    </div>
                </div>

                <!-- 5 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_5_title'] ?? 'Claims Advocacy & Client Care' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_5_desc'] ?? 'Dedicated assistance navigating open carrier claims, tracking status, and advocating for fair settlements.' }}</p>
                    </div>
                </div>

                <!-- 6 -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-6-15B2.25 2.25 0 0 0 7.5 6v12.75A2.25 2.25 0 0 0 9.75 21h6a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H9.75Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_6_title'] ?? 'Certificates & Underwriting Support' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_6_desc'] ?? 'Fast Certificate of Insurance (COI) turnaround, policy changes, and mortgagee escrow coordination.' }}</p>
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
                    <h3 class="value-item-title">{{ $content['value_1_title'] ?? 'Florida Licensed Agents' }}</h3>
                    <p class="value-item-desc">{{ $content['value_1_desc'] ?? 'Fully credentialed 2-20 and 4-40 insurance agents licensed by the Florida Department of Financial Services.' }}</p>
                </div>

                <!-- 2 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_2_title'] ?? 'Carrier Certified' }}</h3>
                    <p class="value-item-desc">{{ $content['value_2_desc'] ?? 'Appointed with leading national and regional carriers including Travelers, Progressive, Liberty Mutual, and Hartford.' }}</p>
                </div>

                <!-- 3 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_3_title'] ?? 'Local Consultations' }}</h3>
                    <p class="value-item-desc">{{ $content['value_3_desc'] ?? 'In-person consultations available at our downtown Tampa office or virtually via video conference.' }}</p>
                </div>

                <!-- 4 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_4_title'] ?? 'Direct Access' }}</h3>
                    <p class="value-item-desc">{{ $content['value_4_desc'] ?? 'Reach a real, knowledgeable advisor directly by phone at (813) 214-1731 during standard business hours.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SIMPLER SECTION / MEET THE FOUNDER
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
                    <p class="simpler-eyebrow">MEET THE FOUNDER</p>
                    <h2 class="simpler-title">Advisors Who Listen First</h2>
                    <p class="simpler-paragraph">
                        I’m Karry, founder of Surebound Insurance. My background in both personal and commercial insurance helps me work with families and business owners. I’ll walk you through what your policy covers, where you may have gaps, and which options fit your budget.
                    </p>
                    <a href="{{ route('contact') }}" class="btn-learn-more">
                        <span>Get in Touch</span>
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
                <h2>Ready to work with a dedicated insurance advisor?</h2>
                <p>Connect with our Tampa team for an honest review of your coverage options.</p>
            </div>
            <div class="cta-button-group">
                <a href="{{ route('contact') }}" class="btn-cta-white">
                    <span>Contact Our Team</span>
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
