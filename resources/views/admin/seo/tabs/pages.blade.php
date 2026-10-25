<!-- ==========================================
     MODULE 3: PAGES & ON-PAGE SEO MANAGEMENT
     ========================================== -->
<div class="seo-tab-panel" id="tab-pages">
    {{-- Header Banner --}}
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">Pages &amp; On-Page SEO Management ({{ $totalPagesCount }} URLs)</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Manage SEO title, meta descriptions, canonical URLs, robots directives, Open Graph, schema types, and search intent for all 29 public pages.
                </p>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="text" id="pageSearchInput" class="seo-form-input" placeholder="Search pages..." style="width: 220px; padding: 8px 12px; font-size: 0.85rem;" onkeyup="filterPagesTable()">
            </div>
        </div>
    </div>

    {{-- Pages Table --}}
    <div class="seo-card">
        <div class="seo-table-container">
            <table class="seo-table" id="seoPagesTable">
                <thead>
                    <tr>
                        <th>Page &amp; Route Name</th>
                        <th>SEO Title &amp; Snippet Length</th>
                        <th>Meta Description</th>
                        <th>Focus Keyword &amp; Intent</th>
                        <th>Index Directives</th>
                        <th>Schema</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                        @php
                            $titleLen = mb_strlen($page->seo_title ?? '');
                            $descLen = mb_strlen($page->meta_description ?? '');
                            $isDescShort = $descLen < 50;
                        @endphp
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #f8fafc;">
                                    {{ $page->title ?: ucwords(str_replace('-', ' ', trim($page->url_path, '/'))) ?: 'Homepage' }}
                                </div>
                                <div style="display: flex; align-items: center; gap: 6px; margin-top: 2px;">
                                    <a href="{{ url($page->url_path) }}" target="_blank" style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #38bdf8; text-decoration: none;">
                                        {{ $page->url_path }}
                                    </a>
                                    <svg width="12" height="12" fill="none" stroke="#64748b" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </div>
                                <div style="font-size: 0.75rem; color: #64748b; margin-top: 2px;">
                                    Route: {{ $page->route_name ?? 'web' }}
                                </div>
                            </td>
                            <td>
                                <div style="font-size: 0.9rem; color: #e2e8f0; font-weight: 500; max-width: 280px;">
                                    {{ $page->seo_title }}
                                </div>
                                <div style="display: flex; align-items: center; gap: 6px; margin-top: 4px;">
                                    <span class="seo-badge {{ $titleLen >= 30 && $titleLen <= 65 ? 'seo-badge-success' : 'seo-badge-warning' }}">
                                        {{ $titleLen }} chars
                                    </span>
                                    @if($titleLen < 30)
                                        <span style="font-size: 0.7rem; color: #f59e0b;">Short</span>
                                    @elseif($titleLen > 65)
                                        <span style="font-size: 0.7rem; color: #f87171;">May Truncate</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="font-size: 0.8rem; color: #94a3b8; max-width: 320px; line-height: 1.4;">
                                    {{ Str::limit($page->meta_description, 90) ?: 'No description configured' }}
                                </div>
                                <div style="margin-top: 4px;">
                                    <span class="seo-badge {{ $descLen >= 110 && $descLen <= 165 ? 'seo-badge-success' : ($descLen === 0 ? 'seo-badge-danger' : 'seo-badge-warning') }}">
                                        {{ $descLen }} chars
                                    </span>
                                </div>
                            </td>
                            <td>
                                @if($page->focus_keyword)
                                    <div style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #a7f3d0; font-weight: 600;">
                                        {{ $page->focus_keyword }}
                                    </div>
                                    <span class="seo-badge seo-badge-neutral" style="margin-top: 4px;">
                                        {{ ucfirst($page->search_intent ?? 'commercial') }}
                                    </span>
                                @else
                                    <span style="font-size: 0.8rem; color: #64748b;">Not set</span>
                                @endif
                            </td>
                            <td>
                                @if(str_contains(strtolower($page->meta_robots ?? ''), 'noindex'))
                                    <span class="seo-badge seo-badge-danger">noindex</span>
                                @else
                                    <span class="seo-badge seo-badge-success">index, follow</span>
                                @endif
                                <div style="font-size: 0.7rem; color: #64748b; margin-top: 4px;">
                                    {{ $page->target_country }}-{{ $page->target_language }}
                                </div>
                            </td>
                            <td>
                                <span class="seo-badge seo-badge-info">
                                    {{ $page->schema_type ?: 'WebPage' }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <button type="button" class="seo-btn seo-btn-primary" style="padding: 6px 12px; font-size: 0.8rem;"
                                    onclick="openEditPageModal({{ json_encode($page) }})">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    <span>Edit SEO</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function filterPagesTable() {
    const input = document.getElementById('pageSearchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#seoPagesTable tbody tr');
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? '' : 'none';
    });
}
</script>
