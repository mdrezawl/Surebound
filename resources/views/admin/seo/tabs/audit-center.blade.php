<!-- ==========================================
     MODULE 2: TECHNICAL SEO AUDIT CENTER
     ========================================== -->
<div class="seo-tab-panel" id="tab-audit-center">
    {{-- Header Banner with Action --}}
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">Technical SEO Audit &amp; Automated Recommendation Engine</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Scheduled and on-demand crawler evaluating 29 public routes for HTTP status, indexability, metadata, canonicals, schema, and link integrity.
                </p>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <form action="{{ route('admin.seo.audit.run') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="seo-btn seo-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        <span>Run Full Site Audit</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Audit Metrics Row --}}
    <div class="seo-grid-4">
        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Health Score</span>
                <span class="seo-badge {{ ($latestAudit?->health_score ?? 100) >= 80 ? 'seo-badge-success' : 'seo-badge-warning' }}">
                    {{ ($latestAudit?->health_score ?? 100) >= 80 ? 'Healthy' : 'Needs Work' }}
                </span>
            </div>
            <div class="seo-kpi-value" style="color: {{ ($latestAudit?->health_score ?? 100) >= 80 ? '#34d399' : '#f59e0b' }};">
                {{ $latestAudit?->health_score ?? 100 }}<span style="font-size: 1.1rem; color: #64748b;">/100</span>
            </div>
            <div class="seo-kpi-sub">
                <span>Last run: {{ $latestAudit ? $latestAudit->completed_at?->diffForHumans() ?? 'Just now' : 'Never' }}</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Critical Findings</span>
                <span class="seo-badge seo-badge-danger">{{ $criticalIssuesCount }} Open</span>
            </div>
            <div class="seo-kpi-value" style="color: {{ $criticalIssuesCount > 0 ? '#f87171' : '#34d399' }};">
                {{ $criticalIssuesCount }}
            </div>
            <div class="seo-kpi-sub">
                <span>Immediate search indexing blocker</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">High &amp; Medium Findings</span>
                <span class="seo-badge seo-badge-warning">{{ $highIssuesCount + $mediumIssuesCount }}</span>
            </div>
            <div class="seo-kpi-value" style="color: #fbbf24;">
                {{ $highIssuesCount + $mediumIssuesCount }}
            </div>
            <div class="seo-kpi-sub">
                <span>{{ $highIssuesCount }} High &bull; {{ $mediumIssuesCount }} Medium</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Automated Recommendations</span>
                <span class="seo-badge seo-badge-info">{{ $recommendations->where('status', 'suggested')->count() }} Ready</span>
            </div>
            <div class="seo-kpi-value" style="color: #38bdf8;">
                {{ $recommendations->count() }}
            </div>
            <div class="seo-kpi-sub">
                <span>Mode: {{ ucwords(str_replace('_', ' ', $automationSettings->mode)) }}</span>
            </div>
        </div>
    </div>

    {{-- Automated Recommendations Section --}}
    <div class="seo-card" style="margin-bottom: 24px;">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <span>Automated Recommendation Actions (Safe Fixes &amp; Approval Queue)</span>
            </div>
            <span style="font-size: 0.85rem; color: #94a3b8;">
                Safe fixes can be auto-applied or reverted with 1-click rollback history.
            </span>
        </div>

        @if($recommendations->isEmpty())
            <div class="seo-empty-state">
                <svg class="seo-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div class="seo-empty-title">All Recommendations Clear</div>
                <div class="seo-empty-sub">No pending SEO recommendations found for current audit.</div>
            </div>
        @else
            <div class="seo-table-container">
                <table class="seo-table">
                    <thead>
                        <tr>
                            <th>Finding &amp; Target URL</th>
                            <th>Suggested Correction</th>
                            <th>Confidence &amp; Effort</th>
                            <th>Human Approval</th>
                            <th>Status</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recommendations->take(15) as $rec)
                            <tr>
                                <td>
                                    <div style="font-weight: 600; color: #f1f5f9;">{{ $rec->title }}</div>
                                    <div style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #38bdf8;">{{ $rec->affected_url }}</div>
                                    <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 2px;">{{ Str::limit($rec->impact_explanation, 75) }}</div>
                                </td>
                                <td>
                                    <div style="font-size: 0.85rem; color: #cbd5e1; max-width: 320px;">
                                        {{ $rec->suggested_fix }}
                                    </div>
                                    @if($rec->diff_preview)
                                        <div style="margin-top: 4px; font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; background: rgba(0,0,0,0.3); padding: 4px 8px; border-radius: 4px; color: #a7f3d0;">
                                            &rarr; {{ Str::limit($rec->diff_preview['after'] ?? '', 50) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; flex-direction: column; gap: 4px;">
                                        <span class="seo-badge seo-badge-success">{{ $rec->confidence_score }}% Confidence</span>
                                        <span style="font-size: 0.75rem; color: #94a3b8;">Effort: {{ ucfirst($rec->estimated_effort) }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($rec->requires_approval)
                                        <span class="seo-badge seo-badge-warning">Required</span>
                                    @else
                                        <span class="seo-badge seo-badge-info">Safe Auto-Fix</span>
                                    @endif
                                </td>
                                <td>
                                    @if($rec->status === 'applied')
                                        <span class="seo-badge seo-badge-success">Applied</span>
                                    @elseif($rec->status === 'rolled_back')
                                        <span class="seo-badge seo-badge-neutral">Rolled Back</span>
                                    @elseif($rec->status === 'dismissed')
                                        <span class="seo-badge seo-badge-neutral">Dismissed</span>
                                    @else
                                        <span class="seo-badge seo-badge-warning">Pending Review</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    @if($rec->status === 'applied')
                                        <form action="{{ route('admin.seo.recommendations.rollback', $rec->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="seo-btn seo-btn-secondary" style="padding: 4px 10px; font-size: 0.8rem;" title="Rollback to original value">
                                                Rollback
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.seo.recommendations.apply', $rec->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="seo-btn seo-btn-primary" style="padding: 4px 10px; font-size: 0.8rem;">
                                                Apply Safe Fix
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Detailed Audit Findings Table --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span>Audit Findings &amp; Technical Issues ({{ $findings->count() }} Detected)</span>
            </div>
            <div style="display: flex; gap: 8px;">
                <input type="text" id="findingSearchInput" class="seo-form-input" placeholder="Filter by URL or issue..." style="width: 240px; padding: 6px 12px; font-size: 0.85rem;" onkeyup="filterAuditTable()">
            </div>
        </div>

        <div class="seo-table-container">
            <table class="seo-table" id="auditFindingsTable">
                <thead>
                    <tr>
                        <th>Severity</th>
                        <th>Category</th>
                        <th>Target URL</th>
                        <th>Issue &amp; Root Cause Evidence</th>
                        <th>Recommended Fix</th>
                        <th>Discovered</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($findings as $finding)
                        <tr>
                            <td>
                                @if($finding->severity === 'critical')
                                    <span class="seo-badge seo-badge-danger">CRITICAL</span>
                                @elseif($finding->severity === 'high')
                                    <span class="seo-badge seo-badge-warning">HIGH</span>
                                @elseif($finding->severity === 'medium')
                                    <span class="seo-badge seo-badge-info">MEDIUM</span>
                                @else
                                    <span class="seo-badge seo-badge-neutral">{{ strtoupper($finding->severity) }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="seo-badge seo-badge-neutral">{{ strtoupper(str_replace('_', ' ', $finding->category)) }}</span>
                            </td>
                            <td>
                                <a href="{{ $finding->affected_url }}" target="_blank" style="font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; color: #38bdf8; text-decoration: none;">
                                    {{ $finding->affected_url }}
                                </a>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #f1f5f9;">{{ $finding->issue_title }}</div>
                                <div style="font-size: 0.8rem; color: #94a3b8; margin-top: 2px;">{{ Str::limit($finding->explanation, 120) }}</div>
                                @if($finding->evidence)
                                    <div style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; color: #f59e0b; margin-top: 4px; background: rgba(0,0,0,0.25); padding: 2px 6px; border-radius: 3px; display: inline-block;">
                                        {{ Str::limit(json_encode($finding->evidence), 90) }}
                                    </div>
                                @endif
                            </td>
                            <td style="font-size: 0.85rem; color: #a7f3d0;">
                                {{ $finding->recommended_fix }}
                            </td>
                            <td style="font-size: 0.8rem; color: #64748b; white-space: nowrap;">
                                {{ $finding->created_at->diffForHumans() }}
                            </td>
                            <td>
                                @if($finding->status === 'resolved')
                                    <span class="seo-badge seo-badge-success">Resolved</span>
                                @elseif($finding->status === 'ignored')
                                    <span class="seo-badge seo-badge-neutral">Ignored</span>
                                @else
                                    <span class="seo-badge seo-badge-danger">Open</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 32px; color: #94a3b8;">
                                No issues recorded. Run an audit above to evaluate all 29 public pages.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function filterAuditTable() {
    const input = document.getElementById('findingSearchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#auditFindingsTable tbody tr');
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? '' : 'none';
    });
}
</script>
