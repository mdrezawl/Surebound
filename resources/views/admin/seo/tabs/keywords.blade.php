<!-- ==========================================
     MODULE 4: KEYWORD RESEARCH & MAPPING
     ========================================== -->
<div class="seo-tab-panel" id="tab-keywords">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">Keyword Research, Intent &amp; Topic Mapping</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Map primary and secondary keywords to commercial landing pages. Detect keyword cannibalization and prevent overlapping search intent.
                </p>
            </div>
            <div>
                <button type="button" class="seo-btn seo-btn-primary" onclick="openAddKeywordModal()">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Add Target Keyword</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Keyword Metrics Cards --}}
    <div class="seo-grid-4">
        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Mapped Keywords</span>
                <span class="seo-badge seo-badge-info">{{ $keywords->count() }} Total</span>
            </div>
            <div class="seo-kpi-value">{{ $keywords->count() }}</div>
            <div class="seo-kpi-sub">
                <span>Across {{ $keywords->pluck('target_url')->unique()->count() }} unique landing pages</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Cannibalization Warnings</span>
                <span class="seo-badge {{ $keywords->whereNotNull('cannibalization_warning')->count() > 0 ? 'seo-badge-danger' : 'seo-badge-success' }}">
                    {{ $keywords->whereNotNull('cannibalization_warning')->count() > 0 ? 'Detected' : 'Clean' }}
                </span>
            </div>
            <div class="seo-kpi-value" style="color: {{ $keywords->whereNotNull('cannibalization_warning')->count() > 0 ? '#f87171' : '#34d399' }};">
                {{ $keywords->whereNotNull('cannibalization_warning')->count() }}
            </div>
            <div class="seo-kpi-sub">
                <span>Multiple pages competing for same query</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Topic Clusters</span>
                <span class="seo-badge seo-badge-neutral">{{ $keywords->pluck('topic_cluster')->filter()->unique()->count() }} Active</span>
            </div>
            <div class="seo-kpi-value">{{ $keywords->pluck('topic_cluster')->filter()->unique()->count() }}</div>
            <div class="seo-kpi-sub">
                <span>Commercial lines, Personal, Specialty, Surety</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Provider Connection</span>
                <span class="seo-badge seo-badge-neutral">Manual / GSC</span>
            </div>
            <div class="seo-kpi-value" style="font-size: 1.1rem; color: #94a3b8; font-weight: 500;">
                GSC Analytics
            </div>
            <div class="seo-kpi-sub">
                <span>Connect 3rd-party provider for third-party volume</span>
            </div>
        </div>
    </div>

    {{-- Keywords Table --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                <span>Keyword Mapping Directory</span>
            </div>
            <div>
                <input type="text" id="keywordSearchInput" class="seo-form-input" placeholder="Search keywords..." style="width: 220px; padding: 6px 12px; font-size: 0.85rem;" onkeyup="filterKeywordsTable()">
            </div>
        </div>

        @if($keywords->isEmpty())
            <div class="seo-empty-state">
                <svg class="seo-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                <div class="seo-empty-title">No Keywords Mapped Yet</div>
                <div class="seo-empty-sub">Map primary keywords like "surety bonds ca" or "commercial general liability insurance" to target pages.</div>
                <button type="button" class="seo-btn seo-btn-primary" style="margin-top: 16px;" onclick="openAddKeywordModal()">Add First Keyword</button>
            </div>
        @else
            <div class="seo-table-container">
                <table class="seo-table" id="keywordsTable">
                    <thead>
                        <tr>
                            <th>Target Keyword</th>
                            <th>Target Landing URL</th>
                            <th>Search Intent</th>
                            <th>Topic Cluster</th>
                            <th>Search Volume / Rank</th>
                            <th>Cannibalization Alert</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keywords as $kw)
                            <tr>
                                <td>
                                    <div style="font-family: 'JetBrains Mono', monospace; font-weight: 600; color: #f8fafc; font-size: 0.9rem;">
                                        {{ $kw->keyword }}
                                    </div>
                                    @if($kw->notes)
                                        <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 2px;">{{ $kw->notes }}</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url($kw->target_url) }}" target="_blank" style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #38bdf8; text-decoration: none;">
                                        {{ $kw->target_url }}
                                    </a>
                                </td>
                                <td>
                                    <span class="seo-badge seo-badge-neutral">{{ ucfirst($kw->search_intent) }}</span>
                                </td>
                                <td>
                                    <span class="seo-badge seo-badge-info">{{ $kw->topic_cluster ?: 'General' }}</span>
                                </td>
                                <td>
                                    <div style="font-size: 0.85rem; color: #cbd5e1;">
                                        {{ $kw->search_volume ? number_format($kw->search_volume) . '/mo' : 'Provider unlinked' }}
                                    </div>
                                    @if($kw->current_position)
                                        <div style="font-size: 0.75rem; color: #34d399; margin-top: 2px;">
                                            Pos: #{{ $kw->current_position }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($kw->cannibalization_warning)
                                        <span class="seo-badge seo-badge-danger" title="{{ $kw->cannibalization_warning }}">
                                            Conflict Alert
                                        </span>
                                    @else
                                        <span class="seo-badge seo-badge-success">Unique</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <form action="{{ route('admin.seo.keywords.delete', $kw->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Delete mapped keyword \'{{ $kw->keyword }}\'?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="seo-btn seo-btn-secondary" style="padding: 4px 8px; color: #f87171;" title="Delete keyword">
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

<script>
function filterKeywordsTable() {
    const input = document.getElementById('keywordSearchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#keywordsTable tbody tr');
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? '' : 'none';
    });
}
</script>
