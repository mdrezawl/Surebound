<!-- ==========================================
     MODULE 9: SITEMAP & ROBOTS MANAGER
     ========================================== -->
<div class="seo-tab-panel" id="tab-robots-sitemap">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">XML Sitemap &amp; Robots.txt Manager</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Manage dynamic search index generation, crawler allowances for Googlebot, OAI-SearchBot, PerplexityBot, and safeguard sensitive routes from indexing.
                </p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ url('/sitemap.xml') }}" target="_blank" class="seo-btn seo-btn-secondary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>View Live sitemap.xml</span>
                </a>
                <a href="{{ url('/robots.txt') }}" target="_blank" class="seo-btn seo-btn-secondary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>View Live robots.txt</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Grid 2: Left Sitemap Overview, Right Robots Editor --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
        {{-- Sitemap Status Card --}}
        <div class="seo-card">
            <div class="seo-card-header">
                <div class="seo-card-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Live XML Sitemap Coverage (29 URLs)</span>
                </div>
                <span class="seo-badge seo-badge-success">Valid XML 1.0</span>
            </div>

            <div style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 16px;">
                Auto-generated at <code style="color: #38bdf8;">/sitemap.xml</code>. Excludes authenticated admin routes (<code style="color: #f87171;">/admin/*</code>) and any page marked <code style="color: #f87171;">noindex</code>.
            </div>

            <div style="max-height: 400px; overflow-y: auto; border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; background: rgba(0,0,0,0.25);">
                <table class="seo-table" style="font-size: 0.8rem;">
                    <thead>
                        <tr>
                            <th>Canonical URL</th>
                            <th>Priority</th>
                            <th>Changefreq</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $p)
                            <tr>
                                <td>
                                    <div style="font-family: 'JetBrains Mono', monospace; color: #38bdf8;">
                                        {{ url($p->url_path) }}
                                    </div>
                                    <div style="font-size: 0.7rem; color: #64748b;">
                                        Updated: {{ $p->updated_at?->toDateString() }}
                                    </div>
                                </td>
                                <td>
                                    <span class="seo-badge seo-badge-neutral">
                                        {{ $p->url_path === '/' ? '1.0' : (str_contains($p->url_path, 'insurance') ? '0.9' : '0.8') }}
                                    </span>
                                </td>
                                <td>
                                    <span style="color: #cbd5e1;">weekly</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Robots.txt Code Editor --}}
        <div class="seo-card">
            <div class="seo-card-header">
                <div class="seo-card-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    <span>Robots.txt Directive Editor</span>
                </div>
                <span class="seo-badge seo-badge-info">Directives Guard</span>
            </div>

            <form action="{{ route('admin.seo.robots.save') }}" method="POST">
                @csrf
                <div style="margin-bottom: 14px;">
                    <label class="seo-form-label" style="margin-bottom: 6px;">Robots.txt Content</label>
                    <textarea name="content" rows="14" class="seo-form-textarea" style="font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; line-height: 1.5; color: #a7f3d0;" required>{{ $robotsContent }}</textarea>
                </div>

                <div style="margin-bottom: 16px;">
                    <label class="seo-form-label" style="margin-bottom: 4px;">Audit Note / Reason for Change</label>
                    <input type="text" name="note" class="seo-form-input" placeholder="e.g. Allowed OAI-SearchBot for ChatGPT Search discovery" style="font-size: 0.85rem;">
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.75rem; color: #94a3b8;">
                        * Googlebot &amp; OAI-SearchBot must not be blocked.
                    </span>
                    <button type="submit" class="seo-btn seo-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Save &amp; Publish Robots.txt</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
