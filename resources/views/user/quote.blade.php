@extends('layouts.user')

@section('content')
<div class="quotes-page-wrapper">

    <!-- TOP HEADER -->
    <div class="section-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
        <div>
            <h1 class="section-title" style="font-size: 1.75rem; font-weight: 800; color: var(--brand-navy); margin-bottom: 4px;">Insurance Rate Proposals &amp; Quotes</h1>
            <p class="section-subtitle" style="font-size: 0.9375rem; color: var(--text-muted);">
                Actuarial underwriting proposals, customized risk schedules, locked annual premiums, and one-click policy contract binding.
            </p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <button type="button" onclick="openRequestQuoteModal()" class="btn-primary-action" style="display: inline-flex; align-items: center; gap: 8px; background: var(--brand-blue); color: #fff; padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: var(--shadow-sm); border: none; cursor: pointer; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Request Custom Quote</span>
            </button>
            <a href="{{ route('user.policies') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: var(--shadow-sm); text-decoration: none; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>My Active Policies</span>
            </a>
        </div>
    </div>

    <!-- METRICS / KPI CARDS -->
    <div class="metrics-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; margin-bottom: 28px;">
        
        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Total Inquiries</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; color: var(--brand-blue); display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); line-height: 1.2;">{{ $quotes->count() }}</div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Rate proposals &amp; requests
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Proposals Ready</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #059669; line-height: 1.2;">{{ $quotes->where('status', 'quoted')->count() }}</div>
            <div style="font-size: 0.8125rem; color: #059669; font-weight: 500; margin-top: 4px;">
                Ready for One-Click Binding
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Underwriting Review</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #fffbeb; color: #d97706; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #d97706; line-height: 1.2;">{{ $quotes->whereIn('status', ['new', 'reviewing'])->count() }}</div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Actuarial Risk Assessment
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Bound as Policy</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #f3e8ff; color: #9333ea; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #9333ea; line-height: 1.2;">{{ $quotes->where('status', 'converted')->count() }}</div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Converted to Active Contracts
            </div>
        </div>

    </div>

    <!-- CONTROLS & FILTER BAR -->
    <div class="quote-controls-bar" style="background: #ffffff; padding: 14px 20px; border-radius: var(--radius-md); border: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 24px; box-shadow: var(--shadow-sm);">
        
        <div class="filter-pills" style="display: flex; gap: 8px; flex-wrap: wrap;">
            <button type="button" class="quote-filter-btn active" data-filter="all" onclick="filterUserQuotes('all', this)">All Quotes ({{ $quotes->count() }})</button>
            <button type="button" class="quote-filter-btn" data-filter="quoted" onclick="filterUserQuotes('quoted', this)">Proposal Ready ({{ $quotes->where('status', 'quoted')->count() }})</button>
            <button type="button" class="quote-filter-btn" data-filter="reviewing" onclick="filterUserQuotes('reviewing', this)">Under Review ({{ $quotes->whereIn('status', ['new', 'reviewing'])->count() }})</button>
            <button type="button" class="quote-filter-btn" data-filter="converted" onclick="filterUserQuotes('converted', this)">Bound Policies ({{ $quotes->where('status', 'converted')->count() }})</button>
            <button type="button" class="quote-filter-btn" data-filter="declined" onclick="filterUserQuotes('declined', this)">Declined</button>
        </div>

        <div style="display: flex; gap: 12px; align-items: center; flex: 1; max-width: 380px; min-width: 240px;">
            <div style="position: relative; width: 100%;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="quoteSearchInput" placeholder="Search by quote #, coverage, or line..." onkeyup="searchUserQuotes()" style="width: 100%; padding: 9px 12px 9px 38px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); background: #f8fafc; font-size: 0.875rem; color: var(--text-main); outline: none; transition: border-color 0.2s;">
            </div>
        </div>

    </div>

    <!-- QUOTES LIST CARDS -->
    <div class="quotes-list-container" id="quotesListGrid" style="display: flex; flex-direction: column; gap: 20px;">
        @forelse($quotes as $q)
        <div class="quote-card-item" data-status="{{ strtolower($q->status) }}" data-number="{{ strtolower($q->quote_ref) }}" data-type="{{ strtolower($q->type) }}" data-coverage="{{ strtolower($q->coverage) }}" style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
            
            <!-- Card Header -->
            <div style="padding: 20px 24px; background: #ffffff; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div style="display: flex; align-items: center; gap: 14px;">
                    <div style="width: 46px; height: 46px; border-radius: 12px; background: {{ $q->type === 'home' ? '#eff6ff' : ($q->type === 'auto' ? '#ecfdf5' : ($q->type === 'umbrella' ? '#f3e8ff' : '#fef3c7')) }}; color: {{ $q->type === 'home' ? '#1d4ed8' : ($q->type === 'auto' ? '#059669' : ($q->type === 'umbrella' ? '#7c3aed' : '#d97706')) }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        @if($q->type === 'home')
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        @elseif($q->type === 'auto')
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        @elseif($q->type === 'umbrella')
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        @else
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        @endif
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                            <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">{{ $q->type_label }}</h3>
                            <code style="font-family: var(--font-mono); font-size: 0.8125rem; font-weight: 700; color: var(--brand-blue); background: #eff6ff; padding: 2px 8px; border-radius: 4px; border: 1px solid #bfdbfe;">
                                {{ $q->quote_ref }}
                            </code>
                        </div>
                        <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 3px;">
                            Submitted on {{ $q->created_at ? $q->created_at->format('M d, Y') : 'Recent' }} • Location: {{ $q->location ?: 'United States' }}
                        </div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 10px;">
                    @if($q->status === 'quoted')
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 20px; font-size: 0.8125rem; font-weight: 700; background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #10b981;"></span>
                            Proposal Ready
                        </span>
                    @elseif($q->status === 'reviewing')
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 20px; font-size: 0.8125rem; font-weight: 700; background: #fffbeb; color: #b45309; border: 1px solid #fde68a;">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #f59e0b;"></span>
                            Actuarial Review
                        </span>
                    @elseif($q->status === 'converted')
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 20px; font-size: 0.8125rem; font-weight: 700; background: #10b981; color: #ffffff;">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Bound Policy Contract
                        </span>
                    @elseif($q->status === 'declined')
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 20px; font-size: 0.8125rem; font-weight: 700; background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3;">
                            Declined
                        </span>
                    @else
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 20px; font-size: 0.8125rem; font-weight: 700; background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe;">
                            New Underwriter Request
                        </span>
                    @endif
                </div>
            </div>

            <!-- Card Body / Key Terms Grid -->
            <div style="padding: 20px 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; background: #fafbfc; border-bottom: 1px solid #f1f5f9;">
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">Coverage Limit Requested</span>
                    <strong style="font-size: 1rem; color: var(--text-main);">{{ $q->coverage ?: '$500,000 Standard' }}</strong>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">Proposed Annual Premium</span>
                    <strong style="font-size: 1.125rem; color: #0284c7; font-family: var(--font-mono);">{{ $q->premium ?: 'Calculating Rate...' }}</strong>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">Applicant</span>
                    <div style="font-size: 0.875rem; color: var(--text-main); font-weight: 600;">{{ $q->name }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $q->email }}</div>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">Underwriting Status</span>
                    <div style="font-size: 0.875rem; color: var(--text-secondary); font-weight: 600;">
                        {{ $q->status === 'quoted' ? 'Rate Guaranteed for 30 Days' : ($q->status === 'converted' ? 'Active In-Force Contract' : 'Risk Modeling In Progress') }}
                    </div>
                </div>
            </div>

            <!-- Underwriter Notes / Terms Breakdown -->
            @if($q->notes)
            <div style="padding: 14px 24px; background: #ffffff; border-bottom: 1px solid #f1f5f9;">
                <div style="display: flex; align-items: flex-start; gap: 8px;">
                    <div style="color: var(--brand-blue); margin-top: 1px;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div style="font-size: 0.8125rem; color: var(--text-secondary); line-height: 1.5;">
                        <strong style="color: var(--text-main);">Underwriter Notes &amp; Endorsements:</strong> {{ $q->notes }}
                    </div>
                </div>
            </div>
            @endif

            <!-- Card Actions Footer -->
            <div style="padding: 14px 24px; background: #ffffff; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div style="font-size: 0.8125rem; color: var(--text-muted);">
                    All proposals underwritten by Surebound National Insurance Syndicate.
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <button type="button" onclick='openViewQuoteModal(@json($q))' style="background: #f8fafc; color: var(--text-main); border: 1px solid var(--border-light); padding: 8px 14px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; cursor: pointer;">
                        View Proposal Scope
                    </button>

                    @if($q->status === 'quoted')
                        <button type="button" onclick="acceptAndBindQuote({{ $q->id }}, '{{ $q->quote_ref }}')" style="background: #059669; color: #ffffff; border: none; padding: 8px 16px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(5, 150, 105, 0.25);">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Accept &amp; Bind Policy</span>
                        </button>
                    @elseif($q->status === 'converted')
                        <a href="{{ route('user.policies') }}" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; padding: 8px 14px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                            <span>View Active Policy Contract &rarr;</span>
                        </a>
                    @else
                        <a href="{{ route('user.support') }}" style="background: #f8fafc; color: var(--brand-blue); border: 1px solid var(--border-light); padding: 8px 14px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none;">
                            Contact Underwriter
                        </a>
                    @endif
                </div>
            </div>

        </div>
        @empty
        <div style="background: #ffffff; border-radius: var(--radius-md); padding: 60px 24px; text-align: center; border: 1px solid var(--border-light);">
            <div style="font-size: 3rem; margin-bottom: 12px;">📑</div>
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 6px;">No Active Quote Inquiries</h3>
            <p style="font-size: 0.9375rem; color: var(--text-muted); max-width: 440px; margin: 0 auto 20px;">
                Looking to protect a new home, motor vehicle, commercial business, or excess umbrella liability? Request a custom quote proposal today.
            </p>
            <button type="button" onclick="openRequestQuoteModal()" class="btn-primary-action" style="background: var(--brand-blue); color: #fff; padding: 10px 22px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; border: none; cursor: pointer;">
                Request Your First Quote
            </button>
        </div>
        @endforelse
    </div>

</div>

<!-- ====================================================================
     MODAL: REQUEST NEW INSURANCE QUOTE
     ==================================================================== -->
<div class="user-modal-overlay" id="modalRequestQuote" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: var(--radius-md); max-width: 680px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
        <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 38px; height: 38px; border-radius: 10px; background: #eff6ff; color: var(--brand-blue); display: flex; align-items: center; justify-content: center;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 1.1875rem; font-weight: 700; color: var(--brand-navy);">Request Custom Insurance Quote</h3>
                    <p style="margin: 2px 0 0; font-size: 0.8125rem; color: var(--text-muted);">Receive a tailored underwriting proposal with locked annual rates</p>
                </div>
            </div>
            <button type="button" onclick="closeUserModal('modalRequestQuote')" style="border: none; background: none; font-size: 1.5rem; line-height: 1; cursor: pointer; color: var(--text-muted);">&times;</button>
        </div>

        <form action="{{ route('user.quotes.store') }}" method="POST" id="userQuoteForm" style="padding: 24px;">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Insurance Line *</label>
                    <select name="type" id="new_quote_type" required onchange="onQuoteTypeChanged(this.value)" style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main); background: #ffffff;">
                        <option value="home">Homeowners Comprehensive (HO-5)</option>
                        <option value="auto">Auto / Motor Vehicle Fleet</option>
                        <option value="business">Commercial Business Owners (BOP)</option>
                        <option value="umbrella">Excess Umbrella &amp; Worldwide Liability</option>
                        <option value="cyber">Cyber Security &amp; Data Breach</option>
                        <option value="life">Universal Life &amp; Key Person</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Proposal Plan Title *</label>
                    <input type="text" name="type_label" id="new_quote_type_label" required value="Homeowners Comprehensive (HO-5)" style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main);">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Coverage Limit Requested *</label>
                    <select name="coverage" required style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main); background: #ffffff;">
                        <option value="$500,000 Standard Protection">$500,000 Standard Protection</option>
                        <option value="$1,000,000 Comprehensive Limit" selected>$1,000,000 Comprehensive Limit</option>
                        <option value="$2,000,000 High-Value Estate Limit">$2,000,000 High-Value Estate Limit</option>
                        <option value="$5,000,000 Commercial Umbrella Tier">$5,000,000 Commercial Umbrella Tier</option>
                        <option value="$10,000,000 Executive Syndicate Tier">$10,000,000 Executive Syndicate Tier</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Property / Asset Location (ZIP / City)</label>
                    <input type="text" name="location" placeholder="e.g. Austin, TX 78701" value="Austin, TX 78701" style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main);">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Specific Coverage Notes, Property Specifications &amp; Endorsements</label>
                <textarea name="notes" rows="3" placeholder="Provide details on square footage, construction type, vehicle VIN, or specialized security systems..." style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main);"></textarea>
            </div>

            <div style="padding-top: 16px; border-top: 1px solid var(--border-light); display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" onclick="closeUserModal('modalRequestQuote')" style="padding: 10px 18px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); background: #ffffff; color: var(--text-main); font-weight: 600; font-size: 0.875rem; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 10px 22px; border-radius: var(--radius-sm); border: none; background: var(--brand-blue); color: #ffffff; font-weight: 700; font-size: 0.875rem; cursor: pointer; box-shadow: var(--shadow-sm);">
                    Submit Quote Inquiry
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ====================================================================
     MODAL: VIEW QUOTE PROPOSAL DOSSIER
     ==================================================================== -->
<div class="user-modal-overlay" id="modalViewQuoteDetail" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: var(--radius-md); max-width: 640px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
        <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <code id="viewQuoteRef" style="font-family: var(--font-mono); font-size: 1.125rem; font-weight: 800; color: var(--brand-blue);"></code>
                <span id="viewQuoteStatusBadge" style="padding: 3px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: 700;"></span>
            </div>
            <button type="button" onclick="closeUserModal('modalViewQuoteDetail')" style="border: none; background: none; font-size: 1.5rem; line-height: 1; cursor: pointer; color: var(--text-muted);">&times;</button>
        </div>
        <div style="padding: 24px;">
            <h3 id="viewQuoteTitle" style="margin: 0 0 16px; font-size: 1.25rem; font-weight: 700; color: var(--brand-navy);"></h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 20px; background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block;">Coverage Limit</span>
                    <strong id="viewQuoteCoverage" style="font-size: 0.9375rem; color: var(--text-main);"></strong>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block;">Annual Premium</span>
                    <strong id="viewQuotePremium" style="font-size: 1.0625rem; color: #059669; font-family: var(--font-mono);"></strong>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block;">Applicant Name</span>
                    <div id="viewQuoteApplicant" style="font-size: 0.875rem; color: var(--text-main); font-weight: 600;"></div>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block;">Location / Territory</span>
                    <div id="viewQuoteLocation" style="font-size: 0.875rem; color: var(--text-secondary);"></div>
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-size: 0.8125rem; font-weight: 700; color: var(--text-main); display: block; margin-bottom: 6px;">Underwriter Assessment &amp; Proposal Conditions</label>
                <div id="viewQuoteNotes" style="font-size: 0.875rem; color: var(--text-secondary); line-height: 1.6; background: #ffffff; border: 1px solid var(--border-light); padding: 12px 14px; border-radius: 6px;"></div>
            </div>

            <div id="viewQuoteBindActionWrap" style="text-align: right; display: none;">
                <button type="button" id="viewQuoteBindBtn" style="background: #059669; color: #ffffff; border: none; padding: 10px 20px; border-radius: var(--radius-sm); font-size: 0.875rem; font-weight: 700; cursor: pointer;">
                    Accept &amp; Bind Policy Contract
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.quote-filter-btn {
    background: #ffffff;
    border: 1px solid var(--border-light);
    color: var(--text-secondary);
    padding: 7px 14px;
    border-radius: 20px;
    font-size: 0.8125rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}
.quote-filter-btn:hover {
    background: #f8fafc;
    color: var(--brand-blue);
    border-color: var(--brand-blue);
}
.quote-filter-btn.active {
    background: var(--brand-blue);
    color: #ffffff;
    border-color: var(--brand-blue);
}
</style>

<script>
function openRequestQuoteModal() {
    document.getElementById('modalRequestQuote').style.display = 'flex';
}

function openViewQuoteModal(q) {
    document.getElementById('viewQuoteRef').innerText = q.quote_ref;
    document.getElementById('viewQuoteTitle').innerText = q.type_label || 'Insurance Rate Proposal';
    document.getElementById('viewQuoteCoverage').innerText = q.coverage || '$500,000 Standard';
    document.getElementById('viewQuotePremium').innerText = q.premium || 'Pending Underwriter Rating';
    document.getElementById('viewQuoteApplicant').innerText = q.name || 'Valued Policyholder';
    document.getElementById('viewQuoteLocation').innerText = q.location || 'United States';
    document.getElementById('viewQuoteNotes').innerText = q.notes || 'Standard underwriting guidelines apply. Proposal valid for 30 calendar days from issue.';

    const statusBadge = document.getElementById('viewQuoteStatusBadge');
    statusBadge.innerText = (q.status || 'new').toUpperCase();
    if (q.status === 'quoted') {
        statusBadge.style.background = '#ecfdf5';
        statusBadge.style.color = '#047857';
        document.getElementById('viewQuoteBindActionWrap').style.display = 'block';
        document.getElementById('viewQuoteBindBtn').onclick = function() {
            closeUserModal('modalViewQuoteDetail');
            acceptAndBindQuote(q.id, q.quote_ref);
        };
    } else {
        statusBadge.style.background = '#eff6ff';
        statusBadge.style.color = '#1d4ed8';
        document.getElementById('viewQuoteBindActionWrap').style.display = 'none';
    }

    document.getElementById('modalViewQuoteDetail').style.display = 'flex';
}

function closeUserModal(id) {
    const el = document.getElementById(id);
    if (el) el.style.display = 'none';
}

function onQuoteTypeChanged(val) {
    const labels = {
        home: 'Homeowners Comprehensive (HO-5)',
        auto: 'Auto / Motor Vehicle Fleet',
        business: 'Commercial Business Owners (BOP)',
        umbrella: 'Excess Umbrella & Worldwide Liability',
        cyber: 'Cyber Security & Data Breach',
        life: 'Universal Life & Key Person'
    };
    document.getElementById('new_quote_type_label').value = labels[val] || 'Custom Line';
}

function filterUserQuotes(status, btn) {
    document.querySelectorAll('.quote-filter-btn').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');

    const items = document.querySelectorAll('.quote-card-item');
    items.forEach(card => {
        const cardStatus = card.getAttribute('data-status');
        if (status === 'all') {
            card.style.display = '';
        } else if (status === 'reviewing') {
            card.style.display = (cardStatus === 'new' || cardStatus === 'reviewing') ? '' : 'none';
        } else {
            card.style.display = (cardStatus === status) ? '' : 'none';
        }
    });
}

function searchUserQuotes() {
    const query = (document.getElementById('quoteSearchInput').value || '').toLowerCase().trim();
    const items = document.querySelectorAll('.quote-card-item');
    items.forEach(card => {
        const text = card.innerText.toLowerCase();
        card.style.display = (!query || text.includes(query)) ? '' : 'none';
    });
}

function acceptAndBindQuote(quoteId, quoteRef) {
    SureboundModal.confirm({
        title: 'Bind Insurance Policy',
        badge: '#' + quoteRef,
        message: 'Are you ready to accept proposal #' + quoteRef + ' and bind this coverage into an active insurance policy contract with immediate effect?',
        confirmText: 'Accept & Bind Policy',
        cancelText: 'Review Later',
        type: 'success',
        icon: 'shield-check'
    }).then(confirmed => {
        if (!confirmed) return;

        SureboundModal.toast({
            message: 'Binding insurance policy with underwriters...',
            type: 'info',
            duration: 2500
        });

        fetch(`/dashboard/quote/${quoteId}/accept`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                SureboundModal.alert({
                    title: 'Policy Bound Successfully!',
                    badge: '#' + quoteRef,
                    message: data.message || 'Congratulations! Your policy contract has been bound successfully.',
                    type: 'success',
                    icon: 'shield-check',
                    buttonText: 'View My Policies'
                }).then(() => {
                    window.location.href = '{{ route("user.policies") }}';
                });
            } else {
                SureboundModal.alert({
                    title: 'Binding Notice',
                    message: data.message || 'Could not bind quote at this time.',
                    type: 'danger',
                    icon: 'alert',
                    buttonText: 'Close'
                });
            }
        })
        .catch(err => {
            SureboundModal.alert({
                title: 'Connection Error',
                message: 'Error accepting quote: ' + err.message,
                type: 'danger',
                buttonText: 'Close'
            });
        });
    });
}
</script>
@endsection
