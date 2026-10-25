<!-- ==========================================
     MODULE 22: LEAD & CONVERSION TRACKING
     ========================================== -->
<div class="seo-tab-panel" id="tab-leads">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">Commercial Lead &amp; Quote Conversion Analytics</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Attribution telemetry connecting Google organic search and AI referrals to real quote requests in the Surebound underwriting pipeline.
                </p>
            </div>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="seo-btn seo-btn-primary">
                    View Underwriter Quote Desk
                </a>
            </div>
        </div>
    </div>

    {{-- Lead KPI Cards --}}
    @php
        $realQuotes = \App\Models\Quote::latest()->take(25)->get();
        $totalQuotesCount = \App\Models\Quote::count();
        $convertedQuotesCount = \App\Models\Quote::where('status', 'converted')->count();
        $quotedCount = \App\Models\Quote::whereIn('status', ['quoted', 'converted'])->count();
    @endphp

    <div class="seo-grid-4">
        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Total Database Leads</span>
                <span class="seo-badge seo-badge-success">Verified DB</span>
            </div>
            <div class="seo-kpi-value">{{ $totalQuotesCount }}</div>
            <div class="seo-kpi-sub">
                <span>Inbound quote inquiries</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Quotes Dispatched</span>
                <span class="seo-badge seo-badge-info">Active</span>
            </div>
            <div class="seo-kpi-value" style="color: #38bdf8;">{{ $quotedCount }}</div>
            <div class="seo-kpi-sub">
                <span>Underwritten policy proposals</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Bound Policies</span>
                <span class="seo-badge seo-badge-success">Converted</span>
            </div>
            <div class="seo-kpi-value" style="color: #34d399;">{{ $convertedQuotesCount }}</div>
            <div class="seo-kpi-sub">
                <span>Active paying clients</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Organic Close Rate</span>
                <span class="seo-badge seo-badge-neutral">Performance</span>
            </div>
            <div class="seo-kpi-value">
                {{ $totalQuotesCount > 0 ? round(($convertedQuotesCount / $totalQuotesCount) * 100, 1) : 0 }}%
            </div>
            <div class="seo-kpi-sub">
                <span>Quote-to-bind conversion ratio</span>
            </div>
        </div>
    </div>

    {{-- Leads Table --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span>Recent Inbound Leads &amp; Landing Page Attribution</span>
            </div>
            <span style="font-size: 0.85rem; color: #94a3b8;">PII masked for SEO analyst governance</span>
        </div>

        @if($realQuotes->isEmpty())
            <div class="seo-empty-state">
                <svg class="seo-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <div class="seo-empty-title">No Quotes Logged in Database Yet</div>
                <div class="seo-empty-sub">When visitors submit quote forms on /custom-quote or service pages, they will appear here.</div>
            </div>
        @else
            <div class="seo-table-container">
                <table class="seo-table">
                    <thead>
                        <tr>
                            <th>Quote Ref</th>
                            <th>Insurance Type</th>
                            <th>Coverage Selected</th>
                            <th>Region / ZIP</th>
                            <th>Status</th>
                            <th>Submission Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($realQuotes as $quote)
                            <tr>
                                <td>
                                    <div style="font-family: 'JetBrains Mono', monospace; font-weight: 600; color: #38bdf8;">
                                        {{ $quote->quote_ref }}
                                    </div>
                                </td>
                                <td>
                                    <span class="seo-badge seo-badge-neutral">{{ $quote->type_label ?: ucfirst($quote->type) }}</span>
                                </td>
                                <td style="color: #cbd5e1; font-size: 0.85rem;">
                                    {{ $quote->coverage }}
                                </td>
                                <td>
                                    <span style="font-size: 0.85rem; color: #94a3b8;">{{ $quote->location ?: ($quote->zip_code ?: 'US Nationwide') }}</span>
                                </td>
                                <td>
                                    @if($quote->status === 'converted')
                                        <span class="seo-badge seo-badge-success">Converted (Bound)</span>
                                    @elseif($quote->status === 'quoted')
                                        <span class="seo-badge seo-badge-info">Quoted</span>
                                    @elseif($quote->status === 'reviewing')
                                        <span class="seo-badge seo-badge-warning">Reviewing</span>
                                    @else
                                        <span class="seo-badge seo-badge-neutral">New Lead</span>
                                    @endif
                                </td>
                                <td style="font-size: 0.8rem; color: #64748b;">
                                    {{ $quote->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
