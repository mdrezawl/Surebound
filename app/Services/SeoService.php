<?php

namespace App\Services;

use App\Models\SeoHreflangMapping;
use App\Models\SeoMetadata;
use App\Models\SeoSchemaRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class SeoService
{
    /**
     * Default page configurations across all supported agency routes.
     */
    public static function getDefaultPages(): array
    {
        return [
            [
                'url_path' => '/',
                'route_name' => 'home',
                'seo_title' => 'Tampa, FL Insurance Agency | Surebound Insurance',
                'meta_description' => 'Surebound Insurance is based in Tampa, Florida. Get help with home, auto, business and life insurance. Contact our team to request a quote.',
                'focus_keyword' => 'Tampa FL Insurance Agency',
                'secondary_keywords' => ['surebound insurance', 'tampa insurance agent', 'florida insurance agency', 'home and auto insurance tampa'],
                'search_intent' => 'commercial',
                'schema_type' => 'Organization',
            ],
            [
                'url_path' => '/home-insurance',
                'route_name' => 'home-insurance',
                'seo_title' => 'Home Insurance in Tampa, FL | Surebound',
                'meta_description' => 'Explore home insurance options in Tampa, Florida. Talk with Surebound about your property, coverage needs and the details needed to request a quote.',
                'focus_keyword' => 'home insurance tampa fl',
                'secondary_keywords' => ['florida homeowners insurance', 'dwelling protection', 'tampa hurricane deductibles'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/auto-insurance',
                'route_name' => 'auto-insurance',
                'seo_title' => 'Auto Insurance in Tampa, FL | Surebound',
                'meta_description' => 'Get reliable auto insurance coverage in Tampa, Florida. Compare collision, comprehensive, and liability options with Surebound Insurance.',
                'focus_keyword' => 'auto insurance tampa fl',
                'secondary_keywords' => ['car insurance tampa', 'florida auto coverage', 'collision comprehensive tampa'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/commercial-auto-insurance',
                'route_name' => 'commercial-auto-insurance',
                'seo_title' => 'Commercial Auto Insurance in Tampa | Surebound',
                'meta_description' => 'Commercial auto and fleet insurance coverage for business vehicles in Tampa, Florida. Protect your drivers, trucks, and cargo with Surebound.',
                'focus_keyword' => 'commercial auto insurance tampa',
                'secondary_keywords' => ['fleet insurance florida', 'business vehicle coverage tampa', 'commercial truck insurance'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/surety-bond',
                'route_name' => 'surety-bond',
                'seo_title' => 'Surety Bonds in Florida | Surebound Insurance',
                'meta_description' => 'Contractor, license, and permit surety bonds in Florida. Request a fast bond quote with experienced underwriting assistance from Surebound.',
                'focus_keyword' => 'surety bonds florida',
                'secondary_keywords' => ['florida contractor bond', 'license and permit bond tampa', 'performance bonds'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/life-insurance',
                'route_name' => 'life-insurance',
                'seo_title' => 'Life Insurance in Tampa, FL | Surebound',
                'meta_description' => 'Talk with Surebound in Tampa about life insurance options, coverage amounts and your next steps. Request a quote from our team.',
                'focus_keyword' => 'life insurance tampa fl',
                'secondary_keywords' => ['term life insurance florida', 'whole life policy tampa', 'family life insurance'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/health-insurance',
                'route_name' => 'health-insurance',
                'seo_title' => 'Health Insurance in Tampa, FL | Surebound',
                'meta_description' => 'Individual and family health insurance coverage options in Tampa, Florida. Find medical and supplemental plans that fit your household needs.',
                'focus_keyword' => 'health insurance tampa',
                'secondary_keywords' => ['individual health insurance florida', 'family medical coverage tampa', 'health plans florida'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/umbrella-insurance',
                'route_name' => 'umbrella-insurance',
                'seo_title' => 'Umbrella Insurance in Tampa, FL | Surebound',
                'meta_description' => 'Add an extra layer of liability protection over your home and auto policies with personal umbrella insurance from Surebound in Tampa, FL.',
                'focus_keyword' => 'umbrella insurance tampa',
                'secondary_keywords' => ['excess liability florida', 'personal umbrella policy tampa', 'asset protection insurance'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/personal-coverage',
                'route_name' => 'personal-coverage',
                'seo_title' => 'Personal Insurance Coverage | Surebound Insurance',
                'meta_description' => 'Comprehensive personal line bundles combining home, auto, valuable articles, and umbrella liability with Surebound Insurance in Tampa, FL.',
                'focus_keyword' => 'personal insurance packages tampa',
                'secondary_keywords' => ['personal lines insurance florida', 'bundled home and auto tampa', 'florida family insurance'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/property-insurance',
                'route_name' => 'property-insurance',
                'seo_title' => 'Commercial Property Insurance in Tampa | Surebound',
                'meta_description' => 'Protect commercial real estate, machinery, technology, and inventory in Tampa, FL against fire, windstorm, theft, and business interruption losses.',
                'focus_keyword' => 'commercial property insurance tampa',
                'secondary_keywords' => ['business property coverage florida', 'commercial building insurance tampa', 'business interruption'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/liability-insurance',
                'route_name' => 'liability-insurance',
                'seo_title' => 'General Liability Insurance in Tampa | Surebound',
                'meta_description' => 'Essential commercial general liability coverage shielding small businesses and corporations in Tampa from bodily injury, property damage, and legal defense costs.',
                'focus_keyword' => 'general liability insurance tampa',
                'secondary_keywords' => ['commercial liability florida', 'tampa business liability quote', 'slip and fall insurance'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/workers-compensation',
                'route_name' => 'workers-compensation',
                'seo_title' => 'Workers Compensation Insurance in Florida | Surebound',
                'meta_description' => 'Meet Florida statutory requirements and protect your workforce with workers compensation insurance from Surebound Insurance in Tampa.',
                'focus_keyword' => 'workers compensation insurance florida',
                'secondary_keywords' => ['florida workers comp requirements', 'workers comp quote tampa', 'florida chapter 440 compliance'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/group-benefits',
                'route_name' => 'group-benefits',
                'seo_title' => 'Employee Benefits in Tampa, FL | Surebound',
                'meta_description' => 'Group employee health, dental, vision, life, and disability benefits for Florida businesses. Build attractive packages with Surebound Insurance.',
                'focus_keyword' => 'employee benefits tampa',
                'secondary_keywords' => ['group health insurance florida', 'small business group benefits tampa', 'dental vision group plans'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/specialty-coverage',
                'route_name' => 'specialty-coverage',
                'seo_title' => 'Specialty Insurance Solutions | Surebound Insurance',
                'meta_description' => 'Specialized insurance solutions for unique commercial and personal risks placed through admitted and surplus lines carrier partners.',
                'focus_keyword' => 'specialty insurance tampa',
                'secondary_keywords' => ['surplus lines florida', 'hard to place insurance', 'unique risk coverage'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/coverage',
                'route_name' => 'coverage',
                'seo_title' => 'Insurance Coverage Overview | Surebound Insurance',
                'meta_description' => 'Explore Surebound\'s complete portfolio of personal and commercial insurance solutions in Tampa, Florida.',
                'focus_keyword' => 'insurance coverage options tampa',
                'secondary_keywords' => ['florida insurance portfolio', 'business and personal insurance tampa'],
                'search_intent' => 'informational',
                'schema_type' => 'WebSite',
            ],
            [
                'url_path' => '/custom-quote',
                'route_name' => 'custom-quote',
                'seo_title' => 'Request an Insurance Quote | Surebound',
                'meta_description' => 'Request a personalized insurance quote from Surebound Insurance in Tampa, FL for home, auto, commercial liability, property, or life coverage.',
                'focus_keyword' => 'request insurance quote tampa',
                'secondary_keywords' => ['florida insurance quotes', 'independent agent quote tampa'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/compare',
                'route_name' => 'compare',
                'seo_title' => 'Compare Insurance Coverage & Limits | Surebound',
                'meta_description' => 'Compare insurance deductibles, coverage limits, and policy endorsements with guidance from Surebound Insurance in Tampa, FL.',
                'focus_keyword' => 'compare insurance policies florida',
                'secondary_keywords' => ['insurance deductible comparison', 'coverage limits compare tampa'],
                'search_intent' => 'commercial',
                'schema_type' => 'WebSite',
            ],
            [
                'url_path' => '/story',
                'route_name' => 'story',
                'seo_title' => 'About Surebound Insurance | Tampa, FL',
                'meta_description' => 'Learn about Surebound Insurance, an independent agency based in Tampa, Florida dedicated to honest guidance and reliable coverage.',
                'focus_keyword' => 'about surebound insurance tampa',
                'secondary_keywords' => ['tampa insurance agency story', 'independent agency florida'],
                'search_intent' => 'informational',
                'schema_type' => 'Organization',
            ],
            [
                'url_path' => '/team',
                'route_name' => 'team',
                'seo_title' => 'Meet Our Team | Surebound',
                'meta_description' => 'Meet the licensed insurance professionals and client advisors serving individuals and businesses at Surebound Insurance in Tampa, FL.',
                'focus_keyword' => 'surebound insurance team tampa',
                'secondary_keywords' => ['licensed agents tampa', 'insurance advisors florida'],
                'search_intent' => 'informational',
                'schema_type' => 'Organization',
            ],
            [
                'url_path' => '/careers',
                'route_name' => 'careers',
                'seo_title' => 'Careers at Surebound | Tampa, FL',
                'meta_description' => 'Explore insurance career opportunities and broker positions at Surebound Insurance in downtown Tampa, Florida.',
                'focus_keyword' => 'insurance careers tampa',
                'secondary_keywords' => ['insurance agent jobs tampa', 'account manager positions florida'],
                'search_intent' => 'navigational',
                'schema_type' => 'Organization',
            ],
            [
                'url_path' => '/community',
                'route_name' => 'community',
                'seo_title' => 'Community Impact | Surebound Insurance',
                'meta_description' => 'Discover our local community involvement, neighborhood support, and storm preparedness initiatives in Tampa Bay.',
                'focus_keyword' => 'surebound community tampa',
                'secondary_keywords' => ['tampa bay community giving', 'hurricane prep outreach'],
                'search_intent' => 'informational',
                'schema_type' => 'Organization',
            ],
            [
                'url_path' => '/articles',
                'route_name' => 'articles',
                'seo_title' => 'Insurance Articles & Guides | Surebound Insurance',
                'meta_description' => 'Practical insurance articles on Florida home insurance, hurricane deductibles, commercial liability, and auto coverage from our Tampa team.',
                'focus_keyword' => 'florida insurance articles',
                'secondary_keywords' => ['hurricane deductible guide', 'florida insurance tips', 'commercial risk tampa'],
                'search_intent' => 'informational',
                'schema_type' => 'Article',
            ],
            [
                'url_path' => '/faqs',
                'route_name' => 'faqs',
                'seo_title' => 'Insurance FAQs | Surebound Insurance',
                'meta_description' => 'Clear answers to frequent questions about insurance policies, Florida hurricane deductibles, carrier claims, and billing options.',
                'focus_keyword' => 'florida insurance faqs',
                'secondary_keywords' => ['hurricane deductible questions', 'insurance payment grace period', 'policy help tampa'],
                'search_intent' => 'informational',
                'schema_type' => 'WebSite',
            ],
            [
                'url_path' => '/guides',
                'route_name' => 'guides',
                'seo_title' => 'Insurance Buyer Guides | Surebound Insurance',
                'meta_description' => 'Comprehensive buyer guides and checklists for Florida home insurance, small business coverage, and commercial auto.',
                'focus_keyword' => 'florida insurance buyer guides',
                'secondary_keywords' => ['home insurance guide florida', 'small business insurance checklist tampa'],
                'search_intent' => 'informational',
                'schema_type' => 'Article',
            ],
            [
                'url_path' => '/business-insurance',
                'route_name' => 'business-insurance',
                'seo_title' => 'Business Insurance in Tampa, FL | Surebound',
                'meta_description' => 'Get help with business insurance in Tampa. Discuss liability, commercial property, vehicles and coverage options with Surebound Insurance.',
                'focus_keyword' => 'business insurance tampa fl',
                'secondary_keywords' => ['bop insurance florida', 'small business insurance tampa', 'commercial package policy'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/claims',
                'route_name' => 'claims',
                'seo_title' => 'Claims Assistance & Carrier Reporting | Surebound Insurance',
                'meta_description' => 'File and track your insurance claim. Access 24/7 carrier claims numbers and receive guidance from our Tampa agency claims support team.',
                'focus_keyword' => 'file insurance claim tampa',
                'secondary_keywords' => ['carrier claims reporting', 'surebound claims assistance', 'emergency claims hotline'],
                'search_intent' => 'navigational',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/payment',
                'route_name' => 'payment',
                'seo_title' => 'Policy Payments & Billing Options | Surebound Insurance',
                'meta_description' => 'Review payment options, access carrier bill-pay portals, or manage your policy billing through Surebound Insurance in Tampa.',
                'focus_keyword' => 'pay insurance premium tampa',
                'secondary_keywords' => ['carrier bill pay', 'surebound invoice payments', 'insurance billing support'],
                'search_intent' => 'transactional',
                'schema_type' => 'WebSite',
            ],
            [
                'url_path' => '/contact',
                'route_name' => 'contact',
                'seo_title' => 'Contact Surebound Insurance | Tampa, FL',
                'meta_description' => 'Contact Surebound Insurance in Tampa, Florida. Call (813) 214-1731, visit our downtown Tampa office at 100 N Tampa St, Suite 2500, or send a message online.',
                'focus_keyword' => 'contact surebound insurance tampa',
                'secondary_keywords' => ['surebound phone number', 'tampa insurance office address', 'agent contact (813) 214-1731'],
                'search_intent' => 'navigational',
                'schema_type' => 'LocalBusiness',
            ],
            [
                'url_path' => '/privacy',
                'route_name' => 'privacy',
                'seo_title' => 'Privacy Policy | Surebound Insurance',
                'meta_description' => 'Read our commitment to protecting your personal information, financial privacy, and policyholder confidentiality.',
                'focus_keyword' => 'surebound privacy policy',
                'secondary_keywords' => ['data protection', 'privacy disclosures'],
                'search_intent' => 'informational',
                'schema_type' => 'WebSite',
            ],
            [
                'url_path' => '/terms',
                'route_name' => 'terms',
                'seo_title' => 'Terms of Use | Surebound Insurance',
                'meta_description' => 'Review the terms and conditions governing use of the Surebound Insurance website and client advisory services.',
                'focus_keyword' => 'terms of use surebound',
                'secondary_keywords' => ['website terms', 'service terms'],
                'search_intent' => 'informational',
                'schema_type' => 'WebSite',
            ],
        ];
    }

    /**
     * Ensure default SEO metadata rows exist in the database.
     */
    public function ensureDefaultMetadata(): void
    {
        foreach (self::getDefaultPages() as $page) {
            SeoMetadata::firstOrCreate(
                ['url_path' => $page['url_path']],
                [
                    'route_name' => $page['route_name'],
                    'seo_title' => $page['seo_title'],
                    'meta_description' => $page['meta_description'],
                    'canonical_url' => url($page['url_path']),
                    'meta_robots' => 'index, follow',
                    'og_title' => $page['seo_title'],
                    'og_description' => $page['meta_description'],
                    'og_image' => 'images/logo.png',
                    'og_type' => 'website',
                    'twitter_card' => 'summary_large_image',
                    'focus_keyword' => $page['focus_keyword'],
                    'secondary_keywords' => $page['secondary_keywords'],
                    'search_intent' => $page['search_intent'],
                    'target_country' => 'US',
                    'target_language' => 'en',
                    'schema_type' => $page['schema_type'],
                    'is_published' => true,
                ]
            );
        }
    }

    /**
     * Resolve metadata for the current request.
     */
    public function getMetadataForRequest(?Request $request = null): ?SeoMetadata
    {
        $request = $request ?: request();
        $path = '/'.ltrim($request->path(), '/');
        $routeName = Route::currentRouteName();

        try {
            if (Schema::hasTable('seo_metadata')) {
                $meta = SeoMetadata::where('url_path', $path)->first()
                    ?: ($routeName ? SeoMetadata::where('route_name', $routeName)->first() : null);
                if ($meta) {
                    return $meta;
                }
            }
        } catch (\Throwable) {
            // DB fallback
        }

        // Virtual fallback from configured default pages
        foreach (self::getDefaultPages() as $defaultPage) {
            if ($defaultPage['url_path'] === $path || ($routeName && $defaultPage['route_name'] === $routeName)) {
                $virtual = new SeoMetadata;
                $virtual->url_path = $defaultPage['url_path'];
                $virtual->route_name = $defaultPage['route_name'];
                $virtual->seo_title = $defaultPage['seo_title'];
                $virtual->meta_description = $defaultPage['meta_description'];
                $virtual->canonical_url = url($defaultPage['url_path']);
                $virtual->meta_robots = 'index, follow';
                $virtual->og_title = $defaultPage['seo_title'];
                $virtual->og_description = $defaultPage['meta_description'];
                $virtual->og_image = 'images/logo.png';
                $virtual->og_type = 'website';
                $virtual->twitter_card = 'summary_large_image';
                $virtual->focus_keyword = $defaultPage['focus_keyword'];
                $virtual->secondary_keywords = $defaultPage['secondary_keywords'];
                $virtual->search_intent = $defaultPage['search_intent'];
                $virtual->schema_type = $defaultPage['schema_type'];
                $virtual->is_published = true;

                return $virtual;
            }
        }

        return null;
    }

    /**
     * Generate JSON-LD Schema markup for the given metadata or URL.
     */
    public function generateSchemaJson(?SeoMetadata $metadata = null, ?string $url = null): array
    {
        $currentUrl = $url ?: url()->current();
        $schemaType = $metadata?->schema_type ?: 'WebSite';

        // Check if there is a custom schema record in seo_schema_records
        $path = '/'.ltrim(parse_url($currentUrl, PHP_URL_PATH) ?: '/', '/');
        try {
            if (Schema::hasTable('seo_schema_records')) {
                $customSchema = SeoSchemaRecord::where('url_path', $path)->where('is_active', true)->first();
                if ($customSchema && ! empty($customSchema->schema_json)) {
                    return $customSchema->schema_json;
                }
            }
        } catch (\Throwable) {
            // Fall back to automatic generation
        }

        $baseOrg = [
            '@context' => 'https://schema.org',
            '@type' => 'InsuranceAgency',
            '@id' => 'https://sureboundinsurance.com/#agency',
            'name' => 'Surebound Insurance',
            'alternateName' => ['Surebound', 'sureboundinsurance', 'Surebound Insurance Agency'],
            'url' => 'https://sureboundinsurance.com',
            'logo' => asset('images/logo.png'),
            'image' => asset('images/hero-family.jpg'),
            'description' => 'Dependable insurance protection built around you. Home, auto, commercial liability, workers compensation, and surety bonds.',
            'telephone' => '+1-813-214-1731',
            'priceRange' => '$$',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => '100 N Tampa St, Suite 2500',
                'addressLocality' => 'Tampa',
                'addressRegion' => 'FL',
                'postalCode' => '33602',
                'addressCountry' => 'US',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => 27.9478,
                'longitude' => -82.4584,
            ],
            'founder' => [
                '@type' => 'Person',
                'name' => 'Karry',
                'jobTitle' => 'Founder & Licensed Risk Advisor',
                'image' => asset('images/karry-founder-v2.jpg'),
                'description' => 'Founder of Surebound Insurance with extensive background in personal and commercial insurance solutions in Florida.',
            ],
            'areaServed' => [
                [
                    '@type' => 'State',
                    'name' => 'Florida',
                ],
                [
                    '@type' => 'Country',
                    'name' => 'United States',
                ],
            ],
            'knowsAbout' => [
                'Florida Homeowners Insurance',
                'Commercial General Liability',
                'Workers Compensation Florida Statute 440',
                'Commercial Property & Windstorm Insurance',
                'Flood Insurance (NFIP & Private)',
                'Commercial Auto & Fleet Coverage',
                'Group Employee Benefits',
                'Surety Bonds',
            ],
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                    'opens' => '08:30',
                    'closes' => '17:30',
                ],
            ],
            'sameAs' => [
                'https://www.linkedin.com/company/surebound',
                'https://www.facebook.com/share/1FMYaUktDN/',
            ],
        ];

        if ($path === '/' || $schemaType === 'Organization') {
            return [
                '@context' => 'https://schema.org',
                '@graph' => [
                    $baseOrg,
                    [
                        '@type' => 'WebSite',
                        '@id' => 'https://sureboundinsurance.com/#website',
                        'name' => 'Surebound Insurance',
                        'url' => 'https://sureboundinsurance.com',
                    ],
                ],
            ];
        }

        if ($schemaType === 'Service') {
            return [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $metadata?->seo_title ?: 'Insurance Coverage Service',
                'serviceType' => 'Commercial and Personal Lines Insurance',
                'description' => $metadata?->meta_description ?: 'Bespoke insurance policy tailored by licensed advisors.',
                'provider' => [
                    '@type' => 'InsuranceAgency',
                    'name' => 'Surebound Insurance',
                    'url' => 'https://sureboundinsurance.com',
                ],
                'areaServed' => [
                    ['@type' => 'State', 'name' => 'Florida'],
                    ['@type' => 'Country', 'name' => 'United States'],
                ],
            ];
        }

        if ($schemaType === 'LocalBusiness') {
            return $baseOrg;
        }

        if ($schemaType === 'Article') {
            return [
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => $metadata?->seo_title ?: 'Insurance Insights & Risk Management',
                'description' => $metadata?->meta_description ?: 'Comprehensive insurance analysis and regulatory guide.',
                'author' => [
                    '@type' => 'Organization',
                    'name' => 'Surebound Underwriting Team',
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'Surebound Insurance',
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('images/logo.png'),
                    ],
                ],
                'datePublished' => '2026-01-01',
                'dateModified' => date('Y-m-d'),
                'mainEntityOfPage' => $currentUrl,
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $metadata?->seo_title ?: 'Surebound Insurance',
            'description' => $metadata?->meta_description ?: 'Premier insurance protection built around you.',
            'url' => $currentUrl,
            'isPartOf' => [
                '@type' => 'WebSite',
                'name' => 'Surebound Insurance',
                'url' => 'https://sureboundinsurance.com',
            ],
        ];
    }

    /**
     * Get alternate hreflang links for current or given path.
     */
    public function getHreflangLinks(?string $path = null): array
    {
        $path = $path ?: '/'.ltrim(request()->path(), '/');

        try {
            if (Schema::hasTable('seo_hreflang_mappings')) {
                $mappings = SeoHreflangMapping::where('source_url', $path)->get();
                if ($mappings->isNotEmpty()) {
                    return $mappings->pluck('alternate_url', 'locale')->toArray();
                }
            }
        } catch (\Throwable) {
            // Fall back to default hreflang links
        }

        // Agency targets Florida / US audiences
        return [
            'en-US' => url($path),
            'x-default' => url($path),
        ];
    }
}
