@extends('layouts.app')

@section('title', 'Frequently Asked Questions – Insurance FAQ | Surebound')
@section('meta_description', 'Find clear, honest answers to common insurance questions about Florida hurricane deductibles, COIs, claims reporting, policy bundling, and payments.')

@section('content')

    <!-- ==========================================
         HERO SECTION
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/faqs_hero.jpg') }}" 
                alt="Frequently Asked Questions at Surebound Insurance" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'HELP &amp; FREQUENTLY ASKED QUESTIONS' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Clear Answers to Your<br>Insurance Questions' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Find straightforward answers about policy coverage, Florida hurricane deductibles, certificates of insurance, billing, and claims processing.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#faq-accordion" class="btn-primary-hero">
                        <span>Browse FAQs &darr;</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
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

            <!-- Floating Card -->
            <div class="hero-card-positioner">
                <div class="hero-floating-card">
                    <div class="hero-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">Knowledge Base</span>
                        <span class="hero-card-label">Direct Agency Answers</span>
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
         FAQ ACCORDION SECTION
         ========================================== -->
    <section class="faq-section" id="faq-accordion" style="padding: 70px 0;">
        <div class="container faq-container">
            <p class="section-eyebrow" style="text-align: center;">INSURANCE KNOWLEDGE BASE</p>
            <h2 class="section-title" style="text-align: center;">Frequently Asked Questions</h2>
            <p class="section-subtitle" style="text-align: center;">Got a specific question not covered here? Call our Tampa office at (813) 214-1731.</p>

            <div class="faq-accordion">
                <!-- Q1 -->
                <div class="faq-item active">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>What is an independent insurance agency and how does it benefit me?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        Unlike captive insurance agencies (such as State Farm or Allstate) that sell policies exclusively from a single company, an independent agency like Surebound works with numerous top-rated national and Florida-admitted carriers. We shop the market on your behalf, compare rates, and match you with the policy that best balances price and coverage.
                    </div>
                </div>

                <!-- Q2 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>How do Florida hurricane deductibles work on property policies?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        Under Florida law, hurricane deductibles apply only when damage is caused by a hurricane declared by the National Hurricane Center, from the time a hurricane watch/warning is issued until 72 hours after it ends. The deductible is calculated as a percentage (typically 2%, 3%, or 5%) of your dwelling limit (Coverage A) and applies on a calendar-year basis rather than per-storm.
                    </div>
                </div>

                <!-- Q3 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>How quickly can Surebound issue a Certificate of Insurance (COI)?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        For existing commercial clients with active policies, our Tampa team typically issues standard ACORD 25 Certificates of Insurance within 1 business day, and often same-day for urgent job bids, vendor contracts, or commercial lease signings.
                    </div>
                </div>

                <!-- Q4 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>How do I file an insurance claim, and what is the FNOL process?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        For the fastest response, report your loss directly to your underwriting carrier's 24/7 hotline or website (see our <a href="{{ route('claims') }}" style="color: #1e3a8a; text-decoration: underline;">Claims Center</a>). This initiates First Notice of Loss (FNOL) and immediately dispatches adjusters or emergency repair teams. Then contact Surebound with your claim number so we can advocate on your behalf.
                    </div>
                </div>

                <!-- Q5 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>What is the grace period for paying insurance premiums?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        Payment grace periods typically range from 10 to 30 days depending on the insurance carrier, policy line, and Florida regulations. Payments received after the expiration of a carrier's statutory grace period are subject to cancellation for non-payment, which can cause coverage lapses and reinstatement fees. Please review your carrier invoice or contact us if you anticipate billing issues.
                    </div>
                </div>

                <!-- Q6 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Can I bundle multiple insurance policies for a discount?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        Yes. Bundling home and auto insurance or packaging commercial property and general liability into a Business Owner Policy (BOP) is one of the most effective ways to lower annual premiums, often unlocking multi-policy discounts of 15% to 25%.
                    </div>
                </div>

                <!-- Q7 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Who is required to carry Workers\' Compensation in Florida?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        Under Florida Statute 440, all non-construction businesses with 4 or more employees must carry workers' compensation coverage. In the construction industry, employers with 1 or more employees (including corporate officers) are legally required to carry coverage. Failure to comply can result in immediate stop-work orders and significant fines.
                    </div>
                </div>

                <!-- Q8 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Where is Surebound located and how can I speak with an advisor?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        Surebound Insurance is headquartered in downtown Tampa at 100 N Tampa St, Suite 2500, Tampa, FL 33602. You can call our office directly at <strong>(813) 214-1731</strong> Monday through Friday from 8:30 AM to 5:30 PM EST, or submit an inquiry through our <a href="{{ route('contact') }}" style="color: #1e3a8a; text-decoration: underline;">contact form</a>.
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
                <h2>Have a question not listed here?</h2>
                <p>Call our licensed Tampa advisors directly at (813) 214-1731 or request a consultation.</p>
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
