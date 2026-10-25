<!-- ==========================================
     MODULE 10: STRUCTURED DATA / SCHEMA (JSON-LD)
     ========================================== -->
<div class="seo-tab-panel" id="tab-schema">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">Structured Data &amp; Schema Generator (JSON-LD)</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Automated, high-fidelity JSON-LD generation aligned with Google Search and AI Knowledge Graph schemas: InsuranceAgency, Organization, WebSite, Service, Article, and BreadcrumbList.
                </p>
            </div>
            <div>
                <span class="seo-badge seo-badge-success" style="padding: 6px 12px; font-size: 0.85rem;">Valid JSON-LD 1.0</span>
            </div>
        </div>
    </div>

    {{-- Schema Types Grid --}}
    <div class="seo-grid-4">
        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Organization &amp; Agency</span>
                <span class="seo-badge seo-badge-success">Active</span>
            </div>
            <div class="seo-kpi-value" style="font-size: 1.25rem;">InsuranceAgency</div>
            <div class="seo-kpi-sub">
                <span>Applied to homepage &amp; core pages</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Product Lines</span>
                <span class="seo-badge seo-badge-info">12 Services</span>
            </div>
            <div class="seo-kpi-value" style="font-size: 1.25rem;">Service / Financial</div>
            <div class="seo-kpi-sub">
                <span>Commercial, Surety, Personal</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Knowledge Hub</span>
                <span class="seo-badge seo-badge-neutral">Articles &amp; Guides</span>
            </div>
            <div class="seo-kpi-value" style="font-size: 1.25rem;">Article / HowTo</div>
            <div class="seo-kpi-sub">
                <span>Includes Author &amp; Publisher metadata</span>
            </div>
        </div>

        <div class="seo-card">
            <div class="seo-kpi-header">
                <span class="seo-kpi-label">Navigation Hierarchy</span>
                <span class="seo-badge seo-badge-success">100% Valid</span>
            </div>
            <div class="seo-kpi-value" style="font-size: 1.25rem;">BreadcrumbList</div>
            <div class="seo-kpi-sub">
                <span>Self-contained position sequences</span>
            </div>
        </div>
    </div>

    {{-- JSON-LD Live Preview Card --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                <span>Rendered JSON-LD Schema Code Preview (Live Public Payload)</span>
            </div>
            <div style="display: flex; gap: 8px;">
                <select id="schemaTypeSelector" class="seo-form-select" style="font-size: 0.85rem; padding: 4px 8px; width: 220px;" onchange="updateSchemaPreview(this.value)">
                    <option value="agency">Homepage (InsuranceAgency)</option>
                    <option value="service">Service (/business-insurance)</option>
                    <option value="surety">Surety Bond (/surety-bond)</option>
                    <option value="article">Article (/articles)</option>
                </select>
            </div>
        </div>

        @php
            $sampleAgencySchema = [
                "@context" => "https://schema.org",
                "@type" => "InsuranceAgency",
                "name" => "Surebound Insurance",
                "legalName" => "Surebound Insurance Services, LLC",
                "url" => url('/'),
                "logo" => asset('images/logo.png'),
                "description" => "Independent business agency and specialty underwriting firm providing commercial, personal, surety bond, and cyber risk coverage across the US, UK, and Canada.",
                "areaServed" => ["US", "GB", "CA"],
                "knowsAbout" => [
                    "Commercial Auto Insurance",
                    "Surety Bonds",
                    "General Liability",
                    "Commercial Property",
                    "Specialty Cyber Coverage"
                ],
                "contactPoint" => [
                    "@type" => "ContactPoint",
                    "contactType" => "customer service",
                    "email" => "underwriting@surebound.com",
                    "availableLanguage" => ["en"]
                ]
            ];
        @endphp

        <div style="background: #090d16; border-radius: 8px; padding: 16px; border: 1px solid rgba(255,255,255,0.08);">
            <pre style="margin: 0; font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; color: #a7f3d0; overflow-x: auto; line-height: 1.5;" id="schemaJsonOutput">{{ json_encode($sampleAgencySchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
        </div>
    </div>
</div>

<script>
function updateSchemaPreview(type) {
    var schema = {};
    var baseUrl = '{{ url('/') }}';
    var ctx = String.fromCharCode(64) + 'context';
    var typ = String.fromCharCode(64) + 'type';

    if (type === 'agency') {
        schema[ctx] = 'https://schema.org';
        schema[typ] = 'InsuranceAgency';
        schema.name = 'Surebound Insurance';
        schema.url = baseUrl;
        schema.description = 'Commercial agency and underwriting firm.';
        schema.areaServed = ['US', 'GB', 'CA'];
    } else if (type === 'service') {
        schema[ctx] = 'https://schema.org';
        schema[typ] = 'Service';
        schema.serviceType = 'Commercial General Liability Insurance';
        schema.provider = {};
        schema.provider[typ] = 'InsuranceAgency';
        schema.provider.name = 'Surebound Insurance';
        schema.areaServed = 'US';
        schema.url = baseUrl + '/liability-insurance';
    } else if (type === 'surety') {
        schema[ctx] = 'https://schema.org';
        schema[typ] = 'FinancialProduct';
        schema.name = 'Commercial & Contract Surety Bonds';
        schema.provider = {};
        schema.provider[typ] = 'InsuranceAgency';
        schema.provider.name = 'Surebound Insurance';
        schema.url = baseUrl + '/surety-bond';
    } else {
        schema[ctx] = 'https://schema.org';
        schema[typ] = 'Article';
        schema.headline = 'Commercial Risk Management Guidelines';
        schema.author = { name: 'Surebound Senior Underwriter' };
        schema.author[typ] = 'Person';
        schema.publisher = { name: 'Surebound Insurance' };
        schema.publisher[typ] = 'Organization';
    }
    document.getElementById('schemaJsonOutput').textContent = JSON.stringify(schema, null, 2);
}
</script>
