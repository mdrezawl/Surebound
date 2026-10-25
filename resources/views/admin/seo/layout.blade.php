<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surebound – Advanced SEO &amp; AI Search Management System</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">

    <!-- Google Fonts: Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/seo-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/surebound-modal.css') }}">

    <!-- Early Tab Resolver -->
    <script>
        (function() {
            try {
                var urlParams = new URLSearchParams(window.location.search);
                var activeTab = urlParams.get('tab') || window.location.hash.replace('#tab-', '').replace('#', '') || 'overview';
                window.__ACTIVE_SEO_TAB = activeTab;
            } catch(e) {}
        })();
    </script>
</head>
<body>
    <div class="seo-admin-container">
        <!-- ==========================================
             SIDEBAR NAVIGATION (26 MODULES)
             ========================================== -->
        <aside class="seo-sidebar" id="seoSidebar">
            <div class="seo-brand-header">
                <div class="seo-brand-left">
                    <div class="seo-brand-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="22" height="22">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <div class="seo-brand-name">Surebound</div>
                        <div class="seo-brand-sub">SEO &amp; AI Search Hub</div>
                    </div>
                </div>
            </div>

            <nav class="seo-sidebar-nav">
                <!-- Group 1: Core Intelligence -->
                <div class="seo-nav-category">
                    <span>Core Intelligence</span>
                    <span class="seo-nav-badge info">Core</span>
                </div>

                <a class="seo-nav-item {{ $activeTab === 'overview' ? 'active' : '' }}" data-tab="overview" onclick="switchSeoTab('overview')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        <span>1. Overview Dashboard</span>
                    </span>
                    <span class="seo-nav-badge success">{{ $latestAudit?->health_score ?? 100 }}%</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'audit-center' ? 'active' : '' }}" data-tab="audit-center" onclick="switchSeoTab('audit-center')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <span>2. SEO Audit Center</span>
                    </span>
                    @if($criticalIssuesCount > 0)
                        <span class="seo-nav-badge danger">{{ $criticalIssuesCount }} Critical</span>
                    @else
                        <span class="seo-nav-badge success">Passed</span>
                    @endif
                </a>

                <a class="seo-nav-item {{ $activeTab === 'technical' ? 'active' : '' }}" data-tab="technical" onclick="switchSeoTab('technical')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        <span>8. Technical SEO</span>
                    </span>
                    <span class="seo-nav-badge">{{ $findings->count() }}</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'robots-sitemap' ? 'active' : '' }}" data-tab="robots-sitemap" onclick="switchSeoTab('robots-sitemap')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <span>9. Sitemap &amp; Robots Manager</span>
                    </span>
                    <span class="seo-nav-badge success">29 URLs</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'schema' ? 'active' : '' }}" data-tab="schema" onclick="switchSeoTab('schema')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                        <span>10. Structured Data / Schema</span>
                    </span>
                    <span class="seo-nav-badge info">JSON-LD</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'internal-links' ? 'active' : '' }}" data-tab="internal-links" onclick="switchSeoTab('internal-links')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        <span>20. Internal Link Manager</span>
                    </span>
                    <span class="seo-nav-badge">{{ $internalLinks->count() }}</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'redirects' ? 'active' : '' }}" data-tab="redirects" onclick="switchSeoTab('redirects')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        <span>21. Redirect &amp; Broken Links</span>
                    </span>
                    <span class="seo-nav-badge">{{ $redirectsCount }} Active</span>
                </a>

                <!-- Group 2: Search & AI Optimization -->
                <div class="seo-nav-category">
                    <span>Search &amp; AI Visibility</span>
                    <span class="seo-nav-badge info">GEO/AEO</span>
                </div>

                <a class="seo-nav-item {{ $activeTab === 'pages' ? 'active' : '' }}" data-tab="pages" onclick="switchSeoTab('pages')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>3. Pages &amp; On-Page SEO</span>
                    </span>
                    <span class="seo-nav-badge success">{{ $totalPagesCount }}</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'keywords' ? 'active' : '' }}" data-tab="keywords" onclick="switchSeoTab('keywords')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        <span>4. Keyword Research &amp; Mapping</span>
                    </span>
                    <span class="seo-nav-badge">{{ $keywords->count() }}</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'content-studio' ? 'active' : '' }}" data-tab="content-studio" onclick="switchSeoTab('content-studio')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <span>5. Content Studio</span>
                    </span>
                    <span class="seo-nav-badge">{{ $contentReviews->count() }}</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'services' ? 'active' : '' }}" data-tab="services" onclick="switchSeoTab('services')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>6. Services &amp; Landing Pages</span>
                    </span>
                    <span class="seo-nav-badge info">12 Lines</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'case-studies' ? 'active' : '' }}" data-tab="case-studies" onclick="switchSeoTab('case-studies')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>7. Portfolio &amp; Case Studies</span>
                    </span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'ai-visibility' ? 'active' : '' }}" data-tab="ai-visibility" onclick="switchSeoTab('ai-visibility')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        <span>14. AI Search Visibility</span>
                    </span>
                    <span class="seo-nav-badge success">{{ $aiReadiness['score'] }}% Score</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'ai-crawlers' ? 'active' : '' }}" data-tab="ai-crawlers" onclick="switchSeoTab('ai-crawlers')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                        <span>15. AI Crawler Management</span>
                    </span>
                    <span class="seo-nav-badge success">OAI Ready</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'international' ? 'active' : '' }}" data-tab="international" onclick="switchSeoTab('international')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>16. International SEO</span>
                    </span>
                    <span class="seo-nav-badge info">US/UK/CA</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'local-seo' ? 'active' : '' }}" data-tab="local-seo" onclick="switchSeoTab('local-seo')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>17. Local SEO &amp; Trust</span>
                    </span>
                </a>

                <!-- Group 3: Analytics & External Signals -->
                <div class="seo-nav-category">
                    <span>Analytics &amp; Performance</span>
                    <span class="seo-nav-badge info">Data</span>
                </div>

                <a class="seo-nav-item {{ $activeTab === 'search-console' ? 'active' : '' }}" data-tab="search-console" onclick="switchSeoTab('search-console')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span>11. Google Search Console</span>
                    </span>
                    <span class="seo-nav-badge {{ $gscIntegration->is_connected ? 'success' : '' }}">
                        {{ $gscIntegration->is_connected ? 'Connected' : 'Offline' }}
                    </span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'analytics' ? 'active' : '' }}" data-tab="analytics" onclick="switchSeoTab('analytics')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        <span>12. Google Analytics 4</span>
                    </span>
                    <span class="seo-nav-badge {{ $ga4Integration->is_connected ? 'success' : '' }}">
                        {{ $ga4Integration->is_connected ? 'Connected' : 'Offline' }}
                    </span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'pagespeed' ? 'active' : '' }}" data-tab="pagespeed" onclick="switchSeoTab('pagespeed')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span>13. PageSpeed &amp; Core Web Vitals</span>
                    </span>
                    <span class="seo-nav-badge success">{{ $latestPerformance?->performance_score ?? 88 }} Score</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'leads' ? 'active' : '' }}" data-tab="leads" onclick="switchSeoTab('leads')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>22. Lead &amp; Conversion Tracking</span>
                    </span>
                    <span class="seo-nav-badge success">{{ $analyticsSummary['database_leads'] }} Leads</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'backlinks' ? 'active' : '' }}" data-tab="backlinks" onclick="switchSeoTab('backlinks')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        <span>18. Backlinks &amp; Mentions</span>
                    </span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'competitors' ? 'active' : '' }}" data-tab="competitors" onclick="switchSeoTab('competitors')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>19. Competitor Analysis</span>
                    </span>
                </a>

                <!-- Group 4: Governance & Operations -->
                <div class="seo-nav-category">
                    <span>Governance &amp; Setup</span>
                    <span class="seo-nav-badge info">Ops</span>
                </div>

                <a class="seo-nav-item {{ $activeTab === 'reports' ? 'active' : '' }}" data-tab="reports" onclick="switchSeoTab('reports')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span>23. Reports &amp; Notifications</span>
                    </span>
                    @if($unreadAlertsCount > 0)
                        <span class="seo-nav-badge danger">{{ $unreadAlertsCount }}</span>
                    @endif
                </a>

                <a class="seo-nav-item {{ $activeTab === 'integrations' ? 'active' : '' }}" data-tab="integrations" onclick="switchSeoTab('integrations')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/></svg>
                        <span>24. Integrations &amp; Credentials</span>
                    </span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'roles' ? 'active' : '' }}" data-tab="roles" onclick="switchSeoTab('roles')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>25. User Roles &amp; Permissions</span>
                    </span>
                    <span class="seo-nav-badge">{{ $users->count() }} Users</span>
                </a>

                <a class="seo-nav-item {{ $activeTab === 'settings' ? 'active' : '' }}" data-tab="settings" onclick="switchSeoTab('settings')">
                    <span class="seo-nav-item-left">
                        <svg class="seo-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>26. Settings &amp; Audit Logs</span>
                    </span>
                    <span class="seo-nav-badge info">{{ $automationSettings->mode }}</span>
                </a>
            </nav>
        </aside>

        <!-- ==========================================
             MAIN VIEWPORT
             ========================================== -->
        <main class="seo-main-content">
            <!-- Top Header Bar -->
            <header class="seo-topbar">
                <div class="seo-topbar-left">
                    <button type="button" class="seo-btn seo-btn-secondary" id="seoSidebarToggle" style="display: none;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="seo-topbar-title">
                        <span id="activeTabTitle">SEO Overview Dashboard</span>
                    </div>
                </div>

                <div class="seo-topbar-right">
                    <!-- Quick Jump back to Agency Portal -->
                    <a href="{{ route('admin.dashboard') }}" class="seo-btn seo-btn-secondary" title="Return to Agency Underwriting Portal">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Agency Portal</span>
                    </a>

                    <!-- Run Audit Trigger Form -->
                    <form action="{{ route('admin.seo.audit.run') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="seo-btn seo-btn-primary" id="btnRunAudit">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            <span>Run Technical Audit</span>
                        </button>
                    </form>

                    <!-- Authenticated User Avatar -->
                    <div style="display: flex; align-items: center; gap: 8px; padding-left: 8px; border-left: 1px solid rgba(255,255,255,0.1);">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: #2563eb; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; color: white;">
                            {{ substr(auth()->user()->name ?? 'Admin', 0, 1) }}
                        </div>
                        <span style="font-size: 0.85rem; font-weight: 600; color: #f1f5f9;">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </header>

            <!-- Main Body Container -->
            <div class="seo-body">
                {{-- Flash Notifications --}}
                @if(session('success'))
                    <div class="seo-flash-alert seo-flash-success">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; color: inherit; cursor: pointer;">&times;</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="seo-flash-alert seo-flash-error">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; color: inherit; cursor: pointer;">&times;</button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Tab Switching Script -->
    <script>
        const tabTitles = {
            'overview': '1. Overview Dashboard',
            'audit-center': '2. Technical SEO Audit Center',
            'pages': '3. Pages & On-Page SEO Management',
            'keywords': '4. Keyword Research & Mapping',
            'content-studio': '5. Content Studio & Editorial Workflow',
            'services': '6. Services & Landing Pages',
            'case-studies': '7. Portfolio & Case Studies',
            'technical': '8. Technical SEO Diagnostics',
            'robots-sitemap': '9. Sitemap & Robots Manager',
            'schema': '10. Structured Data / Schema (JSON-LD)',
            'search-console': '11. Google Search Console Integration',
            'analytics': '12. Google Analytics 4 Integration',
            'pagespeed': '13. PageSpeed & Core Web Vitals',
            'ai-visibility': '14. AI Search Visibility (GEO/AEO)',
            'ai-crawlers': '15. AI Crawler Management',
            'international': '16. International SEO (US, UK, CA)',
            'local-seo': '17. Local SEO & Business Trust',
            'backlinks': '18. Backlinks & Brand Mentions',
            'competitors': '19. Competitor Analysis & Content Gaps',
            'internal-links': '20. Internal Link Manager',
            'redirects': '21. Redirect & Broken Link Manager',
            'leads': '22. Lead & Conversion Analytics',
            'reports': '23. Reports & Notification Center',
            'integrations': '24. Integrations & API Credentials',
            'roles': '25. User Roles & Permissions',
            'settings': '26. System Settings & Audit Logs'
        };

        function switchSeoTab(tabKey) {
            // Update active link in sidebar
            document.querySelectorAll('.seo-nav-item').forEach(el => {
                if (el.getAttribute('data-tab') === tabKey) {
                    el.classList.add('active');
                } else {
                    el.classList.remove('active');
                }
            });

            // Update active panel in DOM
            document.querySelectorAll('.seo-tab-panel').forEach(panel => {
                if (panel.id === 'tab-' + tabKey) {
                    panel.classList.add('active');
                } else {
                    panel.classList.remove('active');
                }
            });

            // Update topbar title
            const titleEl = document.getElementById('activeTabTitle');
            if (titleEl && tabTitles[tabKey]) {
                titleEl.textContent = tabTitles[tabKey];
            }

            // Sync URL hash
            if (window.history.pushState) {
                const newUrl = window.location.pathname + '?tab=' + tabKey;
                window.history.pushState({ path: newUrl }, '', newUrl);
            }
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            var activeTab = window.__ACTIVE_SEO_TAB || 'overview';
            switchSeoTab(activeTab);

            // Responsive sidebar toggle
            const sidebarToggle = document.getElementById('seoSidebarToggle');
            const sidebar = document.getElementById('seoSidebar');
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                });
            }
        });
    </script>
</body>
</html>
