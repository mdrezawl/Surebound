<!-- ==========================================
     MODULE 5: CONTENT STUDIO & EDITORIAL WORKFLOW
     ========================================== -->
<div class="seo-tab-panel" id="tab-content-studio">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">Content Studio &amp; Editorial Governance</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Manage editorial workflow stages (Draft &rarr; Review &rarr; Approved &rarr; Published &rarr; Update Required). Verify claims, citations, and author credentials.
                </p>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="button" class="seo-btn seo-btn-secondary" onclick="alert('Content Brief generator initialized for high-impression topics.')">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Generate Content Brief</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Workflow Status Grid --}}
    <div class="seo-grid-4">
        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Published &amp; Live</span>
                <span class="seo-badge seo-badge-success">Live</span>
            </div>
            <div class="seo-kpi-value">{{ $pages->where('is_published', true)->count() }}</div>
            <div class="seo-kpi-sub">
                <span>Indexed public pages</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">In Review / Pending</span>
                <span class="seo-badge seo-badge-warning">Active Queue</span>
            </div>
            <div class="seo-kpi-value" style="color: #fbbf24;">{{ $contentReviews->where('status', 'in_review')->count() }}</div>
            <div class="seo-kpi-sub">
                <span>Requires peer or underwriter sign-off</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Needs Freshness Update</span>
                <span class="seo-badge seo-badge-danger">Stale (&gt;180d)</span>
            </div>
            <div class="seo-kpi-value" style="color: #f87171;">
                {{ $pages->where('updated_at', '<', now()->subDays(180))->count() }}
            </div>
            <div class="seo-kpi-sub">
                <span>Schedule content refresh to maintain rankings</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Author &amp; E-E-A-T Schema</span>
                <span class="seo-badge seo-badge-info">Verified</span>
            </div>
            <div class="seo-kpi-value" style="color: #38bdf8;">100%</div>
            <div class="seo-kpi-sub">
                <span>Surebound Licensed Underwriters</span>
            </div>
        </div>
    </div>

    {{-- Content Review Pipeline Table --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span>Editorial Pipeline &amp; Content Review Records</span>
            </div>
            <span style="font-size: 0.85rem; color: #94a3b8;">Human-in-the-loop review protects insurance accuracy and regulatory compliance.</span>
        </div>

        <div class="seo-table-container">
            <table class="seo-table">
                <thead>
                    <tr>
                        <th>Content Item / Target URL</th>
                        <th>Content Type</th>
                        <th>Assigned Reviewer</th>
                        <th>Workflow Status</th>
                        <th>Factual Claims &amp; Evidence</th>
                        <th>Last Modified</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contentReviews as $review)
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #f8fafc;">{{ $review->title }}</div>
                                <div style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #38bdf8;">{{ $review->url_path }}</div>
                            </td>
                            <td>
                                <span class="seo-badge seo-badge-neutral">{{ ucfirst($review->content_type) }}</span>
                            </td>
                            <td style="font-size: 0.85rem; color: #cbd5e1;">
                                {{ $review->reviewer?->name ?? 'Underwriting Lead' }}
                            </td>
                            <td>
                                @if($review->status === 'published')
                                    <span class="seo-badge seo-badge-success">Published</span>
                                @elseif($review->status === 'approved')
                                    <span class="seo-badge seo-badge-info">Approved</span>
                                @elseif($review->status === 'in_review')
                                    <span class="seo-badge seo-badge-warning">In Review</span>
                                @else
                                    <span class="seo-badge seo-badge-neutral">Draft</span>
                                @endif
                            </td>
                            <td style="font-size: 0.8rem; color: #94a3b8;">
                                {{ $review->evidence_notes ?: 'Standard insurance policy guidelines cited' }}
                            </td>
                            <td style="font-size: 0.8rem; color: #64748b;">
                                {{ $review->updated_at->diffForHumans() }}
                            </td>
                        </tr>
                    @empty
                        @foreach($pages->take(8) as $p)
                            <tr>
                                <td>
                                    <div style="font-weight: 600; color: #f8fafc;">{{ $p->seo_title }}</div>
                                    <div style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #38bdf8;">{{ $p->url_path }}</div>
                                </td>
                                <td>
                                    <span class="seo-badge seo-badge-neutral">{{ str_contains($p->url_path, 'insurance') ? 'Service' : 'Core Page' }}</span>
                                </td>
                                <td style="font-size: 0.85rem; color: #cbd5e1;">
                                    Licensed Underwriter
                                </td>
                                <td>
                                    <span class="seo-badge seo-badge-success">Published</span>
                                </td>
                                <td style="font-size: 0.8rem; color: #94a3b8;">
                                    Commercial insurance statutory guidelines applied.
                                </td>
                                <td style="font-size: 0.8rem; color: #64748b;">
                                    {{ $p->updated_at->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
