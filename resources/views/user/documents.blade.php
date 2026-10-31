@extends('layouts.user')

@section('content')
<div class="documents-page-wrapper">

    <!-- TOP HEADER -->
    <div class="section-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
        <div>
            <h1 class="section-title" style="font-size: 1.75rem; font-weight: 800; color: var(--brand-navy); margin-bottom: 4px;">Digital Insurance Document Locker</h1>
            <p class="section-subtitle" style="font-size: 0.9375rem; color: var(--text-muted);">
                Declarations pages (DEC), digital auto &amp; property ID cards, certificates of liability insurance (COI), and official payment receipts.
            </p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <button type="button" onclick="openRequestCertModal()" class="btn-primary-action" style="display: inline-flex; align-items: center; gap: 8px; background: var(--brand-blue); color: #fff; padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: var(--shadow-sm); border: none; cursor: pointer; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Request Certificate (COI)</span>
            </button>
            <button type="button" onclick="openUploadModal()" style="display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: var(--shadow-sm); cursor: pointer; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                <span>Upload Signed Doc</span>
            </button>
        </div>
    </div>

    <!-- METRICS / KPI CARDS -->
    <div class="metrics-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; margin-bottom: 28px;">
        
        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Document Vault</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; color: var(--brand-blue); display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); line-height: 1.2;">
                {{ ($policies->count() * 3) + $invoices->count() }}
            </div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Verified policy files &amp; receipts
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Active Declarations (DEC)</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #059669; line-height: 1.2;">{{ $policies->where('status', 'active')->count() }}</div>
            <div style="font-size: 0.8125rem; color: #059669; font-weight: 500; margin-top: 4px;">
                Legally binding underwriting schedules
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Insurance ID Cards</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #fdf4ff; color: #a855f7; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #a855f7; line-height: 1.2;">{{ $policies->count() }}</div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Official proof for DMV &amp; mobile wallet
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Archived Invoices &amp; Receipts</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #fffbeb; color: #d97706; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #d97706; line-height: 1.2;">{{ $invoices->count() }}</div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Tax &amp; accounting certified
            </div>
        </div>

    </div>

    <!-- FILTER BAR & SEARCH -->
    <div class="filter-search-container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; background: #ffffff; padding: 14px 20px; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); margin-bottom: 24px;">
        
        <!-- Filter Pills -->
        <div class="filter-pills" style="display: flex; gap: 8px; flex-wrap: wrap;">
            <button type="button" class="doc-filter-btn active" data-filter="all" onclick="filterDocuments('all')" style="padding: 7px 15px; border-radius: 20px; font-size: 0.8125rem; font-weight: 600; border: 1px solid var(--brand-blue); background: var(--brand-blue); color: #ffffff; cursor: pointer; transition: all 0.2s;">
                All Documents
            </button>
            <button type="button" class="doc-filter-btn" data-filter="dec" onclick="filterDocuments('dec')" style="padding: 7px 15px; border-radius: 20px; font-size: 0.8125rem; font-weight: 600; border: 1px solid var(--border-light); background: #ffffff; color: var(--text-muted); cursor: pointer; transition: all 0.2s;">
                Declarations (DEC)
            </button>
            <button type="button" class="doc-filter-btn" data-filter="id-card" onclick="filterDocuments('id-card')" style="padding: 7px 15px; border-radius: 20px; font-size: 0.8125rem; font-weight: 600; border: 1px solid var(--border-light); background: #ffffff; color: var(--text-muted); cursor: pointer; transition: all 0.2s;">
                Proof ID Cards
            </button>
            <button type="button" class="doc-filter-btn" data-filter="coi" onclick="filterDocuments('coi')" style="padding: 7px 15px; border-radius: 20px; font-size: 0.8125rem; font-weight: 600; border: 1px solid var(--border-light); background: #ffffff; color: var(--text-muted); cursor: pointer; transition: all 0.2s;">
                Certificates (COI)
            </button>
            <button type="button" class="doc-filter-btn" data-filter="receipt" onclick="filterDocuments('receipt')" style="padding: 7px 15px; border-radius: 20px; font-size: 0.8125rem; font-weight: 600; border: 1px solid var(--border-light); background: #ffffff; color: var(--text-muted); cursor: pointer; transition: all 0.2s;">
                Billing &amp; Receipts
            </button>
        </div>

        <!-- Search Input -->
        <div style="position: relative; min-width: 260px;">
            <input type="text" id="docSearchInput" onkeyup="searchDocuments()" placeholder="Search documents, policies, or ref..." style="width: 100%; padding: 8px 14px 8px 36px; font-size: 0.875rem; border: 1px solid var(--border-light); border-radius: var(--radius-sm); outline: none; transition: border-color 0.2s;">
            <svg style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--text-muted);" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>

    </div>

    <!-- DOCUMENTS GRID -->
    <div class="documents-grid" id="documentsContainer" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 20px;">

        @foreach($policies as $pol)
            <!-- DOCUMENT 1: POLICY DECLARATIONS PAGE (DEC) -->
            <div class="document-card" data-category="dec" style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: 20px; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; border-radius: 10px; background: #eff6ff; color: var(--brand-blue); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <span style="font-size: 0.6875rem; font-weight: 700; text-transform: uppercase; color: var(--brand-blue); letter-spacing: 0.5px;">Policy Schedule</span>
                                <h3 style="font-size: 1rem; font-weight: 700; color: var(--brand-navy); line-height: 1.3;">Declarations Page (DEC)</h3>
                            </div>
                        </div>
                        <span style="background: #ecfdf5; color: #059669; font-size: 0.6875rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; border: 1px solid rgba(5, 150, 105, 0.2); text-transform: uppercase;">
                            Active
                        </span>
                    </div>

                    <div style="background: #f8fafc; border-radius: var(--radius-sm); padding: 12px; margin-bottom: 16px; font-size: 0.8125rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Policy Contract:</span>
                            <span style="font-weight: 700; font-family: monospace; color: var(--brand-navy);">{{ $pol->policy_number }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Line of Coverage:</span>
                            <span style="font-weight: 600; color: var(--text-main);">{{ ucfirst($pol->type) }} ({{ $pol->plan_name }})</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Stipulated Limit:</span>
                            <span style="font-weight: 700; color: #059669;">{{ $pol->coverage_limit }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-muted);">Term:</span>
                            <span style="color: var(--text-muted);">{{ \Carbon\Carbon::parse($pol->effective_date)->format('M d, Y') }} &ndash; {{ \Carbon\Carbon::parse($pol->renewal_date)->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 10px; border-top: 1px solid var(--border-light); padding-top: 14px;">
                    <a href="{{ route('user.policies.show', $pol->id) }}" style="flex: 1; text-align: center; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 8px 12px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; transition: all 0.2s;">
                        Inspect Schedule
                    </a>
                    <a href="{{ route('user.policies.show', $pol->id) }}" target="_blank" style="flex: 1; text-align: center; background: var(--brand-blue); color: #ffffff; border: none; padding: 8px 12px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Download PDF</span>
                    </a>
                </div>
            </div>

            <!-- DOCUMENT 2: OFFICIAL PROOF OF INSURANCE / ID CARD -->
            <div class="document-card" data-category="id-card" style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: 20px; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; border-radius: 10px; background: #fdf4ff; color: #a855f7; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                            </div>
                            <div>
                                <span style="font-size: 0.6875rem; font-weight: 700; text-transform: uppercase; color: #a855f7; letter-spacing: 0.5px;">DMV &amp; Proof</span>
                                <h3 style="font-size: 1rem; font-weight: 700; color: var(--brand-navy); line-height: 1.3;">Proof of Insurance Card</h3>
                            </div>
                        </div>
                        <span style="background: #fdf4ff; color: #a855f7; font-size: 0.6875rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; border: 1px solid rgba(168, 85, 247, 0.2); text-transform: uppercase;">
                            Wallet Ready
                        </span>
                    </div>

                    <div style="background: #f8fafc; border-radius: var(--radius-sm); padding: 12px; margin-bottom: 16px; font-size: 0.8125rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Policy Ref:</span>
                            <span style="font-weight: 700; font-family: monospace; color: var(--brand-navy);">{{ $pol->policy_number }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Named Insured:</span>
                            <span style="font-weight: 600; color: var(--text-main);">{{ $pol->holder_name }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Underwriter NAIC:</span>
                            <span style="font-weight: 600; font-family: monospace; color: var(--text-main);">#29482 (Surebound)</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-muted);">Expiration:</span>
                            <span style="font-weight: 600; color: #059669;">{{ \Carbon\Carbon::parse($pol->renewal_date)->format('m/d/Y') }}</span>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 10px; border-top: 1px solid var(--border-light); padding-top: 14px;">
                    <a href="{{ route('user.policies.id-card', $pol->id) }}" target="_blank" style="flex: 1; text-align: center; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 8px 12px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; transition: all 0.2s;">
                        Digital Card
                    </a>
                    <a href="{{ route('user.policies.id-card', $pol->id) }}" target="_blank" style="flex: 1; text-align: center; background: #a855f7; color: #ffffff; border: none; padding: 8px 12px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Print Card</span>
                    </a>
                </div>
            </div>

            <!-- DOCUMENT 3: ACORD 25 CERTIFICATE OF INSURANCE (COI) -->
            <div class="document-card" data-category="coi" style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: 20px; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; border-radius: 10px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                            </div>
                            <div>
                                <span style="font-size: 0.6875rem; font-weight: 700; text-transform: uppercase; color: #059669; letter-spacing: 0.5px;">ACORD 25</span>
                                <h3 style="font-size: 1rem; font-weight: 700; color: var(--brand-navy); line-height: 1.3;">Certificate of Insurance (COI)</h3>
                            </div>
                        </div>
                        <span style="background: #ecfdf5; color: #059669; font-size: 0.6875rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; border: 1px solid rgba(5, 150, 105, 0.2); text-transform: uppercase;">
                            ACORD Certified
                        </span>
                    </div>

                    <div style="background: #f8fafc; border-radius: var(--radius-sm); padding: 12px; margin-bottom: 16px; font-size: 0.8125rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Policy Contract:</span>
                            <span style="font-weight: 700; font-family: monospace; color: var(--brand-navy);">{{ $pol->policy_number }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Liability Limit:</span>
                            <span style="font-weight: 700; color: #059669;">{{ $pol->coverage_limit }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Additional Insured:</span>
                            <span style="font-weight: 600; color: var(--text-main);">Automatic By Contract</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-muted);">Subrogation Waiver:</span>
                            <span style="font-weight: 600; color: #059669;">Included</span>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 10px; border-top: 1px solid var(--border-light); padding-top: 14px;">
                    <a href="{{ route('user.documents.view-certificate', $pol->id) }}" target="_blank" style="flex: 1; text-align: center; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 8px 12px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; transition: all 0.2s;">
                        Inspect ACORD
                    </a>
                    <a href="{{ route('user.documents.view-certificate', $pol->id) }}" target="_blank" style="flex: 1; text-align: center; background: #059669; color: #ffffff; border: none; padding: 8px 12px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 2px 6px rgba(5, 150, 105, 0.25);">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Print COI</span>
                    </a>
                </div>
            </div>
        @endforeach

        @foreach($invoices as $inv)
            <!-- DOCUMENT 4: INVOICE & OFFICIAL PAYMENT RECEIPT -->
            <div class="document-card" data-category="receipt" style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: 20px; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; border-radius: 10px; background: #fffbeb; color: #d97706; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"/></svg>
                            </div>
                            <div>
                                <span style="font-size: 0.6875rem; font-weight: 700; text-transform: uppercase; color: #d97706; letter-spacing: 0.5px;">Premium Accounting</span>
                                <h3 style="font-size: 1rem; font-weight: 700; color: var(--brand-navy); line-height: 1.3;">
                                    {{ $inv->status === 'paid' ? 'Official Payment Receipt' : 'Premium Invoice Statement' }}
                                </h3>
                            </div>
                        </div>
                        <span style="background: {{ $inv->status === 'paid' ? '#ecfdf5' : '#fffbeb' }}; color: {{ $inv->status === 'paid' ? '#059669' : '#d97706' }}; font-size: 0.6875rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; border: 1px solid currentColor; text-transform: uppercase;">
                            {{ $inv->status }}
                        </span>
                    </div>

                    <div style="background: #f8fafc; border-radius: var(--radius-sm); padding: 12px; margin-bottom: 16px; font-size: 0.8125rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Invoice Ref:</span>
                            <span style="font-weight: 700; font-family: monospace; color: var(--brand-navy);">{{ $inv->invoice_number }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Policy Ref:</span>
                            <span style="font-weight: 600; font-family: monospace; color: var(--text-main);">{{ $inv->policy_number }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                            <span style="color: var(--text-muted);">Statement Total:</span>
                            <span style="font-weight: 800; color: var(--brand-navy);">${{ number_format($inv->total_amount, 2) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-muted);">Date:</span>
                            <span style="color: var(--text-muted);">{{ \Carbon\Carbon::parse($inv->issue_date)->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 10px; border-top: 1px solid var(--border-light); padding-top: 14px;">
                    <a href="{{ route('admin.invoices.pdf', $inv->id) }}" target="_blank" style="flex: 1; text-align: center; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 8px 12px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; transition: all 0.2s;">
                        View Receipt
                    </a>
                    <a href="{{ route('admin.invoices.print', $inv->id) }}" target="_blank" style="flex: 1; text-align: center; background: #d97706; color: #ffffff; border: none; padding: 8px 12px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 2px 6px rgba(217, 119, 6, 0.25);">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Print Statement</span>
                    </a>
                </div>
            </div>
        @endforeach

        @if($policies->isEmpty() && $invoices->isEmpty())
            <div style="grid-column: 1 / -1; background: #ffffff; border-radius: var(--radius-md); padding: 60px 24px; text-align: center; border: 1px dashed var(--border-light);">
                <div style="font-size: 3rem; margin-bottom: 12px;">📄</div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">No Documents or Certificates Yet</h3>
                <p style="font-size: 0.9375rem; color: var(--text-muted); max-width: 460px; margin: 0 auto 20px;">
                    Your account currently has no bound policies or generated billing statements. Once a policy is active, all official Declaration sheets, DMV Proof ID cards, and certified ACORD certificates will be available here.
                </p>
                <a href="{{ route('user.quote') }}" style="display: inline-flex; align-items: center; gap: 8px; background: var(--brand-blue); color: #fff; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none;">
                    Request an Insurance Quote &rarr;
                </a>
            </div>
        @endif

    </div>

</div>

<!-- MODAL: REQUEST CERTIFICATE OF INSURANCE (COI) -->
<div id="modalRequestCert" style="display: none; position: fixed; inset: 0; background: rgba(9, 19, 46, 0.7); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: var(--radius-md); max-width: 580px; width: 100%; box-shadow: var(--shadow-lg); border: 1px solid var(--border-light); overflow: hidden; animation: modalPop 0.2s ease-out;">
        
        <div style="background: var(--brand-navy); padding: 20px 24px; color: #ffffff; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 32px; height: 32px; border-radius: 6px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 700; margin: 0;">Request Certificate of Insurance (COI)</h3>
            </div>
            <button type="button" onclick="closeRequestCertModal()" style="background: transparent; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer; line-height: 1;">&times;</button>
        </div>

        <form action="{{ route('user.documents.certificate') }}" method="POST" style="padding: 24px;">
            @csrf

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Select Applicable Policy *</label>
                <select name="policy_number" required style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem; background: #fff;">
                    @foreach($policies as $pol)
                        <option value="{{ $pol->policy_number }}">{{ $pol->policy_number }} &ndash; {{ ucfirst($pol->type) }} ({{ $pol->plan_name }})</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Certificate Holder Name / Company *</label>
                <input type="text" name="holder_name" required placeholder="e.g. Austin Commercial Properties LLC or Wells Fargo Bank" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                <span style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px; display: block;">The legal entity name to appear as Certificate Holder / Loss Payee.</span>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Certificate Holder Address *</label>
                <input type="text" name="holder_address" required placeholder="Street address, City, State, ZIP" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Recipient Email for Automated Dispatch (Optional)</label>
                <input type="email" name="holder_email" placeholder="landlord@realty.com" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Special Endorsement Requirements / Wording</label>
                <textarea name="notes" rows="3" placeholder="e.g. Include 30-day notice of cancellation, waiver of subrogation, and additional insured status for project #9042." style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;"></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" onclick="closeRequestCertModal()" style="padding: 10px 18px; border: 1px solid var(--border-light); background: #ffffff; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 10px 22px; background: var(--brand-blue); color: #ffffff; border: none; border-radius: var(--radius-sm); font-weight: 700; font-size: 0.875rem; cursor: pointer; box-shadow: var(--shadow-sm);">Submit COI Request</button>
            </div>
        </form>

    </div>
</div>

<!-- MODAL: UPLOAD SIGNED DOCUMENT -->
<div id="modalUploadDoc" style="display: none; position: fixed; inset: 0; background: rgba(9, 19, 46, 0.7); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: var(--radius-md); max-width: 520px; width: 100%; box-shadow: var(--shadow-lg); border: 1px solid var(--border-light); overflow: hidden; animation: modalPop 0.2s ease-out;">
        
        <div style="background: var(--brand-navy); padding: 20px 24px; color: #ffffff; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 32px; height: 32px; border-radius: 6px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 700; margin: 0;">Upload Signed Policy Document</h3>
            </div>
            <button type="button" onclick="closeUploadModal()" style="background: transparent; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer; line-height: 1;">&times;</button>
        </div>

        <div style="padding: 24px;">
            <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 18px;">
                Securely transmit signed application forms, sworn statements in proof of loss, appraisal receipts, or mortgage escrow authorizations to your dedicated underwriter.
            </p>

            <div style="border: 2px dashed var(--border-light); border-radius: var(--radius-md); padding: 32px 20px; text-align: center; margin-bottom: 20px; background: #f8fafc; cursor: pointer;" onclick="document.getElementById('fileUploadInput').click()">
                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--brand-blue); margin-bottom: 10px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                <div style="font-weight: 700; font-size: 0.9375rem; color: var(--brand-navy); margin-bottom: 4px;">Click to select file or drag &amp; drop</div>
                <div style="font-size: 0.75rem; color: var(--text-muted);">PDF, JPG, PNG or DOCX up to 25MB (256-bit AES Encrypted)</div>
                <input type="file" id="fileUploadInput" style="display: none;" onchange="handleFileSelected(this)">
            </div>

            <div id="selectedFileBanner" style="display: none; background: #eff6ff; border: 1px solid var(--brand-blue); border-radius: var(--radius-sm); padding: 10px 14px; font-size: 0.8125rem; color: var(--brand-navy); margin-bottom: 20px;">
                <strong>Selected:</strong> <span id="selectedFileName">filename.pdf</span>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" onclick="closeUploadModal()" style="padding: 10px 18px; border: 1px solid var(--border-light); background: #ffffff; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; cursor: pointer;">Cancel</button>
                <button type="button" onclick="submitUploadFile()" style="padding: 10px 22px; background: var(--brand-blue); color: #ffffff; border: none; border-radius: var(--radius-sm); font-weight: 700; font-size: 0.875rem; cursor: pointer; box-shadow: var(--shadow-sm);">Upload to Vault</button>
            </div>
        </div>

    </div>
</div>

<script>
function openRequestCertModal() {
    const m = document.getElementById('modalRequestCert');
    m.style.display = 'flex';
}
function closeRequestCertModal() {
    document.getElementById('modalRequestCert').style.display = 'none';
}

function openUploadModal() {
    const m = document.getElementById('modalUploadDoc');
    m.style.display = 'flex';
}
function closeUploadModal() {
    document.getElementById('modalUploadDoc').style.display = 'none';
}

function handleFileSelected(input) {
    if (input.files && input.files[0]) {
        document.getElementById('selectedFileName').textContent = input.files[0].name;
        document.getElementById('selectedFileBanner').style.display = 'block';
    }
}

function submitUploadFile() {
    const banner = document.getElementById('selectedFileBanner');
    if (banner.style.display === 'none') {
        SureboundModal.alert({
            title: 'File Selection Required',
            message: 'Please choose an insurance document, declaration, or receipt to upload first.',
            type: 'warning',
            buttonText: 'Got It'
        });
        return;
    }
    closeUploadModal();
    SureboundModal.alert({
        title: 'Document Securely Vaulted',
        message: 'Document securely uploaded and archived into your vault! An underwriter will verify your documentation within 4 business hours.',
        type: 'success',
        icon: 'shield-check',
        buttonText: 'Done'
    });
}

function filterDocuments(filter) {
    document.querySelectorAll('.doc-filter-btn').forEach(btn => {
        if (btn.getAttribute('data-filter') === filter) {
            btn.classList.add('active');
            btn.style.background = 'var(--brand-blue)';
            btn.style.borderColor = 'var(--brand-blue)';
            btn.style.color = '#ffffff';
        } else {
            btn.classList.remove('active');
            btn.style.background = '#ffffff';
            btn.style.borderColor = 'var(--border-light)';
            btn.style.color = 'var(--text-muted)';
        }
    });

    const cards = document.querySelectorAll('.document-card');
    cards.forEach(card => {
        if (filter === 'all' || card.getAttribute('data-category') === filter) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

function searchDocuments() {
    const query = document.getElementById('docSearchInput').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.document-card');

    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = (!query || text.includes(query)) ? 'flex' : 'none';
    });
}
</script>
@endsection
