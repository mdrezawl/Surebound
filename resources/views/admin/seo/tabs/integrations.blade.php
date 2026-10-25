<!-- ==========================================
     MODULE 24: INTEGRATIONS & API CREDENTIALS
     ========================================== -->
<div class="seo-tab-panel" id="tab-integrations">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">Integrations &amp; Secure API Credentials</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Manage authenticated API connections for Google Search Console, Google Analytics 4, PageSpeed Insights, and AI Search services. All keys are encrypted at rest.
                </p>
            </div>
            <div>
                <span class="seo-badge seo-badge-success" style="padding: 6px 12px; font-size: 0.85rem;">AES-256 Encrypted</span>
            </div>
        </div>
    </div>

    {{-- Integrations Grid --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
        {{-- Google Search Console --}}
        <div class="seo-card">
            <div class="seo-card-header">
                <div class="seo-card-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Google Search Console API</span>
                </div>
                <span class="seo-badge {{ $gscIntegration->is_connected ? 'seo-badge-success' : 'seo-badge-neutral' }}">
                    {{ $gscIntegration->is_connected ? 'Connected' : 'Offline' }}
                </span>
            </div>

            <form action="{{ route('admin.seo.integrations.save', 'gsc') }}" method="POST">
                @csrf
                <div style="margin-bottom: 12px;">
                    <label class="seo-form-label">Search Console Property Domain</label>
                    <input type="text" name="property_id" class="seo-form-input" value="{{ $gscIntegration->property_id ?? 'sc-domain:surebound.com' }}" placeholder="sc-domain:surebound.com" required>
                </div>
                <div style="margin-bottom: 12px;">
                    <label class="seo-form-label">Client ID / OAuth State</label>
                    <input type="text" name="credentials[client_id]" class="seo-form-input" value="{{ $gscIntegration->credentials['client_id'] ?? '' }}" placeholder="xxxxxx.apps.googleusercontent.com">
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: flex; align-items: center; gap: 8px; color: #cbd5e1; font-size: 0.85rem; cursor: pointer;">
                        <input type="checkbox" name="is_connected" value="1" {{ $gscIntegration->is_connected ? 'checked' : '' }}>
                        <span>Enable Google Search Console Sync</span>
                    </label>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <button type="button" class="seo-btn seo-btn-secondary" onclick="testIntegrationConnection('gsc')">
                        Test Connection
                    </button>
                    <button type="submit" class="seo-btn seo-btn-primary">
                        Save Credentials
                    </button>
                </div>
            </form>
        </div>

        {{-- Google Analytics 4 --}}
        <div class="seo-card">
            <div class="seo-card-header">
                <div class="seo-card-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span>Google Analytics 4 Data API</span>
                </div>
                <span class="seo-badge {{ $ga4Integration->is_connected ? 'seo-badge-success' : 'seo-badge-neutral' }}">
                    {{ $ga4Integration->is_connected ? 'Connected' : 'Offline' }}
                </span>
            </div>

            <form action="{{ route('admin.seo.integrations.save', 'ga4') }}" method="POST">
                @csrf
                <div style="margin-bottom: 12px;">
                    <label class="seo-form-label">GA4 Numeric Property ID</label>
                    <input type="text" name="property_id" class="seo-form-input" value="{{ $ga4Integration->property_id ?? 'properties/412345678' }}" placeholder="properties/123456789" required>
                </div>
                <div style="margin-bottom: 12px;">
                    <label class="seo-form-label">Measurement ID</label>
                    <input type="text" name="credentials[measurement_id]" class="seo-form-input" value="{{ $ga4Integration->credentials['measurement_id'] ?? 'G-SUREBOUND01' }}" placeholder="G-XXXXXXXXXX">
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: flex; align-items: center; gap: 8px; color: #cbd5e1; font-size: 0.85rem; cursor: pointer;">
                        <input type="checkbox" name="is_connected" value="1" {{ $ga4Integration->is_connected ? 'checked' : '' }}>
                        <span>Enable GA4 Conversion Attribution Sync</span>
                    </label>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <button type="button" class="seo-btn seo-btn-secondary" onclick="testIntegrationConnection('ga4')">
                        Test Connection
                    </button>
                    <button type="submit" class="seo-btn seo-btn-primary">
                        Save Credentials
                    </button>
                </div>
            </form>
        </div>

        {{-- Google PageSpeed Insights --}}
        <div class="seo-card">
            <div class="seo-card-header">
                <div class="seo-card-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    <span>Google PageSpeed Insights API</span>
                </div>
                <span class="seo-badge seo-badge-success">Ready</span>
            </div>

            <form action="{{ route('admin.seo.integrations.save', 'pagespeed') }}" method="POST">
                @csrf
                <div style="margin-bottom: 12px;">
                    <label class="seo-form-label">Google Cloud API Key (Optional for High Quota)</label>
                    <input type="password" name="credentials[api_key]" class="seo-form-input" value="{{ $pageSpeedIntegration->credentials['api_key'] ?? '' }}" placeholder="AIzaSy...">
                </div>
                <div style="font-size: 0.8rem; color: #94a3b8; margin-bottom: 14px;">
                    * PageSpeed tests operate via public Google API with rate limiting. An optional API key unlocks higher concurrent audits.
                </div>
                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="seo-btn seo-btn-primary">
                        Save Key
                    </button>
                </div>
            </form>
        </div>

        {{-- AI Search & Generative API Keys --}}
        <div class="seo-card">
            <div class="seo-card-header">
                <div class="seo-card-title">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    <span>AI Content &amp; Briefs Assistant (Optional)</span>
                </div>
                <span class="seo-badge seo-badge-neutral">Configurable</span>
            </div>

            <form action="{{ route('admin.seo.integrations.save', 'ai') }}" method="POST">
                @csrf
                <div style="margin-bottom: 12px;">
                    <label class="seo-form-label">OpenAI / Anthropic / Gemini Key</label>
                    <input type="password" name="credentials[api_key]" class="seo-form-input" placeholder="sk-..." value="{{ $integrations['ai']->credentials['api_key'] ?? '' }}">
                </div>
                <div style="font-size: 0.8rem; color: #94a3b8; margin-bottom: 14px;">
                    * All deterministic technical SEO audits, crawler checks, sitemaps, and schema work with zero external AI cost.
                </div>
                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="seo-btn seo-btn-primary">
                        Save AI Key
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function testIntegrationConnection(serviceKey) {
    fetch('{{ url('admin/seo/integrations') }}/' + serviceKey + '/test', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({})
    })
    .then(r => r.json())
    .then(data => {
        alert(serviceKey.toUpperCase() + ' Status: ' + (data.status || 'Verified') + '\n' + (data.message || 'Connection test response received.'));
    })
    .catch(e => {
        alert('Test failed: ' + e.message);
    });
}
</script>
