<!-- ==========================================
     MODULE 23: REPORTS & NOTIFICATION CENTER
     ========================================== -->
<div class="seo-tab-panel" id="tab-reports">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">SEO Alerts &amp; Executive Notification Center</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Real-time alert monitoring for unexpected noindex changes, broken sitemaps, 5xx server spikes, canonical drifts, and API credential expiration.
                </p>
            </div>
            <div>
                <span class="seo-badge {{ $unreadAlertsCount > 0 ? 'seo-badge-danger' : 'seo-badge-success' }}" style="padding: 6px 12px; font-size: 0.85rem;">
                    {{ $unreadAlertsCount }} Unread Alerts
                </span>
            </div>
        </div>
    </div>

    {{-- Alerts Table --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                <span>Automated System Alerts ({{ $alerts->count() }})</span>
            </div>
        </div>

        @if($alerts->isEmpty())
            <div class="seo-empty-state">
                <svg class="seo-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div class="seo-empty-title">All Systems Operating Normally</div>
                <div class="seo-empty-sub">No technical SEO regressions, sitemap errors, or crawler issues detected.</div>
            </div>
        @else
            <div class="seo-table-container">
                <table class="seo-table">
                    <thead>
                        <tr>
                            <th>Severity</th>
                            <th>Alert Title &amp; Description</th>
                            <th>Channel</th>
                            <th>Generated</th>
                            <th>Status</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alerts as $alert)
                            <tr>
                                <td>
                                    @if($alert->severity === 'critical')
                                        <span class="seo-badge seo-badge-danger">CRITICAL</span>
                                    @elseif($alert->severity === 'warning')
                                        <span class="seo-badge seo-badge-warning">WARNING</span>
                                    @else
                                        <span class="seo-badge seo-badge-info">INFO</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: #f8fafc;">{{ $alert->title }}</div>
                                    <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 2px;">{{ $alert->message }}</div>
                                </td>
                                <td>
                                    <span class="seo-badge seo-badge-neutral">{{ ucfirst($alert->channel) }}</span>
                                </td>
                                <td style="font-size: 0.8rem; color: #64748b; white-space: nowrap;">
                                    {{ $alert->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    @if($alert->is_read)
                                        <span class="seo-badge seo-badge-success">Resolved</span>
                                    @else
                                        <span class="seo-badge seo-badge-danger">Unread</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    @if(!$alert->is_read)
                                        <form action="{{ route('admin.seo.alerts.read', $alert->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="seo-btn seo-btn-secondary" style="padding: 4px 8px; font-size: 0.8rem;">
                                                Mark Resolved
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
</div>
