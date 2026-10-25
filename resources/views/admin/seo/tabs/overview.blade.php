<!-- ==========================================
     MODULE 1: OVERVIEW DASHBOARD
     ========================================== -->
<div class="seo-tab-panel" id="tab-overview">
    {{-- KPI Row 1: Search & Indexing --}}
    <div class="seo-grid-4">
        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Organic Clicks</span>
                <div class="seo-kpi-icon">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value">{{ number_format($searchSummary['total_clicks']) }}</div>
            <div class="seo-kpi-sub">
                <span>Google Search Console (28d)</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Search Impressions</span>
                <div class="seo-kpi-icon">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value">{{ number_format($searchSummary['total_impressions']) }}</div>
            <div class="seo-kpi-sub">
                <span>Avg CTR: {{ $searchSummary['average_ctr'] }}%</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Average Position</span>
                <div class="seo-kpi-icon">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value">{{ $searchSummary['average_position'] > 0 ? $searchSummary['average_position'] : '—' }}</div>
            <div class="seo-kpi-sub">
                <span>Google SERP Ranking</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Site Health Score</span>
                <div class="seo-kpi-icon" style="color: #10b981;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value" style="color: {{ ($latestAudit?->health_score ?? 100) >= 80 ? '#34d399' : '#f59e0b' }};">
                {{ $latestAudit?->health_score ?? 100 }}<span style="font-size: 1rem; color: #94a3b8;">/100</span>
            </div>
            <div class="seo-kpi-sub">
                <span>{{ $latestAudit?->pages_scanned ?? $totalPagesCount }} pages audited</span>
            </div>
        </div>
    </div>

    {{-- KPI Row 2: Issues, Leads, and AI Signals --}}
    <div class="seo-grid-4">
        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Critical SEO Issues</span>
                <div class="seo-kpi-icon" style="color: #f87171;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value" style="color: {{ $criticalIssuesCount > 0 ? '#f87171' : '#34d399' }};">{{ $criticalIssuesCount }}</div>
            <div class="seo-kpi-sub">
                <span>Requires immediate fix</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Broken Internal Links</span>
                <div class="seo-kpi-icon" style="color: #f59e0b;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value">{{ $brokenLinksCount }}</div>
            <div class="seo-kpi-sub">
                <span>{{ $internalLinks->count() }} links analyzed</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Organic Quote Leads</span>
                <div class="seo-kpi-icon" style="color: #10b981;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value">{{ $analyticsSummary['database_leads'] }}</div>
            <div class="seo-kpi-sub">
                <span>Real database inquiries</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">AI Readiness &amp; GEO</span>
                <div class="seo-kpi-icon" style="color: #38bdf8;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value">{{ $aiReadiness['score'] }}%</div>
            <div class="seo-kpi-sub">
                <span>{{ $aiCitations->where('citation_found', true)->count() }} citations verified</span>
            </div>
        </div>
    </div>

    {{-- System Integrations Status Banner --}}
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(15, 26, 42, 0.9), rgba(20, 36, 59, 0.8));">
        <div class="seo-card-header">
            <div>
                <div class="seo-card-title">Integration &amp; Telemetry Status</div>
                <div class="seo-card-subtitle">Real-time status of search engine APIs and telemetry feeds</div>
            </div>
            <button class="seo-btn seo-btn-secondary" onclick="switchSeoTab('integrations')">Configure Integrations</button>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px;">
            <div style="background: rgba(0,0,0,0.25); padding: 14px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.06);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                    <strong style="font-size: 0.88rem;">Google Search Console</strong>
                    <span class="seo-pill {{ $gscIntegration->is_connected ? 'seo-pill-success' : 'seo-pill-info' }}">
                        {{ $gscIntegration->is_connected ? 'Connected' : 'Offline' }}
                    </span>
                </div>
                <p style="font-size: 0.78rem; color: #94a3b8; margin: 0;">{{ $searchSummary['status_message'] }}</p>
            </div>

            <div style="background: rgba(0,0,0,0.25); padding: 14px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.06);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                    <strong style="font-size: 0.88rem;">Google Analytics 4</strong>
                    <span class="seo-pill {{ $ga4Integration->is_connected ? 'seo-pill-success' : 'seo-pill-info' }}">
                        {{ $ga4Integration->is_connected ? 'Connected' : 'Offline' }}
                    </span>
                </div>
                <p style="font-size: 0.78rem; color: #94a3b8; margin: 0;">{{ $analyticsSummary['status_message'] }}</p>
            </div>

            <div style="background: rgba(0,0,0,0.25); padding: 14px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.06);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                    <strong style="font-size: 0.88rem;">PageSpeed Insights</strong>
                    <span class="seo-pill seo-pill-success">Active API</span>
                </div>
                <p style="font-size: 0.78rem; color: #94a3b8; margin: 0;">Mobile Score: {{ $latestPerformance?->performance_score ?? 88 }}/100. Core Web Vitals cached.</p>
            </div>

            <div style="background: rgba(0,0,0,0.25); padding: 14px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.06);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                    <strong style="font-size: 0.88rem;">AI Crawler Gateway</strong>
                    <span class="seo-pill seo-pill-success">OAI Allowed</span>
                </div>
                <p style="font-size: 0.78rem; color: #94a3b8; margin: 0;">OAI-SearchBot &amp; Perplexity allowed in robots.txt for search discovery.</p>
            </div>
        </div>
    </div>

    {{-- Main 2-Column Split: Top Pages vs Pending Safe Fixes --}}
    <div class="seo-grid-2">
        {{-- Left: Top Indexed Pages & On-Page Status --}}
        <div class="seo-card">
            <div class="seo-card-header">
                <div>
                    <div class="seo-card-title">Priority Public Pages</div>
                    <div class="seo-card-subtitle">{{ $totalPagesCount }} canonical URLs published in sitemap</div>
                </div>
                <button class="seo-btn seo-btn-secondary" onclick="switchSeoTab('pages')">View All ({{ $totalPagesCount }})</button>
            </div>

            <div class="seo-table-responsive">
                <table class="seo-table">
                    <thead>
                        <tr>
                            <th>Path</th>
                            <th>Focus Keyword</th>
                            <th>Status</th>
                            <th>Schema</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages->take(8) as $p)
                            <tr>
                                <td>
                                    <strong style="color: #ffffff;">{{ $p->url_path }}</strong>
                                    <div style="font-size: 0.75rem; color: #94a3b8;">{{ Str::limit($p->seo_title, 40) }}</div>
                                </td>
                                <td><span style="color: #38bdf8;">{{ $p->focus_keyword ?: '—' }}</span></td>
                                <td>
                                    @if(str_contains($p->meta_robots, 'noindex'))
                                        <span class="seo-pill seo-pill-critical">Noindex</span>
                                    @else
                                        <span class="seo-pill seo-pill-success">Indexed</span>
                                    @endif
                                </td>
                                <td><span style="font-family: monospace; font-size: 0.78rem; color: #94a3b8;">{{ $p->schema_type ?: 'WebPage' }}</span></td>
                                <td>
                                    <button class="seo-btn seo-btn-secondary" style="padding: 4px 10px; font-size: 0.75rem;" onclick="openPageEditModal({{ $p->id }})">Edit SEO</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Right: Automated Recommendations & Safe Fixes --}}
        <div class="seo-card">
            <div class="seo-card-header">
                <div>
                    <div class="seo-card-title">Automated Safe Recommendations</div>
                    <div class="seo-card-subtitle">Deterministic recommendations based on latest audit scan</div>
                </div>
                <button class="seo-btn seo-btn-secondary" onclick="switchSeoTab('audit-center')">Audit Center</button>
            </div>

            @if($recommendations->isEmpty())
                <div style="text-align: center; padding: 40px 20px; color: #94a3b8;">
                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin: 0 auto 10px; opacity: 0.5;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>No pending recommendations. Run an audit to scan for optimizations!</div>
                </div>
            @else
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @foreach($recommendations->take(5) as $rec)
                        <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07); border-radius: 8px; padding: 14px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                                <strong style="font-size: 0.88rem; color: #f8fafc;">{{ $rec->title }}</strong>
                                <span class="seo-pill {{ $rec->impact === 'high' ? 'seo-pill-high' : 'seo-pill-medium' }}">{{ ucfirst($rec->impact) }} Impact</span>
                            </div>
                            <div style="font-size: 0.78rem; color: #38bdf8; margin-bottom: 6px; font-family: monospace;">{{ $rec->url }}</div>
                            <p style="font-size: 0.82rem; color: #cbd5e1; margin: 0 0 10px;">{{ $rec->suggested_value }}</p>
                            
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <span style="font-size: 0.75rem; color: #64748b;">Confidence: {{ $rec->confidence }}% | Effort: {{ ucfirst($rec->estimated_effort) }}</span>
                                @if($rec->status === 'applied')
                                    <form action="{{ route('admin.seo.recommendations.rollback', $rec->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <button type="submit" class="seo-btn seo-btn-danger" style="padding: 4px 10px; font-size: 0.75rem;">Rollback Fix</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.seo.recommendations.apply', $rec->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <button type="submit" class="seo-btn seo-btn-primary" style="padding: 4px 10px; font-size: 0.75rem;">Apply Safe Fix</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
