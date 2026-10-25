@extends('admin.seo.layout')

@section('content')
    {{-- Include All 26 System Tabs --}}
    @include('admin.seo.tabs.overview')
    @include('admin.seo.tabs.audit-center')
    @include('admin.seo.tabs.pages')
    @include('admin.seo.tabs.keywords')
    @include('admin.seo.tabs.content-studio')
    @include('admin.seo.tabs.services')
    @include('admin.seo.tabs.case-studies')
    @include('admin.seo.tabs.technical')
    @include('admin.seo.tabs.robots-sitemap')
    @include('admin.seo.tabs.schema')
    @include('admin.seo.tabs.search-console')
    @include('admin.seo.tabs.analytics')
    @include('admin.seo.tabs.pagespeed')
    @include('admin.seo.tabs.ai-visibility')
    @include('admin.seo.tabs.ai-crawlers')
    @include('admin.seo.tabs.international')
    @include('admin.seo.tabs.local-seo')
    @include('admin.seo.tabs.backlinks')
    @include('admin.seo.tabs.competitors')
    @include('admin.seo.tabs.internal-links')
    @include('admin.seo.tabs.redirects')
    @include('admin.seo.tabs.leads')
    @include('admin.seo.tabs.reports')
    @include('admin.seo.tabs.integrations')
    @include('admin.seo.tabs.roles')
    @include('admin.seo.tabs.settings')

    {{-- ========================================================
         MODAL 1: ON-PAGE SEO EDITOR WITH LIVE SERP & SOCIAL PREVIEW
         ======================================================== --}}
    <div id="editPageSeoModal" class="seo-modal" style="display: none;">
        <div class="seo-modal-overlay" onclick="closeEditPageModal()"></div>
        <div class="seo-modal-dialog" style="max-width: 840px;">
            <div class="seo-modal-header">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div class="seo-brand-icon" style="width: 32px; height: 32px;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 1.15rem; font-weight: 700; color: #f8fafc;" id="editModalPageTitle">On-Page SEO Configuration</h4>
                        <span style="font-size: 0.8rem; color: #38bdf8; font-family: 'JetBrains Mono', monospace;" id="editModalPagePath">/page</span>
                    </div>
                </div>
                <button type="button" class="seo-modal-close" onclick="closeEditPageModal()">&times;</button>
            </div>

            <form id="editPageSeoForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="seo-modal-body" style="max-height: 75vh; overflow-y: auto; padding: 24px;">
                    {{-- Real-Time Google SERP Preview Card --}}
                    <div style="margin-bottom: 24px; background: #0b1120; border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; color: #38bdf8;">
                                Live Google Search Snippet Preview
                            </span>
                            <span style="font-size: 0.75rem; color: #94a3b8;" id="serpCharCounts">0 chars</span>
                        </div>
                        <div style="font-family: Arial, sans-serif; max-width: 600px;">
                            <div style="font-size: 0.8rem; color: #202124; display: flex; align-items: center; gap: 4px; margin-bottom: 4px;">
                                <span style="color: #cbd5e1;" id="serpPreviewUrl">{{ url('/') }}</span>
                            </div>
                            <div style="font-size: 1.15rem; color: #60a5fa; font-weight: 500; cursor: pointer; text-decoration: underline; line-height: 1.3; margin-bottom: 4px;" id="serpPreviewTitle">
                                Page Title
                            </div>
                            <div style="font-size: 0.85rem; color: #94a3b8; line-height: 1.4;" id="serpPreviewDesc">
                                Meta description preview...
                            </div>
                        </div>
                    </div>

                    {{-- Form Fields --}}
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div style="grid-column: 1 / -1;">
                            <label class="seo-form-label">SEO Title (30 - 65 characters)</label>
                            <input type="text" name="seo_title" id="inputSeoTitle" class="seo-form-input" required oninput="syncSerpPreview()">
                        </div>

                        <div style="grid-column: 1 / -1;">
                            <label class="seo-form-label">Meta Description (110 - 160 characters)</label>
                            <textarea name="meta_description" id="inputMetaDesc" rows="3" class="seo-form-textarea" required oninput="syncSerpPreview()"></textarea>
                        </div>

                        <div>
                            <label class="seo-form-label">Focus Keyword</label>
                            <input type="text" name="focus_keyword" id="inputFocusKeyword" class="seo-form-input" placeholder="e.g. surety bonds ca">
                        </div>

                        <div>
                            <label class="seo-form-label">Search Intent</label>
                            <select name="search_intent" id="selectSearchIntent" class="seo-form-select">
                                <option value="commercial">Commercial</option>
                                <option value="transactional">Transactional</option>
                                <option value="informational">Informational</option>
                                <option value="navigational">Navigational</option>
                            </select>
                        </div>

                        <div>
                            <label class="seo-form-label">Canonical URL (Override or leave blank for self-ref)</label>
                            <input type="url" name="canonical_url" id="inputCanonicalUrl" class="seo-form-input" placeholder="https://surebound.com/...">
                        </div>

                        <div>
                            <label class="seo-form-label">Meta Robots Directive</label>
                            <select name="meta_robots" id="selectMetaRobots" class="seo-form-select">
                                <option value="index, follow">index, follow (Default Public Index)</option>
                                <option value="noindex, follow">noindex, follow (Hide from SERP, follow links)</option>
                                <option value="noindex, nofollow">noindex, nofollow (Complete block)</option>
                            </select>
                        </div>

                        <div>
                            <label class="seo-form-label">Target Market Country</label>
                            <select name="target_country" id="selectTargetCountry" class="seo-form-select">
                                <option value="US">United States (US)</option>
                                <option value="GB">United Kingdom (GB)</option>
                                <option value="CA">Canada (CA)</option>
                                <option value="Global">Global / All</option>
                            </select>
                        </div>

                        <div>
                            <label class="seo-form-label">Target Language</label>
                            <input type="text" name="target_language" id="inputTargetLanguage" class="seo-form-input" value="en" required>
                        </div>

                        <div>
                            <label class="seo-form-label">Primary Schema Type</label>
                            <select name="schema_type" id="selectSchemaType" class="seo-form-select">
                                <option value="InsuranceAgency">InsuranceAgency (Homepage / General)</option>
                                <option value="Service">Service (Product Lines)</option>
                                <option value="FinancialProduct">FinancialProduct (Surety Bonds)</option>
                                <option value="Article">Article (Guides / News)</option>
                                <option value="WebPage">WebPage (General)</option>
                            </select>
                        </div>

                        <div>
                            <label class="seo-form-label">Secondary Keywords (Comma-separated)</label>
                            <input type="text" name="secondary_keywords" id="inputSecondaryKeywords" class="seo-form-input" placeholder="bond quotes, contract surety">
                        </div>

                        <div style="grid-column: 1 / -1; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 14px;">
                            <label class="seo-form-label">Open Graph Social Image URL</label>
                            <input type="text" name="og_image" id="inputOgImage" class="seo-form-input" placeholder="{{ asset('images/social-card.jpg') }}">
                        </div>

                        <div style="grid-column: 1 / -1;">
                            <label style="display: flex; align-items: center; gap: 8px; color: #cbd5e1; font-size: 0.9rem; cursor: pointer;">
                                <input type="checkbox" name="is_published" id="checkIsPublished" value="1">
                                <span>Published &amp; Active for Public XML Sitemap &amp; Search Bots</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="seo-modal-footer">
                    <button type="button" class="seo-btn seo-btn-secondary" onclick="closeEditPageModal()">Cancel</button>
                    <button type="submit" class="seo-btn seo-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Save SEO Settings</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ========================================================
         MODAL 2: ADD NEW 301/302 REDIRECT
         ======================================================== --}}
    <div id="addRedirectModal" class="seo-modal" style="display: none;">
        <div class="seo-modal-overlay" onclick="closeAddRedirectModal()"></div>
        <div class="seo-modal-dialog" style="max-width: 560px;">
            <div class="seo-modal-header">
                <h4 style="margin: 0; font-size: 1.15rem; font-weight: 700; color: #f8fafc;">Create SEO Redirect</h4>
                <button type="button" class="seo-modal-close" onclick="closeAddRedirectModal()">&times;</button>
            </div>
            <form action="{{ route('admin.seo.redirects.store') }}" method="POST">
                @csrf
                <div class="seo-modal-body" style="padding: 24px;">
                    <div class="seo-form-group">
                        <label class="seo-form-label">Source Path (URL to intercept)</label>
                        <input type="text" name="source_path" class="seo-form-input" placeholder="/old-surety-bonds" required>
                    </div>
                    <div class="seo-form-group">
                        <label class="seo-form-label">Destination URL (Forward to)</label>
                        <input type="text" name="destination_url" class="seo-form-input" placeholder="/surety-bond" required>
                    </div>
                    <div class="seo-form-group">
                        <label class="seo-form-label">HTTP Status Code</label>
                        <select name="status_code" class="seo-form-select" required>
                            <option value="301">301 - Permanent Redirect (Recommended for SEO link equity)</option>
                            <option value="302">302 - Temporary Redirect (Temporary maintenance)</option>
                            <option value="307">307 - Temporary Redirect (Preserve HTTP method)</option>
                            <option value="308">308 - Permanent Redirect (Preserve HTTP method)</option>
                        </select>
                    </div>
                    <div class="seo-form-group" style="margin-bottom: 0;">
                        <label class="seo-form-label">Reason / Audit Note (Optional)</label>
                        <input type="text" name="reason" class="seo-form-input" placeholder="e.g. Migration from old site structure">
                    </div>
                </div>
                <div class="seo-modal-footer">
                    <button type="button" class="seo-btn seo-btn-secondary" onclick="closeAddRedirectModal()">Cancel</button>
                    <button type="submit" class="seo-btn seo-btn-primary">Save Redirect</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ========================================================
         MODAL 3: ADD TARGET KEYWORD
         ======================================================== --}}
    <div id="addKeywordModal" class="seo-modal" style="display: none;">
        <div class="seo-modal-overlay" onclick="closeAddKeywordModal()"></div>
        <div class="seo-modal-dialog" style="max-width: 560px;">
            <div class="seo-modal-header">
                <h4 style="margin: 0; font-size: 1.15rem; font-weight: 700; color: #f8fafc;">Map Target Keyword</h4>
                <button type="button" class="seo-modal-close" onclick="closeAddKeywordModal()">&times;</button>
            </div>
            <form action="{{ route('admin.seo.keywords.store') }}" method="POST">
                @csrf
                <div class="seo-modal-body" style="padding: 24px;">
                    <div style="margin-bottom: 14px;">
                        <label class="seo-form-label">Target Keyword</label>
                        <input type="text" name="keyword" class="seo-form-input" placeholder="e.g. commercial general liability insurance quote" required>
                    </div>
                    <div style="margin-bottom: 14px;">
                        <label class="seo-form-label">Target Landing URL</label>
                        <input type="text" name="target_url" class="seo-form-input" placeholder="/liability-insurance" required>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                        <div>
                            <label class="seo-form-label">Search Intent</label>
                            <select name="search_intent" class="seo-form-select">
                                <option value="commercial">Commercial</option>
                                <option value="transactional">Transactional</option>
                                <option value="informational">Informational</option>
                                <option value="navigational">Navigational</option>
                            </select>
                        </div>
                        <div>
                            <label class="seo-form-label">Topic Cluster</label>
                            <input type="text" name="topic_cluster" class="seo-form-input" placeholder="Commercial Lines">
                        </div>
                    </div>
                    <div style="margin-bottom: 14px;">
                        <label class="seo-form-label">Notes / Strategic Intent</label>
                        <input type="text" name="notes" class="seo-form-input" placeholder="Primary commercial acquisition term">
                    </div>
                </div>
                <div class="seo-modal-footer">
                    <button type="button" class="seo-btn seo-btn-secondary" onclick="closeAddKeywordModal()">Cancel</button>
                    <button type="submit" class="seo-btn seo-btn-primary">Save Keyword Target</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ========================================================
         MODAL 4: LOG VERIFIED AI CITATION
         ======================================================== --}}
    <div id="logCitationModal" class="seo-modal" style="display: none;">
        <div class="seo-modal-overlay" onclick="closeLogCitationModal()"></div>
        <div class="seo-modal-dialog" style="max-width: 600px;">
            <div class="seo-modal-header">
                <h4 style="margin: 0; font-size: 1.15rem; font-weight: 700; color: #f8fafc;">Log Verified AI Search Citation</h4>
                <button type="button" class="seo-modal-close" onclick="closeLogCitationModal()">&times;</button>
            </div>
            <form action="{{ route('admin.seo.citations.store') }}" method="POST">
                @csrf
                <div class="seo-modal-body" style="padding: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                        <div>
                            <label class="seo-form-label">AI Search Platform</label>
                            <select name="platform" class="seo-form-select" required>
                                <option value="ChatGPT Search">ChatGPT Search</option>
                                <option value="Google AI Overviews">Google AI Overviews</option>
                                <option value="Perplexity">Perplexity AI</option>
                                <option value="Gemini">Google Gemini</option>
                            </select>
                        </div>
                        <div>
                            <label class="seo-form-label">Test Evaluation Date</label>
                            <input type="date" name="test_date" class="seo-form-input" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div style="margin-bottom: 14px;">
                        <label class="seo-form-label">Query Tested</label>
                        <input type="text" name="query_tested" class="seo-form-input" placeholder="e.g. Best commercial surety bond providers in Texas" required>
                    </div>

                    <div style="margin-bottom: 14px;">
                        <label class="seo-form-label">Cited URL on Surebound</label>
                        <input type="url" name="cited_url" class="seo-form-input" placeholder="{{ url('/surety-bond') }}">
                    </div>

                    <div style="margin-bottom: 14px;">
                        <label class="seo-form-label">Evidence Snippet / AI Output Text</label>
                        <textarea name="evidence_text" rows="3" class="seo-form-textarea" placeholder="Paste the exact response snippet or citation link from the AI engine..."></textarea>
                    </div>

                    <div style="display: flex; gap: 20px; margin-bottom: 14px;">
                        <label style="display: flex; align-items: center; gap: 8px; color: #cbd5e1; font-size: 0.85rem; cursor: pointer;">
                            <input type="checkbox" name="brand_mentioned" value="1" checked>
                            <span>Surebound Brand Mentioned</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; color: #cbd5e1; font-size: 0.85rem; cursor: pointer;">
                            <input type="checkbox" name="citation_found" value="1" checked>
                            <span>Direct Link / Citation Included</span>
                        </label>
                    </div>

                    <div style="margin-bottom: 14px;">
                        <label class="seo-form-label">Verification Status</label>
                        <select name="verification_status" class="seo-form-select">
                            <option value="verified">Verified (Direct screenshot or link evidence)</option>
                            <option value="unverified">Unverified (Pending confirmation)</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="seo-modal-footer">
                    <button type="button" class="seo-btn seo-btn-secondary" onclick="closeLogCitationModal()">Cancel</button>
                    <button type="submit" class="seo-btn seo-btn-primary">Save AI Citation Record</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Interactive Modals JavaScript --}}
    <script>
        function openEditPageModal(page) {
            const form = document.getElementById('editPageSeoForm');
            form.action = '{{ url('admin/seo/pages') }}/' + page.id;

            document.getElementById('editModalPageTitle').textContent = page.title || page.url_path;
            document.getElementById('editModalPagePath').textContent = page.url_path;

            document.getElementById('inputSeoTitle').value = page.seo_title || '';
            document.getElementById('inputMetaDesc').value = page.meta_description || '';
            document.getElementById('inputFocusKeyword').value = page.focus_keyword || '';
            document.getElementById('selectSearchIntent').value = page.search_intent || 'commercial';
            document.getElementById('inputCanonicalUrl').value = page.canonical_url || '';
            document.getElementById('selectMetaRobots').value = page.meta_robots || 'index, follow';
            document.getElementById('selectTargetCountry').value = page.target_country || 'US';
            document.getElementById('inputTargetLanguage').value = page.target_language || 'en';
            document.getElementById('selectSchemaType').value = page.schema_type || 'WebPage';
            document.getElementById('inputSecondaryKeywords').value = Array.isArray(page.secondary_keywords) ? page.secondary_keywords.join(', ') : (page.secondary_keywords || '');
            document.getElementById('inputOgImage').value = page.og_image || '';
            document.getElementById('checkIsPublished').checked = !!page.is_published;

            syncSerpPreview(page.url_path);

            document.getElementById('editPageSeoModal').style.display = 'flex';
        }

        function closeEditPageModal() {
            document.getElementById('editPageSeoModal').style.display = 'none';
        }

        function syncSerpPreview(path) {
            const title = document.getElementById('inputSeoTitle').value || 'Surebound Insurance | Commercial & Specialty Underwriting';
            const desc = document.getElementById('inputMetaDesc').value || 'Licensed commercial insurance broker and specialty underwriting firm.';
            const baseUrl = '{{ url('/') }}';
            const activePath = path || document.getElementById('editModalPagePath').textContent;

            document.getElementById('serpPreviewTitle').textContent = title;
            document.getElementById('serpPreviewDesc').textContent = desc;
            document.getElementById('serpPreviewUrl').textContent = baseUrl + (activePath === '/' ? '' : activePath);
            document.getElementById('serpCharCounts').textContent = title.length + ' title chars | ' + desc.length + ' desc chars';
        }

        function openAddRedirectModal() {
            document.getElementById('addRedirectModal').style.display = 'flex';
        }

        function closeAddRedirectModal() {
            document.getElementById('addRedirectModal').style.display = 'none';
        }

        function openAddKeywordModal() {
            document.getElementById('addKeywordModal').style.display = 'flex';
        }

        function closeAddKeywordModal() {
            document.getElementById('addKeywordModal').style.display = 'none';
        }

        function openLogCitationModal() {
            document.getElementById('logCitationModal').style.display = 'flex';
        }

        function closeLogCitationModal() {
            document.getElementById('logCitationModal').style.display = 'none';
        }
    </script>
@endsection
