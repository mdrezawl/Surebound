@extends('layouts.app')

@section('title', 'Make a Payment – Policy Billing & Carrier Portals | Surebound')
@section('meta_description', 'Pay your insurance premium online. Access direct carrier bill-pay portals, client account billing, and agency payment assistance in Tampa, FL.')

@section('content')

    <!-- ==========================================
         HERO SECTION
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/hero-business.jpg') }}" 
                alt="Make an Insurance Payment" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'POLICY BILLING &amp; PAYMENTS' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Convenient &amp; Secure<br>Payment Options' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Pay your premium directly through your underwriting carrier\'s secure billing portal, access your Surebound client account, or contact our Tampa office for billing support.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#carrier-pay" class="btn-primary-hero">
                        <span>Pay Carrier Direct &rarr;</span>
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
        </div>
    </section>

    <!-- ==========================================
         PAYMENT METHODS EXPLANATION
         ========================================== -->
    <section class="coverage-section" id="payment-options">
        <div class="container">
            <p class="section-eyebrow">BILLING CHANNELS</p>
            <h2 class="section-title">How to Pay Your Premium</h2>
            <p class="section-subtitle">Depending on how your policy is structured, you can pay directly to your insurance carrier or through our client portal.</p>
            
            <div class="coverage-cards-grid">
                <!-- 1. Direct Carrier Bill Pay -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Carrier Direct Bill</h3>
                        <p class="coverage-card-desc">Most policies are billed directly by the insurance company. Pay instantly online, set up carrier AutoPay, or pay by phone with your carrier.</p>
                        <a href="#carrier-pay" style="display: inline-block; margin-top: 12px; color: #1e3a8a; font-weight: 600; text-decoration: underline;">View Carrier Portals &darr;</a>
                    </div>
                </div>

                <!-- 2. Client Portal Pay -->
                <div class="coverage-card" onclick="window.location.href='{{ route('login') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Surebound Client Portal</h3>
                        <p class="coverage-card-desc">Log into your Surebound account to view active policies, download invoices, review billing statements, and submit payments.</p>
                        <span style="display: inline-block; margin-top: 12px; color: #2563eb; font-weight: 600;">Client Login &rarr;</span>
                    </div>
                </div>

                <!-- 3. Mortgage Escrow & Agency Assistance -->
                <div class="coverage-card" onclick="window.location.href='tel:8132141731'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Escrow &amp; Agency Help</h3>
                        <p class="coverage-card-desc">Changing lenders or need mortgage escrow updates? Call our Tampa team at (813) 214-1731 for fast billing coordination.</p>
                        <span style="display: inline-block; margin-top: 12px; color: #1e3a8a; font-weight: 600;">(813) 214-1731 &rarr;</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         CARRIER BILL-PAY DIRECTORY
         ========================================== -->
    <section class="coverage-section" id="carrier-pay" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
        <div class="container">
            <p class="section-eyebrow">DIRECT CARRIER PAYMENTS</p>
            <h2 class="section-title">Insurance Carrier Bill-Pay Directory</h2>
            <p class="section-subtitle">Have your policy number and billing account number ready from your invoice or declarations page.</p>

            <div class="coverage-cards-grid">
                <!-- Travelers -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <h3 class="coverage-card-title">Travelers Insurance</h3>
                        <p class="coverage-card-desc">Pay online or enroll in AutoPay via the Travelers customer portal.</p>
                        <div style="margin-top: 12px; font-size: 14px;">
                            <div>Phone: <a href="tel:18008425075" style="color: #1e3a8a; font-weight: 600;">1-800-842-5075</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.travelers.com/pay-my-bill" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">travelers.com/pay-my-bill &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- Progressive -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <h3 class="coverage-card-title">Progressive</h3>
                        <p class="coverage-card-desc">Pay with credit card, debit, or checking account without logging in.</p>
                        <div style="margin-top: 12px; font-size: 14px;">
                            <div>Phone: <a href="tel:18008765036" style="color: #1e3a8a; font-weight: 600;">1-800-876-5036</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.progressive.com/manage-policy/make-a-payment/" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">progressive.com/make-a-payment &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- Liberty Mutual -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <h3 class="coverage-card-title">Liberty Mutual</h3>
                        <p class="coverage-card-desc">Quick pay option by policy number or manage AutoPay preferences.</p>
                        <div style="margin-top: 12px; font-size: 14px;">
                            <div>Phone: <a href="tel:18002908711" style="color: #1e3a8a; font-weight: 600;">1-800-290-8711</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.libertymutual.com/customer-support/billing-and-payments" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">libertymutual.com/billing &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- The Hartford -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <h3 class="coverage-card-title">The Hartford</h3>
                        <p class="coverage-card-desc">Commercial business and personal lines billing management.</p>
                        <div style="margin-top: 12px; font-size: 14px;">
                            <div>Phone: <a href="tel:18664678730" style="color: #1e3a8a; font-weight: 600;">1-866-467-8730</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.thehartford.com/pay-bill" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">thehartford.com/pay-bill &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- Nationwide -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <h3 class="coverage-card-title">Nationwide</h3>
                        <p class="coverage-card-desc">Single one-time bill payment or recurring payment profile.</p>
                        <div style="margin-top: 12px; font-size: 14px;">
                            <div>Phone: <a href="tel:18002821446" style="color: #1e3a8a; font-weight: 600;">1-800-282-1446</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.nationwide.com/personal/insurance/payments/" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">nationwide.com/payments &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- Citizens Property -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <h3 class="coverage-card-title">Citizens Property Insurance</h3>
                        <p class="coverage-card-desc">Florida property insurance premium payments and policy renewals.</p>
                        <div style="margin-top: 12px; font-size: 14px;">
                            <div>Phone: <a href="tel:18664112742" style="color: #1e3a8a; font-weight: 600;">1-866-411-2742</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.citizensfla.com/online-payments" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">citizensfla.com/online-payments &rarr;</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         GRACE PERIOD & IMPORTANT NOTICE
         ========================================== -->
    <section class="claims-notice-section" style="padding: 40px 0; background-color: #f1f5f9; border-top: 1px solid #cbd5e1; border-bottom: 1px solid #cbd5e1;">
        <div class="container">
            <div style="background: #ffffff; border-left: 4px solid #eab308; border-radius: 8px; padding: 24px 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.04);">
                <h3 style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0 0 8px 0;">Notice Regarding Payment Due Dates &amp; Grace Periods</h3>
                <p style="font-size: 14px; color: #475569; line-height: 1.6; margin: 0 0 8px 0;">
                    Payment grace periods typically range from <strong>10 to 30 days</strong>, but vary depending on the insurance carrier, policy type, and governing Florida regulations. Payments received after the expiration of a carrier's statutory grace period are subject to cancellation for non-payment, which may leave you without coverage or require reinstatement underwriting fees.
                </p>
                <p style="font-size: 14px; color: #64748b; line-height: 1.5; margin: 0;">
                    If you anticipate a billing difficulty or need to adjust your payment schedule, please contact our Tampa agency office at <strong>(813) 214-1731</strong> or contact your carrier prior to your cancellation effective date.
                </p>
            </div>
        </div>
    </section>

    <!-- ==========================================
         BOTTOM CTA BANNER
         ========================================== -->
    <section class="cta-banner-section">
        <div class="container">
            <div class="cta-text-wrap">
                <h2>Have questions about your bill or escrow account?</h2>
                <p>Our Tampa team is here to assist you Monday through Friday from 8:30 AM to 5:30 PM EST.</p>
            </div>
            <div class="cta-button-group">
                <a href="tel:8132141731" class="btn-cta-white">
                    <span>Call (813) 214-1731</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}" class="btn-cta-transparent">
                    <span>Contact Agency Team</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

@endsection
