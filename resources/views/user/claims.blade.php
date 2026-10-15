@extends('layouts.user')

@section('content')
<div class="claims-page-wrapper">

    <!-- TOP HEADER -->
    <div class="section-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
        <div>
            <h1 class="section-title" style="font-size: 1.75rem; font-weight: 800; color: var(--brand-navy); margin-bottom: 4px;">Claims Center &amp; FNOL Intake</h1>
            <p class="section-subtitle" style="font-size: 0.9375rem; color: var(--text-muted);">
                Submit first notice of loss (FNOL), track assigned field adjusters, view damage appraisals, and monitor draft settlement disbursements.
            </p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <button type="button" onclick="openFileClaimModal()" class="btn-primary-action" style="display: inline-flex; align-items: center; gap: 8px; background: #dc2626; color: #fff; padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25); border: none; cursor: pointer; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>File a Claim (FNOL)</span>
            </button>
            <a href="tel:18005555677" style="display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: var(--shadow-sm); text-decoration: none; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span>24/7 Emergency Dispatch</span>
            </a>
        </div>
    </div>

    <!-- METRICS / KPI CARDS -->
    <div class="metrics-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; margin-bottom: 28px;">
        
        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Total Claims Filed</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; color: var(--brand-blue); display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); line-height: 1.2;">{{ $claims->count() }}</div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Lifetime incident records
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Active Investigations</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #fffbeb; color: #d97706; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #d97706; line-height: 1.2;">{{ $claims->whereIn('status', ['submitted', 'reviewing'])->count() }}</div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Adjusters currently dispatched
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Settlements Resolved</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #059669; line-height: 1.2;">{{ $claims->whereIn('status', ['approved', 'paid'])->count() }}</div>
            <div style="font-size: 0.8125rem; color: #059669; font-weight: 500; margin-top: 4px;">
                {{ $claims->where('status', 'paid')->count() }} Claims Disbursed
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Loss Reserves / Disbursed</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            @php
                $totalReserveSum = 0;
                foreach ($claims as $cItem) {
                    $num = (float) preg_replace('/[^0-9.]/', '', $cItem->estimated_loss ?? '0');
                    $totalReserveSum += $num;
                }
            @endphp
            <div style="font-size: 1.75rem; font-weight: 800; color: #dc2626; line-height: 1.2;">${{ number_format($totalReserveSum, 2) }}</div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Cumulative claim evaluations
            </div>
        </div>

    </div>

    <!-- CONTROLS & FILTER BAR -->
    <div class="claims-controls-bar" style="background: #ffffff; padding: 14px 20px; border-radius: var(--radius-md); border: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 24px; box-shadow: var(--shadow-sm);">
        
        <div class="filter-pills" style="display: flex; gap: 8px; flex-wrap: wrap;">
            <button type="button" class="claim-filter-btn active" data-filter="all" onclick="filterUserClaims('all', this)">All Claims ({{ $claims->count() }})</button>
            <button type="button" class="claim-filter-btn" data-filter="submitted" onclick="filterUserClaims('submitted', this)">Submitted ({{ $claims->where('status', 'submitted')->count() }})</button>
            <button type="button" class="claim-filter-btn" data-filter="reviewing" onclick="filterUserClaims('reviewing', this)">Under Review ({{ $claims->where('status', 'reviewing')->count() }})</button>
            <button type="button" class="claim-filter-btn" data-filter="approved" onclick="filterUserClaims('approved', this)">Approved ({{ $claims->where('status', 'approved')->count() }})</button>
            <button type="button" class="claim-filter-btn" data-filter="paid" onclick="filterUserClaims('paid', this)">Paid &amp; Settled ({{ $claims->where('status', 'paid')->count() }})</button>
            <button type="button" class="claim-filter-btn" data-filter="declined" onclick="filterUserClaims('declined', this)">Declined</button>
        </div>

        <div style="display: flex; gap: 12px; align-items: center; flex: 1; max-width: 380px; min-width: 240px;">
            <div style="position: relative; width: 100%;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="claimSearchInput" placeholder="Search by claim #, policy #, peril, adjuster..." onkeyup="searchUserClaims()" style="width: 100%; padding: 9px 12px 9px 38px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); background: #f8fafc; font-size: 0.875rem; color: var(--text-main); outline: none; transition: border-color 0.2s;">
            </div>
        </div>

    </div>

    <!-- CLAIMS LIST CARDS -->
    <div class="claims-list-container" id="claimsListGrid" style="display: flex; flex-direction: column; gap: 20px;">
        @forelse($claims as $c)
        <div class="claim-card-item" data-status="{{ strtolower($c->status) }}" data-number="{{ strtolower($c->claim_number) }}" data-policy="{{ strtolower($c->policy_number) }}" data-peril="{{ strtolower($c->incident_type) }}" data-adjuster="{{ strtolower($c->assigned_adjuster) }}" style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
            
            <!-- Card Header -->
            <div style="padding: 20px 24px; background: #ffffff; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div style="display: flex; align-items: center; gap: 14px;">
                    <div style="width: 46px; height: 46px; border-radius: 12px; background: {{ $c->status === 'paid' ? '#ecfdf5' : ($c->status === 'approved' ? '#eff6ff' : ($c->status === 'reviewing' ? '#fffbeb' : '#fef2f2')) }}; color: {{ $c->status === 'paid' ? '#059669' : ($c->status === 'approved' ? '#2563eb' : ($c->status === 'reviewing' ? '#d97706' : '#dc2626')) }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        @if($c->status === 'paid')
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @elseif($c->status === 'approved')
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        @elseif($c->status === 'reviewing')
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @else
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        @endif
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                            <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">{{ $c->incident_type ?: 'General Property / Casualty Loss' }}</h3>
                            <code style="font-family: var(--font-mono); font-size: 0.8125rem; font-weight: 700; color: #0284c7; background: #e0f2fe; padding: 2px 8px; border-radius: 4px; border: 1px solid #bae6fd;">
                                {{ $c->claim_number }}
                            </code>
                            @if($c->priority === 'urgent')
                                <span style="font-size: 0.6875rem; font-weight: 700; background: #fef2f2; color: #dc2626; border: 1px solid #fca5a5; padding: 2px 6px; border-radius: 12px; text-transform: uppercase;">Urgent</span>
                            @endif
                        </div>
                        <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 3px;">
                            Date of Loss: <strong>{{ $c->incident_date ? \Carbon\Carbon::parse($c->incident_date)->format('M d, Y') : 'Recent' }}</strong> • Underwriting Policy: <span style="font-family: var(--font-mono); font-weight: 600; color: var(--text-main);">{{ $c->policy_number }}</span>
                        </div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 10px;">
                    @if($c->status === 'paid')
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 20px; font-size: 0.8125rem; font-weight: 700; background: #10b981; color: #ffffff;">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Settlement Disbursed
                        </span>
                    @elseif($c->status === 'approved')
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 20px; font-size: 0.8125rem; font-weight: 700; background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #10b981;"></span>
                            Settlement Approved
                        </span>
                    @elseif($c->status === 'reviewing')
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 20px; font-size: 0.8125rem; font-weight: 700; background: #fffbeb; color: #b45309; border: 1px solid #fde68a;">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #f59e0b;"></span>
                            Field Inspection &amp; Review
                        </span>
                    @elseif($c->status === 'declined' || $c->status === 'rejected')
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 20px; font-size: 0.8125rem; font-weight: 700; background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3;">
                            Declined
                        </span>
                    @else
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 20px; font-size: 0.8125rem; font-weight: 700; background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe;">
                            FNOL Intake Submitted
                        </span>
                    @endif
                </div>
            </div>

            <!-- Settlement Stepper Progress Visualizer -->
            <div style="padding: 16px 24px; background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
                <div style="display: flex; justify-content: space-between; position: relative;">
                    <!-- Track line -->
                    <div style="position: absolute; top: 12px; left: 24px; right: 24px; height: 3px; background: #e2e8f0; z-index: 1;"></div>
                    @php
                        $progressWidth = '10%';
                        if ($c->status === 'reviewing') $progressWidth = '45%';
                        if ($c->status === 'approved') $progressWidth = '75%';
                        if ($c->status === 'paid') $progressWidth = '100%';
                    @endphp
                    <div style="position: absolute; top: 12px; left: 24px; width: calc({{ $progressWidth }} - 24px); height: 3px; background: #059669; z-index: 2; transition: width 0.3s;"></div>

                    <!-- Steps -->
                    <div style="position: relative; z-index: 3; text-align: center;">
                        <div style="width: 26px; height: 26px; border-radius: 50%; background: #059669; color: #fff; font-size: 0.75rem; font-weight: 700; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">✓</div>
                        <span style="font-size: 0.6875rem; font-weight: 700; color: #0f172a; text-transform: uppercase;">1. FNOL Filed</span>
                    </div>

                    <div style="position: relative; z-index: 3; text-align: center;">
                        <div style="width: 26px; height: 26px; border-radius: 50%; background: {{ in_array($c->status, ['reviewing', 'approved', 'paid']) ? '#059669' : '#e2e8f0' }}; color: {{ in_array($c->status, ['reviewing', 'approved', 'paid']) ? '#fff' : '#64748b' }}; font-size: 0.75rem; font-weight: 700; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">
                            {{ in_array($c->status, ['reviewing', 'approved', 'paid']) ? '✓' : '2' }}
                        </div>
                        <span style="font-size: 0.6875rem; font-weight: 700; color: {{ in_array($c->status, ['reviewing', 'approved', 'paid']) ? '#0f172a' : '#94a3b8' }}; text-transform: uppercase;">2. Adjuster Assigned</span>
                    </div>

                    <div style="position: relative; z-index: 3; text-align: center;">
                        <div style="width: 26px; height: 26px; border-radius: 50%; background: {{ in_array($c->status, ['approved', 'paid']) ? '#059669' : '#e2e8f0' }}; color: {{ in_array($c->status, ['approved', 'paid']) ? '#fff' : '#64748b' }}; font-size: 0.75rem; font-weight: 700; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">
                            {{ in_array($c->status, ['approved', 'paid']) ? '✓' : '3' }}
                        </div>
                        <span style="font-size: 0.6875rem; font-weight: 700; color: {{ in_array($c->status, ['approved', 'paid']) ? '#0f172a' : '#94a3b8' }}; text-transform: uppercase;">3. Settlement Approved</span>
                    </div>

                    <div style="position: relative; z-index: 3; text-align: center;">
                        <div style="width: 26px; height: 26px; border-radius: 50%; background: {{ $c->status === 'paid' ? '#059669' : '#e2e8f0' }}; color: {{ $c->status === 'paid' ? '#fff' : '#64748b' }}; font-size: 0.75rem; font-weight: 700; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">
                            {{ $c->status === 'paid' ? '✓' : '4' }}
                        </div>
                        <span style="font-size: 0.6875rem; font-weight: 700; color: {{ $c->status === 'paid' ? '#059669' : '#94a3b8' }}; text-transform: uppercase;">4. Draft Disbursed</span>
                    </div>
                </div>
            </div>

            <!-- Key Terms Grid -->
            <div style="padding: 20px 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; background: #ffffff; border-bottom: 1px solid #f1f5f9;">
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">Estimated Loss Reserve</span>
                    <strong style="font-size: 1.125rem; color: #dc2626; font-family: var(--font-mono);">{{ $c->estimated_loss ?: '$0.00' }}</strong>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">Assigned Adjuster</span>
                    <div style="font-size: 0.875rem; color: var(--text-main); font-weight: 600;">{{ $c->assigned_adjuster ?: 'Awaiting assignment' }}</div>
                    <div style="font-size: 0.75rem; color: #0284c7; font-weight: 500;">Direct Underwriting Liaison</div>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">Occurrence Location</span>
                    <div style="font-size: 0.875rem; color: var(--text-secondary); font-weight: 500;">{{ $c->incident_location ?: 'On file with policy' }}</div>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">Claimant</span>
                    <div style="font-size: 0.875rem; color: var(--text-main); font-weight: 600;">{{ $c->claimant_name }}</div>
                </div>
            </div>

            <!-- Adjuster Investigation Log Callout -->
            @if($c->adjuster_notes)
            <div style="padding: 14px 24px; background: #fffbeb; border-bottom: 1px solid #fde68a;">
                <div style="display: flex; align-items: flex-start; gap: 8px;">
                    <div style="color: #b45309; margin-top: 1px;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div style="font-size: 0.8125rem; color: #78350f; line-height: 1.5;">
                        <strong style="color: #92400e;">Adjuster Investigation Update:</strong> {{ $c->adjuster_notes }}
                    </div>
                </div>
            </div>
            @endif

            <!-- Card Actions Footer -->
            <div style="padding: 14px 24px; background: #ffffff; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div style="font-size: 0.8125rem; color: var(--text-muted);">
                    All settlements directly funded via NACHA Automated Clearing House &amp; FedNow.
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <button type="button" onclick='openViewClaimModal(@json($c))' style="background: #f8fafc; color: var(--text-main); border: 1px solid var(--border-light); padding: 8px 14px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; cursor: pointer;">
                        View Claim Dossier
                    </button>
                    <a href="{{ route('user.support') }}" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; padding: 8px 14px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none;">
                        Contact Adjuster
                    </a>
                </div>
            </div>

        </div>
        @empty
        <div style="background: #ffffff; border-radius: var(--radius-md); padding: 60px 24px; text-align: center; border: 1px solid var(--border-light);">
            <div style="font-size: 3rem; margin-bottom: 12px;">🛡️</div>
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 6px;">No Insurance Claims on Record</h3>
            <p style="font-size: 0.9375rem; color: var(--text-muted); max-width: 440px; margin: 0 auto 20px;">
                All insured properties, motor vehicles, and commercial schedules are in continuous good standing with zero active loss notices.
            </p>
            <button type="button" onclick="openFileClaimModal()" class="btn-primary-action" style="background: #dc2626; color: #fff; padding: 10px 22px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; border: none; cursor: pointer;">
                File First Notice of Loss (FNOL)
            </button>
        </div>
        @endforelse
    </div>

</div>

<!-- ====================================================================
     MODAL: CUSTOMER FILE FIRST NOTICE OF LOSS (FNOL)
     ==================================================================== -->
<div class="user-modal-overlay" id="modalFileClaim" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: var(--radius-md); max-width: 720px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
        <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 38px; height: 38px; border-radius: 10px; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 1.1875rem; font-weight: 700; color: var(--brand-navy);">File First Notice of Loss (FNOL)</h3>
                    <p style="margin: 2px 0 0; font-size: 0.8125rem; color: var(--text-muted);">Initiate official claims investigation and emergency mitigation dispatch</p>
                </div>
            </div>
            <button type="button" onclick="closeUserModal('modalFileClaim')" style="border: none; background: none; font-size: 1.5rem; line-height: 1; cursor: pointer; color: var(--text-muted);">&times;</button>
        </div>

        <form action="{{ route('user.claims.store') }}" method="POST" id="userFileClaimForm" style="padding: 24px;">
            @csrf
            
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 16px; margin-bottom: 18px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Select Active Bound Policy *</label>
                <select name="policy_number" id="claim_policy_select" required onchange="onUserClaimPolicyChanged(this)" style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main); background: #ffffff;">
                    <option value="">-- Choose Bound Policy --</option>
                    @foreach($policies as $p)
                        <option value="{{ $p->policy_number }}" data-item="{{ $p->insured_item }}" data-type="{{ $p->type_label }}">
                            {{ $p->policy_number }} — {{ $p->type_label }} [{{ $p->insured_item }}]
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Date of Loss / Occurrence *</label>
                    <input type="date" name="incident_date" required value="{{ date('Y-m-d') }}" style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main);">
                </div>

                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Peril / Loss Category *</label>
                    <select name="incident_type" required style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main); background: #ffffff;">
                        <option value="Water Damage & Plumbing Rupture">Water Damage &amp; Plumbing Rupture</option>
                        <option value="Vehicle Collision / Physical Damage">Vehicle Collision / Physical Damage</option>
                        <option value="Severe Windstorm & Hail">Severe Windstorm &amp; Hail</option>
                        <option value="Fire, Smoke & Lightning">Fire, Smoke &amp; Lightning</option>
                        <option value="Theft, Burglary & Vandalism">Theft, Burglary &amp; Vandalism</option>
                        <option value="Bodily Injury Liability">Bodily Injury Liability</option>
                        <option value="Equipment Breakdown">Equipment Breakdown</option>
                        <option value="General Property Damage">General Property Damage</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Occurrence Location / Property Address</label>
                    <input type="text" name="incident_location" id="user_claim_location" placeholder="e.g. 742 Evergreen Terrace, Austin, TX" style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main);">
                </div>

                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Estimated Repair / Loss Amount ($ USD) *</label>
                    <input type="text" name="estimated_loss" required placeholder="$5,000.00" value="$5,000.00" style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main);">
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Detailed Occurrence Narrative &amp; Damage Description *</label>
                <textarea name="incident_description" rows="3" required placeholder="Describe what occurred, point of origin, damaged areas, and any emergency mitigation measures taken..." style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main);"></textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Claim Urgency Level</label>
                <select name="priority" style="width: 100%; padding: 10px 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); font-size: 0.875rem; color: var(--text-main); background: #ffffff;">
                    <option value="normal" selected>Normal</option>
                    <option value="urgent">Urgent (Uninhabitable property / Major accident)</option>
                    <option value="low">Low</option>
                </select>
            </div>

            <div style="padding-top: 16px; border-top: 1px solid var(--border-light); display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" onclick="closeUserModal('modalFileClaim')" style="padding: 10px 18px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); background: #ffffff; color: var(--text-main); font-weight: 600; font-size: 0.875rem; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 10px 24px; border-radius: var(--radius-sm); border: none; background: #dc2626; color: #ffffff; font-weight: 700; font-size: 0.875rem; cursor: pointer; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);">
                    Submit First Notice of Loss
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ====================================================================
     MODAL: VIEW CLAIM DOSSIER
     ==================================================================== -->
<div class="user-modal-overlay" id="modalViewClaimDetail" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: var(--radius-md); max-width: 680px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
        <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <code id="viewClaimId" style="font-family: var(--font-mono); font-size: 1.125rem; font-weight: 800; color: #0284c7;"></code>
                <span id="viewClaimStatusBadge" style="padding: 3px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: 700;"></span>
            </div>
            <button type="button" onclick="closeUserModal('modalViewClaimDetail')" style="border: none; background: none; font-size: 1.5rem; line-height: 1; cursor: pointer; color: var(--text-muted);">&times;</button>
        </div>
        <div style="padding: 24px;">
            <h3 id="viewClaimPeril" style="margin: 0 0 16px; font-size: 1.25rem; font-weight: 700; color: var(--brand-navy);"></h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 20px; background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block;">Policy Contract</span>
                    <strong id="viewClaimPolicy" style="font-size: 0.9375rem; color: var(--text-main); font-family: var(--font-mono);"></strong>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block;">Loss Reserve Estimate</span>
                    <strong id="viewClaimReserve" style="font-size: 1.0625rem; color: #dc2626; font-family: var(--font-mono);"></strong>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block;">Date of Loss</span>
                    <div id="viewClaimDate" style="font-size: 0.875rem; color: var(--text-main); font-weight: 600;"></div>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700; display: block;">Assigned Field Adjuster</span>
                    <div id="viewClaimAdjuster" style="font-size: 0.875rem; color: #4338ca; font-weight: 600;"></div>
                </div>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="font-size: 0.8125rem; font-weight: 700; color: var(--text-main); display: block; margin-bottom: 6px;">Occurrence &amp; Damage Description</label>
                <div id="viewClaimNarrative" style="font-size: 0.875rem; color: var(--text-secondary); line-height: 1.6; background: #ffffff; border: 1px solid var(--border-light); padding: 12px 14px; border-radius: 6px;"></div>
            </div>

            <div id="viewClaimNotesWrap" style="margin-bottom: 18px; display: none;">
                <label style="font-size: 0.8125rem; font-weight: 700; color: #92400e; display: block; margin-bottom: 6px;">Adjuster Investigation Log</label>
                <div id="viewClaimNotes" style="font-size: 0.875rem; color: #78350f; line-height: 1.5; background: #fffbeb; border: 1px solid #fde68a; padding: 12px 14px; border-radius: 6px;"></div>
            </div>

            <div style="padding-top: 14px; border-top: 1px solid var(--border-light); text-align: right;">
                <button type="button" onclick="closeUserModal('modalViewClaimDetail')" style="padding: 9px 18px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); background: #ffffff; color: var(--text-main); font-weight: 600; font-size: 0.875rem; cursor: pointer;">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
.claim-filter-btn {
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
.claim-filter-btn:hover {
    background: #f8fafc;
    color: var(--brand-blue);
    border-color: var(--brand-blue);
}
.claim-filter-btn.active {
    background: var(--brand-blue);
    color: #ffffff;
    border-color: var(--brand-blue);
}
</style>

<script>
function openFileClaimModal() {
    document.getElementById('modalFileClaim').style.display = 'flex';
}

function closeUserModal(id) {
    const el = document.getElementById(id);
    if (el) el.style.display = 'none';
}

function onUserClaimPolicyChanged(selectEl) {
    const opt = selectEl.options[selectEl.selectedIndex];
    if (opt && opt.dataset.item) {
        document.getElementById('user_claim_location').value = opt.dataset.item;
    }
}

function openViewClaimModal(c) {
    document.getElementById('viewClaimId').innerText = c.claim_number;
    document.getElementById('viewClaimPeril').innerText = c.incident_type || 'Property & Casualty Loss';
    document.getElementById('viewClaimPolicy').innerText = c.policy_number;
    document.getElementById('viewClaimReserve').innerText = c.estimated_loss || '$0.00';
    document.getElementById('viewClaimDate').innerText = c.incident_date ? new Date(c.incident_date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'N/A';
    document.getElementById('viewClaimAdjuster').innerText = c.assigned_adjuster || 'Awaiting Underwriting Review';
    document.getElementById('viewClaimNarrative').innerText = c.incident_description || 'No damage details provided.';

    const notesWrap = document.getElementById('viewClaimNotesWrap');
    if (c.adjuster_notes && c.adjuster_notes.trim() !== '') {
        document.getElementById('viewClaimNotes').innerText = c.adjuster_notes;
        notesWrap.style.display = 'block';
    } else {
        notesWrap.style.display = 'none';
    }

    const badge = document.getElementById('viewClaimStatusBadge');
    badge.innerText = (c.status || 'submitted').toUpperCase();
    if (c.status === 'paid') {
        badge.style.background = '#ecfdf5';
        badge.style.color = '#047857';
    } else if (c.status === 'approved') {
        badge.style.background = '#eff6ff';
        badge.style.color = '#1d4ed8';
    } else if (c.status === 'reviewing') {
        badge.style.background = '#fffbeb';
        badge.style.color = '#b45309';
    } else {
        badge.style.background = '#fef2f2';
        badge.style.color = '#dc2626';
    }

    document.getElementById('modalViewClaimDetail').style.display = 'flex';
}

function filterUserClaims(status, btn) {
    document.querySelectorAll('.claim-filter-btn').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');

    const items = document.querySelectorAll('.claim-card-item');
    items.forEach(card => {
        const cardStatus = card.getAttribute('data-status');
        if (status === 'all') {
            card.style.display = '';
        } else if (status === 'declined') {
            card.style.display = (cardStatus === 'declined' || cardStatus === 'rejected') ? '' : 'none';
        } else {
            card.style.display = (cardStatus === status) ? '' : 'none';
        }
    });
}

function searchUserClaims() {
    const query = (document.getElementById('claimSearchInput').value || '').toLowerCase().trim();
    const items = document.querySelectorAll('.claim-card-item');
    items.forEach(card => {
        const text = card.innerText.toLowerCase();
        card.style.display = (!query || text.includes(query)) ? '' : 'none';
    });
}
</script>
@endsection
