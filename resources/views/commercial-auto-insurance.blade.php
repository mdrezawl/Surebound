@extends('layouts.app')

@section('title', 'Commercial Auto Insurance – Fleet & Business Vehicle Protection | Surebound')

@section('content')

    <!-- ==========================================
         HERO SECTION (COMMERCIAL AUTO & FLEET)
         ========================================== -->
    <section class="hero-section">
        <!-- Right side full bleed photo with seamless alpha mask & right royal blue gradient -->
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/hero-commercial-auto.jpg') }}" 
                alt="Comprehensive Commercial Auto and Fleet Insurance" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'COMMERCIAL AUTO &amp; FLEET INSURANCE' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Total Protection for Every<br>Vehicle, Driver &amp; Mile' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'From single service vans to heavy commercial fleets, Surebound delivers customizable liability, collision, cargo, and telematics-powered safety coverage built to keep your business moving forward.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#fleet-quote-calculator" class="btn-primary-hero">
                        <span>Get Instant Fleet Quote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="#coverage-options" class="btn-outline-hero">
                        <span>Explore Fleet Coverage</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">{{ $content['hero_card_sub'] ?? 'Fleet Safety & Savings' }}</span>
                        <span class="hero-card-label">{{ $content['hero_card_label'] ?? 'Save up to 35% with telematics & clean fleet records' }}</span>
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
         DARK NAVY VALUE PROPOSITION BAR (4 COMMERCIAL AUTO PILLARS)
         ========================================== -->
    <section class="value-bar-section">
        <div class="container">
            <div class="value-bar-grid">
                <!-- 1. High Liability Limits -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_1_title'] ?? 'Up to $5M Combined Single Limit' }}</h3>
                    <p class="value-item-desc">{{ $content['value_1_desc'] ?? 'Heavy-duty commercial liability limits to protect corporate balance sheets against catastrophic road liability claims.' }}</p>
                </div>

                <!-- 2. Telematics Fleet Discounts -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_2_title'] ?? 'Telematics Fleet Discounts' }}</h3>
                    <p class="value-item-desc">{{ $content['value_2_desc'] ?? 'Earn up to 35% premium reductions with integrated safe-driving telemetry, GPS speed tracking, and dual-facing dashcams.' }}</p>
                </div>

                <!-- 3. Heavy-Duty Roadside -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_3_title'] ?? 'Rapid Heavy-Duty Roadside' }}</h3>
                    <p class="value-item-desc">{{ $content['value_3_desc'] ?? 'Dedicated 24/7 dispatch for commercial flatbeds, heavy wreckers, mobile mechanics, and replacement vehicle logistics.' }}</p>
                </div>

                <!-- 4. Hired & Non-Owned Auto -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_4_title'] ?? 'Hired & Non-Owned Inclusion' }}</h3>
                    <p class="value-item-desc">{{ $content['value_4_desc'] ?? 'Seamless blanket protection covering employees running work errands in personal cars or rented utility trucks.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         INLINE COMMERCIAL AUTO QUOTE FORM (ON-PAGE)
         ========================================== -->
    <section class="quote-calculator-section" id="fleet-quote-calculator">
        <div class="container">
            <div class="fleet-quote-card">
                <div class="fleet-quote-header">
                    <span class="fleet-quote-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        ONLINE FLEET UNDERWRITING
                    </span>
                    <h2 class="fleet-quote-title">Calculate Your Commercial Auto Quote</h2>
                    <p class="fleet-quote-subtitle">
                        Enter your business and fleet details below to receive competitive carrier quotes, custom liability limits, and underwriter review in under 2 minutes.
                    </p>
                </div>

                <!-- Success Confirmation Box -->
                <div id="fleetQuoteSuccessAlert" class="fleet-alert-success" style="display: none;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div>
                        <strong style="display: block; font-size: 16px; margin-bottom: 4px;" id="fleetSuccessMsgTitle">Commercial Quote Request Submitted Successfully!</strong>
                        <span id="fleetSuccessMsgBody" style="font-size: 14.5px; line-height: 1.5;">Your fleet quote reference has been generated. Our senior commercial auto underwriter is preparing your custom proposal now.</span>
                    </div>
                </div>

                <form id="commercialAutoQuoteForm" onsubmit="submitCommercialFleetQuote(event)">
                    @csrf
                    <input type="hidden" name="type" value="commercial_auto">

                    <div class="fleet-quote-grid">
                        <!-- Company Name -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Company / Business Name <span class="req">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="company_name" 
                                class="fleet-form-input" 
                                placeholder="e.g. Apex Logistics Services LLC" 
                                required
                            >
                        </div>

                        <!-- Contact Full Name -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Contact Full Name <span class="req">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                class="fleet-form-input" 
                                placeholder="e.g. Sarah Sterling" 
                                required
                            >
                        </div>

                        <!-- Work Email -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Work Email Address <span class="req">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                class="fleet-form-input" 
                                placeholder="sarah@apexlogistics.com" 
                                required
                            >
                        </div>

                        <!-- Phone Number -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Direct Phone Number <span class="req">*</span>
                            </label>
                            <input 
                                type="tel" 
                                name="phone" 
                                class="fleet-form-input" 
                                placeholder="(555) 345-6789" 
                                required
                            >
                        </div>

                        <!-- Fleet Size -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Fleet Size / Vehicle Count <span class="req">*</span>
                            </label>
                            <select name="fleet_size" class="fleet-form-select" required>
                                <option value="" disabled selected>Select vehicle count...</option>
                                <option value="1-2 Vehicles">1 - 2 Commercial Vehicles</option>
                                <option value="3-5 Vehicles">3 - 5 Vehicles (Small Fleet)</option>
                                <option value="6-15 Vehicles">6 - 15 Vehicles (Mid-Sized Fleet)</option>
                                <option value="16-50 Vehicles">16 - 50 Vehicles (Commercial Fleet)</option>
                                <option value="50+ Vehicles">50+ Vehicles (Enterprise Fleet)</option>
                            </select>
                        </div>

                        <!-- Primary Vehicle Type -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Primary Vehicle Type <span class="req">*</span>
                            </label>
                            <select name="vehicle_type" class="fleet-form-select" required>
                                <option value="" disabled selected>Select primary vehicle type...</option>
                                <option value="Cargo Vans / Sprinters">Cargo Vans / Sprinters / Work Vans</option>
                                <option value="Service & Pickup Trucks">Service &amp; Utility Pickups (F-250 / Silverado)</option>
                                <option value="Box Trucks / Straight Trucks">Box Trucks / Straight Delivery Trucks</option>
                                <option value="Flatbeds & Heavy Trucks">Flatbeds &amp; Heavy-Duty Haulers</option>
                                <option value="Passenger Vans & Shuttles">Passenger Vans &amp; Executive Shuttles</option>
                                <option value="Mixed Commercial Fleet">Mixed Commercial Fleet</option>
                            </select>
                        </div>

                        <!-- Business ZIP Code -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Primary Garaging ZIP Code <span class="req">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="zip" 
                                class="fleet-form-input" 
                                placeholder="e.g. 75001" 
                                maxlength="10" 
                                required
                            >
                        </div>

                        <!-- Desired Coverage Tier -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Desired Coverage Tier <span class="req">*</span>
                            </label>
                            <select name="coverage_tier" class="fleet-form-select">
                                <option value="Full Comprehensive & Collision ($1M CSL Liability)" selected>Full Comprehensive &amp; Collision ($1M CSL Liability)</option>
                                <option value="Preferred Fleet Guard ($2M CSL + Cargo Protection)">Preferred Fleet Guard ($2M CSL + Cargo Protection)</option>
                                <option value="High-Limit Enterprise Guard ($5M CSL + Umbrella)">High-Limit Enterprise Guard ($5M CSL + Umbrella)</option>
                                <option value="State Minimum Liability Only">State Minimum Liability Only</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="fleetSubmitBtn" class="fleet-submit-btn">
                        <span id="fleetSubmitBtnText">Calculate My Commercial Fleet Quote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18" id="fleetSubmitIcon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </button>

                    <!-- Trust Bar -->
                    <div class="fleet-trust-bar">
                        <div class="fleet-trust-item">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <span>256-Bit SSL Encrypted Submission</span>
                        </div>
                        <div class="fleet-trust-item">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Same-Day COI (Certificates) Dispatched</span>
                        </div>
                        <div class="fleet-trust-item">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            <span>A-Rated National Commercial Carriers</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- ==========================================
         COMMERCIAL AUTO COVERAGE OPTIONS (6 CARDS)
         ========================================== -->
    <section class="coverage-section" id="coverage-options">
        <div class="container">
            <p class="section-eyebrow">COMMERCIAL FLEET PROTECTION</p>
            <h2 class="section-title">Comprehensive Coverage for Every Commercial Vehicle</h2>
            <p class="section-subtitle">Shielding company drivers, transport cargo, and commercial utility fleets against road liabilities.</p>

            <div class="coverage-cards-grid">
                <!-- 1. Commercial Auto Liability -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Auto')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_1_title'] ?? 'Commercial Auto Liability (BI & PD)' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_1_desc'] ?? 'High-limit bodily injury and property damage coverage protecting your business against catastrophic legal and medical expenses if a company driver causes an accident.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 2. Collision & Comprehensive Shield -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Auto')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_2_title'] ?? 'Collision & Comprehensive Shield' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_2_desc'] ?? 'Covers physical damage to company trucks, vans, and utility vehicles from highway collisions, rollovers, theft, vandalism, falling objects, and extreme weather events.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 3. Hired & Non-Owned Auto -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Auto')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_3_title'] ?? 'Hired & Non-Owned Auto (HNOA)' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_3_desc'] ?? 'Essential liability protection when employees use personal vehicles for business errands or your company leases, hires, or rents commercial vehicles temporarily.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 4. Motor Truck Cargo & Equipment -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Auto')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_4_title'] ?? 'Motor Truck Cargo & Equipment' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_4_desc'] ?? 'Safeguards customer goods, raw materials, inventory, and specialized tools while in transit against theft, transit damage, spoilage, or highway overturn.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 5. Uninsured / Underinsured Motorist -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Auto')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_5_title'] ?? 'Uninsured / Underinsured Motorist' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_5_desc'] ?? 'Shields your company drivers and vehicles if struck by an at-fault driver who lacks insurance, has insufficient limits, or leaves the scene.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 6. Fleet Telematics & 24/7 Roadside -->
                <div class="coverage-card" onclick="openQuoteModal('Commercial Auto')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_6_title'] ?? 'Fleet Telematics & 24/7 Roadside' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_6_desc'] ?? 'Commercial-grade heavy-duty towing, battery jump-starts, tire changes, fuel dispatch, and intelligent dashcam telematics discounts for proactive risk management.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         GUIDANCE / COMMERCIAL FLEET RISK ADVISOR
         ========================================== -->
    <section class="simpler-section">
        <div class="container">
            <div class="simpler-grid">
                <!-- Left: Commercial Fleet Advisor Photo -->
                <div class="simpler-image-frame">
                    <img 
                        src="{{ asset('images/commercial-fleet-advisor.jpg') }}" 
                        alt="Surebound certified commercial fleet risk advisor reviewing telematics and safety specs with business client" 
                        class="simpler-image"
                    >
                </div>

                <!-- Right: Content -->
                <div class="simpler-content">
                    <p class="simpler-eyebrow">{!! $content['guidance_eyebrow'] ?? 'COMMERCIAL FLEET RISK MANAGEMENT' !!}</p>
                    <h2 class="simpler-title">{!! $content['guidance_title'] ?? 'Fleet Insurance Engineered Around Your Business Operations' !!}</h2>
                    <p class="simpler-paragraph">
                        {{ $content['guidance_text'] ?? 'Whether you operate local trade vans, regional delivery routes, or interstate freight lines, commercial auto insurance requires more than a generic policy. Surebound works directly with fleet managers, contractors, and business owners to optimize driver MVR monitoring, customize cargo limits, and secure volume discounts that directly improve your bottom line.' }}
                    </p>
                    <a href="#fleet-quote-calculator" class="btn-learn-more">
                        <span>Calculate Fleet Premium</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         WHY CHOOSE SUREBOUND FOR COMMERCIAL AUTO
         ========================================== -->
    <section class="why-section">
        <div class="container">
            <p class="section-eyebrow">THE SUREBOUND ADVANTAGE</p>
            <h2 class="section-title">Why Fleet Managers Choose Surebound</h2>

            <div class="why-grid">
                <!-- 1 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_1_title'] ?? 'Instant Multi-Carrier Comparison' }}</h3>
                    <p class="why-card-desc">{{ $content['why_1_desc'] ?? 'Compare commercial auto quotes across A-rated commercial carriers in minutes with a single digital application.' }}</p>
                </div>

                <!-- 2 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_2_title'] ?? 'Dedicated Fleet Claims Specialists' }}</h3>
                    <p class="why-card-desc">{{ $content['why_2_desc'] ?? 'Direct access to certified commercial claims adjusters focused on minimizing downtime and getting your vehicles back on the road.' }}</p>
                </div>

                <!-- 3 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-6h6" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_3_title'] ?? 'Flexible Schedule of Vehicles' }}</h3>
                    <p class="why-card-desc">{{ $content['why_3_desc'] ?? 'Add or remove vans, box trucks, trailers, and drivers instantly through the Surebound digital policy portal.' }}</p>
                </div>

                <!-- 4 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_4_title'] ?? 'USDOT & State Filings Handled' }}</h3>
                    <p class="why-card-desc">{{ $content['why_4_desc'] ?? 'Prompt federal and state compliance filings including Form BMC-91X, MCS-90, and state certificate dispatches.' }}</p>
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
            <h2 class="section-title" style="text-align: center;">Commercial Auto FAQ</h2>
            <p class="section-subtitle" style="text-align: center;">Clear answers about commercial liability, fleet telematics, HNOA, and cargo protection.</p>

            <div class="faq-accordion">
                <!-- Q1 -->
                <div class="faq-item active">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_1_question'] ?? 'What vehicles require Commercial Auto Insurance instead of Personal Auto?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_1_answer'] ?? 'Any vehicle titled to a business or used primarily for commercial purposes—such as transporting equipment, delivering goods, driving clients, hauling cargo, or displaying commercial branding—must be covered under a commercial auto policy. Personal auto policies almost always exclude business use.' }}
                    </div>
                </div>

                <!-- Q2 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_2_question'] ?? 'What is Hired and Non-Owned Auto (HNOA) insurance, and do I need it?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_2_answer'] ?? 'HNOA covers your business against liability if an employee causes an accident while driving their own personal vehicle for company business (like delivering orders, picking up supplies, or driving to job sites) or if your company rents a vehicle for work. It is essential for protecting your business against vicarious liability.' }}
                    </div>
                </div>

                <!-- Q3 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_3_question'] ?? 'How are commercial auto insurance premiums calculated?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_3_answer'] ?? 'Premiums depend on vehicle types and weights, annual mileage, operational radius, cargo hauled, driver motor vehicle records (MVRs), fleet safety telematics, and chosen policy limits and deductibles. Surebound helps you qualify for discounts up to 35% based on driver safety programs.' }}
                    </div>
                </div>

                <!-- Q4 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_4_question'] ?? 'Can I add and remove vehicles or drivers during the policy term?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_4_answer'] ?? 'Yes. Our digital policyholder portal allows fleet managers and business owners to submit vehicle additions, swaps, and new driver authorizations 24/7 with instant endorsement processing and immediate digital proof of insurance certificates.' }}
                    </div>
                </div>

                <!-- Q5 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_5_question'] ?? 'Does commercial auto insurance cover the tools and equipment inside my truck?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_5_answer'] ?? 'Commercial auto comprehensive and collision covers damage to the vehicle itself. To protect tools, machinery, and cargo carried inside the vehicle, you can add an Inland Marine or Motor Truck Cargo rider to your Surebound policy for complete protection.' }}
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
                <h2>{!! $content['cta_title'] ?? 'Ready to protect your company fleet and cut commercial auto costs?' !!}</h2>
                <p>{{ $content['cta_subtitle'] ?? 'Get a customized commercial vehicle quote in minutes or consult with our fleet risk underwriters.' }}</p>
            </div>
            <div class="cta-button-group">
                <a href="#fleet-quote-calculator" class="btn-cta-white">
                    <span>Get a Commercial Quote</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="javascript:void(0)" onclick="openQuoteModal('Commercial Auto')" class="btn-cta-transparent">
                    <span>Talk to a Fleet Advisor</span>
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

        async function submitCommercialFleetQuote(e) {
            e.preventDefault();
            const form = document.getElementById('commercialAutoQuoteForm');
            const submitBtn = document.getElementById('fleetSubmitBtn');
            const btnText = document.getElementById('fleetSubmitBtnText');
            const alertBox = document.getElementById('fleetQuoteSuccessAlert');
            const alertTitle = document.getElementById('fleetSuccessMsgTitle');
            const alertBody = document.getElementById('fleetSuccessMsgBody');

            submitBtn.disabled = true;
            btnText.textContent = 'Calculating Fleet Rate...';

            const formData = new FormData(form);

            try {
                const response = await fetch('{{ route("quotes.store") }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    alertTitle.textContent = 'Commercial Fleet Quote Request Received (' + (data.quote_ref || 'Q-FLEET') + ')';
                    alertBody.textContent = data.message || 'Thank you! Your commercial quote request has been securely dispatched. A commercial underwriter will reach out with carrier options.';
                    alertBox.style.display = 'flex';
                    form.reset();
                    alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else {
                    alert('Unable to submit quote. Please verify required fields and try again.');
                }
            } catch (err) {
                console.error(err);
                alert('A network error occurred. Please check your connection and try again.');
            } finally {
                submitBtn.disabled = false;
                btnText.textContent = 'Calculate My Commercial Fleet Quote';
            }
        }
    </script>
@endsection
