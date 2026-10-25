@if(!empty($marketingConfig))
    {{-- Search Engine & Domain Verification Tags --}}
    @if(!empty($marketingConfig['google']['enabled']) && !empty($marketingConfig['google']['site_verification']))
        <meta name="google-site-verification" content="{{ $marketingConfig['google']['site_verification'] }}">
    @endif
    @if(!empty($marketingConfig['meta']['enabled']) && !empty($marketingConfig['meta']['domain_verification']))
        <meta name="facebook-domain-verification" content="{{ $marketingConfig['meta']['domain_verification'] }}">
    @endif

    {{-- Social Open Graph (Facebook, LinkedIn, Meta) & Twitter Cards Meta Tags --}}
    @php
        $ogTitle = $marketingConfig['social_meta']['default_title'] ?? 'Surebound Insurance – Premier Home, Auto & Business Coverage';
        $ogDesc = $marketingConfig['social_meta']['default_description'] ?? 'Dependable insurance protection built around you. Get fast quotes and dedicated underwriter support.';
        $ogImage = $marketingConfig['social_meta']['default_image'] ?? 'images/logo.png';
        $ogImageUrl = str_starts_with($ogImage, 'http') ? $ogImage : asset($ogImage);
        $ogType = $marketingConfig['social_meta']['og_type'] ?? 'website';
        $twitterCard = $marketingConfig['social_meta']['twitter_card_type'] ?? 'summary_large_image';
        $twitterHandle = $marketingConfig['twitter']['site_handle'] ?? '@SureboundIns';
    @endphp

    <meta property="og:site_name" content="Surebound Insurance">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDesc }}">
    <meta property="og:image" content="{{ $ogImageUrl }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <meta name="twitter:card" content="{{ $twitterCard }}">
    @if(!empty($twitterHandle))
        <meta name="twitter:site" content="{{ $twitterHandle }}">
        <meta name="twitter:creator" content="{{ $twitterHandle }}">
    @endif
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDesc }}">
    <meta name="twitter:image" content="{{ $ogImageUrl }}">

    {{-- 1. Google Tag Manager (GTM) --}}
    @if(!empty($marketingConfig['google']['enabled']) && !empty($marketingConfig['google']['gtm_enabled']) && !empty($marketingConfig['google']['gtm_id']))
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{ $marketingConfig['google']['gtm_id'] }}');</script>
        <!-- End Google Tag Manager -->
    @endif

    {{-- 2. Google Analytics 4 (GA4) & Google Ads --}}
    @if(!empty($marketingConfig['google']['enabled']) && !empty($marketingConfig['google']['ga4_enabled']) && !empty($marketingConfig['google']['ga4_id']))
        <!-- Google tag (gtag.js) GA4 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $marketingConfig['google']['ga4_id'] }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $marketingConfig['google']['ga4_id'] }}', {
                'send_page_view': true,
                'cookie_flags': 'SameSite=None;Secure'
            });
            @if(!empty($marketingConfig['google']['google_ads_enabled']) && !empty($marketingConfig['google']['google_ads_id']))
                gtag('config', '{{ $marketingConfig['google']['google_ads_id'] }}');
            @endif
        </script>
    @endif

    {{-- 3. Meta (Facebook) Pixel --}}
    @if(!empty($marketingConfig['meta']['enabled']) && !empty($marketingConfig['meta']['pixel_enabled']) && !empty($marketingConfig['meta']['pixel_id']))
        <!-- Meta Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $marketingConfig['meta']['pixel_id'] }}');
            fbq('track', 'PageView');
        </script>
        <!-- End Meta Pixel Code -->
    @endif

    {{-- 4. LinkedIn Insight Tag --}}
    @if(!empty($marketingConfig['linkedin']['enabled']) && !empty($marketingConfig['linkedin']['partner_id']))
        <!-- LinkedIn Insight Tag -->
        <script type="text/javascript">
            _linkedin_partner_id = "{{ $marketingConfig['linkedin']['partner_id'] }}";
            window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
            window._linkedin_data_partner_ids.push(_linkedin_partner_id);
            (function(l) {
            if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
            window.lintrk.q=[]}
            var s = document.getElementsByTagName("script")[0];
            var b = document.createElement("script");
            b.type = "text/javascript";b.async = true;
            b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
            s.parentNode.insertBefore(b, s);})(window.lintrk);
        </script>
        <!-- End LinkedIn Insight Tag -->
    @endif

    {{-- 5. Twitter / X Universal Website Tag --}}
    @if(!empty($marketingConfig['twitter']['enabled']) && !empty($marketingConfig['twitter']['pixel_id']))
        <!-- Twitter / X conversion tracking -->
        <script>
            !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
            },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
            a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
            twq('config','{{ $marketingConfig['twitter']['pixel_id'] }}');
            twq('track','PageView');
        </script>
        <!-- End Twitter / X conversion tracking -->
    @endif

    {{-- 6. TikTok Pixel --}}
    @if(!empty($marketingConfig['tiktok']['enabled']) && !empty($marketingConfig['tiktok']['pixel_id']))
        <!-- TikTok Pixel Code -->
        <script>
            !function (w, d, t) {
                w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(
                var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script")
                ;n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};
                ttq.load('{{ $marketingConfig['tiktok']['pixel_id'] }}');
                ttq.page();
            }(window, document, 'ttq');
        </script>
        <!-- End TikTok Pixel Code -->
    @endif

    {{-- 7. Custom Marketing Header Scripts --}}
    @if(!empty($marketingConfig['custom_scripts']['enabled']) && !empty($marketingConfig['custom_scripts']['header_scripts']))
        {!! $marketingConfig['custom_scripts']['header_scripts'] !!}
    @endif
@endif
