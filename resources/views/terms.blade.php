@extends('layouts.app')

@section('title', 'Terms of Service & Policyholder Agreement | Surebound Insurance Services')

@section('content')
<style>
    .legal-hero {
        background: linear-gradient(135deg, #011638 0%, #032b69 60%, #0a449b 100%);
        color: #ffffff;
        padding: 60px 0 50px;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid rgba(255,255,255,0.12);
    }
    .legal-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 80% 20%, rgba(26, 115, 232, 0.25) 0%, transparent 60%);
        pointer-events: none;
    }
    .legal-breadcrumbs {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13.5px;
        color: #9cb5db;
        margin-bottom: 16px;
    }
    .legal-breadcrumbs a {
        color: #c4d7f5;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .legal-breadcrumbs a:hover {
        color: #ffffff;
        text-decoration: underline;
    }
    .legal-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.22);
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #70b4ff;
        margin-bottom: 14px;
    }
    .legal-title {
        font-family: var(--font-headline, "Outfit", sans-serif);
        font-size: clamp(30px, 3.6vw, 44px);
        font-weight: 800;
        line-height: 1.15;
        color: #ffffff;
        margin: 0 0 12px 0;
        letter-spacing: -0.02em;
    }
    .legal-subtitle {
        font-size: 16.5px;
        color: #d1e2fc;
        max-width: 780px;
        line-height: 1.6;
        margin: 0 0 20px 0;
    }
    .legal-meta-row {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        font-size: 13px;
        color: #a6c4ec;
        padding-top: 10px;
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    .legal-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .legal-meta-item svg {
        color: #38ef7d;
        flex-shrink: 0;
    }

    .legal-body-wrap {
        background-color: #f6f8fc;
        padding: 55px 0 80px;
    }
    .legal-grid {
        display: grid;
        grid-template-columns: 290px 1fr;
        gap: 36px;
        align-items: flex-start;
    }
    .legal-sidebar {
        position: sticky;
        top: 95px;
        background: #ffffff;
        border: 1px solid #e1e7f0;
        border-radius: 14px;
        padding: 22px;
        box-shadow: 0 6px 20px rgba(7, 30, 84, 0.05);
    }
    .legal-sidebar-title {
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #032b69;
        margin: 0 0 14px 0;
        padding-bottom: 10px;
        border-bottom: 2px solid #ebf1fa;
    }
    .legal-toc-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .legal-toc-link {
        display: block;
        padding: 8px 12px;
        font-size: 13.5px;
        color: #435472;
        text-decoration: none;
        border-radius: 8px;
        line-height: 1.4;
        transition: all 0.2s ease;
    }
    .legal-toc-link:hover {
        background-color: #eef4fe;
        color: #0b57d0;
        padding-left: 15px;
    }

    .legal-contact-callout {
        margin-top: 20px;
        padding: 16px;
        background: #edf4fe;
        border-radius: 10px;
        border-left: 3px solid #0b57d0;
    }
    .legal-contact-callout h4 {
        margin: 0 0 6px;
        font-size: 14px;
        color: #032b69;
        font-weight: 700;
    }
    .legal-contact-callout p {
        font-size: 12.5px;
        color: #4a5d7c;
        line-height: 1.5;
        margin: 0 0 10px;
    }
    .legal-contact-callout a {
        font-size: 12.5px;
        font-weight: 700;
        color: #0b57d0;
        text-decoration: none;
    }

    .legal-content-card {
        background: #ffffff;
        border: 1px solid #e1e7f0;
        border-radius: 14px;
        padding: 42px 48px;
        box-shadow: 0 6px 20px rgba(7, 30, 84, 0.05);
        color: #2b3952;
    }
    .legal-section {
        margin-bottom: 42px;
        padding-bottom: 34px;
        border-bottom: 1px solid #eef2f7;
    }
    .legal-section:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    .legal-section h2 {
        font-family: var(--font-headline, "Outfit", sans-serif);
        font-size: 22px;
        font-weight: 700;
        color: #032b69;
        margin: 0 0 16px 0;
        line-height: 1.3;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .legal-section h2 .sec-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background: #e7effc;
        color: #0b57d0;
        font-size: 13px;
        font-weight: 800;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .legal-section p {
        font-size: 15px;
        line-height: 1.75;
        color: #4a5872;
        margin: 0 0 16px 0;
    }
    .legal-section ul {
        margin: 0 0 18px 20px;
        padding: 0;
    }
    .legal-section li {
        font-size: 14.5px;
        line-height: 1.7;
        color: #4a5872;
        margin-bottom: 8px;
    }
    .legal-section strong {
        color: #0a2540;
    }
    .legal-notice-box {
        background: #f4f8ff;
        border: 1px solid #cce0ff;
        border-left: 4px solid #0b57d0;
        border-radius: 10px;
        padding: 18px 22px;
        margin: 20px 0;
    }
    .legal-notice-box h4 {
        margin: 0 0 6px 0;
        color: #032b69;
        font-size: 15px;
        font-weight: 700;
    }
    .legal-notice-box p {
        margin: 0;
        font-size: 14px;
        color: #3b5072;
        line-height: 1.6;
    }

    @media (max-width: 991px) {
        .legal-grid {
            grid-template-columns: 1fr;
        }
        .legal-sidebar {
            position: relative;
            top: 0;
        }
        .legal-content-card {
            padding: 30px 24px;
        }
    }
</style>

<div class="legal-hero">
    <div class="container">
        <div class="legal-breadcrumbs">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <span>Legal</span>
            <span>/</span>
            <span style="color:#ffffff;">Terms of Service</span>
        </div>
        <div class="legal-badge">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            Underwriting &amp; Agency Agreement
        </div>
        <h1 class="legal-title">Terms of Service</h1>
        <p class="legal-subtitle">
            Please read these terms and conditions carefully. They govern your use of Surebound's digital platforms, insurance quote engines, policyholder accounts, and customer portals.
        </p>
        <div class="legal-meta-row">
            <div class="legal-meta-item">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Last Updated:</strong> October 2026</span>
            </div>
            <div class="legal-meta-item">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>ESIGN &amp; UETA</strong> Compliant Digital Agreements</span>
            </div>
            <div class="legal-meta-item">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Licensed Independent Agency</strong> Across the US</span>
            </div>
        </div>
    </div>
</div>

<div class="legal-body-wrap">
    <div class="container">
        <div class="legal-grid">
            <!-- Left: Table of Contents -->
            <aside class="legal-sidebar">
                <h3 class="legal-sidebar-title">Contents</h3>
                <ul class="legal-toc-list">
                    <li><a href="#sec-acceptance" class="legal-toc-link">1. Acceptance of Terms</a></li>
                    <li><a href="#sec-agency" class="legal-toc-link">2. Agency Relationship &amp; Quotes</a></li>
                    <li><a href="#sec-accuracy" class="legal-toc-link">3. Applicant Truthfulness &amp; Duty</a></li>
                    <li><a href="#sec-payments" class="legal-toc-link">4. Billing &amp; Premium Execution</a></li>
                    <li><a href="#sec-claims" class="legal-toc-link">5. Claims Notification &amp; Loss Duty</a></li>
                    <li><a href="#sec-portal" class="legal-toc-link">6. User Accounts &amp; Portal Security</a></li>
                    <li><a href="#sec-esign" class="legal-toc-link">7. Electronic Signatures &amp; Notices</a></li>
                    <li><a href="#sec-liability" class="legal-toc-link">8. Limitation of Liability</a></li>
                    <li><a href="#sec-law" class="legal-toc-link">9. Governing Law &amp; Arbitration</a></li>
                </ul>

                <div class="legal-contact-callout">
                    <h4>Legal &amp; Policy Help</h4>
                    <p>Have questions regarding policy binders, terms, or underwriting conditions?</p>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteContact['primary_phone'] ?? '+1 813-214-1731') }}">📞 {{ $siteContact['primary_phone'] ?? '+1 813-214-1731' }}</a><br>
                    <a href="mailto:{{ $siteContact['support_email'] ?? 'support@surebound.com' }}" style="margin-top:4px; display:inline-block;">✉️ {{ $siteContact['support_email'] ?? 'support@surebound.com' }}</a>
                </div>
            </aside>

            <!-- Right: Detailed Content -->
            <main class="legal-content-card">
                <!-- Section 1 -->
                <section class="legal-section" id="sec-acceptance">
                    <h2><span class="sec-num">1</span> Acceptance of Terms</h2>
                    <p>
                        These Terms of Service ("Terms") constitute a legally binding agreement between you ("User", "Policyholder", or "Applicant") and Surebound Insurance Services LLC ("Surebound", "we", "us", or "our"). By accessing or using our websites, interactive quote engines, payment processing services, customer portal, or engaging with our licensed insurance producers, you acknowledge that you have read, understood, and agree to be bound by these Terms.
                    </p>
                    <p>
                        If you do not agree with any provision of these Terms, you must discontinue the use of our services immediately.
                    </p>
                </section>

                <!-- Section 2 -->
                <section class="legal-section" id="sec-agency">
                    <h2><span class="sec-num">2</span> Agency Relationship &amp; Nature of Quotes</h2>
                    <p>
                        Surebound operates as an independent insurance agency and broker representing top-rated domestic and international insurance carriers. All rate quotes generated through our online calculators, digital forms, or phone consultations represent preliminary estimates based on the unverified representations provided by the applicant.
                    </p>
                    <div class="legal-notice-box">
                        <h4>Important Binder &amp; Coverage Notice</h4>
                        <p>A quote does not constitute an offer of coverage, an insurance binder, or an executed contract of insurance. Coverage is bound and effective ONLY when an underwriting carrier formally approves the application, appropriate down payment is received, and an official Written Policy Binder or Declarations Page is issued by Surebound.</p>
                    </div>
                </section>

                <!-- Section 3 -->
                <section class="legal-section" id="sec-accuracy">
                    <h2><span class="sec-num">3</span> Applicant Truthfulness &amp; Duty of Good Faith</h2>
                    <p>
                        Insurance contracts are contracts of utmost good faith (<em>uberrimae fidei</em>). You agree that all information supplied during the quote request, application process, and policy term—including vehicle registrations, property conditions, claims loss history, driver records, and business payroll figures—is complete, truthful, and accurate to the best of your knowledge.
                    </p>
                    <p>
                        Providing false, incomplete, or misleading information may result in premium adjustments, retroactive cancellation of coverage, denial of claims, or prosecution under state insurance anti-fraud statutes.
                    </p>
                </section>

                <!-- Section 4 -->
                <section class="legal-section" id="sec-payments">
                    <h2><span class="sec-num">4</span> Billing, Invoices &amp; Premium Execution</h2>
                    <p>
                        Policyholders are responsible for timely payment of all insurance premiums, policy fees, and statutory state surcharges according to the agreed payment schedule (annual, semi-annual, quarterly, or monthly installments).
                    </p>
                    <ul>
                        <li><strong>Payment Methods:</strong> We accept ACH bank transfers, debit cards, major credit cards (Visa, MasterCard, Amex, Discover), and wire transfers.</li>
                        <li><strong>Late Payments &amp; Cancellation:</strong> Failure to submit premium payments prior to the statutory grace period expiration may trigger a formal Notice of Cancellation for Non-Payment in accordance with applicable state insurance regulations.</li>
                        <li><strong>Automated Renewals:</strong> If enrolled in automatic payment plans, your designated payment method will be charged on your regular billing cycle unless you provide written cancellation notice.</li>
                    </ul>
                </section>

                <!-- Section 5 -->
                <section class="legal-section" id="sec-claims">
                    <h2><span class="sec-num">5</span> Claims Notification &amp; Policyholder Duty</h2>
                    <p>
                        In the event of a covered loss, auto accident, property damage, bodily injury, or legal lawsuit:
                    </p>
                    <ul>
                        <li>You must provide prompt written or telephonic notice to Surebound or directly to the underwriting carrier's claims department.</li>
                        <li>You have a legal duty to take reasonable precautions to mitigate further damage or loss.</li>
                        <li>You must cooperate fully with claims investigators, provide requested documentation (photos, receipts, police reports), and submit to examination under oath where required by your policy contract.</li>
                    </ul>
                </section>

                <!-- Section 6 -->
                <section class="legal-section" id="sec-portal">
                    <h2><span class="sec-num">6</span> User Accounts &amp; Portal Security</h2>
                    <p>
                        When creating an account on the Surebound Client Portal or Agent Portal, you are responsible for maintaining the strict confidentiality of your username and password. You agree to immediately notify Surebound of any unauthorized access, compromised credentials, or security incidents affecting your account.
                    </p>
                </section>

                <!-- Section 7 -->
                <section class="legal-section" id="sec-esign">
                    <h2><span class="sec-num">7</span> Electronic Signatures &amp; Digital Document Consent</h2>
                    <p>
                        Under the federal Electronic Signatures in Global and National Commerce Act (ESIGN, 15 U.S.C. § 7001) and the Uniform Electronic Transactions Act (UETA), you consent to conduct business electronically with Surebound. Your digital signature, checkbox confirmations, and electronic submission of applications carry the same legal weight as a handwritten signature.
                    </p>
                </section>

                <!-- Section 8 -->
                <section class="legal-section" id="sec-liability">
                    <h2><span class="sec-num">8</span> Limitation of Liability &amp; Disclaimers</h2>
                    <p>
                        Our websites, tools, and calculators are provided on an "as is" and "as available" basis without express or implied warranties. In no event shall Surebound, its directors, officers, or appointed producers be liable for indirect, punitive, or consequential damages resulting from website disruptions, telecommunications failures, or transmission errors beyond our reasonable control.
                    </p>
                </section>

                <!-- Section 9 -->
                <section class="legal-section" id="sec-law">
                    <h2><span class="sec-num">9</span> Governing Law &amp; Dispute Resolution</h2>
                    <p>
                        These Terms and any insurance advisory relationship are governed by the substantive laws of the State of Florida and applicable federal statutes, without regard to conflict of law principles. Any dispute arising out of these Terms shall be resolved in the state or federal courts located in Hillsborough County, Florida, or through binding American Arbitration Association (AAA) commercial arbitration where mutually agreed.
                    </p>
                    <div class="legal-notice-box" style="background:#f8faff; border-color:#d7e4fa;">
                        <h4>Questions Regarding These Terms?</h4>
                        <p style="margin-bottom:6px;"><strong>Agency:</strong> Surebound Insurance Services LLC</p>
                        <p style="margin-bottom:6px;"><strong>Advisory Phone:</strong> <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteContact['primary_phone'] ?? '+1 813-214-1731') }}" style="color:#0b57d0; font-weight:700;">{{ $siteContact['primary_phone'] ?? '+1 813-214-1731' }}</a></p>
                        <p style="margin-bottom:6px;"><strong>Email:</strong> <a href="mailto:{{ $siteContact['support_email'] ?? 'support@surebound.com' }}" style="color:#0b57d0;">{{ $siteContact['support_email'] ?? 'support@surebound.com' }}</a></p>
                        <p style="margin-bottom:0;"><strong>Corporate Address:</strong> {{ $siteContact['hq_address'] ?? '100 North Tampa Street, Suite 2400, Tampa, FL 33602' }}</p>
                    </div>
                </section>
            </main>
        </div>
    </div>
</div>
@endsection
