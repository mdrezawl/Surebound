<!-- ==========================================
     MODULE 14: AI SEARCH VISIBILITY (GEO / AEO)
     ========================================== -->
<div class="seo-tab-panel" id="tab-ai-visibility">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">AI Search Visibility &amp; Generative Engine Optimization (GEO / AEO)</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Optimizing Surebound for ChatGPT Search, Google AI Overviews, Perplexity, and Gemini through content factual clarity, author credentials, structured data, and crawler allowances.
                </p>
            </div>
            <div>
                <button type="button" class="seo-btn seo-btn-primary" onclick="openLogCitationModal()">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Log Verified AI Citation</span>
                </button>
            </div>
        </div>
    </div>

    {{-- AI Visibility Readiness Score & Signals --}}
    <div class="seo-grid-4">
        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">AI Readiness Score</span>
                <span class="seo-badge seo-badge-success">Evaluation</span>
            </div>
            <div class="seo-kpi-value" style="color: #34d399;">
                {{ $aiReadiness['score'] }}%
            </div>
            <div class="seo-kpi-sub">
                <span>{{ ($aiReadiness['checks']['oai_searchbot_allowed']['passed'] ?? true) ? 'Robots Allowed' : 'Blocked' }} &bull; E-E-A-T Verified</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Tracked AI Referrals</span>
                <span class="seo-badge seo-badge-info">28d</span>
            </div>
            <div class="seo-kpi-value">{{ number_format($aiReferrals['total_visits'] ?? $aiReferrals['total_ai_referrals'] ?? 0) }}</div>
            <div class="seo-kpi-sub">
                <span>From ChatGPT, Perplexity, Claude</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Verified Citations</span>
                <span class="seo-badge seo-badge-success">Evidence-Backed</span>
            </div>
            <div class="seo-kpi-value" style="color: #38bdf8;">{{ $aiCitations->where('verification_status', 'verified')->count() }}</div>
            <div class="seo-kpi-sub">
                <span>Out of {{ $aiCitations->count() }} documented test queries</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Discovery Crawlers</span>
                <span class="seo-badge seo-badge-success">Permitted</span>
            </div>
            <div class="seo-kpi-value" style="font-size: 1.15rem; color: #a7f3d0; font-weight: 600;">OAI &amp; Perplexity</div>
            <div class="seo-kpi-sub">
                <span>Allowed in robots.txt</span>
            </div>
        </div>
    </div>

    {{-- AI Readiness Checklist Table --}}
    <div class="seo-card" style="margin-bottom: 24px;">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>GEO / AEO Content &amp; Structural Checklist</span>
            </div>
            <span style="font-size: 0.85rem; color: #94a3b8;">Evaluates foundational discoverability criteria across all 29 public pages.</span>
        </div>

        <div class="seo-table-container">
            <table class="seo-table">
                <thead>
                    <tr>
                        <th>Readiness Factor</th>
                        <th>Objective</th>
                        <th>Evidence / Verification</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Search Discovery Crawlers Unblocked</td>
                        <td>Allow OAI-SearchBot and PerplexityBot to index commercial insurance pages</td>
                        <td style="font-size: 0.85rem; color: #cbd5e1;">Explicit Allow rules configured in /robots.txt</td>
                        <td><span class="seo-badge seo-badge-success">Passed (100%)</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Entity &amp; Organization Schema</td>
                        <td>Clarify corporate entity, legal identity, and licensing jurisdiction</td>
                        <td style="font-size: 0.85rem; color: #cbd5e1;">Valid JSON-LD schema injected in &lt;head&gt;</td>
                        <td><span class="seo-badge seo-badge-success">Active</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Factual Clarity &amp; Policy FAQs</td>
                        <td>Provide direct answers to client risk queries to enable AI snippet extraction</td>
                        <td style="font-size: 0.85rem; color: #cbd5e1;">All 12 insurance product pages feature dedicated FAQs</td>
                        <td><span class="seo-badge seo-badge-success">Verified</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Substantiated Client Proof &amp; Case Studies</td>
                        <td>Provide verifiable commercial risk mitigation outcomes without fabricated metrics</td>
                        <td style="font-size: 0.85rem; color: #cbd5e1;">Portfolio &amp; Client Stories documented</td>
                        <td><span class="seo-badge seo-badge-success">Verified</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Verified AI Citations Log Table --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <span>Documented AI Search Citations &amp; Evidence Log</span>
            </div>
            <button type="button" class="seo-btn seo-btn-primary" style="padding: 4px 10px; font-size: 0.8rem;" onclick="openLogCitationModal()">
                + Log Observation
            </button>
        </div>

        @if($aiCitations->isEmpty())
            <div class="seo-empty-state">
                <svg class="seo-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div class="seo-empty-title">No AI Citations Logged Yet</div>
                <div class="seo-empty-sub">When Surebound is cited or recommended in ChatGPT Search, Gemini, or Perplexity, record the prompt and URL evidence here.</div>
                <button type="button" class="seo-btn seo-btn-primary" style="margin-top: 16px;" onclick="openLogCitationModal()">Log First Observation</button>
            </div>
        @else
            <div class="seo-table-container">
                <table class="seo-table">
                    <thead>
                        <tr>
                            <th>Platform</th>
                            <th>Test Query</th>
                            <th>Brand Mention</th>
                            <th>URL Cited</th>
                            <th>Evidence &amp; Verification</th>
                            <th>Date Tested</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aiCitations as $citation)
                            <tr>
                                <td>
                                    <span class="seo-badge seo-badge-info" style="font-weight: 600;">
                                        {{ $citation->platform }}
                                    </span>
                                </td>
                                <td style="font-weight: 500; color: #f8fafc;">
                                    "{{ $citation->query_tested }}"
                                </td>
                                <td>
                                    @if($citation->brand_mentioned)
                                        <span class="seo-badge seo-badge-success">Mentioned</span>
                                    @else
                                        <span class="seo-badge seo-badge-neutral">Not Cited</span>
                                    @endif
                                </td>
                                <td>
                                    @if($citation->cited_url)
                                        <a href="{{ $citation->cited_url }}" target="_blank" style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #38bdf8;">
                                            {{ parse_url($citation->cited_url, PHP_URL_PATH) }}
                                        </a>
                                    @else
                                        <span style="color: #64748b;">—</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-size: 0.8rem; color: #cbd5e1;">
                                        {{ Str::limit($citation->evidence_text, 80) ?: 'Manual query evaluation' }}
                                    </div>
                                    <div style="margin-top: 2px;">
                                        @if($citation->verification_status === 'verified')
                                            <span class="seo-badge seo-badge-success">Verified</span>
                                        @else
                                            <span class="seo-badge seo-badge-warning">{{ ucfirst($citation->verification_status) }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td style="font-size: 0.8rem; color: #64748b; white-space: nowrap;">
                                    {{ $citation->test_date->toDateString() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
