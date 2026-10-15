@if(!empty($marketingConfig))
    {{-- 1. Google Tag Manager (noscript) --}}
    @if(!empty($marketingConfig['google']['enabled']) && !empty($marketingConfig['google']['gtm_enabled']) && !empty($marketingConfig['google']['gtm_id']))
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $marketingConfig['google']['gtm_id'] }}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

    {{-- 2. Meta (Facebook) Pixel (noscript) --}}
    @if(!empty($marketingConfig['meta']['enabled']) && !empty($marketingConfig['meta']['pixel_enabled']) && !empty($marketingConfig['meta']['pixel_id']))
        <!-- Meta Pixel (noscript) -->
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id={{ $marketingConfig['meta']['pixel_id'] }}&ev=PageView&noscript=1"
        /></noscript>
    @endif

    {{-- 3. LinkedIn Insight Tag (noscript) --}}
    @if(!empty($marketingConfig['linkedin']['enabled']) && !empty($marketingConfig['linkedin']['partner_id']))
        <!-- LinkedIn Insight Tag (noscript) -->
        <noscript>
            <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid={{ $marketingConfig['linkedin']['partner_id'] }}&fmt=gif" />
        </noscript>
    @endif

    {{-- 4. Custom Marketing Body Scripts --}}
    @if(!empty($marketingConfig['custom_scripts']['enabled']) && !empty($marketingConfig['custom_scripts']['body_scripts']))
        {!! $marketingConfig['custom_scripts']['body_scripts'] !!}
    @endif
@endif
