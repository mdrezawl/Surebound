@extends('layouts.user')

@section('content')
<!-- DASHBOARD PAGE CONTAINER -->
<div class="dashboard-page-container">
    
    <!-- TOP SECTION: MAIN OVERVIEW + RIGHT SIDEBAR -->
    <div class="dashboard-content">
        
        <!-- LEFT PANEL -->
        <div class="dashboard-left">
            
            <!-- HERO -->
            <div class="hero-banner">
                <div class="hero-content">
                    <div class="hero-greeting">Hello, {{ explode(' ', Auth::user()->name ?? 'Md Rejawl')[0] }} 👋</div>
                    <h1 class="hero-title">Welcome back!</h1>
                    <p class="hero-subtitle">Here's an overview of your insurance journey. Manage your policies, make payments, and get the support you need &mdash; all in one place.</p>
                    
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <div class="hero-stat-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="hero-stat-info">
                                <span class="hero-stat-val">{{ $activePoliciesCount }}</span>
                                <span class="hero-stat-label">Active Policies</span>
                            </div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <div class="hero-stat-info">
                                <span class="hero-stat-val">{{ $pendingClaimsCount }}</span>
                                <span class="hero-stat-label">Claims (In Progress)</span>
                            </div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="hero-stat-info">
                                <span class="hero-stat-val">{{ $invoices->whereIn('status', ['pending', 'overdue'])->count() }}</span>
                                <span class="hero-stat-label">Upcoming Payments</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FIND RIGHT COVERAGE -->
            <div class="dashboard-section">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Find the Right Coverage</h2>
                        <p class="section-subtitle">Explore our insurance solutions designed for your needs.</p>
                    </div>
                    <a href="{{ route('user.quote') }}" class="view-all">View All Categories &rarr;</a>
                </div>
                
                <div class="coverage-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
                    <a href="{{ route('home-insurance') }}" class="coverage-card" style="text-decoration: none; color: inherit;">
                        <div class="coverage-icon" style="background: #eff6ff; color: #1d4ed8;">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        </div>
                        <div class="coverage-info">
                            <h4>Home Insurance</h4>
                            <p>Protect your sanctuary.</p>
                        </div>
                        <div class="coverage-arrow">&rarr;</div>
                    </a>

                    <a href="{{ route('auto-insurance') }}" class="coverage-card" style="text-decoration: none; color: inherit;">
                        <div class="coverage-icon" style="background: #ecfdf5; color: #059669;">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        </div>
                        <div class="coverage-info">
                            <h4>Auto Insurance</h4>
                            <p>Drive with confidence.</p>
                        </div>
                        <div class="coverage-arrow">&rarr;</div>
                    </a>

                    <a href="{{ route('life-insurance') }}" class="coverage-card" style="text-decoration: none; color: inherit;">
                        <div class="coverage-icon" style="background: #fdf2f8; color: #db2777;">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>
                        </div>
                        <div class="coverage-info">
                            <h4>Life Insurance</h4>
                            <p>Family financial certainty.</p>
                        </div>
                        <div class="coverage-arrow">&rarr;</div>
                    </a>

                    <a href="{{ route('health-insurance') }}" class="coverage-card" style="text-decoration: none; color: inherit;">
                        <div class="coverage-icon" style="background: #f0fdf4; color: #16a34a;">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        </div>
                        <div class="coverage-info">
                            <h4>Health Insurance</h4>
                            <p>Live healthy &amp; protected.</p>
                        </div>
                        <div class="coverage-arrow">&rarr;</div>
                    </a>

                    <a href="{{ route('umbrella-insurance') }}" class="coverage-card" style="text-decoration: none; color: inherit;">
                        <div class="coverage-icon" style="background: #f3e8ff; color: #7c3aed;">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div class="coverage-info">
                            <h4>Umbrella Insurance</h4>
                            <p>$1M-$10M excess shield.</p>
                        </div>
                        <div class="coverage-arrow">&rarr;</div>
                    </a>
                    
                    <a href="{{ route('business-insurance') }}" class="coverage-card" style="text-decoration: none; color: inherit;">
                        <div class="coverage-icon" style="background: #fffbeb; color: #d97706;">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div class="coverage-info">
                            <h4>Business Insurance</h4>
                            <p>Commercial protection.</p>
                        </div>
                        <div class="coverage-arrow">&rarr;</div>
                    </a>
                </div>
            </div>
            
            <!-- MY POLICIES -->
            <div class="dashboard-section">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">My Policies</h2>
                        <p class="section-subtitle">View and manage your active and past insurance policies.</p>
                    </div>
                    <a href="{{ route('user.policies') }}" class="view-all">View All Policies &rarr;</a>
                </div>
                
                <div class="table-card">
                    <div class="table-responsive">
                        <table class="policies-table">
                            <thead>
                                <tr>
                                    <th>Policy No.</th>
                                    <th>Type</th>
                                    <th>Coverage</th>
                                    <th>Status</th>
                                    <th>Renewal Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($policies as $p)
                                <tr>
                                    <td>
                                        <div class="policy-id-cell">
                                            <div class="policy-icon-small">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            </div>
                                            <span style="font-family: monospace; font-weight: 700;">{{ $p->policy_number }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $p->type_label ?: ucfirst($p->type) }}</td>
                                    <td>
                                        <div class="coverage-details">
                                            <span>{{ $p->coverage_limit }}</span>
                                            <span>({{ $p->annual_premium }})</span>
                                        </div>
                                    </td>
                                    <td><span class="status-badge {{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                                    <td>{{ $p->renewal_date ? \Carbon\Carbon::parse($p->renewal_date)->format('M d, Y') : 'N/A' }}</td>
                                    <td><a href="{{ route('user.policies') }}" class="action-link">View Details &rarr;</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 32px; color: var(--text-muted);">
                                        No active policies found. You can request a quote to bind new coverage.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- RIGHT PANEL -->
        <aside class="dashboard-right">
            
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-header-bg"></div>
                <div class="profile-content">
                    <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Profile" class="profile-avatar">
                    <h2 class="profile-name">{{ Auth::user()->name ?? 'Md Rejawl' }}</h2>
                    <span class="profile-role">{{ Auth::user()?->title ?: 'Primary Policyholder' }}</span>
                    
                    <div class="profile-details">
                        <div class="profile-detail-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>{{ Auth::user()?->email ?? 'client@surebound.com' }}</span>
                        </div>
                        <div class="profile-detail-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>{{ Auth::user()?->phone ?: '+880 9612 345678' }}</span>
                        </div>
                        <div class="profile-detail-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ Auth::user()?->city ? Auth::user()->city.', '.Auth::user()->state : 'Austin, Texas' }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('user.settings') }}" class="btn-outline" style="text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        Edit Profile
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions-card">
                <h3>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Quick Actions
                </h3>
                <div class="action-list">
                    <a href="{{ route('user.quote') }}" class="action-item" style="text-decoration: none; color: inherit;">
                        <div class="action-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                        <div class="action-text">
                            <h4>Get a Quote</h4>
                            <p>Find the right coverage</p>
                        </div>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    
                    <a href="{{ route('user.payments') }}" class="action-item" style="text-decoration: none; color: inherit;">
                        <div class="action-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg></div>
                        <div class="action-text">
                            <h4>Make a Payment</h4>
                            <p>Pay your premium statement</p>
                        </div>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    
                    <a href="{{ route('user.claims') }}" class="action-item" style="text-decoration: none; color: inherit;">
                        <div class="action-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                        <div class="action-text">
                            <h4>File a Claim</h4>
                            <p>Start FNOL intake process</p>
                        </div>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    
                    <a href="{{ route('user.support') }}" class="action-item" style="text-decoration: none; color: inherit;">
                        <div class="action-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
                        <div class="action-text">
                            <h4>Contact Support</h4>
                            <p>Chat or call your advisor</p>
                        </div>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Need Help -->
            <div class="support-card">
                <h3>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Need Help?
                </h3>
                <p>Our support team is available 24/7 to assist you.</p>
                <div class="support-card-buttons">
                    <a href="{{ route('user.support') }}" class="btn-primary" style="text-decoration: none;">Chat Now</a>
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $supportContent['support_phone'] ?? '+8809612345678') }}" class="btn-call" style="text-decoration: none;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        Call {{ $supportContent['support_phone'] ?? '+880 9612 345678' }}
                    </a>
                </div>
            </div>
            
        </aside>
        
    </div>

    <!-- FULLWIDTH BOTTOM SECTION: PLACED BELOW NEED HELP & MY POLICIES -->
    <div class="bottom-widgets-section">
        <div class="bottom-widgets">
            
            <!-- Widget 1: Recent Claims -->
            <div class="widget-card">
                <div class="widget-header">
                    <h3>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Recent Claims
                    </h3>
                    <a href="{{ route('user.claims') }}" class="view-all" style="font-size: 0.875rem;">View All &rarr;</a>
                </div>
                <div class="mini-table-responsive">
                    <table class="mini-table">
                        <thead>
                            <tr>
                                <th>Claim No.</th>
                                <th>Policy No.</th>
                                <th>Date</th>
                                <th style="text-align: right;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($claims->take(3) as $c)
                            <tr>
                                <td><strong style="color: var(--brand-navy); font-family: monospace;">{{ $c->claim_number }}</strong></td>
                                <td><span style="font-family: monospace; color: var(--brand-blue);">{{ $c->policy_number }}</span></td>
                                <td style="color: var(--text-muted);">{{ $c->created_at ? $c->created_at->format('M d, Y') : 'Recent' }}</td>
                                <td style="text-align: right;"><span class="status-badge {{ $c->status }}">{{ ucfirst($c->status) }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 24px; color: var(--text-muted);">
                                    No claims on record.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Widget 2: Recent Activity -->
            <div class="widget-card">
                <div class="widget-header">
                    <h3>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Recent Activity
                    </h3>
                    <a href="{{ route('user.payments') }}" class="view-all" style="font-size: 0.875rem;">View Payments &rarr;</a>
                </div>
                <div class="timeline-list">
                    @php
                        $paidInvoices = $invoices->where('status', 'paid');
                    @endphp
                    @if($paidInvoices->count() > 0)
                        @foreach($paidInvoices->take(3) as $pi)
                        <div class="timeline-item">
                            <div class="timeline-icon purple"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                            <div class="timeline-content">
                                <div class="timeline-title">Payment successful</div>
                                <div class="timeline-desc">${{ number_format((float) $pi->total_amount, 2) }} paid for invoice #{{ $pi->invoice_number }}.</div>
                            </div>
                            <div class="timeline-date" style="font-size: 0.75rem; color: var(--text-muted);">{{ $pi->paid_at ? \Carbon\Carbon::parse($pi->paid_at)->format('M d, Y') : 'Recent' }}</div>
                        </div>
                        @endforeach
                    @elseif($invoices->count() > 0)
                        @foreach($invoices->take(2) as $pi)
                        <div class="timeline-item">
                            <div class="timeline-icon green"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                            <div class="timeline-content">
                                <div class="timeline-title">Premium Invoice Issued</div>
                                <div class="timeline-desc">${{ number_format((float) $pi->total_amount, 2) }} statement ready for #{{ $pi->invoice_number }}.</div>
                            </div>
                            <div class="timeline-date" style="font-size: 0.75rem; color: var(--text-muted);">{{ $pi->created_at ? $pi->created_at->format('M d, Y') : 'Recent' }}</div>
                        </div>
                        @endforeach
                    @else
                        <div style="padding: 24px; text-align: center; color: var(--text-muted); font-size: 0.875rem;">
                            No recent payment activity recorded yet.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Widget 3: Helpful Resources -->
            <div class="widget-card">
                <div class="widget-header">
                    <h3>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Helpful Resources
                    </h3>
                    <a href="{{ route('user.support') }}" class="view-all" style="font-size: 0.875rem;">View All &rarr;</a>
                </div>
                <div class="resource-list">
                    <a href="{{ route('user.documents') }}" class="resource-item" style="text-decoration: none; color: inherit;">
                        <div class="resource-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                        <div class="resource-info">
                            <h4>Insurance Guide</h4>
                            <p>Learn the basics and how it works.</p>
                        </div>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('user.support') }}" class="resource-item" style="text-decoration: none; color: inherit;">
                        <div class="resource-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                        <div class="resource-info">
                            <h4>FAQs</h4>
                            <p>Find quick answers to common questions.</p>
                        </div>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('user.support') }}" class="resource-item" style="text-decoration: none; color: inherit;">
                        <div class="resource-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
                        <div class="resource-info">
                            <h4>Need Assistance?</h4>
                            <p>Contact our support team.</p>
                        </div>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            
        </div>
    </div>

</div>
@endsection
