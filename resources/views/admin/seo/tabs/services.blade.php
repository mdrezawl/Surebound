<!-- ==========================================
     MODULE 6: SERVICES & LANDING PAGES
     ========================================== -->
<div class="seo-tab-panel" id="tab-services">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">Services &amp; Commercial Insurance Landing Pages (12 Lines)</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    High-intent commercial and personal insurance product pages. Monitor schema coverage, conversion CTAs, target markets (US, UK, CA), and search intent.
                </p>
            </div>
            <div>
                <span class="seo-badge seo-badge-success" style="padding: 6px 12px; font-size: 0.85rem;">12 of 12 Services Active</span>
            </div>
        </div>
    </div>

    @php
        $servicePaths = [
            '/business-insurance' => ['title' => 'Business Insurance', 'cluster' => 'Commercial', 'icon' => 'briefcase'],
            '/commercial-auto-insurance' => ['title' => 'Commercial Auto Insurance', 'cluster' => 'Commercial', 'icon' => 'truck'],
            '/liability-insurance' => ['title' => 'General Liability Insurance', 'cluster' => 'Commercial', 'icon' => 'shield'],
            '/property-insurance' => ['title' => 'Commercial Property Insurance', 'cluster' => 'Commercial', 'icon' => 'office-building'],
            '/surety-bond' => ['title' => 'Surety Bonds', 'cluster' => 'Surety & Bonds', 'icon' => 'document-check'],
            '/specialty-coverage' => ['title' => 'Specialty & Cyber Coverage', 'cluster' => 'Specialty', 'icon' => 'sparkles'],
            '/group-benefits' => ['title' => 'Group Employee Benefits', 'cluster' => 'Benefits', 'icon' => 'user-group'],
            '/home-insurance' => ['title' => 'Home Insurance', 'cluster' => 'Personal', 'icon' => 'home'],
            '/auto-insurance' => ['title' => 'Auto Insurance', 'cluster' => 'Personal', 'icon' => 'car'],
            '/life-insurance' => ['title' => 'Life Insurance', 'cluster' => 'Personal', 'icon' => 'heart'],
            '/health-insurance' => ['title' => 'Health Insurance', 'cluster' => 'Personal', 'icon' => 'plus-circle'],
            '/umbrella-insurance' => ['title' => 'Umbrella Insurance', 'cluster' => 'Personal', 'icon' => 'umbrella'],
        ];
    @endphp

    <div class="seo-card">
        <div class="seo-table-container">
            <table class="seo-table">
                <thead>
                    <tr>
                        <th>Insurance Line</th>
                        <th>URL Slug</th>
                        <th>Topic Cluster</th>
                        <th>SEO Title</th>
                        <th>Focus Keyword</th>
                        <th>Structured Data</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicePaths as $path => $info)
                        @php
                            $pageMeta = $pages->firstWhere('url_path', $path);
                        @endphp
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #f8fafc; font-size: 0.95rem;">
                                    {{ $info['title'] }}
                                </div>
                                <div style="font-size: 0.75rem; color: #34d399; margin-top: 2px;">
                                    Instant Quote Enabled
                                </div>
                            </td>
                            <td>
                                <a href="{{ url($path) }}" target="_blank" style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #38bdf8; text-decoration: none;">
                                    {{ $path }}
                                </a>
                            </td>
                            <td>
                                <span class="seo-badge seo-badge-neutral">{{ $info['cluster'] }}</span>
                            </td>
                            <td>
                                <div style="font-size: 0.85rem; color: #cbd5e1; max-width: 260px;">
                                    {{ $pageMeta?->seo_title ?? ($info['title'] . ' | Surebound') }}
                                </div>
                            </td>
                            <td>
                                <span style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #a7f3d0;">
                                    {{ $pageMeta?->focus_keyword ?? strtolower($info['title']) }}
                                </span>
                            </td>
                            <td>
                                <span class="seo-badge seo-badge-info">
                                    {{ $pageMeta?->schema_type ?? 'Service' }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                @if($pageMeta)
                                    <button type="button" class="seo-btn seo-btn-primary" style="padding: 4px 10px; font-size: 0.8rem;"
                                        onclick="openEditPageModal({{ json_encode($pageMeta) }})">
                                        Edit SEO
                                    </button>
                                @else
                                    <a href="{{ url($path) }}" target="_blank" class="seo-btn seo-btn-secondary" style="padding: 4px 10px; font-size: 0.8rem;">
                                        View Page
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
