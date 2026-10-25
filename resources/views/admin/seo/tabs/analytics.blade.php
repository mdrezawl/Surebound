<!-- ==========================================
     MODULE 12: GOOGLE ANALYTICS 4 INTEGRATION
     ========================================== -->
<div class="seo-tab-panel" id="tab-analytics">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">Google Analytics 4 (GA4) &amp; Business Conversion Tracking</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Attribution analytics connecting organic landing pages to real insurance quote submissions and underwriting phone leads.
                </p>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <span class="seo-badge {{ $ga4Integration->is_connected ? 'seo-badge-success' : 'seo-badge-neutral' }}" style="padding: 6px 12px; font-size: 0.85rem;">
                    Status: {{ $ga4Integration->is_connected ? 'Connected (' . ($ga4Integration->property_id ?? 'properties/12345678') . ')' : 'Offline / Awaiting Property ID' }}
                </span>
                <button type="button" class="seo-btn seo-btn-primary" onclick="switchSeoTab('integrations')">
                    GA4 Settings
                </button>
            </div>
        </div>
    </div>

    {{-- GA4 Metrics Cards --}}
    <div class="seo-grid-4">
        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Organic Sessions</span>
                <span class="seo-badge seo-badge-success">GA4</span>
            </div>
            <div class="seo-kpi-value">{{ number_format($analyticsSummary['organic_sessions']) }}</div>
            <div class="seo-kpi-sub">
                <span>Google &amp; Bing organic traffic (28d)</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Engaged Sessions</span>
                <span class="seo-badge seo-badge-info">Engagement</span>
            </div>
            <div class="seo-kpi-value">{{ number_format($analyticsSummary['engaged_sessions']) }}</div>
            <div class="seo-kpi-sub">
                <span>Sessions &gt;10s or 2+ pageviews</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Conversion Rate</span>
                <span class="seo-badge seo-badge-neutral">Lead Ratio</span>
            </div>
            <div class="seo-kpi-value">{{ $analyticsSummary['conversion_rate'] }}%</div>
            <div class="seo-kpi-sub">
                <span>Quotes generated per session</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Verified Database Leads</span>
                <span class="seo-badge seo-badge-success">Surebound DB</span>
            </div>
            <div class="seo-kpi-value" style="color: #34d399;">{{ $analyticsSummary['database_leads'] }}</div>
            <div class="seo-kpi-sub">
                <span>Actual quote submissions in quotes table</span>
            </div>
        </div>
    </div>

    {{-- Conversion Attribution Breakdown --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span>Lead &amp; Conversion Attribution by Insurance Line</span>
            </div>
        </div>

        <div class="seo-table-container">
            <table class="seo-table">
                <thead>
                    <tr>
                        <th>Insurance Category</th>
                        <th>Associated Landing Route</th>
                        <th>Quote Inquiries</th>
                        <th>Attribution Source</th>
                        <th>Conversion Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Commercial Auto &amp; Fleet</td>
                        <td><a href="{{ url('/commercial-auto-insurance') }}" style="color: #38bdf8; font-family: 'JetBrains Mono', monospace;">/commercial-auto-insurance</a></td>
                        <td style="font-weight: 600; color: #34d399;">High Volume</td>
                        <td>Organic Search / Google</td>
                        <td><span class="seo-badge seo-badge-success">Active Lead Intake</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Commercial Surety Bonds</td>
                        <td><a href="{{ url('/surety-bond') }}" style="color: #38bdf8; font-family: 'JetBrains Mono', monospace;">/surety-bond</a></td>
                        <td style="font-weight: 600; color: #34d399;">High Value</td>
                        <td>Organic Search / Direct</td>
                        <td><span class="seo-badge seo-badge-success">Active Lead Intake</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">General Liability</td>
                        <td><a href="{{ url('/liability-insurance') }}" style="color: #38bdf8; font-family: 'JetBrains Mono', monospace;">/liability-insurance</a></td>
                        <td style="font-weight: 600; color: #34d399;">Standard</td>
                        <td>Organic Search / Referral</td>
                        <td><span class="seo-badge seo-badge-success">Active Lead Intake</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Specialty Cyber Coverage</td>
                        <td><a href="{{ url('/specialty-coverage') }}" style="color: #38bdf8; font-family: 'JetBrains Mono', monospace;">/specialty-coverage</a></td>
                        <td style="font-weight: 600; color: #34d399;">High Margin</td>
                        <td>Organic Search / ChatGPT Ref</td>
                        <td><span class="seo-badge seo-badge-success">Active Lead Intake</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
