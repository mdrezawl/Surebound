@extends('layouts.app')

@section('title', 'Surebound – Protection Built Around You')

@section('content')

    <!-- ==========================================
         HERO SECTION (FULL BLEED REPLICA)
         ========================================== -->
    <section class="hero-section">
        <!-- Right side full bleed photo with seamless alpha mask & right royal blue gradient -->
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset('images/hero-family.jpg') }}" 
                alt="Protection Built Around You" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">Reliable Insurance. Lasting Peace of Mind.</p>
                <h1 class="hero-title">Protection Built<br>Around You</h1>
                <p class="hero-subtitle">
                    Tailored insurance solutions <br>  for your home, family, business <br>  and future — with dependable support <br>  whenever you need us.
                </p>
                <div class="hero-buttons">
                    <a href="javascript:void(0)" onclick="openQuoteModal()" class="btn-primary-hero">
                        <span>Get a Quote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="#coverage" class="btn-outline-hero">
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
                        <span class="hero-card-sub">Coverage that</span>
                        <span class="hero-card-label">fits your needs</span>
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
         OUR COVERAGE SECTION (6 CARDS)
         ========================================== -->
    <section class="coverage-section" id="coverage">
        <div class="container">
            <p class="section-eyebrow">OUR COVERAGE</p>
            <h2 class="section-title">Coverage for What Matters</h2>
            <p class="section-subtitle">From everyday life to the unexpected, we've got you covered.</p>

            <div class="coverage-cards-grid">
                <!-- 1. Home Insurance -->
                <div class="coverage-card" onclick="window.location.href='{{ route('home-insurance') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <!-- House outline -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Home Insurance</h3>
                        <p class="coverage-card-desc">Protect your home and everything in it.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 2. Auto Insurance -->
                <div class="coverage-card" onclick="window.location.href='{{ route('auto-insurance') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <!-- Car front outline -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Auto Insurance</h3>
                        <p class="coverage-card-desc">Stay on the road with confidence.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 3. Life Insurance -->
                <div class="coverage-card" onclick="window.location.href='{{ route('life-insurance') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <!-- Heart outline -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Life Insurance</h3>
                        <p class="coverage-card-desc">Protect your family's future certainty.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 4. Health Insurance -->
                <div class="coverage-card" onclick="window.location.href='{{ route('health-insurance') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <!-- Medical plus outline -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Health Insurance</h3>
                        <p class="coverage-card-desc">Premier care and doctor network access.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 5. Umbrella Insurance -->
                <div class="coverage-card" onclick="window.location.href='{{ route('umbrella-insurance') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <!-- Shield outline -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Umbrella Insurance</h3>
                        <p class="coverage-card-desc">Multi-million excess liability shield.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 6. Business Insurance -->
                <div class="coverage-card" onclick="window.location.href='{{ route('business-insurance') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <!-- Briefcase outline -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Business Insurance</h3>
                        <p class="coverage-card-desc">Keep your enterprise moving forward.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>
            </div>
            
            <!-- Carousel Dots for Mobile -->
            <div class="coverage-pagination-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

    <!-- ==========================================
         DARK NAVY VALUE PROPOSITION BAR (4 PILLARS)
         ========================================== -->
    <section class="value-bar-section">
        <div class="container">
            <div class="value-bar-grid">
                <!-- 1. 24/7 Support -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <!-- Headset -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">24/7 Support</h3>
                    <p class="value-item-desc">We're here when you need us, anytime, day or night.</p>
                </div>

                <!-- 2. Expert Guidance -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <!-- People / Team -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Expert Guidance</h3>
                    <p class="value-item-desc">Work with experienced insurance professionals.</p>
                </div>

                <!-- 3. Tailored Coverage -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <!-- Shield Check -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Tailored Coverage</h3>
                    <p class="value-item-desc">Flexible plans for your unique needs.</p>
                </div>

                <!-- 4. Claims Assistance -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <!-- Document with folded corner -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Claims Assistance</h3>
                    <p class="value-item-desc">A simpler process when it matters most.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         INSURANCE MADE SIMPLER SECTION
         ========================================== -->
    <section class="simpler-section">
        <div class="container">
            <div class="simpler-grid">
                <!-- Left: Meeting photo -->
                <div class="simpler-image-frame">
                    <img 
                        src="{{ asset('images/advisor-meeting.png') }}" 
                        alt="Insurance Advisor meeting with clients" 
                        class="simpler-image"
                    >
                </div>

                <!-- Right: Content -->
                <div class="simpler-content">
                    <p class="simpler-eyebrow">OUR GUIDANCE</p>
                    <h2 class="simpler-title">Insurance Made Simpler</h2>
                    <p class="simpler-paragraph">
                        We believe insurance should be easy to understand and even easier to manage. That's why we've built a simple, modern experience — from exploring your options to filing a claim. Our team is here to guide you every step of the way.
                    </p>
                    <a href="javascript:void(0)" onclick="openQuoteModal()" class="btn-learn-more">
                        <span>Learn More</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         BRAND GUIDELINES 2026: PULL QUOTES & TESTIMONIAL
         ========================================== -->
    <section class="pull-quote-section">
        <div class="container pull-quote-container">
            <div class="brand-pull-quote-card">
                <span class="brand-quote-mark">&ldquo;</span>
                <blockquote class="brand-quote-text">
                    We believe that the advantages are so great that a shift to working on slack, or something like it, is inevitable.
                </blockquote>
                <div class="brand-quote-attribution">
                    <div class="brand-quote-author-info">
                        <span class="brand-quote-author">Marcel Gherkina</span>
                        <span class="brand-quote-role">Spokesperson, Surebound</span>
                    </div>
                    <div class="brand-quote-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="14" height="14">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                        </svg>
                        <span>Verified Perspective</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         WHY CHOOSE SUREBOUND SECTION
         ========================================== -->
    <section class="why-section">
        <div class="container">
            <p class="section-eyebrow">WHY CHOOSE SUREBOUND</p>
            <h2 class="section-title">The Right Support. When It Matters.</h2>

            <div class="why-grid">
                <!-- 1. Personalized Solutions -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">Personalized Solutions</h3>
                    <p class="why-card-desc">Coverage designed around your unique needs and goals.</p>
                </div>

                <!-- 2. Experienced Guidance -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">Experienced Guidance</h3>
                    <p class="why-card-desc">Trusted advice from knowledgeable professionals.</p>
                </div>

                <!-- 3. Responsive Service -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">Responsive Service</h3>
                    <p class="why-card-desc">Quick answers and support when you need it most.</p>
                </div>

                <!-- 4. Straightforward Claims Support -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">Straightforward Claims Support</h3>
                    <p class="why-card-desc">A smooth, hassle-free claims process.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         RESOURCES & INSIGHTS SECTION
         ========================================== -->
    <section class="resources-section" id="articles">
        <div class="container">
            <div class="resources-layout">
                <!-- Left Info Column -->
                <div class="resources-info-col">
                    <p class="resources-eyebrow">NEWS &amp; RESOURCES</p>
                    <h2 class="resources-title">Resources &amp; Insights</h2>
                    <p class="resources-desc">Helpful articles, practical tips and expert advice to keep you informed and prepared.</p>
                </div>

                <!-- Right Articles Area -->
                <div class="resources-content-col">
                    <div class="resources-top-link">
                        <a href="#all-articles" class="btn-view-all-articles">
                            <span>View All Articles</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>

                    <div class="articles-grid">
                        <!-- Card 1: Home & Lifestyle -->
                        <div class="article-card">
                            <div class="article-image-box">
                                <img 
                                    src="{{ asset('images/article-house-hires.jpg') }}" 
                                    alt="Beautiful suburban home"
                                >
                            </div>
                            <div class="article-body">
                                <p class="article-tag">HOME &amp; LIFESTYLE</p>
                                <h3 class="article-card-title">Understanding Your Coverage</h3>
                                <p class="article-card-desc">Learn what your policy includes and how it protects you.</p>
                                <div class="article-arrow-wrap">
                                    <span class="article-arrow">&rarr;</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Preparedness -->
                        <div class="article-card">
                            <div class="article-image-box">
                                <img 
                                    src="{{ asset('images/article-rain-hires.jpg') }}" 
                                    alt="Person with umbrella on rainy street"
                                >
                            </div>
                            <div class="article-body">
                                <p class="article-tag">PREPAREDNESS</p>
                                <h3 class="article-card-title">Preparing for the Unexpected</h3>
                                <p class="article-card-desc">Simple steps to help you stay ready for life's surprises.</p>
                                <div class="article-arrow-wrap">
                                    <span class="article-arrow">&rarr;</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Business -->
                        <div class="article-card">
                            <div class="article-image-box">
                                <img 
                                    src="{{ asset('images/article-office-hires.jpg') }}" 
                                    alt="Modern office desk workspace"
                                >
                            </div>
                            <div class="article-body">
                                <p class="article-tag">BUSINESS</p>
                                <h3 class="article-card-title">Insurance Tips for Businesses</h3>
                                <p class="article-card-desc">Practical ways to protect your assets and support long-term growth.</p>
                                <div class="article-arrow-wrap">
                                    <span class="article-arrow">&rarr;</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel Dots for Mobile -->
                    <div class="articles-pagination-dots">
                        <span class="dot active"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
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
                <h2>Ready to protect what matters?</h2>
                <p>Get a personalized quote and discover the right coverage for you.</p>
            </div>
            <div class="cta-button-group">
                <a href="javascript:void(0)" onclick="openQuoteModal()" class="btn-cta-white">
                    <span>Get a Quote</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="#contact" class="btn-cta-transparent">
                    <span>Talk to an Expert</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Auto Slide Script for Articles (Mobile) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const articlesGrid = document.querySelector('.articles-grid');
            const dots = document.querySelectorAll('.articles-pagination-dots .dot');
            
            if (articlesGrid && dots.length > 0) {
                let currentIndex = 0;
                const totalCards = dots.length;
                let isUserInteracting = false;
                let autoSlideInterval;
                
                const updateDots = (index) => {
                    dots.forEach(d => d.classList.remove('active'));
                    if (dots[index]) {
                        dots[index].classList.add('active');
                    }
                };

                const slideTo = (index) => {
                    if (!articlesGrid) return;
                    const cardWidth = articlesGrid.offsetWidth;
                    articlesGrid.scrollTo({
                        left: index * cardWidth,
                        behavior: 'smooth'
                    });
                    updateDots(index);
                };

                const startAutoSlide = () => {
                    clearInterval(autoSlideInterval);
                    autoSlideInterval = setInterval(() => {
                        // Only auto-slide on mobile where slider is active
                        if (!isUserInteracting && window.innerWidth <= 768) {
                            currentIndex = (currentIndex + 1) % totalCards;
                            slideTo(currentIndex);
                        }
                    }, 3000); // 3 seconds
                };

                const stopAutoSlide = () => {
                    clearInterval(autoSlideInterval);
                };

                // Sync dots on manual scroll
                articlesGrid.addEventListener('scroll', () => {
                    if (window.innerWidth <= 768) {
                        const scrollLeft = articlesGrid.scrollLeft;
                        const cardWidth = articlesGrid.offsetWidth;
                        const newIndex = Math.round(scrollLeft / cardWidth);
                        if (newIndex !== currentIndex && newIndex < totalCards) {
                            currentIndex = newIndex;
                            updateDots(currentIndex);
                        }
                    }
                }, { passive: true });

                // Pause on interaction
                articlesGrid.addEventListener('touchstart', () => { isUserInteracting = true; stopAutoSlide(); }, {passive: true});
                articlesGrid.addEventListener('touchend', () => { 
                    isUserInteracting = false; 
                    setTimeout(startAutoSlide, 3000); // Wait a bit before restarting
                }, {passive: true});
                
                // Start initially
                startAutoSlide();
            }

            // Coverage Cards Auto-scroll logic
            const coverageGrid = document.querySelector('.coverage-cards-grid');
            const coverageDots = document.querySelectorAll('.coverage-pagination-dots .dot');
            
            if (coverageGrid && coverageDots.length > 0) {
                let covIndex = 0;
                const totalCovCards = coverageDots.length; // 6 cards
                let covAutoSlideInterval;
                let covInteracting = false;

                const updateCovDots = (index) => {
                    coverageDots.forEach((dot, i) => {
                        dot.classList.toggle('active', i === index);
                    });
                };

                const slideCovTo = (index) => {
                    const firstCard = coverageGrid.querySelector('.coverage-card');
                    if(firstCard) {
                        const cardWidth = firstCard.offsetWidth + 16; // width + gap
                        coverageGrid.scrollTo({
                            left: index * cardWidth,
                            behavior: 'smooth'
                        });
                        updateCovDots(index);
                    }
                };

                const startCovAutoSlide = () => {
                    clearInterval(covAutoSlideInterval);
                    covAutoSlideInterval = setInterval(() => {
                        if (!covInteracting && window.innerWidth <= 768) {
                            // On 50% width, max scroll index is totalCards - 2
                            if (covIndex >= totalCovCards - 2) {
                                covIndex = 0;
                            } else {
                                covIndex++;
                            }
                            slideCovTo(covIndex);
                        }
                    }, 3000);
                };

                const stopCovAutoSlide = () => {
                    clearInterval(covAutoSlideInterval);
                };

                coverageGrid.addEventListener('scroll', () => {
                    if (window.innerWidth <= 768) {
                        const firstCard = coverageGrid.querySelector('.coverage-card');
                        if (firstCard) {
                            const scrollLeft = coverageGrid.scrollLeft;
                            const cardWidth = firstCard.offsetWidth + 16;
                            const newIndex = Math.round(scrollLeft / cardWidth);
                            if (newIndex !== covIndex && newIndex < totalCovCards) {
                                covIndex = newIndex;
                                updateCovDots(covIndex);
                            }
                        }
                    }
                }, { passive: true });

                coverageGrid.addEventListener('touchstart', () => { covInteracting = true; stopCovAutoSlide(); }, {passive: true});
                coverageGrid.addEventListener('touchend', () => { 
                    covInteracting = false; 
                    setTimeout(startCovAutoSlide, 3000); 
                }, {passive: true});
                
                startCovAutoSlide();
            }
        });
    </script>
@endsection
