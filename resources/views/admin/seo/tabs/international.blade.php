<!-- ==========================================
     MODULE 16: INTERNATIONAL SEO (US, UK, CA)
     ========================================== -->
<div class="seo-tab-panel" id="tab-international">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">International SEO &amp; Hreflang Architecture</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Targeting commercial clients across the United States, United Kingdom, and Canada using validated hreflang signals, self-referencing canonicals, and x-default fallback.
                </p>
            </div>
            <div>
                <span class="seo-badge seo-badge-success" style="padding: 6px 12px; font-size: 0.85rem;">Reciprocal Hreflang Validated</span>
            </div>
        </div>
    </div>

    {{-- Market Cards --}}
    <div class="seo-grid-3">
        <div class="seo-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.5rem;">🇺🇸</span>
                    <span style="font-weight: 700; color: #f8fafc; font-size: 1.1rem;">United States</span>
                </div>
                <span class="seo-badge seo-badge-info">en-US</span>
            </div>
            <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.5; margin-bottom: 14px;">
                Primary commercial market. Federal and state-compliant surety bonds, fleet commercial auto, and general liability coverage.
            </p>
            <div style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 10px; font-size: 0.8rem; color: #cbd5e1;">
                Canonical Target: <code style="color: #38bdf8;">https://surebound.com</code>
            </div>
        </div>

        <div class="seo-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.5rem;">🇬🇧</span>
                    <span style="font-weight: 700; color: #f8fafc; font-size: 1.1rem;">United Kingdom</span>
                </div>
                <span class="seo-badge seo-badge-info">en-GB</span>
            </div>
            <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.5; margin-bottom: 14px;">
                UK corporate coverage. Cross-border specialty liability, Lloyd's syndicate reinsurance alignment, and cyber risk policies.
            </p>
            <div style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 10px; font-size: 0.8rem; color: #cbd5e1;">
                Hreflang: <code style="color: #38bdf8;">en-GB</code> alternate mapping
            </div>
        </div>

        <div class="seo-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.5rem;">🇨🇦</span>
                    <span style="font-weight: 700; color: #f8fafc; font-size: 1.1rem;">Canada</span>
                </div>
                <span class="seo-badge seo-badge-info">en-CA</span>
            </div>
            <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.5; margin-bottom: 14px;">
                Provincial and inter-provincial commercial transportation, contract bonds, and property underwriting solutions.
            </p>
            <div style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 10px; font-size: 0.8rem; color: #cbd5e1;">
                Hreflang: <code style="color: #38bdf8;">en-CA</code> alternate mapping
            </div>
        </div>
    </div>

    {{-- Rendered Hreflang Tag Output Preview --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Automated Hreflang Tags Injected in &lt;head&gt;</span>
            </div>
            <span class="seo-badge seo-badge-success">Reciprocal Verified</span>
        </div>

        <div style="background: #090d16; border-radius: 8px; padding: 16px; border: 1px solid rgba(255,255,255,0.08);">
            <pre style="margin: 0; font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; color: #38bdf8; overflow-x: auto; line-height: 1.6;">
&lt;link rel="alternate" hreflang="en-US" href="{{ url('/') }}" /&gt;
&lt;link rel="alternate" hreflang="en-GB" href="{{ url('/') }}" /&gt;
&lt;link rel="alternate" hreflang="en-CA" href="{{ url('/') }}" /&gt;
&lt;link rel="alternate" hreflang="x-default" href="{{ url('/') }}" /&gt;</pre>
        </div>
    </div>
</div>
