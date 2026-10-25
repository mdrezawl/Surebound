<!-- ==========================================
     MODULE 26: SYSTEM SETTINGS & AUDIT LOGS
     ========================================== -->
<div class="seo-tab-panel" id="tab-settings">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">System Automation Settings &amp; Audit Logs</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Configure crawler throttle rate limits, automated fix safeguards, notification webhooks, and review complete immutable audit logs.
                </p>
            </div>
            <div>
                <span class="seo-badge seo-badge-info" style="padding: 6px 12px; font-size: 0.85rem;">
                    Mode: {{ ucwords(str_replace('_', ' ', $automationSettings->mode)) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Automation Form Card --}}
    <div class="seo-card" style="margin-bottom: 24px;">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Crawler Throttling &amp; Automated Recommendation Safeguards</span>
            </div>
        </div>

        <form action="{{ route('admin.seo.settings.save') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label class="seo-form-label">Automation Mode</label>
                    <select name="mode" class="seo-form-select" required>
                        <option value="audit_only" {{ $automationSettings->mode === 'audit_only' ? 'selected' : '' }}>
                            1. Audit Only (Detect and report issues without automated changes)
                        </option>
                        <option value="suggest_and_approve" {{ $automationSettings->mode === 'suggest_and_approve' ? 'selected' : '' }}>
                            2. Suggest and Approve (Prepare fixes for human review) [Default]
                        </option>
                        <option value="safe_auto_fix" {{ $automationSettings->mode === 'safe_auto_fix' ? 'selected' : '' }}>
                            3. Safe Auto-Fix (Automatically apply explicitly approved low-risk fixes)
                        </option>
                    </select>
                </div>

                <div>
                    <label class="seo-form-label">Crawl Limit (Pages per Audit)</label>
                    <input type="number" name="crawl_limit_pages" class="seo-form-input" min="10" max="500" value="{{ $automationSettings->crawl_limit_pages ?? 100 }}" required>
                </div>

                <div>
                    <label class="seo-form-label">Crawl Delay (Throttle Milliseconds)</label>
                    <input type="number" name="crawl_throttle_delay_ms" class="seo-form-input" min="50" max="2000" value="{{ $automationSettings->crawl_throttle_delay_ms ?? 100 }}" required>
                    <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 4px;">Prevents high CPU or production site throttling during crawling.</div>
                </div>

                <div>
                    <label class="seo-form-label">Alert Notification Email</label>
                    <input type="email" name="alert_email" class="seo-form-input" value="{{ $automationSettings->alert_email ?? 'underwriting@surebound.com' }}">
                </div>
            </div>

            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                <label style="display: flex; align-items: center; gap: 8px; color: #cbd5e1; font-size: 0.85rem; cursor: pointer;">
                    <input type="checkbox" name="alert_on_critical" value="1" {{ $automationSettings->alert_on_critical ? 'checked' : '' }}>
                    <span>Send Immediate Alert on Critical Audit Findings</span>
                </label>
                <label style="display: flex; align-items: center; gap: 8px; color: #cbd5e1; font-size: 0.85rem; cursor: pointer;">
                    <input type="checkbox" name="auto_sitemap_sync" value="1" {{ $automationSettings->auto_sitemap_sync ? 'checked' : '' }}>
                    <span>Automatically Regenerate /sitemap.xml on Route Updates</span>
                </label>
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" class="seo-btn seo-btn-primary">
                    Save System Settings
                </button>
            </div>
        </form>
    </div>

    {{-- Immutable Audit Logs Table --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Immutable SEO System Audit Logs</span>
            </div>
            <span style="font-size: 0.85rem; color: #94a3b8;">Full traceability for all metadata, redirect, and setting modifications.</span>
        </div>

        <div class="seo-table-container">
            <table class="seo-table">
                <thead>
                    <tr>
                        <th>Action Type</th>
                        <th>Target Model</th>
                        <th>Record ID</th>
                        <th>Executed By</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($auditLogs as $log)
                        <tr>
                            <td>
                                <span class="seo-badge seo-badge-neutral" style="font-family: 'JetBrains Mono', monospace;">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td style="color: #cbd5e1; font-size: 0.85rem;">
                                {{ $log->model_type }}
                            </td>
                            <td style="font-family: 'JetBrains Mono', monospace; color: #38bdf8;">
                                #{{ $log->model_id }}
                            </td>
                            <td style="font-size: 0.85rem; color: #f8fafc;">
                                {{ $log->user?->name ?? 'System / CLI' }}
                            </td>
                            <td style="font-size: 0.8rem; color: #64748b; white-space: nowrap;">
                                {{ $log->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #94a3b8; padding: 24px;">
                                No system modifications recorded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
