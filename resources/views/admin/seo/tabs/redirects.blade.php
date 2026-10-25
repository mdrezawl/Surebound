<!-- ==========================================
     MODULE 21: REDIRECT & BROKEN LINK MANAGER
     ========================================== -->
<div class="seo-tab-panel" id="tab-redirects">
    {{-- Header Banner --}}
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.25);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin: 0;">Redirect &amp; Broken Link Manager</h3>
                    <span class="seo-badge seo-badge-info">301 &bull; 302 &bull; 307 &bull; 308</span>
                </div>
                <p style="color: #94a3b8; font-size: 0.88rem; margin: 0; max-width: 760px; line-height: 1.5;">
                    Route legacy URLs to target landing pages, prevent crawl errors, and preserve organic link equity. Built-in loop detection stops recursive forwarding chains automatically.
                </p>
            </div>
            <div>
                <button type="button" class="seo-btn seo-btn-primary" onclick="openAddRedirectModal()">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Create Redirect Rule</span>
                </button>
            </div>
        </div>
    </div>

    {{-- KPI Metric Summary Row --}}
    <div class="seo-grid-4">
        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Active Rules</span>
                <div class="seo-kpi-icon" style="color: #60a5fa;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value" style="color: #60a5fa;">{{ $redirects->count() }}</div>
            <div class="seo-kpi-sub">
                <span>Configured URL redirects</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Permanent (301)</span>
                <div class="seo-kpi-icon" style="color: #34d399;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value" style="color: #34d399;">{{ $redirects->where('status_code', 301)->count() }}</div>
            <div class="seo-kpi-sub">
                <span>Passes full link equity</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Temporary (302)</span>
                <div class="seo-kpi-icon" style="color: #fbbf24;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value" style="color: #fbbf24;">{{ $redirects->where('status_code', 302)->count() }}</div>
            <div class="seo-kpi-sub">
                <span>Temporary forward rules</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Total Hits Caught</span>
                <div class="seo-kpi-icon" style="color: #c084fc;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
            <div class="seo-kpi-value" style="color: #c084fc;">{{ number_format($redirects->sum('hit_count')) }}</div>
            <div class="seo-kpi-sub">
                <span>404 errors prevented</span>
            </div>
        </div>
    </div>

    {{-- Redirects Table / Empty State --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                <span>Active Redirect Rules ({{ $redirects->count() }})</span>
            </div>
            @if(!$redirects->isEmpty())
                <button type="button" class="seo-btn seo-btn-secondary" style="padding: 6px 12px; font-size: 0.8rem;" onclick="openAddRedirectModal()">
                    + Add Rule
                </button>
            @endif
        </div>

        @if($redirects->isEmpty())
            <div class="seo-empty-state">
                <svg class="seo-empty-icon" width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
                <div class="seo-empty-title">No Redirect Rules Configured</div>
                <div class="seo-empty-sub">
                    Create 301 permanent redirects to preserve page authority when URLs change, or 302 rules for temporary maintenance redirects.
                </div>
                <button type="button" class="seo-btn seo-btn-primary" style="margin-top: 14px;" onclick="openAddRedirectModal()">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Create First Redirect Rule</span>
                </button>
            </div>
        @else
            <div class="seo-table-container">
                <table class="seo-table">
                    <thead>
                        <tr>
                            <th style="min-width: 220px;">Source Path</th>
                            <th style="min-width: 240px;">Destination URL</th>
                            <th style="min-width: 140px;">Status Code</th>
                            <th style="min-width: 180px;">Reason / Note</th>
                            <th style="min-width: 130px;">Traffic Hits</th>
                            <th style="min-width: 120px;">Created By</th>
                            <th style="text-align: right; min-width: 80px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($redirects as $r)
                            <tr>
                                <td>
                                    <div style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 8px; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.25); border-radius: 6px; font-family: 'JetBrains Mono', monospace; font-size: 0.82rem; font-weight: 600; color: #f87171;">
                                        {{ $r->source_path }}
                                    </div>
                                </td>
                                <td>
                                    <div style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 8px; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.25); border-radius: 6px; font-family: 'JetBrains Mono', monospace; font-size: 0.82rem; font-weight: 600; color: #34d399;">
                                        &rarr; {{ $r->destination_url }}
                                    </div>
                                </td>
                                <td>
                                    <span class="seo-badge {{ $r->status_code === 301 ? 'seo-badge-success' : 'seo-badge-info' }}">
                                        {{ $r->status_code }} {{ $r->status_code === 301 ? 'Permanent' : 'Temporary' }}
                                    </span>
                                </td>
                                <td style="font-size: 0.85rem; color: #94a3b8;">
                                    {{ $r->reason ?: 'Legacy path migration' }}
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: #cbd5e1; font-size: 0.85rem;">{{ number_format($r->hit_count) }} hits</div>
                                    @if($r->last_hit_at)
                                        <div style="font-size: 0.72rem; color: #64748b; margin-top: 2px;">Last: {{ $r->last_hit_at->diffForHumans() }}</div>
                                    @endif
                                </td>
                                <td style="font-size: 0.82rem; color: #94a3b8;">
                                    {{ $r->creator?->name ?? 'Admin' }}
                                </td>
                                <td style="text-align: right;">
                                    <form action="{{ route('admin.seo.redirects.delete', $r->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Remove redirect from {{ $r->source_path }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="seo-btn seo-btn-danger" style="padding: 6px 10px; font-size: 0.75rem;" title="Delete redirect rule">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
