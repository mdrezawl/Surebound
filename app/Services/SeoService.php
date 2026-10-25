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
                'seo_title' => 'Surebound Insurance – Premier Home, Auto & Business Coverage',
                'meta_description' => 'Dependable insurance protection built around you. Get fast quotes and dedicated underwriter support for home, auto, commercial liability, and surety bonds.',
                'focus_keyword' => 'insurance agency',
                'secondary_keywords' => ['surebound insurance', 'commercial auto', 'homeowners insurance', 'surety bond'],
                'search_intent' => 'commercial',
                'schema_type' => 'Organization',
            ],
            [
                'url_path' => '/home-insurance',
                'route_name' => 'home-insurance',
                'seo_title' => 'Homeowners Insurance – Structural & Personal Property Protection | Surebound',
                'meta_description' => 'Protect your family safe haven with comprehensive homeowners coverage. Includes dwelling, personal property, liability, and weather hazard protection.',
                'focus_keyword' => 'homeowners insurance',
                'secondary_keywords' => ['home insurance quote', 'dwelling protection', 'property insurance'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/auto-insurance',
                'route_name' => 'auto-insurance',
                'seo_title' => 'Auto Insurance Coverage – Collision, Comprehensive & Liability | Surebound',
                'meta_description' => 'Tailored car insurance policies covering collision, bodily injury liability, comprehensive perils, and roadside assistance. Fast underwriter quotes.',
                'focus_keyword' => 'auto insurance',
                'secondary_keywords' => ['car insurance quote', 'vehicle coverage', 'collision coverage'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/commercial-auto-insurance',
                'route_name' => 'commercial-auto-insurance',
                'seo_title' => 'Commercial Auto Insurance – Fleet & Commercial Truck Coverage | Surebound',
                'meta_description' => 'Specialized commercial vehicle insurance for delivery vans, contractor trucks, and enterprise fleets with high-limit liability and cargo protection.',
                'focus_keyword' => 'commercial auto insurance',
                'secondary_keywords' => ['fleet insurance', 'commercial vehicle coverage', 'business truck insurance'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/surety-bond',
                'route_name' => 'surety-bond',
                'seo_title' => 'Surety Bonds – Contractor, License & Permit Bonds | Surebound',
                'meta_description' => 'Fast bonding approval for contract performance, bid bonds, payment bonds, and court surety bonds backed by trusted surety underwriters.',
                'focus_keyword' => 'surety bonds',
                'secondary_keywords' => ['contractor bond', 'license and permit bond', 'performance bond'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/life-insurance',
                'route_name' => 'life-insurance',
                'seo_title' => 'Term & Whole Life Insurance – Financial Security for Families | Surebound',
                'meta_description' => 'Safeguard your family future with flexible term and permanent whole life insurance solutions. Customized benefit amounts and living benefits.',
                'focus_keyword' => 'life insurance',
                'secondary_keywords' => ['term life insurance', 'whole life policy', 'family life insurance'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/health-insurance',
                'route_name' => 'health-insurance',
                'seo_title' => 'Individual & Family Health Insurance Coverage | Surebound',
                'meta_description' => 'Quality medical, preventive, dental, and vision insurance coverage with access to top national healthcare networks and prescription benefits.',
                'focus_keyword' => 'health insurance',
                'secondary_keywords' => ['individual health insurance', 'family medical coverage', 'affordable health plans'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/umbrella-insurance',
                'route_name' => 'umbrella-insurance',
                'seo_title' => 'Personal & Commercial Umbrella Liability Insurance | Surebound',
                'meta_description' => 'Extended excess liability protection that shields your accumulated assets and business equity against catastrophic legal claims.',
                'focus_keyword' => 'umbrella insurance',
                'secondary_keywords' => ['excess liability', 'personal umbrella policy', 'asset protection insurance'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/personal-coverage',
                'route_name' => 'personal-coverage',
                'seo_title' => 'Personal Insurance Packages – High-Value Asset & Family Protection | Surebound',
                'meta_description' => 'Comprehensive personal line bundles combining home, auto, valuable articles, watercraft, and liability into one seamless policyholder experience.',
                'focus_keyword' => 'personal insurance packages',
                'secondary_keywords' => ['personal lines insurance', 'bundled coverage', 'high net worth insurance'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/property-insurance',
                'route_name' => 'property-insurance',
                'seo_title' => 'Commercial Property Insurance – Buildings, Equipment & Inventory | Surebound',
                'meta_description' => 'Protect commercial real estate, machinery, technology, and inventory against fire, windstorm, theft, and business interruption losses.',
                'focus_keyword' => 'commercial property insurance',
                'secondary_keywords' => ['business property coverage', 'commercial real estate insurance', 'business interruption'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/liability-insurance',
                'route_name' => 'liability-insurance',
                'seo_title' => 'General Liability Insurance – Commercial Risk & Slip-and-Fall Protection | Surebound',
                'meta_description' => 'Essential commercial general liability coverage shielding small businesses and corporations from bodily injury, property damage, and legal defense costs.',
                'focus_keyword' => 'general liability insurance',
                'secondary_keywords' => ['commercial liability', 'business liability quote', 'slip and fall insurance'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/group-benefits',
                'route_name' => 'group-benefits',
                'seo_title' => 'Workers Compensation & Group Benefits for Employers | Surebound',
                'meta_description' => 'Statutory workers compensation and employee group health benefits that safeguard your workforce while keeping your business fully compliant.',
                'focus_keyword' => 'workers compensation insurance',
                'secondary_keywords' => ['group benefits', 'employee insurance', 'workers comp quote'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/specialty-coverage',
                'route_name' => 'specialty-coverage',
                'seo_title' => 'Specialty & Surplus Lines Insurance – High-Risk Protection | Surebound',
                'meta_description' => 'Bespoke insurance solutions for hard-to-place commercial risks, environmental liability, professional indemnity, and cyber security breaches.',
                'focus_keyword' => 'specialty insurance',
                'secondary_keywords' => ['excess surplus lines', 'cyber liability', 'professional indemnity'],
                'search_intent' => 'commercial',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/coverage',
                'route_name' => 'coverage',
                'seo_title' => 'Insurance Coverage Overview – Commercial & Personal Lines | Surebound',
                'meta_description' => 'Explore the complete Surebound insurance coverage portfolio. Compare business and individual coverage options designed for resilient protection.',
                'focus_keyword' => 'insurance coverage options',
                'secondary_keywords' => ['business coverage', 'personal insurance', 'surebound policies'],
                'search_intent' => 'informational',
                'schema_type' => 'WebSite',
            ],
            [
                'url_path' => '/custom-quote',
                'route_name' => 'custom-quote',
                'seo_title' => 'Request a Custom Insurance Quote – Fast Underwriting Review | Surebound',
                'meta_description' => 'Submit your coverage requirements for a complimentary, bespoke insurance quotation from licensed Surebound underwriters within 24 hours.',
                'focus_keyword' => 'custom insurance quote',
                'secondary_keywords' => ['instant insurance quote', 'underwriter quote', 'request a quote'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/compare',
                'route_name' => 'compare',
                'seo_title' => 'Compare Insurance Policy Tiers & Coverage Limits | Surebound',
                'meta_description' => 'Side-by-side policy comparison of deductibles, coverage limits, policy endorsements, and premium rates to choose the optimal plan.',
                'focus_keyword' => 'compare insurance policies',
                'secondary_keywords' => ['insurance policy comparison', 'coverage limits compare', 'policy tiers'],
                'search_intent' => 'commercial',
                'schema_type' => 'WebSite',
            ],
            [
                'url_path' => '/story',
                'route_name' => 'story',
                'seo_title' => 'Our Story – Dedicated Insurance Heritage & Underwriting Philosophy | Surebound',
                'meta_description' => 'Learn how Surebound Insurance was founded on principles of transparent underwriting, client advocacy, and unyielding policyholder protection.',
                'focus_keyword' => 'about surebound insurance',
                'secondary_keywords' => ['insurance agency heritage', 'underwriting philosophy', 'surebound history'],
                'search_intent' => 'informational',
                'schema_type' => 'Organization',
            ],
            [
                'url_path' => '/team',
                'route_name' => 'team',
                'seo_title' => 'Our Leadership & Licensed Insurance Agents | Surebound',
                'meta_description' => 'Meet our team of licensed insurance brokers, chartered property casualty underwriters (CPCU), and risk management specialists.',
                'focus_keyword' => 'insurance agents and underwriters',
                'secondary_keywords' => ['surebound team', 'licensed brokers', 'risk advisors'],
                'search_intent' => 'informational',
                'schema_type' => 'Organization',
            ],
            [
                'url_path' => '/careers',
                'route_name' => 'careers',
                'seo_title' => 'Insurance Careers & Broker Opportunities | Surebound',
                'meta_description' => 'Join the Surebound team. Explore career opportunities for commercial underwriters, account managers, and licensed insurance producers.',
                'focus_keyword' => 'insurance careers',
                'secondary_keywords' => ['insurance agent jobs', 'underwriter careers', 'commercial insurance jobs'],
                'search_intent' => 'navigational',
                'schema_type' => 'Organization',
            ],
            [
                'url_path' => '/community',
                'route_name' => 'community',
                'seo_title' => 'Community Outreach & Civic Involvement | Surebound',
                'meta_description' => 'Discover our philanthropic partnerships, local community service initiatives, and disaster relief support programs across our service regions.',
                'focus_keyword' => 'community outreach insurance',
                'secondary_keywords' => ['surebound community', 'local giving', 'charity initiatives'],
                'search_intent' => 'informational',
                'schema_type' => 'Organization',
            ],
            [
                'url_path' => '/articles',
                'route_name' => 'articles',
                'seo_title' => 'Insurance Knowledge Hub, Insights & Market Trends | Surebound',
                'meta_description' => 'Expert articles on risk management, emerging commercial perils, rate trends, policy endorsements, and regulatory changes.',
                'focus_keyword' => 'insurance articles and insights',
                'secondary_keywords' => ['insurance blog', 'risk management tips', 'policy advice'],
                'search_intent' => 'informational',
                'schema_type' => 'Article',
            ],
            [
                'url_path' => '/faqs',
                'route_name' => 'faqs',
                'seo_title' => 'Insurance FAQs – Policy Questions, Claims & Billing Answers | Surebound',
                'meta_description' => 'Clear answers to common questions about coverage deductibles, claims filing, policy renewals, certificates of insurance, and payment options.',
                'focus_keyword' => 'insurance faqs',
                'secondary_keywords' => ['insurance questions', 'policy help', 'claims faqs'],
                'search_intent' => 'informational',
                'schema_type' => 'WebSite',
            ],
            [
                'url_path' => '/guides',
                'route_name' => 'guides',
                'seo_title' => 'Insurance Buyer Guides & Risk Reduction Checklists | Surebound',
                'meta_description' => 'Download comprehensive buyer guides and checklists for purchasing commercial property, general liability, and fleet auto insurance.',
                'focus_keyword' => 'insurance buyer guides',
                'secondary_keywords' => ['commercial insurance guide', 'risk management checklist', 'insurance buying tips'],
                'search_intent' => 'informational',
                'schema_type' => 'Article',
            ],
            [
                'url_path' => '/business-insurance',
                'route_name' => 'business-insurance',
                'seo_title' => 'Business Owners Policy (BOP) – Bundled Commercial Protection | Surebound',
                'meta_description' => 'All-in-one Business Owner Policy combining general liability, commercial building, and business interruption coverage for maximum value.',
                'focus_keyword' => 'business insurance',
                'secondary_keywords' => ['bop insurance', 'small business insurance quote', 'commercial package policy'],
                'search_intent' => 'transactional',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/claims',
                'route_name' => 'claims',
                'seo_title' => 'File a Claim & 24/7 First Notice of Loss (FNOL) | Surebound',
                'meta_description' => 'Fast, compassionate claims filing support. Submit your incident report online or call our emergency claims hotline for immediate assistance.',
                'focus_keyword' => 'file an insurance claim',
                'secondary_keywords' => ['claims intake', 'fnol report', 'insurance claims support'],
                'search_intent' => 'navigational',
                'schema_type' => 'Service',
            ],
            [
                'url_path' => '/payment',
                'route_name' => 'payment',
                'seo_title' => 'Pay Insurance Premium & Manage Invoices Online | Surebound',
                'meta_description' => 'Secure online portal to pay insurance premiums, review billing schedules, download payment receipts, and set up automatic ACH debits.',
                'focus_keyword' => 'pay insurance premium',
                'secondary_keywords' => ['pay policy invoice', 'insurance bill payment', 'ach payment portal'],
                'search_intent' => 'transactional',
                'schema_type' => 'WebSite',
            ],
            [
                'url_path' => '/contact',
                'route_name' => 'contact',
                'seo_title' => 'Contact Surebound Insurance – Offices, Phone & Inquiries',
                'meta_description' => 'Get in touch with Surebound insurance brokers and claims specialists. Call (800) 555-SURE or visit our underwriting offices.',
                'focus_keyword' => 'contact insurance agency',
                'secondary_keywords' => ['surebound phone number', 'insurance office address', 'agent contact'],
                'search_intent' => 'navigational',
                'schema_type' => 'LocalBusiness',
            ],
            [
                'url_path' => '/privacy',
                'route_name' => 'privacy',
                'seo_title' => 'Privacy Policy & Data Security Disclosures | Surebound',
                'meta_description' => 'Read our commitment to protecting your personal information, financial privacy, and policyholder confidentiality.',
                'focus_keyword' => 'insurance privacy policy',
                'secondary_keywords' => ['data protection', 'privacy disclosures'],
                'search_intent' => 'informational',
                'schema_type' => 'WebSite',
            ],
            [
                'url_path' => '/terms',
                'route_name' => 'terms',
                'seo_title' => 'Terms of Service & Policyholder Agreement | Surebound',
                'meta_description' => 'Terms and legal conditions governing the use of the Surebound Insurance website, policy quoting tools, and payment services.',
                'focus_keyword' => 'terms of service',
                'secondary_keywords' => ['website terms', 'policyholder agreement'],
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
        try {
            if (! Schema::hasTable('seo_metadata')) {
                return null;
            }

            $request = $request ?: request();
            $path = '/'.ltrim($request->path(), '/');

            return SeoMetadata::where('url_path', $path)->first()
                ?: (Route::currentRouteName() ? SeoMetadata::where('route_name', Route::currentRouteName())->first() : null);
        } catch (\Throwable) {
            return null;
        }
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
            'name' => 'Surebound Insurance',
            'url' => url('/'),
            'logo' => asset('images/logo.png'),
            'image' => asset('images/hero-family.jpg'),
            'description' => 'Dependable insurance protection built around you. Home, auto, commercial liability, workers compensation, and surety bonds.',
            'telephone' => '+1-800-555-7873',
            'priceRange' => '$$',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => '100 Wall Street, Suite 1400',
                'addressLocality' => 'New York',
                'addressRegion' => 'NY',
                'postalCode' => '10005',
                'addressCountry' => 'US',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => 40.7061,
                'longitude' => -74.0092,
            ],
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                    'opens' => '08:00',
                    'closes' => '18:00',
                ],
            ],
            'sameAs' => [
                'https://www.linkedin.com/company/surebound',
                'https://twitter.com/SureboundIns',
            ],
        ];

        if ($path === '/' || $schemaType === 'Organization') {
            return [
                '@context' => 'https://schema.org',
                '@graph' => [
                    $baseOrg,
                    [
                        '@type' => 'WebSite',
                        'name' => 'Surebound Insurance',
                        'url' => url('/'),
                        'potentialAction' => [
                            '@type' => 'SearchAction',
                            'target' => url('/articles').'?q={search_term_string}',
                            'query-input' => 'required name=search_term_string',
                        ],
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
                'description' => $metadata?->meta_description ?: 'Bespoke insurance policy tailored by licensed underwriters.',
                'provider' => [
                    '@type' => 'InsuranceAgency',
                    'name' => 'Surebound Insurance',
                    'url' => url('/'),
                ],
                'areaServed' => [
                    ['@type' => 'Country', 'name' => 'United States'],
                    ['@type' => 'Country', 'name' => 'United Kingdom'],
                    ['@type' => 'Country', 'name' => 'Canada'],
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
                'url' => url('/'),
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

        // Standard default locale links for USA, UK, Canada, and x-default
        return [
            'en-US' => url($path),
            'en-GB' => url($path),
            'en-CA' => url($path),
            'x-default' => url($path),
        ];
    }
}
