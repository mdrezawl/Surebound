<!-- ==========================================
     MODULE 15: AI CRAWLER MANAGEMENT
     ========================================== -->
<div class="seo-tab-panel" id="tab-ai-crawlers">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">AI Crawler &amp; Bot Management Hub</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Separate search discovery bots (which cite and link to Surebound) from indiscriminate LLM training scrapers. Maintain strict directives per user-agent.
                </p>
            </div>
            <div>
                <button type="button" class="seo-btn seo-btn-primary" onclick="switchSeoTab('robots-sitemap')">
                    Edit robots.txt Rules
                </button>
            </div>
        </div>
    </div>

    {{-- Discovery vs Training Crawler Matrix --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                <span>AI Search &amp; Model Crawler Configuration Matrix</span>
            </div>
            <span style="font-size: 0.85rem; color: #94a3b8;">Configured in live /robots.txt</span>
        </div>

        <div class="seo-table-container">
            <table class="seo-table">
                <thead>
                    <tr>
                        <th>Crawler User-Agent</th>
                        <th>Classification</th>
                        <th>Associated Platform</th>
                        <th>Operational Purpose</th>
                        <th>Current Status</th>
                        <th>Commercial Impact</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($crawlerChecks as $check)
                        @php
                            $c = $check['crawler'] ?? [];
                            $name = $c['name'] ?? ($check['agent'] ?? 'Bot');
                            $type = $c['type'] ?? ($check['type'] ?? 'search_discovery');
                            $operator = $c['operator'] ?? ($check['platform'] ?? 'AI');
                            $purpose = $c['purpose'] ?? ($check['purpose'] ?? '');
                            $isAllowed = $check['is_allowed'] ?? false;
                        @endphp
                        <tr>
                            <td>
                                <div style="font-family: 'JetBrains Mono', monospace; font-weight: 700; color: #f8fafc; font-size: 0.9rem;">
                                    {{ $name }}
                                </div>
                            </td>
                            <td>
                                @if($type === 'search_discovery')
                                    <span class="seo-badge seo-badge-success">Search Discovery</span>
                                @else
                                    <span class="seo-badge seo-badge-neutral">Model Training</span>
                                @endif
                            </td>
                            <td style="font-weight: 500; color: #cbd5e1;">
                                {{ $operator }}
                            </td>
                            <td style="font-size: 0.85rem; color: #94a3b8; max-width: 280px;">
                                {{ $purpose }}
                            </td>
                            <td>
                                @if($isAllowed)
                                    <span class="seo-badge seo-badge-success">Allowed (200)</span>
                                @else
                                    <span class="seo-badge seo-badge-danger">Disallowed (Blocked)</span>
                                @endif
                            </td>
                            <td style="font-size: 0.8rem; color: #a7f3d0; max-width: 260px;">
                                {{ $isAllowed && $type === 'search_discovery' ? 'Eligible for real-time citations & search links.' : 'Preserves proprietary content from model corpus ingestion.' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
