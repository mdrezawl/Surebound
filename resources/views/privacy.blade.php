@extends('layouts.app')

@section('title', 'Privacy & Data Protection Policy | Surebound Insurance Services')

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
            <span style="color:#ffffff;">Privacy Policy</span>
        </div>
        <div class="legal-badge">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
            </svg>
            Data Privacy &amp; GLBA Security Compliance
        </div>
        <h1 class="legal-title">Privacy &amp; Security Policy</h1>
        <p class="legal-subtitle">
            At Surebound Insurance Services, safeguarding your personal data, identity, and underwriting information is an uncompromised commitment. Discover how we protect, process, and respect your privacy rights.
        </p>
        <div class="legal-meta-row">
            <div class="legal-meta-item">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Last Updated:</strong> October 2026</span>
            </div>
            <div class="legal-meta-item">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Gramm-Leach-Bliley Act (GLBA)</strong> Compliant</span>
            </div>
            <div class="legal-meta-item">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span><strong>Zero-Sale Policy:</strong> We never sell personal data</span>
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
                    <li><a href="#sec-overview" class="legal-toc-link">1. Policy Overview &amp; Scope</a></li>
                    <li><a href="#sec-collection" class="legal-toc-link">2. Information We Collect</a></li>
                    <li><a href="#sec-usage" class="legal-toc-link">3. How Information Is Used</a></li>
                    <li><a href="#sec-sharing" class="legal-toc-link">4. Sharing &amp; Third-Party Disclosures</a></li>
                    <li><a href="#sec-security" class="legal-toc-link">5. Data Safeguards &amp; Encryption</a></li>
                    <li><a href="#sec-rights" class="legal-toc-link">6. Your Rights &amp; Preferences</a></li>
                    <li><a href="#sec-cookies" class="legal-toc-link">7. Cookies &amp; Tracking</a></li>
                    <li><a href="#sec-contact" class="legal-toc-link">8. Contact Our Privacy Officer</a></li>
                </ul>

                <div class="legal-contact-callout">
                    <h4>Direct Privacy Inquiries</h4>
                    <p>Have questions regarding our security protocols or your policy records?</p>
                    <a href="tel:+18132141731">📞 +1 813-214-1731</a><br>
                    <a href="mailto:compliance@surebound.com" style="margin-top:4px; display:inline-block;">✉️ compliance@surebound.com</a>
                </div>
            </aside>

            <!-- Right: Detailed Content -->
            <main class="legal-content-card">
                <!-- Section 1 -->
                <section class="legal-section" id="sec-overview">
                    <h2><span class="sec-num">1</span> Policy Overview &amp; Scope</h2>
                    <p>
                        Surebound Insurance Services and its operating affiliates ("Surebound", "we", "us", or "our") provide personal, commercial, and specialty insurance brokerage, risk consultation, and underwriting administration. This Privacy Policy governs the collection, use, maintenance, and disclosure of information gathered from clients, prospective policyholders, and visitors across our digital portals, web properties, and offline communication channels.
                    </p>
                    <p>
                        We operate under strict compliance with the federal <strong>Gramm-Leach-Bliley Act (15 U.S.C. § 6801 et seq.)</strong>, state insurance department regulations, the California Consumer Privacy Act (CCPA/CPRA), and relevant state data privacy statutes.
                    </p>
                    <div class="legal-notice-box">
                        <h4>Our Fundamental Pledge to You</h4>
                        <p>Surebound does not, has never, and will never sell, lease, or monetize your non-public personal information (NPI) to third-party direct marketers, data brokers, or advertising networks.</p>
                    </div>
                </section>

                <!-- Section 2 -->
                <section class="legal-section" id="sec-collection">
                    <h2><span class="sec-num">2</span> Information We Collect</h2>
                    <p>
                        In order to provide accurate rate quotes, bind policies, underwrite risk factors, manage claims, and process premium billing, we collect non-public personal information from the following categories:
                    </p>
                    <ul>
                        <li><strong>Personal Identifiers:</strong> Legal full name, residential and business addresses, date of birth, Social Security Number (SSN), Employer Identification Number (EIN), driver’s license number, email address, and phone numbers.</li>
                        <li><strong>Underwriting &amp; Property Details:</strong> Physical properties, vehicle identification numbers (VIN), property square footage, fire protection class, construction type, prior insurance loss history, and credit-based insurance risk scores where permitted by state law.</li>
                        <li><strong>Financial &amp; Billing Data:</strong> Bank account numbers (ACH), debit/credit card details, payment history, and policy financing arrangements.</li>
                        <li><strong>Claims &amp; Incident Information:</strong> Photos, police reports, medical payment reports, loss estimates, recorded statements, and legal correspondence regarding insurance claims.</li>
                        <li><strong>Technical &amp; Portal Information:</strong> IP addresses, browser specifications, login timestamps, device metadata, and interaction events logged in our policyholder portal.</li>
                    </ul>
                </section>

                <!-- Section 3 -->
                <section class="legal-section" id="sec-usage">
                    <h2><span class="sec-num">3</span> How We Utilize Your Information</h2>
                    <p>
                        All gathered data is strictly applied toward legitimate insurance, underwriting, and policyholder service functions, including:
                    </p>
                    <ul>
                        <li>Generating competitive quote estimates and evaluating insurable risk profile suitability.</li>
                        <li>Binding, issuing, amending, and renewing insurance policies with appointed carrier underwriters.</li>
                        <li>Investigating, adjusting, and resolving insurance claims with prompt fair settlements.</li>
                        <li>Processing premium payments, setting up automated recurring billing, and issuing official invoices.</li>
                        <li>Complying with statutory reporting requirements established by State Insurance Commissioners, state DMVs, and the National Association of Insurance Commissioners (NAIC).</li>
                        <li>Preventing financial crimes, identity theft, and fraudulent insurance transactions.</li>
                    </ul>
                </section>

                <!-- Section 4 -->
                <section class="legal-section" id="sec-sharing">
                    <h2><span class="sec-num">4</span> Information Sharing &amp; Third-Party Disclosures</h2>
                    <p>
                        We do not disclose non-public personal information about our current or former customers to anyone, except as permitted or required by law. Routine disclosures necessary to maintain your coverage include:
                    </p>
                    <ul>
                        <li><strong>Appointed Insurance Carriers &amp; Reinsurers:</strong> Underwriting syndicates and insurance carriers who evaluate risk, issue binders, and back policy coverages.</li>
                        <li><strong>Claims Adjusters &amp; Independent Investigators:</strong> Third-party administrators, loss adjusters, repair shops, and legal counsel working directly on active claims.</li>
                        <li><strong>Financial Institutions &amp; Processors:</strong> PCI-DSS compliant credit card processors, Plaid, and ACH payment gateways for secure premium execution.</li>
                        <li><strong>Regulatory &amp; Law Enforcement Bodies:</strong> State departments of insurance, subpoenaed court orders, or mandatory anti-fraud auditing agencies.</li>
                    </ul>
                </section>

                <!-- Section 5 -->
                <section class="legal-section" id="sec-security">
                    <h2><span class="sec-num">5</span> Data Safeguards &amp; Enterprise Encryption</h2>
                    <p>
                        Surebound maintains industry-leading technical, administrative, and physical safeguards designed to guarantee the confidentiality and integrity of your sensitive records:
                    </p>
                    <ul>
                        <li><strong>256-Bit SSL/TLS Encryption:</strong> All data transmissions across our public website, portals, and payment gateways are shielded using high-grade end-to-end encryption.</li>
                        <li><strong>Role-Based Access Controls:</strong> Access to policyholder records is strictly limited to credentialed advisors and underwriters on a least-privilege, need-to-know basis.</li>
                        <li><strong>Audited Infrastructure:</strong> Regular vulnerability scanning, penetration assessments, and encrypted offsite backups protected against unauthorized access.</li>
                    </ul>
                </section>

                <!-- Section 6 -->
                <section class="legal-section" id="sec-rights">
                    <h2><span class="sec-num">6</span> Your Rights &amp; Policyholder Preferences</h2>
                    <p>
                        Depending on your state of residence, you may possess specific legal rights concerning your personal information:
                    </p>
                    <ul>
                        <li><strong>Right to Inspect &amp; Correct:</strong> You have the right to review non-public personal information stored in your file and request corrections to any inaccuracies.</li>
                        <li><strong>Communication Preferences:</strong> You can opt out of promotional newsletters or policy advisory communications at any time while continuing to receive essential legal, billing, and claims notices.</li>
                        <li><strong>California &amp; State Specific Disclosures:</strong> California residents can submit verified consumer requests under the CCPA/CPRA to access or delete personal records not retained under statutory insurance record-keeping mandates.</li>
                    </ul>
                </section>

                <!-- Section 7 -->
                <section class="legal-section" id="sec-cookies">
                    <h2><span class="sec-num">7</span> Cookies &amp; Digital Tracking</h2>
                    <p>
                        Our websites utilize session and persistent cookies to remember your portal authentication state, ensure form security (CSRF protection), and analyze anonymous site performance trends. You may disable cookies through your browser settings, though doing so may impact interactive portal capabilities.
                    </p>
                </section>

                <!-- Section 8 -->
                <section class="legal-section" id="sec-contact">
                    <h2><span class="sec-num">8</span> Contact Our Privacy Officer</h2>
                    <p>
                        If you have questions, privacy requests, or wish to exercise your rights under this policy, please reach our dedicated compliance team:
                    </p>
                    <div class="legal-notice-box" style="background:#f8faff; border-color:#d7e4fa;">
                        <h4>Surebound Compliance &amp; Regulatory Affairs</h4>
                        <p style="margin-bottom:6px;"><strong>Agency:</strong> Surebound Insurance Services LLC</p>
                        <p style="margin-bottom:6px;"><strong>Toll-Free Client Advisory:</strong> <a href="tel:+18132141731" style="color:#0b57d0; font-weight:700;">+1 813-214-1731</a></p>
                        <p style="margin-bottom:6px;"><strong>Email:</strong> <a href="mailto:compliance@surebound.com" style="color:#0b57d0;">compliance@surebound.com</a></p>
                        <p style="margin-bottom:0;"><strong>Physical Address:</strong> 100 North Tampa Street, Suite 2400, Tampa, FL 33602</p>
                    </div>
                </section>
            </main>
        </div>
    </div>
</div>
@endsection
