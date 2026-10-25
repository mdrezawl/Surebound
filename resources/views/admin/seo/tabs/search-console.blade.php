<!-- ==========================================
     MODULE 11: GOOGLE SEARCH CONSOLE INTEGRATION
     ========================================== -->
<div class="seo-tab-panel" id="tab-search-console">
    {{-- Header Banner with Connection Status --}}
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">Google Search Console Integration</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Official Google Search Analytics API sync. Retrieves organic clicks, search impressions, CTR, average SERP position, and top queries.
                </p>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <span class="seo-badge {{ $gscIntegration->is_connected ? 'seo-badge-success' : 'seo-badge-neutral' }}" style="padding: 6px 12px; font-size: 0.85rem;">
                    Status: {{ $gscIntegration->is_connected ? 'Connected (' . ($gscIntegration->property_id ?? 'sc-domain:surebound.com') . ')' : 'Offline / Awaiting OAuth' }}
                </span>
                <button type="button" class="seo-btn seo-btn-primary" onclick="switchSeoTab('integrations')">
                    Configure API Credentials
                </button>
            </div>
        </div>
    </div>

    {{-- GSC Metrics Row --}}
    <div class="seo-grid-4">
        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Organic Clicks</span>
                <span class="seo-badge seo-badge-success">GSC Verified</span>
            </div>
            <div class="seo-kpi-value">{{ number_format($searchSummary['total_clicks']) }}</div>
            <div class="seo-kpi-sub">
                <span>Last 28 days organic traffic</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Search Impressions</span>
                <span class="seo-badge seo-badge-info">28-Day</span>
            </div>
            <div class="seo-kpi-value">{{ number_format($searchSummary['total_impressions']) }}</div>
            <div class="seo-kpi-sub">
                <span>SERP impressions</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Average CTR</span>
                <span class="seo-badge seo-badge-neutral">Click-Through</span>
            </div>
            <div class="seo-kpi-value">{{ $searchSummary['average_ctr'] }}%</div>
            <div class="seo-kpi-sub">
                <span>Google Search snippet CTR</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Average Position</span>
                <span class="seo-badge seo-badge-neutral">SERP Rank</span>
            </div>
            <div class="seo-kpi-value">{{ $searchSummary['average_position'] > 0 ? $searchSummary['average_position'] : '—' }}</div>
            <div class="seo-kpi-sub">
                <span>Across tracked search queries</span>
            </div>
        </div>
    </div>

    {{-- Top Queries & Top Pages Grid --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
        {{-- Top Queries --}}
        <div class="seo-card">
            <div class="seo-card-header">
                <div class="seo-card-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Top Search Queries (Google SERP)</span>
                </div>
            </div>
            @if(empty($searchSummary['top_queries']))
                <div class="seo-empty-state" style="padding: 24px 16px;">
                    <div class="seo-empty-title" style="font-size: 1rem;">No Query Data Available</div>
                    <div class="seo-empty-sub">Connect Google Search Console API in the Integrations tab to pull live query impressions.</div>
                </div>
            @else
                <table class="seo-table" style="font-size: 0.85rem;">
                    <thead>
                        <tr>
                            <th>Search Query</th>
                            <th>Clicks</th>
                            <th>Impressions</th>
                            <th>CTR</th>
                            <th>Avg Pos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($searchSummary['top_queries'] as $row)
                            <tr>
                                <td style="font-family: 'JetBrains Mono', monospace; font-weight: 600; color: #f8fafc;">
                                    {{ $row['query'] }}
                                </td>
                                <td>{{ number_format($row['clicks']) }}</td>
                                <td>{{ number_format($row['impressions']) }}</td>
                                <td>{{ $row['ctr'] }}%</td>
                                <td style="color: #34d399; font-weight: 600;">#{{ $row['position'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Top Pages --}}
        <div class="seo-card">
            <div class="seo-card-header">
                <div class="seo-card-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Top Organic Landing Pages</span>
                </div>
            </div>
            @if(empty($searchSummary['top_pages']))
                <div class="seo-empty-state" style="padding: 24px 16px;">
                    <div class="seo-empty-title" style="font-size: 1rem;">No Landing Page Data Available</div>
                    <div class="seo-empty-sub">Connect Google Search Console API in the Integrations tab to pull live performance.</div>
                </div>
            @else
                <table class="seo-table" style="font-size: 0.85rem;">
                    <thead>
                        <tr>
                            <th>Landing Page</th>
                            <th>Clicks</th>
                            <th>Impressions</th>
                            <th>CTR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($searchSummary['top_pages'] as $p)
                            <tr>
                                <td>
                                    <a href="{{ url($p['page']) }}" target="_blank" style="font-family: 'JetBrains Mono', monospace; color: #38bdf8; text-decoration: none;">
                                        {{ $p['page'] }}
                                    </a>
                                </td>
                                <td style="font-weight: 600; color: #f8fafc;">{{ number_format($p['clicks']) }}</td>
                                <td>{{ number_format($p['impressions']) }}</td>
                                <td>{{ $p['ctr'] }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
