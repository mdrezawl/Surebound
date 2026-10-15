@extends('layouts.user')

@section('content')
<div class="policies-page-wrapper">

    <!-- TOP HEADER -->
    <div class="section-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
        <div>
            <h1 class="section-title" style="font-size: 1.75rem; font-weight: 800; color: var(--brand-navy); margin-bottom: 4px;">Active Insurance Policies &amp; Coverages</h1>
            <p class="section-subtitle" style="font-size: 0.9375rem; color: var(--text-muted);">
                Official policy certificates, itemized coverage schedules, deductibles, digital ID cards, and instant claim filing.
            </p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <a href="{{ route('user.quote') }}" class="btn-primary-action" style="display: inline-flex; align-items: center; gap: 8px; background: var(--brand-blue); color: #fff; padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: var(--shadow-sm); text-decoration: none; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Request New Coverage</span>
            </a>
            <a href="{{ route('user.claims') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: var(--shadow-sm); text-decoration: none; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>File a Claim</span>
            </a>
        </div>
    </div>

    <!-- METRICS / KPI CARDS -->
    <div class="metrics-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; margin-bottom: 28px;">
        
        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Active Coverages</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; color: var(--brand-blue); display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); line-height: 1.2;">{{ $activePoliciesCount }}</div>
            <div style="font-size: 0.8125rem; color: #059669; font-weight: 500; margin-top: 4px;">
                Continuous Protection
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Total Insured Limit</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: var(--brand-blue); line-height: 1.2;">${{ number_format($totalCoverageLimit) }}</div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Total Insured Assets Portfolio
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Combined Annual Premium</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); line-height: 1.2;">${{ number_format($totalAnnualPremium, 2) }}</div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Guaranteed Locked-in Rates
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Next Renewal</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #f3e8ff; color: #9333ea; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.25rem; font-weight: 800; color: var(--text-main); line-height: 1.3;">
                {{ $nextRenewalDate ? \Carbon\Carbon::parse($nextRenewalDate)->format('M d, Y') : 'Continuous' }}
            </div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                {{ $nextRenewalPolicy?->policy_number ?: 'All policies up to date' }}
            </div>
        </div>

    </div>

    <!-- CONTROLS & FILTER BAR -->
    <div class="policy-controls-bar" style="background: #ffffff; padding: 14px 20px; border-radius: var(--radius-md); border: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 24px; box-shadow: var(--shadow-sm);">
        
        <div class="filter-pills" style="display: flex; gap: 8px; flex-wrap: wrap;">
            <button type="button" class="policy-filter-btn active" data-filter="all" onclick="filterUserPolicies('all', this)">All Policies ({{ $totalPoliciesCount }})</button>
            <button type="button" class="policy-filter-btn" data-filter="home" onclick="filterUserPolicies('home', this)">Home</button>
            <button type="button" class="policy-filter-btn" data-filter="auto" onclick="filterUserPolicies('auto', this)">Auto</button>
            <button type="button" class="policy-filter-btn" data-filter="umbrella" onclick="filterUserPolicies('umbrella', this)">Umbrella</button>
            <button type="button" class="policy-filter-btn" data-filter="business" onclick="filterUserPolicies('business', this)">Business</button>
        </div>

        <div style="display: flex; gap: 12px; align-items: center; flex: 1; max-width: 380px; min-width: 240px;">
            <div style="position: relative; width: 100%;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="policySearchInput" placeholder="Search by policy #, asset, or carrier..." onkeyup="searchUserPolicies()" style="width: 100%; padding: 9px 12px 9px 38px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); background: #f8fafc; font-size: 0.875rem; color: var(--text-main); outline: none; transition: border-color 0.2s;">
            </div>
        </div>

    </div>

    <!-- POLICIES LIST / CARDS -->
    <div class="policies-list-container" id="policiesListGrid" style="display: flex; flex-direction: column; gap: 20px;">
        @forelse($policies as $p)
        <div class="policy-card-item" data-type="{{ strtolower($p->type) }}" data-number="{{ strtolower($p->policy_number) }}" data-asset="{{ strtolower($p->insured_item) }}" data-carrier="{{ strtolower($p->carrier) }}" style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
            
            <!-- Card Header -->
            <div style="padding: 20px 24px; background: #ffffff; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div style="display: flex; align-items: center; gap: 14px;">
                    <div style="width: 46px; height: 46px; border-radius: 12px; background: {{ $p->type === 'home' ? '#eff6ff' : ($p->type === 'auto' ? '#ecfdf5' : ($p->type === 'umbrella' ? '#f3e8ff' : '#fef3c7')) }}; color: {{ $p->type === 'home' ? '#1d4ed8' : ($p->type === 'auto' ? '#059669' : ($p->type === 'umbrella' ? '#7c3aed' : '#d97706')) }}; display: flex; align-items: center; justify-content: center;">
                        @if($p->type === 'home')
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        @elseif($p->type === 'auto')
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        @elseif($p->type === 'umbrella')
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        @else
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        @endif
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--brand-navy); margin: 0;">{{ $p->type_label ?: ucfirst($p->type).' Insurance' }}</h3>
                            <span style="font-family: monospace; font-size: 0.8125rem; font-weight: 600; background: #f1f5f9; color: var(--brand-blue); padding: 3px 8px; border-radius: 6px; border: 1px solid #e2e8f0;">
                                {{ $p->policy_number }}
                            </span>
                        </div>
                        <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 3px;">
                            Carrier: <strong style="color: var(--text-main);">{{ $p->carrier ?: 'Surebound Underwriting Syndicate' }}</strong>
                        </div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 12px;">
                    <span class="status-badge {{ $p->status }}" style="padding: 4px 12px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                        {{ ucfirst($p->status) }}
                    </span>
                    <a href="{{ route('user.policies.id-card', $p->id) }}" target="_blank" class="id-card-pill" style="display: inline-flex; align-items: center; gap: 6px; background: #f8fafc; color: var(--brand-blue); border: 1px solid #cbd5e1; padding: 6px 12px; border-radius: 6px; font-size: 0.8125rem; font-weight: 600; text-decoration: none; transition: background 0.2s;">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                        <span>Digital ID Card</span>
                    </a>
                </div>
            </div>

            <!-- Card Body: Insured asset & Financial terms -->
            <div style="padding: 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; border-bottom: 1px solid #f8fafc;">
                
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 4px;">Insured Asset / Schedule</span>
                    <span style="font-size: 0.9375rem; font-weight: 600; color: var(--text-main); display: block;">
                        {{ $p->insured_item ?: 'Standard Scheduled Policy Coverage' }}
                    </span>
                    <span style="font-size: 0.8125rem; color: var(--text-muted);">Named Insured: {{ $p->holder_name }}</span>
                </div>

                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 4px;">Coverage Limit</span>
                    <span style="font-size: 1.25rem; font-weight: 800; color: var(--brand-blue); display: block;">
                        {{ $p->coverage_limit }}
                    </span>
                    <span style="font-size: 0.8125rem; color: var(--text-muted);">Total Incurred Policy Aggregate</span>
                </div>

                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 4px;">Deductible</span>
                    <span style="font-size: 1.0625rem; font-weight: 700; color: var(--text-main); display: block;">
                        {{ $p->deductible ?: '$1,000 Standard' }}
                    </span>
                    <span style="font-size: 0.8125rem; color: var(--text-muted);">Per Claim Occurrence</span>
                </div>

                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 4px;">Annual Premium &amp; Terms</span>
                    <span style="font-size: 1.0625rem; font-weight: 700; color: var(--text-main); display: block;">
                        {{ $p->annual_premium }} <span style="font-size: 0.8125rem; font-weight: 500; color: var(--text-muted);">({{ ucfirst($p->billing_frequency ?: 'annual') }})</span>
                    </span>
                    <span style="font-size: 0.8125rem; color: #059669; font-weight: 600;">
                        Renewal: {{ $p->renewal_date ? \Carbon\Carbon::parse($p->renewal_date)->format('M d, Y') : 'Active Continuous' }}
                    </span>
                </div>

            </div>

            <!-- Sub-coverages Endorsement Pills -->
            @if(!empty($p->coverage_details) && is_array($p->coverage_details))
            <div style="padding: 14px 24px; background: #fafbfc; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-right: 6px;">
                    Endorsements:
                </span>
                @foreach(array_slice($p->coverage_details, 0, 5) as $subLabel => $subVal)
                    <span style="background: #ffffff; border: 1px solid #e2e8f0; padding: 3px 10px; border-radius: 9999px; font-size: 0.75rem; color: #334155; font-weight: 500;">
                        <strong style="color: #0f172a;">{{ $subLabel }}:</strong> {{ $subVal }}
                    </span>
                @endforeach
                @if(count($p->coverage_details) > 5)
                    <span style="font-size: 0.75rem; color: var(--brand-blue); font-weight: 600;">+{{ count($p->coverage_details) - 5 }} more</span>
                @endif
            </div>
            @endif

            <!-- Card Actions Footer -->
            <div style="padding: 14px 24px; background: #ffffff; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div style="font-size: 0.8125rem; color: var(--text-muted); display: flex; align-items: center; gap: 8px;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Effective: {{ $p->effective_date ? \Carbon\Carbon::parse($p->effective_date)->format('M d, Y') : 'Active' }}</span>
                </div>

                <div style="display: flex; gap: 10px; align-items: center;">
                    <button type="button" onclick='openPolicyDetailModal(@json($p))' style="background: #f1f5f9; color: var(--brand-navy); border: 1px solid #e2e8f0; padding: 7px 14px; border-radius: 6px; font-size: 0.8125rem; font-weight: 600; cursor: pointer; transition: background 0.2s;">
                        Coverage Details &rarr;
                    </button>
                    <a href="{{ route('user.claims') }}?policy={{ $p->policy_number }}" style="background: #eff6ff; color: var(--brand-blue); border: 1px solid #bfdbfe; padding: 7px 14px; border-radius: 6px; font-size: 0.8125rem; font-weight: 600; text-decoration: none; transition: all 0.2s;">
                        File Claim on Policy
                    </a>
                </div>
            </div>

        </div>
        @empty
        <div class="empty-policy-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 50px 20px; text-align: center; border: 1px dashed var(--border-light);">
            <div style="font-size: 2.5rem; margin-bottom: 12px;">🛡️</div>
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">No Active Policies Found</h3>
            <p style="color: var(--text-muted); font-size: 0.9375rem; max-width: 460px; margin: 0 auto 20px;">
                You do not currently have any bound insurance policies under this profile. Request a fast quote to bind comprehensive coverage today.
            </p>
            <a href="{{ route('user.quote') }}" class="btn-primary-action" style="display: inline-flex; align-items: center; gap: 8px; background: var(--brand-blue); color: #fff; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none;">
                Get Instant Quote &rarr;
            </a>
        </div>
        @endforelse
    </div>

</div>

<!-- DETAILED COVERAGE SCHEDULE MODAL -->
<div id="policyDetailModal" class="custom-modal-backdrop" style="display: none; position: fixed; inset: 0; background: rgba(9, 19, 46, 0.65); z-index: 1000; align-items: center; justify-content: center; padding: 20px; backdrop-filter: blur(4px);">
    <div class="modal-dialog-box" style="background: #ffffff; width: 100%; max-width: 720px; max-height: 90vh; overflow-y: auto; border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2); border: 1px solid #e2e8f0; animation: modalPopIn 0.25s ease-out;">
        
        <div style="padding: 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: flex-start; background: #fafbfc; border-radius: 16px 16px 0 0;">
            <div>
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                    <span id="modalPolicyBadge" style="background: #eff6ff; color: #1d4ed8; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 700; font-family: monospace;"></span>
                    <span id="modalPolicyStatus" class="status-badge active" style="font-size: 0.75rem;"></span>
                </div>
                <h3 id="modalPolicyTitle" style="font-size: 1.35rem; font-weight: 800; color: #09132e; margin: 0;"></h3>
                <div id="modalPolicyCarrier" style="font-size: 0.875rem; color: #64748b; margin-top: 2px;"></div>
            </div>
            <button type="button" onclick="closePolicyDetailModal()" style="background: none; border: none; font-size: 1.5rem; line-height: 1; color: #94a3b8; cursor: pointer; padding: 4px;">&times;</button>
        </div>

        <div style="padding: 24px;">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px; background: #f8fafc; padding: 16px; border-radius: 10px; border: 1px solid #e2e8f0;">
                <div>
                    <span style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: #64748b; display: block;">Named Insured</span>
                    <strong id="modalHolderName" style="color: #0f172a; font-size: 0.9375rem;"></strong>
                    <div id="modalHolderContact" style="font-size: 0.8125rem; color: #64748b;"></div>
                </div>
                <div>
                    <span style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: #64748b; display: block;">Insured Subject / Property</span>
                    <strong id="modalInsuredItem" style="color: #0f172a; font-size: 0.9375rem;"></strong>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;">
                <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                    <span style="font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Coverage Limit</span>
                    <div id="modalCoverageLimit" style="font-size: 1.25rem; font-weight: 800; color: #1d4ed8; margin-top: 2px;"></div>
                </div>
                <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                    <span style="font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Deductible</span>
                    <div id="modalDeductible" style="font-size: 1.1rem; font-weight: 700; color: #0f172a; margin-top: 2px;"></div>
                </div>
                <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                    <span style="font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Annual Premium</span>
                    <div id="modalAnnualPremium" style="font-size: 1.1rem; font-weight: 700; color: #059669; margin-top: 2px;"></div>
                </div>
            </div>

            <!-- Itemized Sub-Coverages -->
            <div style="margin-bottom: 24px;">
                <h4 style="font-size: 0.9375rem; font-weight: 700; color: #09132e; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Itemized Schedule &amp; Coverage Limits
                </h4>
                <div id="modalCoverageDetailsList" style="border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
                    <!-- Populated via JS -->
                </div>
            </div>

            <!-- Underwriter Notes -->
            <div id="modalNotesWrap" style="margin-bottom: 24px; display: none;">
                <h4 style="font-size: 0.875rem; font-weight: 700; color: #09132e; margin-bottom: 6px;">Underwriting Notes &amp; Warranties:</h4>
                <div id="modalNotesContent" style="font-size: 0.875rem; color: #475569; background: #fffbeb; border: 1px solid #fde68a; padding: 12px; border-radius: 8px; line-height: 1.5;"></div>
            </div>

        </div>

        <div style="padding: 16px 24px; border-top: 1px solid #e2e8f0; background: #fafbfc; border-radius: 0 0 16px 16px; display: flex; justify-content: space-between; align-items: center;">
            <a id="modalIdCardBtn" href="#" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; color: #1d4ed8; font-weight: 600; font-size: 0.875rem; text-decoration: none;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                Print Digital Proof Card &rarr;
            </a>
            <button type="button" onclick="closePolicyDetailModal()" style="background: #e2e8f0; color: #334155; border: none; padding: 8px 18px; border-radius: 6px; font-weight: 600; font-size: 0.875rem; cursor: pointer;">
                Close
            </button>
        </div>

    </div>
</div>

<style>
.policy-filter-btn {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #475569;
    padding: 7px 14px;
    border-radius: 9999px;
    font-size: 0.8125rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}
.policy-filter-btn:hover {
    background: #f1f5f9;
    color: #0f172a;
}
.policy-filter-btn.active {
    background: #1d4ed8;
    color: #ffffff;
    border-color: #1d4ed8;
    box-shadow: 0 2px 4px rgba(29, 78, 216, 0.2);
}
.policy-card-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
}
@keyframes modalPopIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>

<script>
// Filter policies by Category
function filterUserPolicies(category, btn) {
    document.querySelectorAll('.policy-filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const cards = document.querySelectorAll('.policy-card-item');
    cards.forEach(card => {
        const type = card.getAttribute('data-type');
        if (category === 'all' || type === category) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Live Search Filter
function searchUserPolicies() {
    const query = document.getElementById('policySearchInput').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.policy-card-item');

    cards.forEach(card => {
        const number = card.getAttribute('data-number') || '';
        const asset = card.getAttribute('data-asset') || '';
        const carrier = card.getAttribute('data-carrier') || '';
        const type = card.getAttribute('data-type') || '';

        if (number.includes(query) || asset.includes(query) || carrier.includes(query) || type.includes(query)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Open Policy Detail Modal
function openPolicyDetailModal(policy) {
    document.getElementById('modalPolicyBadge').innerText = policy.policy_number;
    document.getElementById('modalPolicyStatus').innerText = (policy.status || 'Active').toUpperCase();
    document.getElementById('modalPolicyStatus').className = 'status-badge ' + (policy.status || 'active');
    document.getElementById('modalPolicyTitle').innerText = policy.type_label || (policy.type ? policy.type.toUpperCase() + ' Coverage' : 'Policy Schedule');
    document.getElementById('modalPolicyCarrier').innerText = 'Underwritten by: ' + (policy.carrier || 'Surebound Syndicate');

    document.getElementById('modalHolderName').innerText = policy.holder_name;
    document.getElementById('modalHolderContact').innerText = (policy.holder_email || '') + (policy.holder_phone ? ' • ' + policy.holder_phone : '');
    document.getElementById('modalInsuredItem').innerText = policy.insured_item || 'General Scheduled Asset';

    document.getElementById('modalCoverageLimit').innerText = policy.coverage_limit;
    document.getElementById('modalDeductible').innerText = policy.deductible || '$1,000 Standard';
    document.getElementById('modalAnnualPremium').innerText = (policy.annual_premium || '$0.00') + ' / ' + (policy.billing_frequency || 'yr');

    // Populate itemized coverage list
    const detailsContainer = document.getElementById('modalCoverageDetailsList');
    detailsContainer.innerHTML = '';

    if (policy.coverage_details && typeof policy.coverage_details === 'object' && Object.keys(policy.coverage_details).length > 0) {
        let isAlt = false;
        for (const [key, val] of Object.entries(policy.coverage_details)) {
            const row = document.createElement('div');
            row.style.display = 'flex';
            row.style.justifyContent = 'space-between';
            row.style.padding = '10px 14px';
            row.style.fontSize = '0.875rem';
            row.style.background = isAlt ? '#f8fafc' : '#ffffff';
            row.style.borderBottom = '1px solid #f1f5f9';
            row.innerHTML = `<span style="color: #475569;">${key}</span><strong style="color: #0f172a;">${val}</strong>`;
            detailsContainer.appendChild(row);
            isAlt = !isAlt;
        }
    } else {
        detailsContainer.innerHTML = '<div style="padding: 14px; text-align: center; color: #64748b; font-size: 0.875rem;">Standard continuous coverage terms apply. Detailed endorsement schedule attached to master policy binder.</div>';
    }

    // Underwriter notes
    const notesWrap = document.getElementById('modalNotesWrap');
    if (policy.notes && policy.notes.trim() !== '') {
        document.getElementById('modalNotesContent').innerText = policy.notes;
        notesWrap.style.display = 'block';
    } else {
        notesWrap.style.display = 'none';
    }

    // Set digital ID card link
    document.getElementById('modalIdCardBtn').href = '/dashboard/policies/' + policy.id + '/id-card';

    // Show modal
    document.getElementById('policyDetailModal').style.display = 'flex';
}

function closePolicyDetailModal() {
    document.getElementById('policyDetailModal').style.display = 'none';
}

// Close on backdrop click
window.addEventListener('click', function(e) {
    const modal = document.getElementById('policyDetailModal');
    if (e.target === modal) {
        closePolicyDetailModal();
    }
});
</script>
@endsection
