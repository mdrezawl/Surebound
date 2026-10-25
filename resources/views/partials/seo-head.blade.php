@php
    $seoService = app(\App\Services\SeoService::class);
    $seoMeta = $seoService->getMetadataForRequest();
    $currentUrl = url()->current();

    // Title & Description resolution
    $seoTitle = $seoMeta?->seo_title ?: null;
    $seoDescription = $seoMeta?->meta_description ?: 'Surebound Insurance – Reliable protection for your home, auto, business and future with dependable support whenever you need us.';
    $canonicalUrl = $seoMeta?->canonical_url ?: $currentUrl;
    $metaRobots = $seoMeta?->meta_robots ?: 'index, follow';

    // JSON-LD Schema
    $schemaJson = $seoService->generateSchemaJson($seoMeta, $currentUrl);

    // Hreflang
    $hreflangLinks = $seoService->getHreflangLinks();
@endphp

{{-- Primary Meta Directives --}}
<meta name="description" content="{{ $seoDescription }}">
<meta name="robots" content="{{ $metaRobots }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- Hreflang International Alternates --}}
@foreach($hreflangLinks as $locale => $alternateUrl)
<link rel="alternate" hreflang="{{ $locale }}" href="{{ $alternateUrl }}">
@endforeach

{{-- Open Graph & Twitter Fallback (rendered when marketingConfig is empty) --}}
@if(empty($marketingConfig))
    @php
        $ogTitle = $seoMeta?->og_title ?: ($seoTitle ?: 'Surebound Insurance – Premier Home, Auto & Business Coverage');
        $ogDesc = $seoMeta?->og_description ?: $seoDescription;
        $ogImage = $seoMeta?->og_image ?: 'images/logo.png';
        $ogImageUrl = str_starts_with($ogImage, 'http') ? $ogImage : asset($ogImage);
        $ogType = $seoMeta?->og_type ?: 'website';
        $twitterCard = $seoMeta?->twitter_card ?: 'summary_large_image';
    @endphp
    <meta property="og:site_name" content="Surebound Insurance">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDesc }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:image" content="{{ $ogImageUrl }}">
    <meta property="og:locale" content="en_US">

    <meta name="twitter:card" content="{{ $twitterCard }}">
    <meta name="twitter:site" content="@SureboundIns">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDesc }}">
    <meta name="twitter:image" content="{{ $ogImageUrl }}">
@endif

{{-- Structured Data JSON-LD --}}
<script type="application/ld+json">
{!! json_encode($schemaJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
