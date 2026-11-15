@extends('layouts.app')

@section('title', 'Claims Center – File & Track Insurance Claims | Surebound')
@section('meta_description', 'Need to file an insurance claim? Access direct 24/7 carrier claim hotlines, portals, step-by-step guidance, and local agency advocacy from Surebound Insurance in Tampa, FL.')

@section('content')

    <!-- ==========================================
         HERO SECTION
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/claims_hero.jpg') }}" 
                alt="Surebound Insurance Claims Center in Tampa" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'SUREBOUND CLAIMS CENTER' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Fast, Fair &amp; Transparent<br>Claims Assistance' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Experiencing a loss is stressful. For immediate 24/7 emergency response, file directly with your underwriting carrier below, or connect with our Tampa agency team for personalized claims advocacy.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#carrier-directory" class="btn-primary-hero">
                        <span>Find Your Carrier &rarr;</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <a href="tel:8132141731" class="btn-outline-hero">
                        <span>Call Agency: (813) 214-1731</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">Fastest Resolution</span>
                        <span class="hero-card-label">Direct Carrier FNOL</span>
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
         FIRST NOTICE OF LOSS (FNOL) GUIDANCE NOTICE
         ========================================== -->
    <section class="claims-notice-section" style="padding: 40px 0; background-color: #f1f5f9; border-bottom: 1px solid #cbd5e1;">
        <div class="container">
            <div style="background: #ffffff; border-left: 4px solid #1e3a8a; border-radius: 8px; padding: 24px 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: flex-start; gap: 16px;">
                    <div style="flex-shrink: 0; color: #1e3a8a;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="32" height="32">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                    </div>
                    <div>
                        <h2 style="font-size: 20px; font-weight: 700; color: #0f172a; margin: 0 0 8px 0;">How Claims Work: File Directly with Your Carrier First</h2>
                        <p style="font-size: 15px; color: #475569; line-height: 1.6; margin: 0 0 12px 0;">
                            As an independent insurance agency, Surebound places your coverage with premier national and regional insurance carriers. <strong>For the fastest possible claim handling, emergency property mitigation, and vehicle towing, report your loss directly to your insurance carrier's 24/7 hotline or portal.</strong>
                        </p>
                        <p style="font-size: 14px; color: #64748b; line-height: 1.5; margin: 0;">
                            Your policy declarations page lists your underwriting company. Once you have filed your First Notice of Loss (FNOL) and received a claim number, our local Tampa advisors are available at <strong>(813) 214-1731</strong> to assist with any questions or claims advocacy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         CARRIER CLAIMS DIRECTORY
         ========================================== -->
    <section class="coverage-section" id="carrier-directory">
        <div class="container">
            <p class="section-eyebrow">24/7 DIRECT CARRIER HOTLINES</p>
            <h2 class="section-title">Insurance Carrier Claims Directory</h2>
            <p class="section-subtitle">Select your carrier below to file a claim online or call their 24/7 claims dispatch department.</p>

            <div class="coverage-cards-grid">
                <!-- Travelers -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Travelers Insurance</h3>
                        <p class="coverage-card-desc">Personal home, auto, and commercial property &amp; casualty claims.</p>
                        <div style="margin-top: 14px; font-size: 14px; color: #1e3a8a; font-weight: 600;">
                            <div>Phone: <a href="tel:18002524633" style="color: #1e3a8a; text-decoration: underline;">1-800-252-4633</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.travelers.com/claims" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">travelers.com/claims &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- Progressive -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Progressive</h3>
                        <p class="coverage-card-desc">Personal auto, commercial auto, motorcycle, and boat claims.</p>
                        <div style="margin-top: 14px; font-size: 14px; color: #1e3a8a; font-weight: 600;">
                            <div>Phone: <a href="tel:18007764737" style="color: #1e3a8a; text-decoration: underline;">1-800-776-4737</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.progressive.com/claims" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">progressive.com/claims &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- Liberty Mutual -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Liberty Mutual</h3>
                        <p class="coverage-card-desc">Homeowners, personal vehicle, and commercial business lines.</p>
                        <div style="margin-top: 14px; font-size: 14px; color: #1e3a8a; font-weight: 600;">
                            <div>Phone: <a href="tel:18002252467" style="color: #1e3a8a; text-decoration: underline;">1-800-225-2467</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.libertymutual.com/claims" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">libertymutual.com/claims &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- The Hartford -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.75c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">The Hartford</h3>
                        <p class="coverage-card-desc">Commercial property, general liability, and business owners policies.</p>
                        <div style="margin-top: 14px; font-size: 14px; color: #1e3a8a; font-weight: 600;">
                            <div>Phone: <a href="tel:18003273636" style="color: #1e3a8a; text-decoration: underline;">1-800-327-3636</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.thehartford.com/claims" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">thehartford.com/claims &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- Nationwide -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Nationwide</h3>
                        <p class="coverage-card-desc">Personal insurance lines and commercial business enterprise claims.</p>
                        <div style="margin-top: 14px; font-size: 14px; color: #1e3a8a; font-weight: 600;">
                            <div>Phone: <a href="tel:18004213535" style="color: #1e3a8a; text-decoration: underline;">1-800-421-3535</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.nationwide.com/personal/insurance/claims/" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">nationwide.com/claims &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- Citizens Property Insurance -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Citizens Property Insurance</h3>
                        <p class="coverage-card-desc">Florida residential and commercial property wind &amp; hurricane claims.</p>
                        <div style="margin-top: 14px; font-size: 14px; color: #1e3a8a; font-weight: 600;">
                            <div>Phone: <a href="tel:18664112742" style="color: #1e3a8a; text-decoration: underline;">1-866-411-2742</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.citizensfla.com/claims" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">citizensfla.com/claims &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- Florida Peninsula -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Florida Peninsula</h3>
                        <p class="coverage-card-desc">Florida homeowners, condo, and tenant property damage claims.</p>
                        <div style="margin-top: 14px; font-size: 14px; color: #1e3a8a; font-weight: 600;">
                            <div>Phone: <a href="tel:18665499672" style="color: #1e3a8a; text-decoration: underline;">1-866-549-9672</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.floridapeninsula.com" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">floridapeninsula.com &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- Tower Hill -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Tower Hill Insurance</h3>
                        <p class="coverage-card-desc">Florida residential property and commercial insurance claims.</p>
                        <div style="margin-top: 14px; font-size: 14px; color: #1e3a8a; font-weight: 600;">
                            <div>Phone: <a href="tel:18003423407" style="color: #1e3a8a; text-decoration: underline;">1-800-342-3407</a></div>
                            <div style="margin-top: 4px;"><a href="https://www.thig.com/claims" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">thig.com/claims &rarr;</a></div>
                        </div>
                    </div>
                </div>

                <!-- Universal Property -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Universal Property &amp; Casualty</h3>
                        <p class="coverage-card-desc">Homeowners and dwelling fire claims across Florida.</p>
                        <div style="margin-top: 14px; font-size: 14px; color: #1e3a8a; font-weight: 600;">
                            <div>Phone: <a href="tel:18004700599" style="color: #1e3a8a; text-decoration: underline;">1-800-470-0599</a></div>
                            <div style="margin-top: 4px;"><a href="https://universalproperty.com/claims" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">universalproperty.com/claims &rarr;</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         WHAT TO PREPARE BEFORE FILING
         ========================================== -->
    <section class="value-bar-section">
        <div class="container">
            <h2 style="text-align: center; color: #ffffff; font-size: 26px; font-weight: 700; margin-bottom: 8px;">What to Prepare Before Filing a Claim</h2>
            <p style="text-align: center; color: #cbd5e1; font-size: 15px; margin-bottom: 36px; max-width: 650px; margin-left: auto; margin-right: auto;">Having these items ready helps your carrier adjuster process and approve your claim without delay.</p>

            <div class="value-bar-grid">
                <!-- 1 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Policy &amp; Contact Info</h3>
                    <p class="value-item-desc">Your policy number, name of insured, and current phone number where an adjuster can reach you.</p>
                </div>

                <!-- 2 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Date, Time &amp; Location</h3>
                    <p class="value-item-desc">The exact date, approximate time, and address or coordinates where the incident or damage took place.</p>
                </div>

                <!-- 3 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316A2.192 2.192 0 0 0 14.453 3.75h-4.906c-.733 0-1.412.36-1.821.93l-.9.001ZM12 15.75a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Photos &amp; Documentation</h3>
                    <p class="value-item-desc">Clear photographs or video showing all damaged items, structures, or vehicle points of impact.</p>
                </div>

                <!-- 4 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-6-15B2.25 2.25 0 0 0 7.5 6v12.75A2.25 2.25 0 0 0 9.75 21h6a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H9.75Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Reports &amp; Third Parties</h3>
                    <p class="value-item-desc">Police or fire incident report numbers, other driver or property owner names, insurance info, and witness details.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         AGENCY ADVOCACY & SUPPORT
         ========================================== -->
    <section class="simpler-section">
        <div class="container">
            <div class="simpler-grid">
                <div class="simpler-image-frame">
                    <picture>
                        <source srcset="{{ asset('images/advisor-meeting.webp') }}" type="image/webp">
                        <img 
                            src="{{ asset('images/advisor-meeting.png') }}" 
                            alt="Surebound insurance advisors providing claims advocacy in Tampa" 
                            class="simpler-image"
                            loading="lazy"
                        >
                    </picture>
                </div>

                <div class="simpler-content">
                    <p class="simpler-eyebrow">YOUR LOCAL ADVOCATE</p>
                    <h2 class="simpler-title">Surebound Agency Claims Support</h2>
                    <p class="simpler-paragraph">
                        While underwriting carriers inspect damage and issue settlement checks, Surebound acts as your independent advocate throughout the claim lifecycle. If you encounter delays with an adjuster, need policy limit clarification, or require assistance following up on an ongoing file, our Tampa team is here to help.
                    </p>
                    <div style="margin: 20px 0; font-size: 15px; color: #334155; line-height: 1.8;">
                        <div><strong>Office:</strong> 100 N Tampa St, Suite 2500, Tampa, FL 33602</div>
                        <div><strong>Direct Line:</strong> <a href="tel:8132141731" style="color: #1e3a8a; text-decoration: underline;">(813) 214-1731</a></div>
                        <div><strong>Email:</strong> <a href="mailto:support@sureboundinsurance.com" style="color: #1e3a8a; text-decoration: underline;">support@sureboundinsurance.com</a></div>
                        <div><strong>Hours:</strong> Mon – Fri: 8:30 AM – 5:30 PM EST</div>
                    </div>
                    <a href="{{ route('contact') }}" class="btn-learn-more">
                        <span>Send Us a Message</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         FAQ ACCORDION
         ========================================== -->
    <section class="faq-section" id="faqs">
        <div class="container faq-container">
            <p class="section-eyebrow" style="text-align: center;">CLAIMS QUESTIONS</p>
            <h2 class="section-title" style="text-align: center;">Frequently Asked Questions</h2>
            <p class="section-subtitle" style="text-align: center;">Common questions about filing and tracking claims with your carrier.</p>

            <div class="faq-accordion">
                <!-- Q1 -->
                <div class="faq-item active">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Should I file my claim with Surebound or directly with my carrier?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        For the fastest response, file directly with your underwriting carrier's 24/7 hotline or website. Carriers dispatch adjusters, tow trucks, and emergency mitigation crews around the clock. Once filed, notify Surebound with your claim number so we can monitor progress and advocate on your behalf.
                    </div>
                </div>

                <!-- Q2 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>What should I do immediately after property damage or an auto accident?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        Ensure everyone is safe and call 911 if medical help or police documentation is required. Take clear photos and video of all damage before anything is moved or altered. Take reasonable steps to prevent further damage (such as covering broken windows or shutting off main water valves), and save all repair receipts.
                    </div>
                </div>

                <!-- Q3 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>How does a Florida hurricane deductible apply to a property claim?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        Florida hurricane deductibles apply only when damage results from a named storm declared a hurricane by the National Hurricane Center. The deductible is typically a stated percentage (e.g., 2% to 5%) of your dwelling coverage limit. Under Florida law, the hurricane deductible applies on an annual basis rather than per-storm.
                    </div>
                </div>

                <!-- Q4 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Can I choose my own contractor or body repair shop?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        Yes. In the State of Florida, policyholders have the legal right to choose any licensed repair contractor or auto body facility. While carriers may recommend preferred network facilities offering warranty guarantees, you are never obligated to use their shop.
                    </div>
                </div>

                <!-- Q5 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>How long does the carrier have to pay or decide my property claim?</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        Under Florida Statute 627.70131, insurance carriers must acknowledge receipt of a residential property claim within 7 calendar days, begin investigation, and pay or deny the claim within 60 days of receiving a complete proof of loss (subject to statutory exceptions for catastrophic weather declarations).
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
                <h2>Need assistance with an ongoing claim?</h2>
                <p>Speak directly with our Tampa insurance advisory team during regular business hours.</p>
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
