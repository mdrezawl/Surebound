@extends('layouts.app')

@section('title', 'Make a Payment | Surebound')

@section('content')

    <!-- ==========================================
         HERO SECTION (DYNAMIC CMS REPLICA)
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/hero-business.jpg') }}" 
                alt="Make a Payment" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'Make a Payment' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Secure & Easy Payments' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Pay your premium quickly and securely online.' }}
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('user.payments') }}" class="btn-primary-hero">
                        <span>Pay Now</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT SECTION -->
    <section class="coverage-section" id="payment-options">
        <div class="container">
            <p class="section-eyebrow">PAYMENT METHODS</p>
            <h2 class="section-title">Flexible payment options for your convenience</h2>
            <p class="section-subtitle">We offer a variety of payment methods to make managing your insurance policy as easy as possible. Choose the option that works best for you and your budget.</p>
            
            <div class="coverage-cards-grid">
                <!-- 1. Online Bill Pay -->
                <div class="coverage-card" onclick="window.location.href='{{ route('user.payments') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Online Bill Pay</h3>
                        <p class="coverage-card-desc">Pay your bill instantly using your bank account, credit card, or digital wallet through our secure portal.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 2. AutoPay -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">AutoPay</h3>
                        <p class="coverage-card-desc">Set it and forget it. Enroll in AutoPay to have your premium automatically deducted on your due date.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 3. Pay by Phone -->
                <div class="coverage-card">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.273-3.974-6.869-6.87l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Pay by Phone</h3>
                        <p class="coverage-card-desc">Call our automated payment line 24/7 to make a payment over the phone securely.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>
            </div>
            
            <!-- Carousel Dots for Mobile -->
            <div class="coverage-pagination-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

    <!-- ==========================================
         PAYMENT SECURITY SECTION (WITH IMAGE)
         ========================================== -->
    <section class="simpler-section">
        <div class="container">
            <div class="simpler-grid">
                <!-- Left: Photo -->
                <div class="simpler-image-frame">
                    <img 
                        src="{{ asset('images/payment-security-card.jpg') }}" 
                        alt="Secure Payments with Surebound" 
                        class="simpler-image"
                    >
                </div>

                <!-- Right: Content -->
                <div class="simpler-content">
                    <p class="simpler-eyebrow">SECURE & RELIABLE</p>
                    <h2 class="simpler-title">Your Data Security is Our Top Priority</h2>
                    <p class="simpler-paragraph">
                        We use industry-leading encryption and security protocols to ensure that your payment information is always protected. Whether you are paying online or setting up AutoPay, you can trust that your transactions with Surebound are safe, seamless, and completely secure.
                    </p>
                    <a href="{{ route('faqs') }}" class="btn-learn-more">
                        <span>Payment FAQs</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Coverage Cards Auto-scroll logic for mobile
            const coverageGrid = document.querySelector('.coverage-cards-grid');
            const coverageDots = document.querySelectorAll('.coverage-pagination-dots .dot');
            
            if (coverageGrid && coverageDots.length > 0) {
                let covIndex = 0;
                const totalCovCards = coverageDots.length; // 3 cards
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
