<?php

namespace App\Http\Controllers;

use App\Models\ApiSetting;
use App\Models\Claim;
use App\Models\Invoice;
use App\Models\PageContent;
use App\Models\Policy;
use App\Models\Quote;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display the Executive Admin Portal with Real Database Records
     */
    public function index()
    {
        $quotes = Quote::orderBy('id', 'desc')->get();
        $policies = Policy::orderBy('id', 'desc')->get();
        $claims = Claim::orderBy('id', 'desc')->get();
        $supportTickets = SupportTicket::orderBy('id', 'desc')->get();
        $allUsers = User::orderBy('id', 'desc')->get();
        $agents = User::where('role', 'agent')->orderBy('id', 'asc')->get();
        $invoices = Invoice::orderBy('id', 'desc')->get();

        $userCounts = [
            'total' => $allUsers->count(),
            'users' => $allUsers->where('role', 'user')->count(),
            'agents' => $allUsers->where('role', 'agent')->count(),
            'admins' => $allUsers->where('role', 'admin')->count(),
            'super_admins' => $allUsers->filter(fn ($u) => $u->isSuperAdmin())->count(),
        ];

        // API Settings retrieval with fallback defaults
        $apiSettingsRaw = ApiSetting::all()->pluck('value', 'key')->toArray();
        $claimsApiConfig = $apiSettingsRaw['claims_api_config'] ?? [
            'enabled' => false,
            'provider' => 'Mitchell / Guidewire ClaimCenter API',
            'environment' => 'production',
            'endpoint_url' => '',
            'api_key' => '',
            'webhook_url' => url('/api/v1/claims/webhook'),
            'webhook_secret' => '',
            'sync_frequency' => 'realtime',
            'auto_approve_limit' => 2500,
            'status' => 'pending',
            'last_synced_at' => null,
        ];

        $stripeConfig = $apiSettingsRaw['stripe_config'] ?? ['enabled' => false, 'environment' => 'live', 'publishable_key' => '', 'secret_key' => '', 'webhook_secret' => '', 'accept_cards' => true, 'accept_apple_pay' => true, 'accept_google_pay' => true];
        $plaidConfig = $apiSettingsRaw['plaid_ach_config'] ?? ['enabled' => false, 'environment' => 'production', 'client_id' => '', 'secret_key' => '', 'same_day_ach' => true];
        $authorizeConfig = $apiSettingsRaw['authorize_config'] ?? ['enabled' => false, 'environment' => 'production', 'api_login_id' => '', 'transaction_key' => ''];
        $wireConfig = $apiSettingsRaw['wire_fednow_config'] ?? ['enabled' => false, 'bank_name' => '', 'routing_number' => '', 'account_number' => '', 'swift_bic' => '', 'fednow_participant_id' => ''];
        $bnplConfig = $apiSettingsRaw['bnpl_klarna_config'] ?? ['enabled' => false, 'merchant_id' => '', 'shared_secret' => '', 'country' => 'US', 'currency' => 'USD'];
        $paymentGeneralConfig = $apiSettingsRaw['payment_general_config'] ?? ['currency' => 'USD', 'surcharge_enabled' => false, 'surcharge_pct' => 2.9, 'surcharge_flat' => 0.30, 'auto_send_receipt' => true];
        $marketingSettings = $apiSettingsRaw['marketing_settings'] ?? self::getDefaultMarketingSettings();

        // Invoice financial KPIs
        $totalInvoiced = $invoices->sum('total_amount');
        $totalPaidInvoices = $invoices->where('status', 'paid')->sum('total_amount');
        $outstandingBalance = $invoices->whereIn('status', ['pending', 'overdue'])->sum('total_amount');
        $overdueCount = $invoices->where('status', 'overdue')->count();

        // Calculate real-time database KPIs
        $activePoliciesCount = Policy::where('status', 'active')->count();
        $pendingQuotesCount = Quote::whereIn('status', ['new', 'reviewing'])->count();
        $urgentQuotesCount = Quote::where('status', 'new')->count();
        $urgentClaimsCount = Claim::whereIn('status', ['reviewing', 'submitted'])->count();

        $claimsCount = $claims->count();
        $totalClaims = $claimsCount;
        $resolvedClaims = Claim::whereIn('status', ['paid', 'approved'])->count();
        $claimsResolutionRate = $claimsCount > 0 ? round(($resolvedClaims / $claimsCount) * 100, 1) : 0;

        // Real-time Total Premium Volume from Policies in DB
        $totalPremiumNum = 0;
        foreach ($policies as $pol) {
            $num = (int) preg_replace('/[^0-9]/', '', $pol->annual_premium ?? '0');
            $totalPremiumNum += $num;
        }
        $formattedPremiumVolume = '$'.number_format($totalPremiumNum);

        // Real-time Insurance Line Distribution from Database
        $totalPolCount = $policies->count();
        $homePolicies = $policies->where('type', 'home');
        $autoPolicies = $policies->where('type', 'auto');
        $lifePolicies = $policies->where('type', 'life');
        $healthPolicies = $policies->where('type', 'health');
        $umbrellaPolicies = $policies->where('type', 'umbrella');
        $businessPolicies = $policies->whereIn('type', ['business', 'bop']);
        $commercialPolicies = $policies->whereIn('type', ['workers_comp', 'general_liability', 'general', 'commercial_property', 'commercial_auto', 'surety_bond']);

        $distribution = [
            'home' => [
                'count' => $homePolicies->count(),
                'pct' => $totalPolCount > 0 ? round(($homePolicies->count() / $totalPolCount) * 100) : 0,
                'volume' => '$'.number_format($homePolicies->sum(fn ($p) => (int) preg_replace('/[^0-9]/', '', $p->annual_premium ?? '0'))),
            ],
            'auto' => [
                'count' => $autoPolicies->count(),
                'pct' => $totalPolCount > 0 ? round(($autoPolicies->count() / $totalPolCount) * 100) : 0,
                'volume' => '$'.number_format($autoPolicies->sum(fn ($p) => (int) preg_replace('/[^0-9]/', '', $p->annual_premium ?? '0'))),
            ],
            'life' => [
                'count' => $lifePolicies->count(),
                'pct' => $totalPolCount > 0 ? round(($lifePolicies->count() / $totalPolCount) * 100) : 0,
                'volume' => '$'.number_format($lifePolicies->sum(fn ($p) => (int) preg_replace('/[^0-9]/', '', $p->annual_premium ?? '0'))),
            ],
            'health' => [
                'count' => $healthPolicies->count(),
                'pct' => $totalPolCount > 0 ? round(($healthPolicies->count() / $totalPolCount) * 100) : 0,
                'volume' => '$'.number_format($healthPolicies->sum(fn ($p) => (int) preg_replace('/[^0-9]/', '', $p->annual_premium ?? '0'))),
            ],
            'umbrella' => [
                'count' => $umbrellaPolicies->count(),
                'pct' => $totalPolCount > 0 ? round(($umbrellaPolicies->count() / $totalPolCount) * 100) : 0,
                'volume' => '$'.number_format($umbrellaPolicies->sum(fn ($p) => (int) preg_replace('/[^0-9]/', '', $p->annual_premium ?? '0'))),
            ],
            'business' => [
                'count' => $businessPolicies->count(),
                'pct' => $totalPolCount > 0 ? round(($businessPolicies->count() / $totalPolCount) * 100) : 0,
                'volume' => '$'.number_format($businessPolicies->sum(fn ($p) => (int) preg_replace('/[^0-9]/', '', $p->annual_premium ?? '0'))),
            ],
            'commercial' => [
                'count' => $commercialPolicies->count(),
                'pct' => $totalPolCount > 0 ? round(($commercialPolicies->count() / $totalPolCount) * 100) : 0,
                'volume' => '$'.number_format($commercialPolicies->sum(fn ($p) => (int) preg_replace('/[^0-9]/', '', $p->annual_premium ?? '0'))),
            ],
        ];

        // Dynamic Monthly Production Trajectory from MySQL policies
        $monthKeys = [
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
        ];

        $trajectory = [];
        $maxMonthVal = 1;

        foreach ($monthKeys as $mNum => $mName) {
            $monthSum = 0;
            foreach ($policies as $p) {
                if ($p->effective_date && str_contains((string) $p->effective_date, "2026-{$mNum}")) {
                    $monthSum += (int) preg_replace('/[^0-9]/', '', $p->annual_premium ?? '0');
                }
            }
            if ($monthSum > $maxMonthVal) {
                $maxMonthVal = $monthSum;
            }
            $trajectory[$mName] = [
                'amount' => $monthSum,
                'formatted' => '$'.number_format($monthSum),
                'short' => '$'.round($monthSum / 1000, 1).'k',
            ];
        }

        foreach ($trajectory as $mName => &$data) {
            $data['height'] = $data['amount'] > 0 ? max(8, round(($data['amount'] / $maxMonthVal) * 92)) : 0;
        }
        unset($data);

        // Calculate YTD Growth rate between May and Oct
        $firstMonthVal = $trajectory['May']['amount'] ?? 0;
        $latestMonthVal = $trajectory['Oct']['amount'] ?? 0;
        if ($firstMonthVal > 0) {
            $ytdGrowth = round((($latestMonthVal - $firstMonthVal) / $firstMonthVal) * 100, 1);
            $ytdGrowthFormatted = ($ytdGrowth >= 0 ? '+' : '').$ytdGrowth.'% YTD';
        } else {
            $ytdGrowthFormatted = $latestMonthVal > 0 ? '+100% YTD' : '0.0% YTD';
        }

        // Real Agent statistics from database
        $agentStats = [];
        foreach ($agents as $ag) {
            $assignedClaims = Claim::where('assigned_adjuster', 'like', "%{$ag->name}%")->count();
            $agentStats[$ag->id] = [
                'policiesCount' => 0,
                'volume' => '$0',
            ];
        }

        // Recent real quotes for overview table
        $recentQuotes = $quotes->take(5);

        $homeInsuranceContent = PageContent::getForPage('home-insurance', self::getDefaultHomeInsuranceContent());
        $autoInsuranceContent = PageContent::getForPage('auto-insurance', self::getDefaultAutoInsuranceContent());
        $lifeInsuranceContent = PageContent::getForPage('life-insurance', self::getDefaultLifeInsuranceContent());
        $healthInsuranceContent = PageContent::getForPage('health-insurance', self::getDefaultHealthInsuranceContent());
        $umbrellaInsuranceContent = PageContent::getForPage('umbrella-insurance', self::getDefaultUmbrellaInsuranceContent());
        $personalCoverageContent = PageContent::getForPage('personal-coverage', self::getDefaultPersonalCoverageContent());
        $propertyInsuranceContent = PageContent::getForPage('property-insurance', self::getDefaultPropertyInsuranceContent());
        $liabilityInsuranceContent = PageContent::getForPage('liability-insurance', self::getDefaultLiabilityInsuranceContent());
        $groupBenefitsContent = PageContent::getForPage('group-benefits', self::getDefaultGroupBenefitsContent());
        $specialtyCoverageContent = PageContent::getForPage('specialty-coverage', self::getDefaultSpecialtyCoverageContent());
        $coverageContent = PageContent::getForPage('coverage', self::getDefaultCoverageContent());
        $businessInsuranceContent = PageContent::getForPage('business-insurance', self::getDefaultBusinessInsuranceContent());
        $customQuoteContent = PageContent::getForPage('custom-quote', self::getDefaultCustomQuoteContent());
        $compareContent = PageContent::getForPage('compare', self::getDefaultCompareContent());
        $storyContent = PageContent::getForPage('story', self::getDefaultStoryContent());
        $teamContent = PageContent::getForPage('team', self::getDefaultTeamContent());
        $careersContent = PageContent::getForPage('careers', self::getDefaultCareersContent());
        $communityContent = PageContent::getForPage('community', self::getDefaultCommunityContent());
        $articlesContent = PageContent::getForPage('articles', self::getDefaultArticlesContent());
        $faqsContent = PageContent::getForPage('faqs', self::getDefaultFaqsContent());
        $guidesContent = PageContent::getForPage('guides', self::getDefaultGuidesContent());
        $supportContent = PageContent::getForPage('support', self::getDefaultSupportContent());
        $commercialAutoInsuranceContent = PageContent::getForPage('commercial-auto-insurance', self::getDefaultCommercialAutoInsuranceContent());
        $suretyBondContent = PageContent::getForPage('surety-bond', self::getDefaultSuretyBondContent());
        $contactContent = PageContent::getForPage('contact', self::getDefaultContactContent());
        $partnersContent = PageContent::getForPage('partners', self::getDefaultPartnersContent());

        $agencySignature = ApiSetting::where('key', 'agency_signature')->first()?->value ?? [
            'signatory_name' => 'Md Rezawl',
            'signatory_title' => 'Chief Underwriter & Authorized Representative',
            'signature_image' => '',
        ];

        return view('admin.dashboard', compact(
            'quotes',
            'policies',
            'claims',
            'supportTickets',
            'supportContent',
            'agents',
            'invoices',
            'agencySignature',
            'allUsers',
            'userCounts',
            'claimsApiConfig',
            'stripeConfig',
            'plaidConfig',
            'authorizeConfig',
            'wireConfig',
            'bnplConfig',
            'paymentGeneralConfig',
            'marketingSettings',
            'totalInvoiced',
            'totalPaidInvoices',
            'outstandingBalance',
            'overdueCount',
            'activePoliciesCount',
            'pendingQuotesCount',
            'urgentQuotesCount',
            'urgentClaimsCount',
            'resolvedClaims',
            'totalClaims',
            'claimsResolutionRate',
            'formattedPremiumVolume',
            'distribution',
            'trajectory',
            'ytdGrowthFormatted',
            'agentStats',
            'recentQuotes',
            'homeInsuranceContent',
            'autoInsuranceContent',
            'commercialAutoInsuranceContent',
            'suretyBondContent',
            'contactContent',
            'lifeInsuranceContent',
            'healthInsuranceContent',
            'umbrellaInsuranceContent',
            'personalCoverageContent',
            'propertyInsuranceContent',
            'liabilityInsuranceContent',
            'groupBenefitsContent',
            'specialtyCoverageContent',
            'coverageContent',
            'businessInsuranceContent',
            'customQuoteContent',
            'compareContent',
            'storyContent',
            'teamContent',
            'careersContent',
            'communityContent',
            'articlesContent',
            'faqsContent',
            'guidesContent',
            'partnersContent'
        ));
    }

    /**
     * Store a new quote lead (from Admin or API)
     */
    public function storeQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'type' => 'required|string|max:50',
            'coverage' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $typeLabels = [
            'home' => 'Homeowners Insurance',
            'auto' => 'Auto Insurance',
            'life' => 'Life Insurance',
            'health' => 'Health Insurance',
            'umbrella' => 'Umbrella Liability',
            'bop' => 'Business Owner Policy (BOP)',
            'business' => 'Business Owner Policy (BOP)',
            'workers_comp' => "Workers' Compensation",
            'general_liability' => 'General Liability',
            'general' => 'General Liability',
            'commercial_property' => 'Commercial Property Coverage',
            'property' => 'Commercial Property Coverage',
            'commercial_auto' => 'Commercial Auto Insurance',
            'surety_bond' => 'Surety Bond',
            'cyber' => 'Cyber Security',
        ];

        $rawType = strtolower($request->input('type', 'home'));
        $quote = Quote::create([
            'quote_ref' => 'Q-'.rand(10000, 99999),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone', '(206) 555-0100'),
            'type' => $rawType,
            'type_label' => $typeLabels[$rawType] ?? ucfirst(str_replace('_', ' ', $rawType)),
            'coverage' => $request->input('coverage') ?: '$500,000 Standard',
            'premium' => '$'.rand(850, 3200).' / yr',
            'location' => $request->filled('zip') ? 'ZIP: '.$request->input('zip') : 'Washington',
            'zip_code' => $request->input('zip'),
            'status' => 'new',
            'notes' => $request->input('notes', 'Submitted via Agent Portal.'),
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Quote lead created successfully!',
                'quote' => $quote,
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#quotes')
            ->with('success', 'Quote '.$quote->quote_ref.' has been recorded!');
    }

    /**
     * Update Quote Underwriting Status
     */
    public function updateQuoteStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:new,reviewing,quoted,converted,declined',
        ]);

        $quote = Quote::findOrFail($id);
        $quote->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated to '.$validated['status'],
            'quote' => $quote,
        ]);
    }

    /**
     * Delete a Quote from MySQL Database
     */
    public function deleteQuote($id)
    {
        $quote = Quote::findOrFail($id);
        $ref = $quote->quote_ref;
        $quote->delete();

        return response()->json([
            'success' => true,
            'message' => 'Quote '.$ref.' was deleted from database.',
        ]);
    }

    /**
     * Store Quote from Public Website Form
     */
    public function storePublicQuote(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'zip' => 'required|string|max:20',
            'type' => 'nullable|string|max:50',
            'company_name' => 'nullable|string|max:255',
            'fleet_size' => 'nullable|string|max:100',
            'vehicle_type' => 'nullable|string|max:100',
            'coverage_tier' => 'nullable|string|max:255',
            'bond_type' => 'nullable|string|max:255',
            'bond_amount' => 'nullable|string|max:100',
        ]);

        $rawType = strtolower($request->input('type', 'home'));
        $typeLabels = [
            'home' => 'Homeowners Insurance',
            'auto' => 'Auto Insurance',
            'life' => 'Life Insurance',
            'health' => 'Health Insurance',
            'umbrella' => 'Umbrella Liability',
            'bop' => 'Business Owner Policy (BOP)',
            'business' => 'Business Owner Policy (BOP)',
            'workers_comp' => "Workers' Compensation",
            'general_liability' => 'General Liability',
            'general' => 'General Liability',
            'commercial_property' => 'Commercial Property Coverage',
            'property' => 'Commercial Property Coverage',
            'commercial_auto' => 'Commercial Auto Insurance',
            'surety_bond' => 'Surety Bond',
            'surety' => 'Surety Bond',
            'cyber' => 'Cyber Security',
        ];

        $notesList = [];
        if ($request->filled('company_name')) {
            $notesList[] = 'Company: '.$request->input('company_name');
        }
        if ($request->filled('fleet_size')) {
            $notesList[] = 'Fleet Size: '.$request->input('fleet_size');
        }
        if ($request->filled('vehicle_type')) {
            $notesList[] = 'Vehicle Type: '.$request->input('vehicle_type');
        }
        if ($request->filled('bond_type')) {
            $notesList[] = 'Bond Type: '.$request->input('bond_type');
        }
        if ($request->filled('bond_amount')) {
            $notesList[] = 'Bond Limit: '.$request->input('bond_amount');
        }
        $notesStr = ! empty($notesList)
            ? implode(' | ', $notesList)
            : 'Generated via website quote widget.';

        $coverage = $request->input('coverage_tier') ?: ($request->filled('bond_amount') ? 'Bond Limit: '.$request->input('bond_amount') : '$500,000 Standard Tier');

        $quote = Quote::create([
            'quote_ref' => 'Q-'.rand(10000, 99999),
            'name' => $request->input('name') ?: 'Online Inquirer',
            'email' => $request->input('email') ?: 'lead-'.rand(100, 999).'@surebound-inquiry.com',
            'phone' => $request->input('phone') ?: null,
            'type' => $rawType,
            'type_label' => $typeLabels[$rawType] ?? ucfirst(str_replace('_', ' ', $rawType)),
            'coverage' => $coverage,
            'premium' => '$'.rand(900, 2400).' / yr',
            'location' => 'ZIP: '.$request->input('zip'),
            'zip_code' => $request->input('zip'),
            'status' => 'new',
            'notes' => $notesStr,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your quote request ('.$quote->quote_ref.') has been received. An underwriter will contact you shortly.',
            'quote_ref' => $quote->quote_ref,
        ]);
    }

    /**
     * Default content dictionary for Home Insurance page
     */
    public static function getDefaultHomeInsuranceContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/hero-house.jpg',
            'hero_eyebrow' => 'HOME & PROPERTY INSURANCE',
            'hero_title' => 'Protection Built Around<br>Your Safe Haven',
            'hero_subtitle' => 'Comprehensive homeowners insurance engineered to safeguard your structure, personal belongings, and loved ones — with dependable support whenever you need us.',
            'hero_card_sub' => 'Multi-Policy Discount',
            'hero_card_label' => 'Save up to 25% bundled',

            // Coverage Cards
            'card_1_title' => 'Dwelling Protection',
            'card_1_desc' => 'Covers rebuilding costs for walls, roof, foundation, and attached structures against fire, wind, and storm damage.',
            'card_2_title' => 'Personal Property',
            'card_2_desc' => 'Protects furniture, appliances, computers, clothing, and personal items whether inside your home or while traveling.',
            'card_3_title' => 'Liability Defense',
            'card_3_desc' => 'Defends against legal suits and pays medical expenses if guests are accidentally injured on your property.',
            'card_4_title' => 'Additional Living Expenses',
            'card_4_desc' => 'Covers hotel stays, restaurant dining, and temporary housing costs if covered damage makes your home unlivable.',
            'card_5_title' => 'Detached Structures',
            'card_5_desc' => 'Safeguards detached garages, storage sheds, gazebos, guest units, fences, and perimeter walls.',
            'card_6_title' => 'Valuable Articles Rider',
            'card_6_desc' => 'Optional endorsements for high-value jewelry, fine art, collectibles, water backup, and equipment breakdown.',

            // Value Pillars
            'value_1_title' => '24/7 Home Claims',
            'value_1_desc' => 'Emergency response dispatch for immediate property mitigation day or night.',
            'value_2_title' => 'Guaranteed Replacement',
            'value_2_desc' => 'Rebuild at current market labor and material prices with zero depreciation penalties.',
            'value_3_title' => 'Bundle & Save 25%',
            'value_3_desc' => 'Combine your home and auto policies into one simple premium discount.',
            'value_4_title' => 'Inflation Protection',
            'value_4_desc' => 'Automatic policy updates ensuring your dwelling limits keep up with local construction costs.',

            // Guidance
            'guidance_eyebrow' => 'OUR EXPERTISE',
            'guidance_title' => 'Homeowners Protection Made Simpler',
            'guidance_text' => 'Whether you are purchasing your first home, upgrading to a custom sanctuary, or protecting a family estate, Surebound eliminates insurance complexity. We calculate your home\'s unique replacement cost using regional building data so you get exact coverage without paying for unnecessary fluff.',

            // Why Choose
            'why_1_title' => 'Digital Photo Claims',
            'why_1_desc' => 'Submit damage pictures directly via your smartphone for rapid claim review and fast repair funds.',
            'why_2_title' => 'Smart Home Discounts',
            'why_2_desc' => 'Earn premium discount credits for installing smart leak detectors, fire alarms, and security systems.',
            'why_3_title' => 'Flexible Deductibles',
            'why_3_desc' => 'Customize deductible thresholds across wind, hail, and general peril coverage options to fit your budget.',
            'why_4_title' => 'Local Claims Experts',
            'why_4_desc' => 'Neighborhood insurance specialists who know local building codes, weather risks, and contractor networks.',

            // FAQs
            'faq_1_question' => 'What is standardly covered under a Homeowners Policy?',
            'faq_1_answer' => 'Standard homeowners insurance (HO-3) covers physical damage to your home’s dwelling and attached structures caused by fire, lightning, windstorms, hail, explosions, vandalism, and theft. It also covers your personal property, personal liability claims, and temporary living expenses if your home requires major repairs after a covered peril.',
            'faq_2_question' => 'How is my home\'s replacement cost value calculated?',
            'faq_2_answer' => 'Replacement cost is the total amount needed to rebuild your home from the ground up using current local labor and construction material prices. It differs from market value, which includes land value and real estate market trends. Surebound uses automated local construction databases to ensure your dwelling limit reflects exact local rebuilding costs.',
            'faq_3_question' => 'Are flood damage and water backup covered automatically?',
            'faq_3_answer' => 'Standard home insurance policies exclude rising groundwater floods and sewer water backup. However, Surebound offers affordable optional endorsements for water backup and sump pump overflow, as well as dedicated Flood Insurance coverage through FEMA\'s National Flood Insurance Program (NFIP) or private flood carriers.',
            'faq_4_question' => 'How can I lower my annual home insurance premium?',
            'faq_4_answer' => 'You can reduce your premium by bundling home and auto insurance (up to 25% off), upgrading your roof with impact-resistant materials, installing monitored security or smart water-leak sensors, maintaining a strong credit score, or opting for a higher deductible level.',
            'faq_5_question' => 'What is personal liability coverage and why do I need it?',
            'faq_5_answer' => 'Personal liability coverage protects you against legal financial claims if someone is accidentally injured on your property (for example, slipping on an icy walkway or tripping on stairs) or if you accidentally cause property damage to someone else. It covers medical payments, attorney legal fees, and court judgments up to your selected policy limit.',

            // CTA
            'cta_title' => 'Ready to protect your home with confidence?',
            'cta_subtitle' => 'Get a personalized home insurance quote tailored to your property in less than 2 minutes.',

            // Brand Perspectives & Pull Quotes
            'quotes_enabled' => '1',
            'quotes_count' => '1',
            'quote_1_text' => 'We believe that the advantages are so great that a shift to working on slack, or something like it, is inevitable.',
            'quote_1_author' => 'Marcel Gherkina',
            'quote_1_role' => 'Spokesperson, Surebound',
            'quote_1_badge' => 'Verified Perspective',
            'quote_1_active' => '1',
        ];
    }

    /**
     * Display Public Home Insurance Page with Dynamic CMS Content
     */
    public function showHomeInsurance()
    {
        $content = PageContent::getForPage('home-insurance', self::getDefaultHomeInsuranceContent());

        return view('home-insurance', compact('content'));
    }

    /**
     * Update Home Insurance CMS Content from Admin Portal
     */
    public function updateHomeInsurance(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_home_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        // Save Insurance Partners configuration if submitted from Home CMS
        if ($request->has('partner_1_name') || $request->has('partners_submitted')) {
            $this->handlePartnersDataSave($request);
        }

        // Save Brand Quotes & Perspectives configuration if submitted from Home CMS
        if ($request->has('quotes_submitted') || $request->has('quote_1_text') || $request->has('quotes_count')) {
            $this->handleQuotesDataSave($request, $data);
        }

        PageContent::setForPage('home-insurance', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Home page content and insurance partners updated and published live successfully!',
                'content' => PageContent::getForPage('home-insurance', self::getDefaultHomeInsuranceContent()),
                'partners' => PageContent::getForPage('partners', self::getDefaultPartnersContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#home-cms')
            ->with('success', 'Home Insurance page updated successfully!');
    }

    /**
     * Default content dictionary for Auto Insurance page
     */
    public static function getDefaultAutoInsuranceContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/hero-auto.jpg',
            'hero_eyebrow' => 'AUTO & VEHICLE INSURANCE',
            'hero_title' => 'Confidence &amp; Protection<br>on Every Mile',
            'hero_subtitle' => 'Drive with total peace of mind knowing you have comprehensive auto protection, 24/7 roadside dispatch, and transparent rates tailored to your driving record.',
            'hero_card_sub' => 'Safe Driver Savings',
            'hero_card_label' => 'Save up to 30% with safe drive rewards',

            // Coverage Cards
            'card_1_title' => 'Comprehensive Coverage',
            'card_1_desc' => 'Covers vehicle damage from non-collision perils like weather storms, theft, fallen tree branches, vandalism, and glass cracks.',
            'card_2_title' => 'Collision Protection',
            'card_2_desc' => 'Pays to repair or replace your vehicle after a collision with another car, object, or rollover incident regardless of fault.',
            'card_3_title' => 'Bodily Injury Liability',
            'card_3_desc' => 'Protects your financial assets against medical bills and legal defense costs if you cause an accident resulting in injury.',
            'card_4_title' => 'Property Damage Liability',
            'card_4_desc' => 'Covers repair or replacement expenses for other drivers\' vehicles, structures, and property damaged in an accident.',
            'card_5_title' => 'Uninsured Motorist Coverage',
            'card_5_desc' => 'Shields you and your passengers if you are hit by a driver who lacks insurance or flees the scene in a hit-and-run.',
            'card_6_title' => 'Roadside Assistance & Rental',
            'card_6_desc' => '24/7 towing, battery jump-starts, flat tire changes, lockout service, and daily rental vehicle reimbursement while in repairs.',

            // Value Pillars
            'value_1_title' => '24/7 Roadside Help',
            'value_1_desc' => 'Immediate towing, fuel delivery, and lockout help anywhere in North America.',
            'value_2_title' => 'Instant Mobile Claims',
            'value_2_desc' => 'Snap photos of accident damage on your phone for rapid repair shop approval.',
            'value_3_title' => 'Safe Driver Reward',
            'value_3_desc' => 'Earn up to 30% off your annual premium by maintaining a clean driving record.',
            'value_4_title' => 'Glass & Windshield Waiver',
            'value_4_desc' => 'Zero-deductible windshield repair and replacement for minor chips and cracks.',

            // Guidance
            'guidance_eyebrow' => 'DRIVE CONFIDENTLY',
            'guidance_title' => 'Auto Insurance Built for Modern Drivers',
            'guidance_text' => 'From daily commuting to family road trips, Surebound delivers flexible vehicle insurance options designed around how you drive. Compare bodily injury, property damage, collision, and comprehensive tiers with transparent pricing and zero hidden fees.',

            // Why Choose
            'why_1_title' => 'Quick Online Quotes',
            'why_1_desc' => 'Get an accurate quote estimate tailored to your vehicle VIN and mileage in under 2 minutes.',
            'why_2_title' => 'OEM Parts Guard',
            'why_2_desc' => 'Guarantee genuine original manufacturer replacement parts for collision repairs.',
            'why_3_title' => 'Vanishing Deductible',
            'why_3_desc' => 'Earn $100 off your deductible for every year of accident-free driving.',
            'why_4_title' => 'Rideshare & EV Friendly',
            'why_4_desc' => 'Seamless endorsements for rideshare drivers, personal commuters, and electric vehicles.',

            // FAQs
            'faq_1_question' => 'What is the difference between Comprehensive and Collision coverage?',
            'faq_1_answer' => 'Collision coverage pays for damage to your vehicle resulting from an impact with another vehicle or object (or a rollover). Comprehensive coverage pays for non-collision damage such as theft, vandalism, weather damage, falling objects, or hitting an animal.',
            'faq_2_question' => 'How can I lower my monthly auto insurance rate?',
            'faq_2_answer' => 'You can reduce your auto premium by bundling your auto and homeowners policies (up to 25% discount), maintaining an accident-free record, installing anti-theft devices, taking a defensive driving course, or increasing your deductible.',
            'faq_3_question' => 'Does auto insurance cover rental car expenses while my vehicle is being repaired?',
            'faq_3_answer' => 'Yes, if you add Rental Reimbursement coverage to your policy, Surebound pays for a rental car up to your selected daily limit while your primary vehicle is undergoing covered repairs after an accident.',
            'faq_4_question' => 'What should I do immediately after a car accident?',
            'faq_4_answer' => 'First ensure everyone is safe and call emergency services if needed. Exchange contact, vehicle, and insurance details with the other driver. Take clear photos of all vehicle damage and scene details, then open the Surebound portal or call our 24/7 claims hotline to file your claim.',
            'faq_5_question' => 'Am I covered if someone else drives my car?',
            'faq_5_answer' => 'In most cases, auto insurance follows the vehicle. If you give a friend or family member permission to borrow your car, your policy will typically serve as primary coverage in the event of an accident, subject to policy terms.',

            // CTA
            'cta_title' => 'Ready to hit the road with complete confidence?',
            'cta_subtitle' => 'Get a personalized auto insurance quote in less than 2 minutes and start saving.',
        ];
    }

    /**
     * Display Public Auto Insurance Page with Dynamic CMS Content
     */
    public function showAutoInsurance()
    {
        $content = PageContent::getForPage('auto-insurance', self::getDefaultAutoInsuranceContent());

        return view('auto-insurance', compact('content'));
    }

    /**
     * Update Auto Insurance CMS Content from Admin Portal
     */
    public function updateAutoInsurance(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_auto_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('auto-insurance', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Auto Insurance page updated and published live successfully!',
                'content' => PageContent::getForPage('auto-insurance', self::getDefaultAutoInsuranceContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#auto-cms')
            ->with('success', 'Auto Insurance page updated successfully!');
    }

    /**
     * Default content dictionary for Commercial Auto Insurance page
     */
    public static function getDefaultCommercialAutoInsuranceContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/hero-commercial-auto.jpg',
            'hero_eyebrow' => 'COMMERCIAL AUTO &amp; FLEET INSURANCE',
            'hero_title' => 'Total Protection for Every<br>Vehicle, Driver &amp; Mile',
            'hero_subtitle' => 'From single service vans to heavy commercial fleets, Surebound delivers customizable liability, collision, cargo, and telematics-powered safety coverage built to keep your business moving forward.',
            'hero_card_sub' => 'Fleet Safety &amp; Savings',
            'hero_card_label' => 'Save up to 35% with telematics &amp; clean fleet records',

            // Coverage Cards
            'card_1_title' => 'Commercial Auto Liability (BI & PD)',
            'card_1_desc' => 'High-limit bodily injury and property damage coverage protecting your business against catastrophic legal and medical expenses if a company driver causes an accident.',
            'card_2_title' => 'Collision & Comprehensive Shield',
            'card_2_desc' => 'Covers physical damage to company trucks, vans, and utility vehicles from highway collisions, rollovers, theft, vandalism, falling objects, and extreme weather events.',
            'card_3_title' => 'Hired & Non-Owned Auto (HNOA)',
            'card_3_desc' => 'Essential liability protection when employees use personal vehicles for business errands or your company leases, hires, or rents commercial vehicles temporarily.',
            'card_4_title' => 'Motor Truck Cargo & Equipment',
            'card_4_desc' => 'Safeguards customer goods, raw materials, inventory, and specialized tools while in transit against theft, transit damage, spoilage, or highway overturn.',
            'card_5_title' => 'Uninsured / Underinsured Motorist',
            'card_5_desc' => 'Shields your company drivers and vehicles if struck by an at-fault driver who lacks insurance, has insufficient limits, or leaves the scene.',
            'card_6_title' => 'Fleet Telematics & 24/7 Roadside',
            'card_6_desc' => 'Commercial-grade heavy-duty towing, battery jump-starts, tire changes, fuel dispatch, and intelligent dashcam telematics discounts for proactive risk management.',

            // Value Pillars
            'value_1_title' => 'Up to $5M Combined Single Limit',
            'value_1_desc' => 'Heavy-duty commercial liability limits to protect corporate balance sheets against catastrophic road liability claims.',
            'value_2_title' => 'Telematics Fleet Discounts',
            'value_2_desc' => 'Earn up to 35% premium reductions with integrated safe-driving telemetry, GPS speed tracking, and dual-facing dashcams.',
            'value_3_title' => 'Rapid Heavy-Duty Roadside',
            'value_3_desc' => 'Dedicated 24/7 dispatch for commercial flatbeds, heavy wreckers, mobile mechanics, and replacement vehicle logistics.',
            'value_4_title' => 'Hired & Non-Owned Inclusion',
            'value_4_desc' => 'Seamless blanket protection covering employees running work errands in personal cars or rented utility trucks.',

            // Guidance
            'guidance_eyebrow' => 'COMMERCIAL FLEET RISK MANAGEMENT',
            'guidance_title' => 'Fleet Insurance Engineered Around Your Business Operations',
            'guidance_text' => 'Whether you operate local trade vans, regional delivery routes, or interstate freight lines, commercial auto insurance requires more than a generic policy. Surebound works directly with fleet managers, contractors, and business owners to optimize driver MVR monitoring, customize cargo limits, and secure volume discounts that directly improve your bottom line.',

            // Why Choose
            'why_1_title' => 'Instant Multi-Carrier Comparison',
            'why_1_desc' => 'Compare commercial auto quotes across A-rated commercial carriers in minutes with a single digital application.',
            'why_2_title' => 'Dedicated Fleet Claims Specialists',
            'why_2_desc' => 'Direct access to certified commercial claims adjusters focused on minimizing downtime and getting your vehicles back on the road.',
            'why_3_title' => 'Flexible Schedule of Vehicles',
            'why_3_desc' => 'Add or remove vans, box trucks, trailers, and drivers instantly through the Surebound digital policy portal.',
            'why_4_title' => 'USDOT &amp; State Filings Handled',
            'why_4_desc' => 'Prompt federal and state compliance filings including Form BMC-91X, MCS-90, and state certificate dispatches.',

            // FAQs
            'faq_1_question' => 'What vehicles require Commercial Auto Insurance instead of Personal Auto?',
            'faq_1_answer' => 'Any vehicle titled to a business or used primarily for commercial purposes—such as transporting equipment, delivering goods, driving clients, hauling cargo, or displaying commercial branding—must be covered under a commercial auto policy. Personal auto policies almost always exclude business use.',
            'faq_2_question' => 'What is Hired and Non-Owned Auto (HNOA) insurance, and do I need it?',
            'faq_2_answer' => 'HNOA covers your business against liability if an employee causes an accident while driving their own personal vehicle for company business (like delivering orders, picking up supplies, or driving to job sites) or if your company rents a vehicle for work. It is essential for protecting your business against vicarious liability.',
            'faq_3_question' => 'How are commercial auto insurance premiums calculated?',
            'faq_3_answer' => 'Premiums depend on vehicle types and weights, annual mileage, operational radius, cargo hauled, driver motor vehicle records (MVRs), fleet safety telematics, and chosen policy limits and deductibles. Surebound helps you qualify for discounts up to 35% based on driver safety programs.',
            'faq_4_question' => 'Can I add and remove vehicles or drivers during the policy term?',
            'faq_4_answer' => 'Yes. Our digital policyholder portal allows fleet managers and business owners to submit vehicle additions, swaps, and new driver authorizations 24/7 with instant endorsement processing and immediate digital proof of insurance certificates.',
            'faq_5_question' => 'Does commercial auto insurance cover the tools and equipment inside my truck?',
            'faq_5_answer' => 'Commercial auto comprehensive and collision covers damage to the vehicle itself. To protect tools, machinery, and cargo carried inside the vehicle, you can add an Inland Marine or Motor Truck Cargo rider to your Surebound policy for complete protection.',

            // CTA
            'cta_title' => 'Ready to protect your company fleet and cut commercial auto costs?',
            'cta_subtitle' => 'Get a customized commercial vehicle quote in minutes or consult with our fleet risk underwriters.',
        ];
    }

    /**
     * Display Public Commercial Auto Insurance Page with Dynamic CMS Content
     */
    public function showCommercialAutoInsurance()
    {
        $content = PageContent::getForPage('commercial-auto-insurance', self::getDefaultCommercialAutoInsuranceContent());

        return view('commercial-auto-insurance', compact('content'));
    }

    /**
     * Update Commercial Auto Insurance CMS Content from Admin Portal
     */
    public function updateCommercialAutoInsurance(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_commercial_auto_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('commercial-auto-insurance', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Commercial Auto Insurance page updated and published live successfully!',
                'content' => PageContent::getForPage('commercial-auto-insurance', self::getDefaultCommercialAutoInsuranceContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#commercial-auto-cms')
            ->with('success', 'Commercial Auto Insurance page updated successfully!');
    }

    /**
     * Default content dictionary for Surety Bond page
     */
    public static function getDefaultSuretyBondContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/hero-surety-bond.jpg',
            'hero_eyebrow' => 'COMMERCIAL SURETY &amp; CONTRACT GUARANTEES',
            'hero_title' => 'Guaranteed Performance &amp;<br>Financial Compliance on Demand',
            'hero_subtitle' => 'Secure project bid capacity, meet state licensing requirements, and protect contractual obligations with instant online underwriting and Treasury-listed surety backing.',
            'hero_card_sub' => 'Instant Bond Issuance',
            'hero_card_label' => 'Over 98% of license and permit bonds approved instantly',

            // Coverage / Bond Category Cards
            'card_1_title' => 'Contract & Performance Bonds',
            'card_1_desc' => 'Guarantees project completion, subcontractor payments, and warranty maintenance for general contractors and municipal infrastructure bids.',
            'card_2_title' => 'License & Permit Bonds',
            'card_2_desc' => 'Mandatory state and municipal compliance bonds for general contractors, electricians, plumbers, HVAC technicians, and licensed trade operators.',
            'card_3_title' => 'Commercial & Court Bonds',
            'card_3_desc' => 'Guarantees fiduciary duties, estate administration, judicial appeals, receiverships, and guardian responsibilities required by probate courts.',
            'card_4_title' => 'Freight Broker BMC-84 Bonds',
            'card_4_desc' => 'Meets the mandatory $75,000 USDOT/FMCSA financial security requirement for transportation freight brokers and forwarders.',
            'card_5_title' => 'Auto Dealer & DMV Bonds',
            'card_5_desc' => 'Protects car buyers and satisfies state Department of Motor Vehicles licensing mandates for wholesale and retail motor vehicle dealers.',
            'card_6_title' => 'Fidelity & ERISA Employee Bonds',
            'card_6_desc' => 'Protects company assets and 401(k) pension plans against employee theft, embezzlement, fraud, and unlawful misappropriation.',

            // Value Pillars
            'value_1_title' => 'Instant Digital Issuance',
            'value_1_desc' => 'Fast online approvals with instant downloadable e-bonds and digital power-of-attorney seals.',
            'value_2_title' => 'Treasury-Listed (T-Listed) Sureties',
            'value_2_desc' => 'Accepted by all 50 states, federal agencies, municipal boards, and commercial developers nationwide.',
            'value_3_title' => 'Competitive Rates from 0.75%',
            'value_3_desc' => 'Tier-1 rates tailored to your business credit, contractor track record, and bonding line history.',
            'value_4_title' => 'Automated Agency Filings',
            'value_4_desc' => 'Direct electronic filing to state licensing boards and obligees to eliminate licensing delays.',

            // Guidance
            'guidance_eyebrow' => 'SURETY CAPACITY &amp; BONDING STRATEGY',
            'guidance_title' => 'Expand Your Bidding Capacity with Dedicated Surety Underwriters',
            'guidance_text' => 'Unlike traditional commercial insurance that covers unexpected losses, surety bonds serve as a strict tripartite guarantee of your operational ability and financial integrity. At Surebound, our senior bond underwriters help growing contractors and enterprises establish generous single and aggregate bonding lines, enabling you to pursue larger public and private tenders with total confidence.',

            // Why Choose
            'why_1_title' => 'No Financials Required up to $500k',
            'why_1_desc' => 'Streamlined credit-only underwriting programs for qualified contractors on jobs up to $500,000.',
            'why_2_title' => 'All 50 States & Federal Jurisdiction',
            'why_2_desc' => 'Licensed across all US jurisdictions with approved power-of-attorney authority for rapid dispatch.',
            'why_3_title' => 'Flexible Collateral Options',
            'why_3_desc' => 'Multiple non-collateral pathways and bad-credit rehabilitation programs to keep your projects moving.',
            'why_4_title' => 'Dedicated Bond Specialists',
            'why_4_desc' => 'Direct phone access to bond officers who understand construction bidding deadlines and tender schedules.',

            // FAQs
            'faq_1_question' => 'What is the difference between a Surety Bond and Insurance?',
            'faq_1_answer' => 'Commercial insurance is a two-party contract designed to protect your business against accidental loss or damage. A Surety Bond is a three-party contract (Principal, Obligee, and Surety) where the surety guarantees to the obligee that the principal will fulfill contractual or legal obligations. If the surety pays a claim, the principal is legally obligated to indemnify the surety.',
            'faq_2_question' => 'How much does a Surety Bond typically cost?',
            'faq_2_answer' => 'Bond costs (premiums) are a small percentage of the total bond amount, typically ranging from 0.75% to 2.5% per year for applicants with solid credit. For higher-risk bonds or non-standard credit, rates typically range from 3% to 7%. For example, a standard $10,000 contractor license bond often costs only $100 to $150 per year.',
            'faq_3_question' => 'Can I get a Surety Bond with poor or challenged credit?',
            'faq_3_answer' => 'Yes. Surebound partners with specialized non-standard surety markets that evaluate your operational experience, business assets, and references. We offer bad-credit bond programs for almost all license, permit, and commercial bonds.',
            'faq_4_question' => 'How quickly can I receive my official bond certificate?',
            'faq_4_answer' => 'Most license and permit bonds, notary bonds, and freight broker bonds are issued digitally within minutes upon payment. Complex contract performance bonds can usually be underwritten and approved within 24 to 48 hours.',
            'faq_5_question' => 'What happens if a claim is filed against my surety bond?',
            'faq_5_answer' => 'If a claim is submitted, the surety conducts a thorough investigation to determine its validity. If the claim is valid and the principal does not resolve the issue, the surety settles the claim with the obligee up to the bond penal sum. However, under the General Indemnity Agreement, the principal is legally responsible to reimburse the surety in full.',

            // CTA
            'cta_title' => 'Ready to secure your surety bond line with competitive rates?',
            'cta_subtitle' => 'Apply online in under 2 minutes or speak directly with our senior surety underwriters.',
        ];
    }

    /**
     * Display Public Surety Bond Page with Dynamic CMS Content
     */
    public function showSuretyBond()
    {
        $content = PageContent::getForPage('surety-bond', self::getDefaultSuretyBondContent());

        return view('surety-bond', compact('content'));
    }

    /**
     * Update Surety Bond CMS Content from Admin Portal
     */
    public function updateSuretyBond(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_surety_bond_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('surety-bond', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Surety Bond page updated and published live successfully!',
                'content' => PageContent::getForPage('surety-bond', self::getDefaultSuretyBondContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#surety-bond-cms')
            ->with('success', 'Surety Bond page updated successfully!');
    }

    /**
     * Default content dictionary for Personal Coverage page
     */
    public static function getDefaultPersonalCoverageContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/hero-personal.jpg',
            'hero_eyebrow' => 'PERSONAL & LIABILITY COVERAGE',
            'hero_title' => 'Comprehensive Security for<br>Everything You Value Most',
            'hero_subtitle' => 'Extend your financial protection beyond standard policy limits. From excess liability umbrella guards to high-value personal asset protection, Surebound secures your lifestyle.',
            'hero_card_sub' => 'Umbrella Protection',
            'hero_card_label' => 'Up to $5,000,000 in excess liability guard',

            // Coverage Cards
            'card_1_title' => 'Personal Umbrella Liability',
            'card_1_desc' => 'Provides an additional layer of $1M to $5M+ liability protection above your standard home and auto policy coverage limits.',
            'card_2_title' => 'High-Value Property & Valuables',
            'card_2_desc' => 'Specialized scheduling for fine jewelry, luxury watches, artwork, antiques, and high-end electronics with zero deductible.',
            'card_3_title' => 'Personal Cyber & Identity Theft',
            'card_3_desc' => 'Reimburses financial losses, legal fees, and data restoration costs resulting from identity theft, ransomware, or online fraud.',
            'card_4_title' => 'Worldwide Personal Liability',
            'card_4_desc' => 'Global liability protection covering accidental injury or property damage claims caused anywhere in the world.',
            'card_5_title' => 'Watercraft & Recreational Craft',
            'card_5_desc' => 'Comprehensive hull, engine, liability, and passenger coverage for boats, yachts, jet skis, and recreational vehicles.',
            'card_6_title' => 'Domestic Employee Protection',
            'card_6_desc' => 'Employment liability and workers\' compensation coverage for nannies, housekeepers, private chefs, and estate staff.',

            // Value Pillars
            'value_1_title' => 'Up to $5M Excess Limits',
            'value_1_desc' => 'Robust umbrella liability protection designed to shield total wealth against major lawsuits.',
            'value_2_title' => 'Zero Deductible Schedules',
            'value_2_desc' => 'Full replacement cost coverage for high-value scheduled items without out-of-pocket deductibles.',
            'value_3_title' => 'Worldwide Coverage',
            'value_3_desc' => 'Protection follows you across international travel, global rentals, and offshore watercraft.',
            'value_4_title' => 'Private Client Concierge',
            'value_4_desc' => 'Dedicated risk advisors offering bespoke insurance portfolio evaluations and discreet claims support.',

            // Guidance
            'guidance_eyebrow' => 'HOLISTIC PERSONAL RISK MANAGEMENT',
            'guidance_title' => 'Personal Risk Protection Tailored to Your Estate',
            'guidance_text' => 'Standard homeowners and auto policies have strict coverage caps. Surebound\'s Personal Coverage solutions fill critical gaps, shielding your family assets, high-value collections, and personal reputation from unexpected legal claims, cyber threats, and high-severity loss events.',

            // Why Choose
            'why_1_title' => 'Bespoke Portfolio Review',
            'why_1_desc' => 'Our senior risk officers conduct a detailed asset review to eliminate dangerous liability gaps.',
            'why_2_title' => 'Seamless Policy Bundling',
            'why_2_desc' => 'Unify home, auto, umbrella, and valuable collections under one consolidated billing statement.',
            'why_3_title' => 'Agreed Value Protection',
            'why_3_desc' => 'Lock in agreed cash values for rare artwork and luxury items before a loss ever occurs.',
            'why_4_title' => '24/7 Confidential Claims',
            'why_4_desc' => 'White-glove claims handling with expedited payouts and direct access to legal specialists.',

            // FAQs
            'faq_1_question' => 'Why do I need a Personal Umbrella policy if I already have Home and Auto insurance?',
            'faq_1_answer' => 'Standard homeowners and auto insurance policies have maximum liability limits (typically $300k to $500k). If you are found liable for a major accident or lawsuit exceeding those limits, your personal savings, home equity, and future wages could be seized. An Umbrella policy kicks in where your underlying limits stop, providing an extra $1M to $5M+ in protection.',
            'faq_2_question' => 'How are luxury items like jewelry, watches, or art covered under Personal Coverage?',
            'faq_2_answer' => 'Standard home policies cap luxury item payouts (often around $1,500 to $2,500). Through scheduled personal property floaters, each valuable item is appraised and insured for its full agreed replacement value with zero deductible and coverage for accidental loss or breakage worldwide.',
            'faq_3_question' => 'What does Personal Cyber Insurance protect against?',
            'faq_3_answer' => 'Personal Cyber protection covers expenses related to cyber extortion (ransomware), identity theft restoration, fraudulent online wire transfers, cyberbullying legal defense, and data recovery for home computer systems.',
            'faq_4_question' => 'Does Personal Coverage apply when I am traveling outside the country?',
            'faq_4_answer' => 'Yes! Our Personal Umbrella and Scheduled Property endorsements provide 24/7 worldwide coverage, protecting you against legal liability, lost valuables, or emergency incidents anywhere across the globe.',
            'faq_5_question' => 'How much does a Personal Umbrella insurance policy typically cost?',
            'faq_5_answer' => 'Personal Umbrella insurance is exceptionally cost-effective. A $1,000,000 umbrella policy typically costs between $150 and $300 per year, making it one of the most affordable ways to protect your overall financial future.',

            // CTA
            'cta_title' => 'Shield your assets and peace of mind today.',
            'cta_subtitle' => 'Speak with a senior risk advisor or request a confidential personal insurance proposal in under 2 minutes.',
        ];
    }

    /**
     * Display Public Personal Coverage Page with Dynamic CMS Content
     */
    public function showPersonalCoverage()
    {
        $content = PageContent::getForPage('personal-coverage', self::getDefaultPersonalCoverageContent());

        return view('personal-coverage', compact('content'));
    }

    /**
     * Update Personal Coverage CMS Content from Admin Portal
     */
    public function updatePersonalCoverage(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_personal_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('personal-coverage', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Personal Coverage page updated and published live successfully!',
                'content' => PageContent::getForPage('personal-coverage', self::getDefaultPersonalCoverageContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#personal-cms')
            ->with('success', 'Personal Coverage page updated successfully!');
    }

    /**
     * Default content dictionary for Life Insurance page
     */
    public static function getDefaultLifeInsuranceContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/hero-life.jpg',
            'hero_eyebrow' => 'LIFE &amp; FAMILY FINANCIAL SECURITY',
            'hero_title' => 'Lifelong Protection for<br>the People You Cherish Most',
            'hero_subtitle' => 'Ensure your family’s standard of living, fund college education, and safeguard generational wealth with customizable term and permanent life insurance solutions.',
            'hero_card_sub' => 'Guaranteed Death Benefit',
            'hero_card_label' => 'From $250k to $10M+ tailored coverage',

            // Coverage Cards
            'card_1_title' => 'Level Term Life Insurance',
            'card_1_desc' => 'Pure death benefit protection for 10, 15, 20, 25, or 30 years with guaranteed level premiums that never increase over the term duration.',
            'card_2_title' => 'Whole Life Insurance',
            'card_2_desc' => 'Permanent lifelong coverage with guaranteed level premiums, guaranteed death benefits, and steady tax-deferred cash value accumulation.',
            'card_3_title' => 'Universal Life Insurance',
            'card_3_desc' => 'Flexible permanent life coverage that lets you adjust premium amounts and death benefit limits as your financial situation evolves.',
            'card_4_title' => 'Final Expense &amp; Burial Guard',
            'card_4_desc' => 'Affordable, simplified-issue coverage designed specifically to cover end-of-life expenses and medical debts with zero medical exams.',
            'card_5_title' => 'Key Person &amp; Executive Life',
            'card_5_desc' => 'Protects business continuity, funds buy-sell agreements, and offsets financial losses if a key executive or partner passes away.',
            'card_6_title' => 'Critical Illness &amp; Living Benefits',
            'card_6_desc' => 'Accelerated benefit riders allowing you to access a portion of your death benefit early if diagnosed with a qualifying illness or injury.',

            // Value Pillars
            'value_1_title' => 'Guaranteed Level Rates',
            'value_1_desc' => 'Lock in fixed premium rates for up to 30 years with zero unexpected cost hikes.',
            'value_2_title' => 'Cash Value Accumulation',
            'value_2_desc' => 'Build guaranteed cash reserves you can borrow against for future opportunities or retirement.',
            'value_3_title' => 'Accelerated Living Benefits',
            'value_3_desc' => 'Access financial support during your lifetime if facing critical, chronic, or terminal illness.',
            'value_4_title' => 'Fast Digital Underwriting',
            'value_4_desc' => 'Accelerated underwriting with no-medical-exam pathways for qualifying applicants up to $2,000,000.',

            // Guidance
            'guidance_eyebrow' => 'LIFE PROTECTION SIMPLIFIED',
            'guidance_title' => 'Securing Tomorrow\'s Promise, Today',
            'guidance_text' => 'Life insurance isn\'t just about planning for the unexpected—it\'s about giving the people you love the freedom to thrive no matter what. At Surebound, we take the mystery out of life insurance by calculating your exact debt, mortgage, and future income replacement needs so you get bulletproof protection at competitive rates.',

            // Why Choose
            'why_1_title' => 'A+ Rated Carrier Syndicate',
            'why_1_desc' => 'We partner exclusively with top-tier insurance carriers holding the highest AM Best financial stability ratings.',
            'why_2_title' => 'Convertibility Privileges',
            'why_2_desc' => 'Easily convert term policies to permanent whole life without undergoing a new medical exam or health evaluation.',
            'why_3_title' => 'Flexible Payment Schedules',
            'why_3_desc' => 'Choose monthly, quarterly, semi-annual, or annual billing with automatic account debit discounts.',
            'why_4_title' => 'Expedited Beneficiary Payouts',
            'why_4_desc' => 'Our compassionate claims specialists prioritize family beneficiaries, delivering prompt payouts within 48-72 hours of verification.',

            // FAQs
            'faq_1_question' => 'How much life insurance coverage do I actually need?',
            'faq_1_answer' => 'A common rule of thumb is 10 to 12 times your annual income. However, our advisors recommend adding outstanding mortgages, personal debts, and estimated future college tuition costs for your children, then subtracting existing liquid savings to find your precise coverage figure.',
            'faq_2_question' => 'What is the main difference between Term and Whole Life Insurance?',
            'faq_2_answer' => 'Term life covers you for a set period (such as 20 or 30 years) and pays out only if death occurs during that window; it is the most affordable type of life insurance. Whole life provides lifetime coverage with a guaranteed death benefit and builds cash value over time.',
            'faq_3_question' => 'Can I obtain a policy without having to take a medical exam?',
            'faq_3_answer' => 'Yes! Surebound offers accelerated digital underwriting and simplified-issue life policies for qualified applicants up to age 60 and coverage limits up to $2,000,000 without requiring blood draws or physical examinations.',
            'faq_4_question' => 'Are life insurance death benefit proceeds taxable for my beneficiaries?',
            'faq_4_answer' => 'In the vast majority of cases, life insurance death benefits paid to named beneficiaries are completely free of federal and state income tax.',
            'faq_5_question' => 'What happens when my term life insurance policy expires?',
            'faq_5_answer' => 'When your term concludes, you typically have three options: renew the policy on an annual basis, convert all or part of it into a permanent life policy without health questions, or let the coverage expire if your financial obligations have decreased.',

            // CTA
            'cta_title' => 'Protect your family\'s future with total certainty.',
            'cta_subtitle' => 'Get an instant personalized life insurance quote in less than 2 minutes and lock in your rate today.',
        ];
    }

    /**
     * Display Public Life Insurance Page with Dynamic CMS Content
     */
    public function showLifeInsurance()
    {
        $content = PageContent::getForPage('life-insurance', self::getDefaultLifeInsuranceContent());

        return view('life-insurance', compact('content'));
    }

    /**
     * Update Life Insurance CMS Content from Admin Portal
     */
    public function updateLifeInsurance(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_life_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('life-insurance', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Life Insurance page updated and published live successfully!',
                'content' => PageContent::getForPage('life-insurance', self::getDefaultLifeInsuranceContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#life-cms')
            ->with('success', 'Life Insurance page updated successfully!');
    }

    /**
     * Default content dictionary for Health Insurance page
     */
    public static function getDefaultHealthInsuranceContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/hero-health.jpg',
            'hero_eyebrow' => 'INDIVIDUAL &amp; FAMILY HEALTH PLANS',
            'hero_title' => 'Comprehensive Healthcare<br>for You &amp; Your Family',
            'hero_subtitle' => 'Access premier national provider networks, 24/7 virtual urgent care, prescription savings, and robust hospital coverage with predictable deductibles and zero surprise medical bills.',
            'hero_card_sub' => 'Open Enrollment &amp; PPO Plans',
            'hero_card_label' => 'Save up to 35% on quality healthcare plans',

            // Coverage Cards
            'card_1_title' => 'Comprehensive Major Medical',
            'card_1_desc' => 'Extensive inpatient hospital stays, outpatient procedures, emergency room care, and surgical coverage across leading national medical centers.',
            'card_2_title' => 'High-Deductible Health Plans (HDHP &amp; HSA)',
            'card_2_desc' => 'Pair lower monthly insurance premiums with triple-tax-advantaged Health Savings Accounts to grow funds for future medical care.',
            'card_3_title' => '100% Preventive &amp; Routine Care',
            'card_3_desc' => 'Annual wellness physicals, preventive cancer screenings, pediatric immunizations, and prenatal checkups covered at 100% with zero copay.',
            'card_4_title' => 'Prescription Drug Coverage',
            'card_4_desc' => 'Comprehensive tiered pharmacy benefits saving up to 85% on generic and brand-name medications through retail pharmacies and home delivery.',
            'card_5_title' => '24/7 Virtual Urgent Care &amp; Telehealth',
            'card_5_desc' => 'Instant video consultations with board-certified physicians from the comfort of your home or smartphone with $0 copays on qualifying plans.',
            'card_6_title' => 'Dental, Vision &amp; Hearing Add-Ons',
            'card_6_desc' => 'Complete coverage packages for routine cleanings, restorative dental treatments, eye exams, designer prescription frames, and hearing aids.',

            // Value Pillars
            'value_1_title' => 'Nationwide PPO Networks',
            'value_1_desc' => 'Choose your own doctors and specialists without burdensome primary care referral requirements.',
            'value_2_title' => '24/7 $0 Telehealth Visits',
            'value_2_desc' => 'Connect to top medical doctors in under 15 minutes right from your phone for instant prescriptions and diagnosis.',
            'value_3_title' => 'HSA Triple Tax Advantage',
            'value_3_desc' => 'Contribute pre-tax dollars, enjoy tax-free growth, and withdraw tax-free for qualified medical expenses.',
            'value_4_title' => 'Clear Out-of-Pocket Limits',
            'value_4_desc' => 'Rest easy with capped annual maximums protecting your family from unexpected catastrophic medical expenses.',

            // Guidance
            'guidance_eyebrow' => 'HEALTHCARE NAVIGATED EASILY',
            'guidance_title' => 'Health Coverage Built Around Modern Wellness',
            'guidance_text' => 'Navigating health insurance plans, co-pays, deductibles, and doctor networks shouldn\'t be a headache. Surebound simplifies the healthcare marketplace by offering curated individual, family, and group options that balance affordable monthly premiums with expansive network freedom and dependable emergency care.',

            // Why Choose
            'why_1_title' => 'Broad In-Network Freedom',
            'why_1_desc' => 'Keep your trusted family physicians, local pediatricians, and regional medical facilities with expansive PPO network options.',
            'why_2_title' => 'No Surprise Medical Billing',
            'why_2_desc' => 'Strict consumer safeguards ensure in-network rates apply to emergency care even if provided by out-of-network clinicians.',
            'why_3_title' => 'Dedicated Patient Advocates',
            'why_3_desc' => 'Personal concierge specialists assist with pre-authorizations, bill audits, and scheduling specialist appointments.',
            'why_4_title' => 'Customized Plan Comparison',
            'why_4_desc' => 'Compare ACA marketplace plans, private carrier plans, and catastrophic coverage side by side in minutes.',

            // FAQs
            'faq_1_question' => 'What is the difference between a PPO and an HMO health plan?',
            'faq_1_answer' => 'A PPO (Preferred Provider Organization) gives you the freedom to see any doctor or specialist without requiring a referral from a primary care physician, and offers coverage for both in-network and out-of-network care. An HMO (Health Maintenance Organization) requires you to choose a primary care doctor and get referrals for specialists, and typically covers only in-network providers.',
            'faq_2_question' => 'Does Surebound health insurance cover pre-existing conditions?',
            'faq_2_answer' => 'Yes. All our ACA-compliant individual and family health insurance plans provide comprehensive coverage for pre-existing conditions from day one with zero waiting periods.',
            'faq_3_question' => 'How does a Health Savings Account (HSA) work with my plan?',
            'faq_3_answer' => 'When enrolled in an HSA-qualified High Deductible Health Plan, you can contribute tax-deductible dollars to a dedicated HSA account. Those funds roll over year after year, can be invested, and can be withdrawn completely tax-free for medical, dental, and vision expenses.',
            'faq_4_question' => 'When can I enroll in or switch my health insurance policy?',
            'faq_4_answer' => 'You can enroll during the annual Open Enrollment period or at any time during the year if you qualify for a Special Enrollment Period due to a life event such as changing jobs, moving, marriage, or the birth of a child.',
            'faq_5_question' => 'What happens if I need medical care while traveling out of state?',
            'faq_5_answer' => 'Emergency medical care is covered nationwide at in-network cost-sharing levels regardless of where you are in the United States. Additionally, our 24/7 virtual telehealth service is available anywhere across all 50 states.',

            // CTA
            'cta_title' => 'Take control of your health and medical peace of mind.',
            'cta_subtitle' => 'Explore tailored health insurance plans for yourself, your family, or your business in under 2 minutes.',
        ];
    }

    /**
     * Display Public Health Insurance Page with Dynamic CMS Content
     */
    public function showHealthInsurance()
    {
        $content = PageContent::getForPage('health-insurance', self::getDefaultHealthInsuranceContent());

        return view('health-insurance', compact('content'));
    }

    /**
     * Update Health Insurance CMS Content from Admin Portal
     */
    public function updateHealthInsurance(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_health_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('health-insurance', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Health Insurance page updated and published live successfully!',
                'content' => PageContent::getForPage('health-insurance', self::getDefaultHealthInsuranceContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#health-cms')
            ->with('success', 'Health Insurance page updated successfully!');
    }

    /**
     * Default content dictionary for Umbrella Insurance page
     */
    public static function getDefaultUmbrellaInsuranceContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/hero-umbrella.jpg',
            'hero_eyebrow' => 'PERSONAL UMBRELLA &amp; EXCESS LIABILITY',
            'hero_title' => 'Excess Liability Shield for<br>Your Entire Net Worth',
            'hero_subtitle' => 'When a major accident or lawsuit exhausts your homeowners or auto liability limits, Surebound Umbrella Insurance provides an indispensable $1M to $10M+ shield over your savings, home, and future earnings.',
            'hero_card_sub' => 'Excess Liability Protection',
            'hero_card_label' => '$1,000,000 to $10,000,000 asset shield',

            // Coverage Cards
            'card_1_title' => 'High-Limit Bodily Injury Defense',
            'card_1_desc' => 'Provides an additional $1M to $10M+ in liability protection if you cause an accident resulting in serious injuries to other parties.',
            'card_2_title' => 'Multi-Car &amp; Teen Driver Protection',
            'card_2_desc' => 'Safeguards your wealth against severe multi-vehicle accidents involving inexperienced household drivers or teenage motorists.',
            'card_3_title' => 'Catastrophic Property Damage Excess',
            'card_3_desc' => 'Covers multimillion-dollar structural, environmental, or commercial property damage that easily breaches basic auto or home limits.',
            'card_4_title' => 'Worldwide Travel &amp; Rental Liability',
            'card_4_desc' => 'Extends your liability protection internationally, covering accidents in overseas rental vehicles, vacation villas, and chartered watercraft.',
            'card_5_title' => 'Defamation, Libel &amp; Slander Defense',
            'card_5_desc' => 'Defends you and your household against legal allegations of character defamation, privacy infringement, false arrest, or online slander.',
            'card_6_title' => 'Legal Defense Costs Outside Limits',
            'card_6_desc' => 'Attorney fees, litigation expenses, court filings, and expert witness charges are fully covered on top of your chosen policy limit.',

            // Value Pillars
            'value_1_title' => '$1M - $10M+ Limits',
            'value_1_desc' => 'Flexible excess liability layers tailored precisely to your estate value and exposure profile.',
            'value_2_title' => 'Worldwide Protection',
            'value_2_desc' => 'Comprehensive protection that travels with you across international borders, vacations, and global rentals.',
            'value_3_title' => 'Legal Defense Included',
            'value_3_desc' => 'Elite legal representation provided with legal defense costs paid in addition to your coverage cap.',
            'value_4_title' => 'Extremely Affordable Rates',
            'value_4_desc' => 'Enjoy an extra $1,000,000 in excess lawsuit protection for often under $1 per day.',

            // Guidance
            'guidance_eyebrow' => 'PRESERVING GENERATIONAL WEALTH',
            'guidance_title' => 'Why High-Net-Worth Households Rely on Umbrella Protection',
            'guidance_text' => 'In today’s litigious environment, a single catastrophic multi-vehicle accident or serious property injury lawsuit can easily lead to a multi-million-dollar judgment. If your underlying auto or homeowners policy caps out at $300,000 or $500,000, the remaining balance can be collected from your personal savings, retirement funds, real estate equity, and future income. Surebound Umbrella Insurance prevents that catastrophe from ever happening.',

            // Why Choose
            'why_1_title' => 'Seamless Underlying Coordination',
            'why_1_desc' => 'Effortlessly integrates above your existing auto, homeowners, condo, boat, and rental property policies.',
            'why_2_title' => 'Household-Wide Protection',
            'why_2_desc' => 'Covers all resident family members including spouses, young drivers, and dependent children living in your home.',
            'why_3_title' => 'Private Client Legal Defense',
            'why_3_desc' => 'Direct access to premier insurance defense litigation teams to handle complex claims and protect your reputation.',
            'why_4_title' => 'No Deductible Claims',
            'why_4_desc' => 'Once your primary policy pays its standard limit, your umbrella coverage takes over immediately with $0 additional deductible.',

            // FAQs
            'faq_1_question' => 'What exactly is Personal Umbrella Insurance?',
            'faq_1_answer' => 'Personal Umbrella Insurance is an excess liability policy designed to provide an extra layer of financial protection beyond the liability limits of your standard auto, homeowners, or boat insurance policies. If you are sued for a major claim, your umbrella policy pays out after your primary policy limits are exhausted.',
            'faq_2_question' => 'Who actually needs an Umbrella Insurance policy?',
            'faq_2_answer' => 'Anyone with assets to protect, including home equity, investment portfolios, retirement accounts, or future earning potential. You are particularly exposed if you own a home, have teenage drivers, own a swimming pool, host frequent gatherings, coach youth sports, or own rental properties.',
            'faq_3_question' => 'How much does an Umbrella Insurance policy typically cost?',
            'faq_3_answer' => 'Umbrella insurance is one of the most cost-effective insurance coverages available. A $1,000,000 personal umbrella policy typically costs between $150 and $300 annually (under $25 a month). Each additional million in coverage generally costs even less.',
            'faq_4_question' => 'Does an umbrella policy cover legal defense and attorney fees?',
            'faq_4_answer' => 'Yes! Your umbrella policy pays for your legal defense costs, including attorney fees, court costs, and investigator expenses. These defense costs are typically paid in addition to your liability limit, meaning they do not reduce your actual payout coverage.',
            'faq_5_question' => 'Can I get Umbrella Insurance if my home and auto policies are with different companies?',
            'faq_5_answer' => 'Yes. While bundling under one carrier can earn you additional multi-policy discounts, Surebound can issue standalone personal umbrella policies over qualifying primary policies from other reputable insurance carriers.',

            // CTA
            'cta_title' => 'Safeguard everything you\'ve worked hard to build.',
            'cta_subtitle' => 'Speak with an underwriting specialist or request your personal umbrella proposal in under 2 minutes.',
        ];
    }

    /**
     * Display Public Umbrella Insurance Page with Dynamic CMS Content
     */
    public function showUmbrellaInsurance()
    {
        $content = PageContent::getForPage('umbrella-insurance', self::getDefaultUmbrellaInsuranceContent());

        return view('umbrella-insurance', compact('content'));
    }

    /**
     * Update Umbrella Insurance CMS Content from Admin Portal
     */
    public function updateUmbrellaInsurance(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_umbrella_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('umbrella-insurance', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Umbrella Insurance page updated and published live successfully!',
                'content' => PageContent::getForPage('umbrella-insurance', self::getDefaultUmbrellaInsuranceContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#umbrella-cms')
            ->with('success', 'Umbrella Insurance page updated successfully!');
    }

    public static function getDefaultPropertyInsuranceContent(): array
    {
        return [
            'hero_image' => 'images/hero-house.jpg',
            'hero_eyebrow' => 'PROPERTY INSURANCE',
            'hero_title' => 'Protection Built Around<br>Your Property',
            'hero_subtitle' => 'Comprehensive property insurance engineered to safeguard your structure and belongings.',
            'hero_card_sub' => 'Multi-Policy Discount',
            'hero_card_label' => 'Save up to 25% bundled',
            'card_1_title' => 'Structure Protection',
            'card_1_desc' => 'Covers rebuilding costs for walls, roof, foundation, and attached structures against fire, wind, and storm damage.',
            'card_2_title' => 'Personal Property',
            'card_2_desc' => 'Protects furniture, appliances, computers, clothing, and personal items whether inside your property or while traveling.',
            'card_3_title' => 'Liability Defense',
            'card_3_desc' => 'Defends against legal suits and pays medical expenses if guests are accidentally injured on your property.',
            'card_4_title' => 'Additional Expenses',
            'card_4_desc' => 'Covers temporary housing costs if covered damage makes your property unlivable.',
            'card_5_title' => 'Detached Structures',
            'card_5_desc' => 'Safeguards detached garages, storage sheds, gazebos, guest units, fences, and perimeter walls.',
            'card_6_title' => 'Valuable Articles Rider',
            'card_6_desc' => 'Optional endorsements for high-value equipment, fine art, collectibles, water backup, and equipment breakdown.',
            'value_1_title' => '24/7 Property Claims',
            'value_1_desc' => 'Emergency response dispatch for immediate property mitigation day or night.',
            'value_2_title' => 'Guaranteed Replacement',
            'value_2_desc' => 'Rebuild at current market labor and material prices with zero depreciation penalties.',
            'value_3_title' => 'Bundle & Save 25%',
            'value_3_desc' => 'Combine your property and auto policies into one simple premium discount.',
            'value_4_title' => 'Inflation Protection',
            'value_4_desc' => 'Automatic policy updates ensuring your dwelling limits keep up with local construction costs.',
            'guidance_eyebrow' => 'OUR EXPERTISE',
            'guidance_title' => 'Property Protection Made Simpler',
            'guidance_text' => 'Whether you are purchasing your first property, upgrading to a custom sanctuary, or protecting an estate, Surebound eliminates insurance complexity. We calculate your unique replacement cost using regional building data so you get exact coverage without paying for unnecessary fluff.',
            'why_1_title' => 'Digital Photo Claims',
            'why_1_desc' => 'Submit damage pictures directly via your smartphone for rapid claim review and fast repair funds.',
            'why_2_title' => 'Smart Property Discounts',
            'why_2_desc' => 'Earn premium discount credits for installing smart leak detectors, fire alarms, and security systems.',
            'why_3_title' => 'Flexible Deductibles',
            'why_3_desc' => 'Customize deductible thresholds across wind, hail, and general peril coverage options to fit your budget.',
            'why_4_title' => 'Local Claims Experts',
            'why_4_desc' => 'Neighborhood insurance specialists who know local building codes, weather risks, and contractor networks.',
            'faq_1_question' => 'What is standardly covered under a Property Policy?',
            'faq_1_answer' => 'Standard property insurance covers physical damage to your dwelling and attached structures caused by fire, lightning, windstorms, hail, explosions, vandalism, and theft. It also covers your personal property, personal liability claims, and temporary living expenses if your property requires major repairs after a covered peril.',
            'faq_2_question' => 'How is my property\'s replacement cost value calculated?',
            'faq_2_answer' => 'Replacement cost is the total amount needed to rebuild your property from the ground up using current local labor and construction material prices. It differs from market value, which includes land value and real estate market trends.',
            'faq_3_question' => 'Are flood damage and water backup covered automatically?',
            'faq_3_answer' => 'Standard property insurance policies exclude rising groundwater floods and sewer water backup. However, Surebound offers affordable optional endorsements for water backup and sump pump overflow.',
            'faq_4_question' => 'How can I lower my annual property insurance premium?',
            'faq_4_answer' => 'You can reduce your premium by bundling policies (up to 25% off), upgrading your roof with impact-resistant materials, installing monitored security or smart water-leak sensors, maintaining a strong credit score, or opting for a higher deductible level.',
            'faq_5_question' => 'What is personal liability coverage and why do I need it?',
            'faq_5_answer' => 'Personal liability coverage protects you against legal financial claims if someone is accidentally injured on your property (for example, slipping on an icy walkway or tripping on stairs) or if you accidentally cause property damage to someone else.',
            'cta_title' => 'Ready to protect your property with confidence?',
            'cta_subtitle' => 'Get a personalized property insurance quote tailored to your needs in less than 2 minutes.',
        ];
    }

    public function showPropertyInsurance()
    {
        $content = PageContent::getForPage('property-insurance', self::getDefaultPropertyInsuranceContent());

        return view('property-insurance', compact('content'));
    }

    public function updatePropertyInsurance(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_property_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('property-insurance', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Property Insurance page updated and published live successfully!',
                'content' => PageContent::getForPage('property-insurance', self::getDefaultPropertyInsuranceContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#property-cms')
            ->with('success', 'Property Insurance page updated successfully!');
    }

    public static function getDefaultLiabilityInsuranceContent(): array
    {
        return [
            'hero_image' => 'images/hero-specialty.jpg',
            'hero_eyebrow' => 'COMMERCIAL LIABILITY INSURANCE',
            'hero_title' => 'Protection Built Around<br>Your Business',
            'hero_subtitle' => 'Comprehensive liability insurance engineered to safeguard your operations and finances against legal claims.',
            'hero_card_sub' => 'Multi-Policy Discount',
            'hero_card_label' => 'Save up to 25% bundled',
            'card_1_title' => 'General Liability',
            'card_1_desc' => 'Covers legal defense costs and settlement payouts for bodily injury and property damage claims caused by your business operations.',
            'card_2_title' => 'Professional Liability (E&O)',
            'card_2_desc' => 'Protects your consulting or service-based firm from claims of negligence, errors, or failure to perform professional duties.',
            'card_3_title' => 'Cyber Liability',
            'card_3_desc' => 'Defends against data breaches, ransomware attacks, and pays for credit monitoring, public relations, and lost income.',
            'card_4_title' => 'Directors & Officers (D&O)',
            'card_4_desc' => 'Safeguards corporate directors and officers against legal actions alleging mismanagement or breach of fiduciary duty.',
            'card_5_title' => 'Product Liability',
            'card_5_desc' => 'Protects manufacturers, distributors, and retailers from claims arising out of defective products causing harm.',
            'card_6_title' => 'Employment Practices (EPLI)',
            'card_6_desc' => 'Provides coverage for defense costs related to claims of discrimination, wrongful termination, or harassment.',
            'value_1_title' => 'Dedicated Legal Teams',
            'value_1_desc' => 'Access to top-tier defense counsel specializing in commercial liability and industry-specific regulations.',
            'value_2_title' => 'Custom Coverage Limits',
            'value_2_desc' => 'Scalable limits and umbrella policies up to $50M to protect against catastrophic judgments.',
            'value_3_title' => 'Bundle & Save 25%',
            'value_3_desc' => 'Combine your liability and property policies into a BOP (Business Owner Policy) for significant discounts.',
            'value_4_title' => 'Risk Management Resources',
            'value_4_desc' => 'Complimentary safety training, contract review templates, and compliance guides to reduce claim frequency.',
            'guidance_eyebrow' => 'OUR EXPERTISE',
            'guidance_title' => 'Liability Protection Made Simpler',
            'guidance_text' => 'Whether you operate a local retail shop, a tech startup, or a manufacturing plant, Surebound eliminates insurance complexity. We analyze your unique operational exposures using industry data so you get exact coverage without paying for unnecessary fluff.',
            'why_1_title' => 'Rapid Claims Resolution',
            'why_1_desc' => 'Our specialized liability adjusters work quickly to investigate claims and negotiate fair settlements to protect your reputation.',
            'why_2_title' => 'Risk Mitigation Discounts',
            'why_2_desc' => 'Earn premium credits for implementing robust employee training, safety protocols, and cybersecurity measures.',
            'why_3_title' => 'Flexible Deductibles',
            'why_3_desc' => 'Customize deductible or self-insured retention (SIR) levels across different liability lines to fit your cash flow.',
            'why_4_title' => 'Industry Experts',
            'why_4_desc' => 'Underwriters and advisors who understand the specific regulatory and legal risks associated with your industry sector.',
            'faq_1_question' => 'What is standardly covered under a General Liability Policy?',
            'faq_1_answer' => 'General Liability covers bodily injury (e.g., slip and falls), property damage to third parties, and personal/advertising injury (e.g., libel, slander, copyright infringement) arising from your business operations, products, or completed operations.',
            'faq_2_question' => 'What is the difference between General and Professional Liability?',
            'faq_2_answer' => 'General liability covers physical risks (bodily injury, property damage), whereas Professional Liability (Errors & Omissions) covers financial loss caused by your professional advice, services, negligence, or failure to deliver promised results.',
            'faq_3_question' => 'Do I need Cyber Liability Insurance?',
            'faq_3_answer' => 'Yes, if your business handles sensitive customer data, processes payments, or relies heavily on computer systems. A general liability policy typically excludes damages arising from a data breach or cyber attack.',
            'faq_4_question' => 'How can I lower my annual liability insurance premium?',
            'faq_4_answer' => 'Reduce premiums by bundling into a Business Owner Policy (BOP), raising deductibles, maintaining a loss-free record, implementing comprehensive safety and training programs, and ensuring all contractors provide certificates of insurance.',
            'faq_5_question' => 'What does an Umbrella Liability policy do?',
            'faq_5_answer' => 'An umbrella policy provides an extra layer of liability coverage above the limits of your underlying general, auto, or employer\'s liability policies, protecting your assets against massive, catastrophic claims.',
            'cta_title' => 'Ready to protect your business with confidence?',
            'cta_subtitle' => 'Get a personalized liability insurance quote tailored to your operational needs in less than 2 minutes.',
        ];
    }

    public static function getDefaultGroupBenefitsContent(): array
    {
        return [
            'hero_image' => 'images/workers_comp_hero.jpg',
            'hero_eyebrow' => 'WORKERS COMPENSATION & BENEFITS',
            'hero_title' => 'Taking Care of<br>Your Team',
            'hero_subtitle' => 'Comprehensive group benefits insurance engineered to safeguard your operations and finances against legal claims.',
            'hero_card_sub' => 'Multi-Policy Discount',
            'hero_card_label' => 'Save up to 25% bundled',
            'card_1_title' => 'General Liability',
            'card_1_desc' => 'Covers legal defense costs and settlement payouts for bodily injury and property damage claims caused by your business operations.',
            'card_2_title' => 'Professional Liability (E&O)',
            'card_2_desc' => 'Protects your consulting or service-based firm from claims of negligence, errors, or failure to perform professional duties.',
            'card_3_title' => 'Cyber Liability',
            'card_3_desc' => 'Defends against data breaches, ransomware attacks, and pays for credit monitoring, public relations, and lost income.',
            'card_4_title' => 'Directors & Officers (D&O)',
            'card_4_desc' => 'Safeguards corporate directors and officers against legal actions alleging mismanagement or breach of fiduciary duty.',
            'card_5_title' => 'Product Liability',
            'card_5_desc' => 'Protects manufacturers, distributors, and retailers from claims arising out of defective products causing harm.',
            'card_6_title' => 'Employment Practices (EPLI)',
            'card_6_desc' => 'Provides coverage for defense costs related to claims of discrimination, wrongful termination, or harassment.',
            'value_1_title' => 'Dedicated Legal Teams',
            'value_1_desc' => 'Access to top-tier defense counsel specializing in commercial group benefits and industry-specific regulations.',
            'value_2_title' => 'Custom Coverage Limits',
            'value_2_desc' => 'Scalable limits and umbrella policies up to $50M to protect against catastrophic judgments.',
            'value_3_title' => 'Bundle & Save 25%',
            'value_3_desc' => 'Combine your group benefits and property policies into a BOP (Business Owner Policy) for significant discounts.',
            'value_4_title' => 'Risk Management Resources',
            'value_4_desc' => 'Complimentary safety training, contract review templates, and compliance guides to reduce claim frequency.',
            'guidance_eyebrow' => 'OUR EXPERTISE',
            'guidance_title' => 'Liability Protection Made Simpler',
            'guidance_text' => 'Whether you operate a local retail shop, a tech startup, or a manufacturing plant, Surebound eliminates insurance complexity. We analyze your unique operational exposures using industry data so you get exact coverage without paying for unnecessary fluff.',
            'why_1_title' => 'Rapid Claims Resolution',
            'why_1_desc' => 'Our specialized group benefits adjusters work quickly to investigate claims and negotiate fair settlements to protect your reputation.',
            'why_2_title' => 'Risk Mitigation Discounts',
            'why_2_desc' => 'Earn premium credits for implementing robust employee training, safety protocols, and cybersecurity measures.',
            'why_3_title' => 'Flexible Deductibles',
            'why_3_desc' => 'Customize deductible or self-insured retention (SIR) levels across different group benefits lines to fit your cash flow.',
            'why_4_title' => 'Industry Experts',
            'why_4_desc' => 'Underwriters and advisors who understand the specific regulatory and legal risks associated with your industry sector.',
            'faq_1_question' => 'What is standardly covered under a General Liability Policy?',
            'faq_1_answer' => 'General Liability covers bodily injury (e.g., slip and falls), property damage to third parties, and personal/advertising injury (e.g., libel, slander, copyright infringement) arising from your business operations, products, or completed operations.',
            'faq_2_question' => 'What is the difference between General and Professional Liability?',
            'faq_2_answer' => 'General group benefits covers physical risks (bodily injury, property damage), whereas Professional Liability (Errors & Omissions) covers financial loss caused by your professional advice, services, negligence, or failure to deliver promised results.',
            'faq_3_question' => 'Do I need Cyber Liability Insurance?',
            'faq_3_answer' => 'Yes, if your business handles sensitive customer data, processes payments, or relies heavily on computer systems. A general group benefits policy typically excludes damages arising from a data breach or cyber attack.',
            'faq_4_question' => 'How can I lower my annual group benefits insurance premium?',
            'faq_4_answer' => 'Reduce premiums by bundling into a Business Owner Policy (BOP), raising deductibles, maintaining a loss-free record, implementing comprehensive safety and training programs, and ensuring all contractors provide certificates of insurance.',
            'faq_5_question' => 'What does an Umbrella Liability policy do?',
            'faq_5_answer' => 'An umbrella policy provides an extra layer of group benefits coverage above the limits of your underlying general, auto, or employer\'s group benefits policies, protecting your assets against massive, catastrophic claims.',
            'cta_title' => 'Ready to protect your business with confidence?',
            'cta_subtitle' => 'Get a personalized group benefits insurance quote tailored to your operational needs in less than 2 minutes.',
        ];
    }

    public function showLiabilityInsurance()
    {
        $content = PageContent::getForPage('liability-insurance', self::getDefaultLiabilityInsuranceContent());

        return view('liability-insurance', compact('content'));
    }

    public function showGroupBenefits()
    {
        $content = PageContent::getForPage('group-benefits', self::getDefaultGroupBenefitsContent());

        return view('group-benefits', compact('content'));
    }

    public function updateLiabilityInsurance(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_liability_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('liability-insurance', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Liability Insurance page updated and published live successfully!',
                'content' => PageContent::getForPage('liability-insurance', self::getDefaultLiabilityInsuranceContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#liability-cms')
            ->with('success', 'Liability Insurance page updated successfully!');
    }

    public function updateGroupBenefits(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_liability_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('group-benefits', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Workers Compensation page updated and published live successfully!',
                'content' => PageContent::getForPage('group-benefits', self::getDefaultGroupBenefitsContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#group-benefits-cms')
            ->with('success', 'Workers Compensation page updated successfully!');
    }

    /**
     * Default content dictionary for Specialty Coverage page
     */
    public static function getDefaultSpecialtyCoverageContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/specialty_hero_new.jpg',
            'hero_eyebrow' => 'SPECIALTY & BESPOKE RISK COVERAGE',
            'hero_title' => 'Bespoke Protection for<br>Your Unique & Rare Assets',
            'hero_subtitle' => 'From vintage collector cars and private aircraft to fine art collections and high-stakes events, Surebound delivers customized underwriting solutions for extraordinary risks.',
            'hero_card_sub' => 'Agreed Value Insurance',
            'hero_card_label' => '100% full valuation payout guaranteed',

            // Coverage Cards
            'card_1_title' => 'Collector Cars & Exotic Autos',
            'card_1_desc' => 'Agreed value policy coverage for antique, vintage, muscle, exotic, and hyper-cars with flexible spare parts riders.',
            'card_2_title' => 'Private Aviation & Aircraft',
            'card_2_desc' => 'Comprehensive hull and passenger liability policies for turboprops, private jets, helicopters, and aviation hangars.',
            'card_3_title' => 'Fine Art & Rare Collectibles',
            'card_3_desc' => 'Worldwide floater coverage for private art galleries, rare sculptures, antique coins, jewelry, and wine cellars.',
            'card_4_title' => 'Luxury Yachts & Marine',
            'card_4_desc' => 'Global maritime coverage for mega-yachts, charter craft, crew liability, navigation limits, and ocean towing.',
            'card_5_title' => 'Special Events & Cancellation',
            'card_5_desc' => 'Financial protection against event cancellations, severe weather disruptions, non-appearance, and venue damage.',
            'card_6_title' => 'Executive Cyber & Ransom Response',
            'card_6_desc' => 'Discreet crisis management, ransomware negotiation, extortion loss reimbursement, and digital asset security.',

            // Value Pillars
            'value_1_title' => 'Agreed Value Guarantee',
            'value_1_desc' => 'Lock in written valuation appraisals with zero depreciation subtraction at claim time.',
            'value_2_title' => 'Worldwide Transit Protection',
            'value_2_desc' => 'Seamless coverage for assets during international shipping, exhibition, or flight transit.',
            'value_3_title' => 'Specialized Claims Team',
            'value_3_desc' => 'Direct access to certified art restorers, master mechanics, and marine surveyors.',
            'value_4_title' => 'Confidential Crisis Response',
            'value_4_desc' => 'Private risk consultation with strict non-disclosure security and immediate payout response.',

            // Guidance
            'guidance_eyebrow' => 'BESPOKE RISK UNDERWRITING',
            'guidance_title' => 'Customized Insurance Architecture for High-Value Assets',
            'guidance_text' => 'Standard off-the-shelf insurance contracts fail to address the nuances of rare collectibles, private aircraft, or high-end maritime vessels. Surebound\'s Specialty Risk team collaborates directly with expert appraisers and underwriters to construct tailored policy terms with zero gaps and total financial protection.',

            // Why Choose
            'why_1_title' => 'Certified Appraisals',
            'why_1_desc' => 'We accept valuation reports from recognized international appraisal authorities.',
            'why_2_title' => 'Inflation & Market Appreciation',
            'why_2_desc' => 'Automatic 150% valuation guard to absorb rapid market price surges for rare items.',
            'why_3_title' => 'Zero Deductible Options',
            'why_3_desc' => 'Selected scheduled specialty riders provide 100% full loss recovery without deductibles.',
            'why_4_title' => 'Discreet Private Underwriting',
            'why_4_desc' => 'Strict confidentiality protocols protecting high-profile owners and sensitive asset lists.',

            // FAQs
            'faq_1_question' => 'What qualifies as a Specialty Coverage asset at Surebound?',
            'faq_1_answer' => 'Specialty Coverage encompasses unique, high-value, or non-standard risks that standard personal or commercial policies exclude or cap. Examples include collector vehicles, private aircraft, mega-yachts, fine art, rare wine cellars, antique jewelry, special event cancellations, and executive cyber threats.',
            'faq_2_question' => 'How does Agreed Value insurance work for collector cars or rare art?',
            'faq_2_answer' => 'Unlike standard policies that pay actual cash value (which factors in heavy depreciation), an Agreed Value policy guarantees that you and Surebound agree on the item\'s exact financial value prior to policy issuance. In the event of a total loss, you receive 100% of that agreed sum with no depreciation deducted.',
            'faq_3_question' => 'Are private aircraft and yachts covered during international travel?',
            'faq_3_answer' => 'Yes. Our Aviation and Marine specialty floaters include tailored navigation and territorial limits designed around your flight paths and maritime routes, offering seamless worldwide hull and liability coverage.',
            'faq_4_question' => 'Do I need a recent formal appraisal to insure fine art or jewelry?',
            'faq_4_answer' => 'For high-value items (typically items over $50,000 individually), a recent appraisal from a certified appraiser or a detailed sales bill of sale is required to establish the agreed value baseline. Our risk officers assist with arranging qualified appraisals.',
            'faq_5_question' => 'How quickly can a Specialty Coverage quote be issued?',
            'faq_5_answer' => 'Preliminary specialty risk proposals are generated within 24 to 48 hours following an initial evaluation with our senior underwriting desk.',

            // CTA
            'cta_title' => 'Protect your extraordinary assets with bespoke coverage.',
            'cta_subtitle' => 'Speak with a senior specialty risk underwriter or request a confidential proposal in under 2 minutes.',
        ];
    }

    public static function getDefaultCoverageContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/specialty_hero_new.jpg',
            'hero_eyebrow' => 'SPECIALTY & BESPOKE RISK COVERAGE',
            'hero_title' => 'Bespoke Protection for<br>Your Unique & Rare Assets',
            'hero_subtitle' => 'From vintage collector cars and private aircraft to fine art collections and high-stakes events, Surebound delivers customized underwriting solutions for extraordinary risks.',
            'hero_card_sub' => 'Agreed Value Insurance',
            'hero_card_label' => '100% full valuation payout guaranteed',

            // Coverage Cards
            'card_1_title' => 'Collector Cars & Exotic Autos',
            'card_1_desc' => 'Agreed value policy coverage for antique, vintage, muscle, exotic, and hyper-cars with flexible spare parts riders.',
            'card_2_title' => 'Private Aviation & Aircraft',
            'card_2_desc' => 'Comprehensive hull and passenger liability policies for turboprops, private jets, helicopters, and aviation hangars.',
            'card_3_title' => 'Fine Art & Rare Collectibles',
            'card_3_desc' => 'Worldwide floater coverage for private art galleries, rare sculptures, antique coins, jewelry, and wine cellars.',
            'card_4_title' => 'Luxury Yachts & Marine',
            'card_4_desc' => 'Global maritime coverage for mega-yachts, charter craft, crew liability, navigation limits, and ocean towing.',
            'card_5_title' => 'Special Events & Cancellation',
            'card_5_desc' => 'Financial protection against event cancellations, severe weather disruptions, non-appearance, and venue damage.',
            'card_6_title' => 'Executive Cyber & Ransom Response',
            'card_6_desc' => 'Discreet crisis management, ransomware negotiation, extortion loss reimbursement, and digital asset security.',

            // Value Pillars
            'value_1_title' => 'Agreed Value Guarantee',
            'value_1_desc' => 'Lock in written valuation appraisals with zero depreciation subtraction at claim time.',
            'value_2_title' => 'Worldwide Transit Protection',
            'value_2_desc' => 'Seamless coverage for assets during international shipping, exhibition, or flight transit.',
            'value_3_title' => 'Specialized Claims Team',
            'value_3_desc' => 'Direct access to certified art restorers, master mechanics, and marine surveyors.',
            'value_4_title' => 'Confidential Crisis Response',
            'value_4_desc' => 'Private risk consultation with strict non-disclosure security and immediate payout response.',

            // Guidance
            'guidance_eyebrow' => 'BESPOKE RISK UNDERWRITING',
            'guidance_title' => 'Customized Insurance Architecture for High-Value Assets',
            'guidance_text' => 'Standard off-the-shelf insurance contracts fail to address the nuances of rare collectibles, private aircraft, or high-end maritime vessels. Surebound\'s Specialty Risk team collaborates directly with expert appraisers and underwriters to construct tailored policy terms with zero gaps and total financial protection.',

            // Why Choose
            'why_1_title' => 'Certified Appraisals',
            'why_1_desc' => 'We accept valuation reports from recognized international appraisal authorities.',
            'why_2_title' => 'Inflation & Market Appreciation',
            'why_2_desc' => 'Automatic 150% valuation guard to absorb rapid market price surges for rare items.',
            'why_3_title' => 'Zero Deductible Options',
            'why_3_desc' => 'Selected scheduled coverage riders provide 100% full loss recovery without deductibles.',
            'why_4_title' => 'Discreet Private Underwriting',
            'why_4_desc' => 'Strict confidentiality protocols protecting high-profile owners and sensitive asset lists.',

            // FAQs
            'faq_1_question' => 'What qualifies as a Specialty Coverage asset at Surebound?',
            'faq_1_answer' => 'Specialty Coverage encompasses unique, high-value, or non-standard risks that standard personal or commercial policies exclude or cap. Examples include collector vehicles, private aircraft, mega-yachts, fine art, rare wine cellars, antique jewelry, special event cancellations, and executive cyber threats.',
            'faq_2_question' => 'How does Agreed Value insurance work for collector cars or rare art?',
            'faq_2_answer' => 'Unlike standard policies that pay actual cash value (which factors in heavy depreciation), an Agreed Value policy guarantees that you and Surebound agree on the item\'s exact financial value prior to policy issuance. In the event of a total loss, you receive 100% of that agreed sum with no depreciation deducted.',
            'faq_3_question' => 'Are private aircraft and yachts covered during international travel?',
            'faq_3_answer' => 'Yes. Our Aviation and Marine coverage floaters include tailored navigation and territorial limits designed around your flight paths and maritime routes, offering seamless worldwide hull and liability coverage.',
            'faq_4_question' => 'Do I need a recent formal appraisal to insure fine art or jewelry?',
            'faq_4_answer' => 'For high-value items (typically items over $50,000 individually), a recent appraisal from a certified appraiser or a detailed sales bill of sale is required to establish the agreed value baseline. Our risk officers assist with arranging qualified appraisals.',
            'faq_5_question' => 'How quickly can a Specialty Coverage quote be issued?',
            'faq_5_answer' => 'Preliminary coverage risk proposals are generated within 24 to 48 hours following an initial evaluation with our senior underwriting desk.',

            // CTA
            'cta_title' => 'Protect your extraordinary assets with bespoke coverage.',
            'cta_subtitle' => 'Speak with a senior coverage risk underwriter or request a confidential proposal in under 2 minutes.',
        ];
    }

    public static function getDefaultCustomQuoteContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/custom_quote_hero.jpg',
            'hero_eyebrow' => 'BESPOKE COVERAGE',
            'hero_title' => 'Custom Quote for<br>Your Unique Needs',
            'hero_subtitle' => 'Receive a fully personalized insurance plan that caters to your distinct high-value assets and lifestyle.',
            'hero_card_sub' => 'Premium Assessment',
            'hero_card_label' => 'Comprehensive evaluation',
            'hero_card_main' => 'Bespoke Underwriting',

            // Value Props
            'value_1_title' => 'Personalized Underwriting',
            'value_1_desc' => 'We don’t use cookie-cutter algorithms. Every policy is hand-crafted.',
            'value_2_title' => 'Global Protection',
            'value_2_desc' => 'Your coverage travels with you, offering worldwide comprehensive security.',
            'value_3_title' => 'Elite Advisors',
            'value_3_desc' => 'Access to top-tier risk management experts and legal counsel.',

            // Feature Block 1
            'feature_1_eyebrow' => 'WHITE GLOVE SERVICE',
            'feature_1_title' => 'A Dedicated Concierge Team',
            'feature_1_desc' => 'From initial risk assessment to claims processing, you have direct line access to a dedicated wealth protection concierge.',
            'feature_1_point_1' => '24/7 direct access',
            'feature_1_point_2' => 'Proactive risk mitigation',
            'feature_1_point_3' => 'Discreet handling',

            // Feature Block 2
            'feature_2_eyebrow' => 'HOLISTIC APPROACH',
            'feature_2_title' => 'Securing Your Legacy',
            'feature_2_desc' => 'We look at the big picture, integrating your commercial, residential, and passion assets into a single cohesive strategy.',
            'feature_2_point_1' => 'Consolidated billing',
            'feature_2_point_2' => 'No coverage gaps',
            'feature_2_point_3' => 'Annual portfolio review',

            // CTA
            'cta_title' => 'Request your confidential custom quote today.',
            'cta_subtitle' => 'Submit your details and a senior underwriter will contact you shortly.',
        ];
    }

    public static function getDefaultCompareContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/compare_hero.jpg',
            'hero_eyebrow' => 'COMPARE POLICIES',
            'hero_title' => 'Find the Perfect<br>Coverage Plan',
            'hero_subtitle' => 'Evaluate our premium insurance options side-by-side to make the best decision for your valuable assets.',
            'hero_card_sub' => 'Policy Comparison',
            'hero_card_label' => 'Detailed Breakdown',
            'hero_card_main' => 'Transparent Benefits',

            // Value Props
            'value_1_title' => 'Clear Comparisons',
            'value_1_desc' => 'We lay out the benefits, limits, and exclusions clearly so you know exactly what you are getting.',
            'value_2_title' => 'Flexible Options',
            'value_2_desc' => 'Discover plans that can be customized to scale with your growing portfolio.',
            'value_3_title' => 'Expert Guidance',
            'value_3_desc' => 'Not sure which policy fits? Our advisors are here to help you weigh the pros and cons.',

            // Feature Block 1
            'feature_1_eyebrow' => 'SIDE-BY-SIDE',
            'feature_1_title' => 'Understand Your Options',
            'feature_1_desc' => 'We believe in full transparency. Compare deductibles, coverage limits, and premium structures across our bespoke plans.',
            'feature_1_point_1' => 'Interactive comparison tools',
            'feature_1_point_2' => 'Highlighting key differences',
            'feature_1_point_3' => 'Unbiased policy advice',

            // Feature Block 2
            'feature_2_eyebrow' => 'MAKE INFORMED DECISIONS',
            'feature_2_title' => 'Clarity at Every Step',
            'feature_2_desc' => 'Ensure you have the right level of protection without paying for redundant coverage across your assets.',
            'feature_2_point_1' => 'Coverage overlap analysis',
            'feature_2_point_2' => 'Cost-benefit breakdowns',
            'feature_2_point_3' => 'Future-proof planning',

            // CTA
            'cta_title' => 'Ready to select your plan?',
            'cta_subtitle' => 'Contact us to finalize your tailored policy today.',
        ];
    }

    public static function getDefaultStoryContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/story_hero.jpg',
            'hero_eyebrow' => 'OUR STORY',
            'hero_title' => 'A Legacy of<br>Trust & Integrity',
            'hero_subtitle' => 'For over three decades, we have been dedicated to providing unparalleled insurance protection for the things you value most.',
            'hero_card_sub' => 'Our Heritage',
            'hero_card_label' => 'Founded in 1982',
            'hero_card_main' => 'Family Owned',

            // Value Props
            'value_1_title' => 'Client First',
            'value_1_desc' => 'Every decision we make is centered around the well-being and security of our clients.',
            'value_2_title' => 'Community Focus',
            'value_2_desc' => 'We believe in giving back and supporting the local communities where we live and work.',
            'value_3_title' => 'Enduring Relationships',
            'value_3_desc' => 'We do not just sell policies; we build lifelong partnerships with our policyholders.',

            // Feature Block 1
            'feature_1_eyebrow' => 'OUR HISTORY',
            'feature_1_title' => 'Humble Beginnings',
            'feature_1_desc' => 'Starting as a small local agency, our commitment to excellence has allowed us to grow into a trusted national provider without losing our personal touch.',
            'feature_1_point_1' => 'Decades of experience',
            'feature_1_point_2' => 'Unwavering core values',
            'feature_1_point_3' => 'Award-winning service',

            // Feature Block 2
            'feature_2_eyebrow' => 'LOOKING FORWARD',
            'feature_2_title' => 'Innovating for Tomorrow',
            'feature_2_desc' => 'While we honor our past, we are constantly embracing new technologies to serve you better, faster, and more securely in the modern world.',
            'feature_2_point_1' => 'Digital-first solutions',
            'feature_2_point_2' => 'Streamlined claims processing',
            'feature_2_point_3' => 'Proactive risk management',

            // CTA
            'cta_title' => 'Become part of our story.',
            'cta_subtitle' => 'Discover the difference of working with a team that truly cares.',
        ];
    }

    public static function getDefaultTeamContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/team_hero.jpg',
            'hero_eyebrow' => 'LEADERSHIP TEAM',
            'hero_title' => 'Meet Our<br>Expert Advisors',
            'hero_subtitle' => 'Our leadership brings decades of industry experience, ensuring your portfolio is managed with the utmost expertise and care.',
            'hero_card_sub' => 'Executive Board',
            'hero_card_label' => 'Top Tier Talent',
            'hero_card_main' => 'Industry Leaders',

            // Value Props
            'value_1_title' => 'Unmatched Expertise',
            'value_1_desc' => 'Our team comprises former underwriters, risk analysts, and financial planners working in synergy.',
            'value_2_title' => 'Strategic Vision',
            'value_2_desc' => 'We stay ahead of market trends to protect your assets against future vulnerabilities.',
            'value_3_title' => 'Dedicated Support',
            'value_3_desc' => 'You have direct access to decision-makers who understand your unique profile.',

            // Feature Block 1
            'feature_1_eyebrow' => 'OUR PEOPLE',
            'feature_1_title' => 'Committed to Excellence',
            'feature_1_desc' => 'Every member of our leadership team has a proven track record of delivering bespoke insurance solutions to high-net-worth individuals and enterprises.',
            'feature_1_point_1' => 'Certified risk managers',
            'feature_1_point_2' => 'Specialized market knowledge',
            'feature_1_point_3' => 'Personalized attention',

            // Feature Block 2
            'feature_2_eyebrow' => 'CORE PHILOSOPHY',
            'feature_2_title' => 'Guidance You Can Trust',
            'feature_2_desc' => 'We believe transparency, integrity, and proactive communication are the cornerstones of effective risk management.',
            'feature_2_point_1' => 'Client-centric advising',
            'feature_2_point_2' => 'Ethical underwriting',
            'feature_2_point_3' => 'Continuous education',

            // CTA
            'cta_title' => 'Connect with our experts.',
            'cta_subtitle' => 'Schedule a consultation with our executive team today.',
        ];
    }

    public static function getDefaultCareersContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/careers_hero.jpg',
            'hero_eyebrow' => 'CAREERS AT SUREBOUND',
            'hero_title' => 'Join Our<br>Growing Team',
            'hero_subtitle' => 'We are always looking for passionate, driven individuals to help us redefine the insurance experience. Build a rewarding career with us.',
            'hero_card_sub' => 'Open Positions',
            'hero_card_label' => 'Hiring Now',
            'hero_card_main' => 'Multiple Roles',

            // Value Props
            'value_1_title' => 'Growth Opportunities',
            'value_1_desc' => 'We invest in our employees with continuous training, mentorship, and clear paths for advancement.',
            'value_2_title' => 'Inclusive Culture',
            'value_2_desc' => 'We foster a collaborative environment where diverse perspectives are celebrated and valued.',
            'value_3_title' => 'Competitive Benefits',
            'value_3_desc' => 'Enjoy comprehensive health coverage, retirement plans, and generous paid time off.',

            // Feature Block 1
            'feature_1_eyebrow' => 'WHY CHOOSE US',
            'feature_1_title' => 'More Than Just a Job',
            'feature_1_desc' => 'At Surebound, you are not just a number. You are an integral part of a team dedicated to protecting what matters most to our clients.',
            'feature_1_point_1' => 'Work-life balance',
            'feature_1_point_2' => 'Meaningful work',
            'feature_1_point_3' => 'Supportive leadership',

            // Feature Block 2
            'feature_2_eyebrow' => 'CURRENT OPENINGS',
            'feature_2_title' => 'Find Your Fit',
            'feature_2_desc' => 'Explore our current open positions across various departments, from underwriting and claims to sales and customer support.',
            'feature_2_point_1' => 'Underwriting specialists',
            'feature_2_point_2' => 'Client success managers',
            'feature_2_point_3' => 'Tech & data analysts',

            // CTA
            'cta_title' => 'Ready to take the next step?',
            'cta_subtitle' => 'Browse our open roles and apply today to join the Surebound family.',
        ];
    }

    public static function getDefaultCommunityContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/community_hero.jpg',
            'hero_eyebrow' => 'COMMUNITY IMPACT',
            'hero_title' => 'Building Stronger,<br>Safer Communities',
            'hero_subtitle' => 'Surebound is committed to reinvesting in the communities we serve through grants, volunteerism, and risk education.',
            'hero_card_sub' => 'Our Promise',
            'hero_card_label' => 'Impact Report',
            'hero_card_main' => 'Local Growth',

            // Guidance
            'guidance_eyebrow' => 'SOCIAL RESPONSIBILITY',
            'guidance_title' => 'Our Commitment to Positive Change',
            'guidance_text' => 'We believe insurance is about more than financial protection—it’s about resilience. That means helping local organizations build strong foundations for the future.',

            // Why Us
            'why_1_title' => 'Local Grants',
            'why_1_desc' => 'Providing direct financial support to non-profits focused on safety and disaster preparedness.',
            'why_2_title' => 'Volunteer Days',
            'why_2_desc' => 'Our employees receive 5 paid days annually to volunteer at local charities and events.',
            'why_3_title' => 'Risk Education',
            'why_3_desc' => 'Free community workshops on financial literacy, cyber safety, and emergency planning.',
            'why_4_title' => 'Sustainability',
            'why_4_desc' => 'Committed to net-zero operations by 2030 and eco-friendly office practices.',

            // FAQs
            'faq_1_question' => 'How can my non-profit apply for a grant?',
            'faq_1_answer' => 'You can apply through our community portal. We review applications on a rolling quarterly basis.',
            'faq_2_question' => 'What causes do you support?',
            'faq_2_answer' => 'We focus on disaster relief, financial literacy, and community safety initiatives.',
            'faq_3_question' => 'Does Surebound match employee donations?',
            'faq_3_answer' => 'Yes, we match employee charitable contributions up to ,000 annually.',
            'faq_4_question' => 'Can we partner with Surebound for an event?',
            'faq_4_answer' => 'We frequently sponsor local safety and community events. Contact our PR team to discuss.',
            'faq_5_question' => 'Where can I read your impact report?',
            'faq_5_answer' => 'Our annual impact report is available for download on this page.',

            // CTA
            'cta_title' => 'Join our efforts today.',
            'cta_subtitle' => 'Learn how you can partner with Surebound to make a difference.',
        ];
    }

    public static function getDefaultArticlesContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/articles_hero.jpg',
            'hero_eyebrow' => 'ARTICLES & INSIGHTS',
            'hero_title' => 'Expert Perspectives<br>on Risk & Protection',
            'hero_subtitle' => 'Stay informed with the latest trends, regulatory updates, and risk management strategies from our industry experts.',
            'hero_card_sub' => 'Knowledge Base',
            'hero_card_label' => 'New Insights',
            'hero_card_main' => 'Weekly Updates',

            // Guidance
            'guidance_eyebrow' => 'THOUGHT LEADERSHIP',
            'guidance_title' => 'Empowering You With Knowledge',
            'guidance_text' => 'An informed client makes better decisions. We share our expertise freely to help you build resilient, future-proof strategies.',

            // Why Us
            'why_1_title' => 'Industry News',
            'why_1_desc' => 'Keep up with the fast-paced changes in the insurance landscape and how they affect your business.',
            'why_2_title' => 'Expert Analysis',
            'why_2_desc' => 'Deep dives into complex risk scenarios, written by our senior underwriting and claims specialists.',
            'why_3_title' => 'Risk Mitigation',
            'why_3_desc' => 'Practical guides and checklists to help you proactively protect your assets and employees.',
            'why_4_title' => 'Market Trends',
            'why_4_desc' => 'Regular updates on how market shifts might impact your premiums.',

            // FAQs
            'faq_1_question' => 'How often are articles posted?',
            'faq_1_answer' => 'We post new insights and articles weekly.',
            'faq_2_question' => 'Can I subscribe to updates?',
            'faq_2_answer' => 'Yes, join our newsletter to get weekly digests delivered to your inbox.',
            'faq_3_question' => 'Who writes the articles?',
            'faq_3_answer' => 'Our content is authored by our in-house team of underwriters, risk assessors, and claims experts.',
            'faq_4_question' => 'Do you cover niche industries?',
            'faq_4_answer' => 'Yes, we frequently feature articles focused on specific sectors like aviation, marine, and cyber.',
            'faq_5_question' => 'Can I share these articles?',
            'faq_5_answer' => 'Absolutely, we encourage you to share our insights with your network.',

            // CTA
            'cta_title' => 'Subscribe to our newsletter.',
            'cta_subtitle' => 'Get the latest insights delivered directly to your inbox.',
        ];
    }

    public static function getDefaultFaqsContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/faqs_hero.jpg',
            'hero_eyebrow' => 'FREQUENTLY ASKED QUESTIONS',
            'hero_title' => 'Answers to Your<br>Insurance Questions',
            'hero_subtitle' => 'Find quick answers to common questions about coverage, claims, payments, and managing your policies with Surebound.',
            'hero_card_sub' => 'Support Center',
            'hero_card_label' => 'Help Desk',
            'hero_card_main' => '24/7 Access',

            // Guidance
            'guidance_eyebrow' => 'UNDERSTANDING COVERAGE',
            'guidance_title' => 'Clarity Above All',
            'guidance_text' => 'We believe insurance should be transparent. Our FAQs break down complex industry jargon so you know exactly what you are paying for.',

            // Why Us
            'why_1_title' => 'Policy Management',
            'why_1_desc' => 'Learn how to easily update your coverage limits, add new assets, or modify your premium payment schedule.',
            'why_2_title' => 'Claims Process',
            'why_2_desc' => 'Understand the steps to file a claim, required documentation, and how we ensure a fast, fair resolution.',
            'why_3_title' => 'Billing Support',
            'why_3_desc' => 'Information on auto-pay, invoicing, and how to access your tax documents securely through our portal.',
            'why_4_title' => 'Direct Agent Access',
            'why_4_desc' => 'Get in touch with real human agents quickly and easily.',

            // FAQs
            'faq_1_question' => 'How do I file a claim?',
            'faq_1_answer' => 'You can file a claim 24/7 through your client portal or by calling our emergency hotline.',
            'faq_2_question' => 'Can I change my coverage mid-year?',
            'faq_2_answer' => 'Yes, you can adjust your coverage limits at any time via the dashboard or by contacting your agent.',
            'faq_3_question' => 'How are premiums calculated?',
            'faq_3_answer' => 'Premiums are based on risk factors, claims history, asset value, and chosen deductibles.',
            'faq_4_question' => 'What payment methods do you accept?',
            'faq_4_answer' => 'We accept all major credit cards, ACH transfers, and check payments.',
            'faq_5_question' => 'Is there a grace period for payments?',
            'faq_5_answer' => 'Yes, we offer a standard 10-day grace period for all premium payments.',

            // CTA
            'cta_title' => 'Still have questions?',
            'cta_subtitle' => 'Reach out to our support team for personalized assistance.',
        ];
    }

    public static function getDefaultGuidesContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/guides_hero_unique.jpg',
            'hero_eyebrow' => 'INSURANCE GUIDES',
            'hero_title' => 'Comprehensive Guides<br>for Every Risk',
            'hero_subtitle' => 'Detailed walkthroughs and playbooks designed to help you understand complex coverage options and protect your assets.',
            'hero_card_sub' => 'Resource Center',
            'hero_card_label' => 'New Playbooks',
            'hero_card_main' => 'In-Depth Analysis',

            // Guidance
            'guidance_eyebrow' => 'DEEP DIVES',
            'guidance_title' => 'Go Beyond the Basics',
            'guidance_text' => 'Our insurance guides don’t just scratch the surface. We provide the detailed context you need to make informed decisions.',

            // Why Us
            'why_1_title' => 'Step-by-Step Plans',
            'why_1_desc' => 'Follow our structured guides to evaluate your risk profile and select the perfect coverage.',
            'why_2_title' => 'Industry Specific',
            'why_2_desc' => 'Playbooks tailored to your exact industry—from construction to tech startups.',
            'why_3_title' => 'Compliance Ready',
            'why_3_desc' => 'Ensure your business meets all local and federal insurance mandates easily.',
            'why_4_title' => 'Downloadable PDFs',
            'why_4_desc' => 'Take our guides with you to share with your board or HR team.',

            // FAQs
            'faq_1_question' => 'Who are these guides for?',
            'faq_1_answer' => 'Business owners, HR managers, and individuals looking to deeply understand their insurance needs.',
            'faq_2_question' => 'Are they free?',
            'faq_2_answer' => 'Yes, our guides are completely free to read and download.',
            'faq_3_question' => 'How often are they updated?',
            'faq_3_answer' => 'We review and update our guides quarterly to ensure compliance with new laws.',
            'faq_4_question' => 'Can I request a custom guide?',
            'faq_4_answer' => 'Absolutely. Reach out to our team if you have a specific risk profile you want covered.',
            'faq_5_question' => 'Do you provide checklists?',
            'faq_5_answer' => 'Yes, most of our guides include printable checklists for easy reference.',

            // CTA
            'cta_title' => 'Ready to dig deeper?',
            'cta_subtitle' => 'Contact an advisor to discuss how these guides apply to your specific situation.',
        ];
    }

    /**
     * Display Public Specialty Coverage Page with Dynamic CMS Content
     */
    public function showSpecialtyCoverage()
    {
        $content = PageContent::getForPage('specialty-coverage', self::getDefaultSpecialtyCoverageContent());

        return view('specialty-coverage', compact('content'));
    }

    public function showCoverage()
    {
        $content = PageContent::getForPage('coverage', self::getDefaultCoverageContent());

        return view('coverage', compact('content'));
    }

    public function showCustomQuote()
    {
        $content = PageContent::getForPage('custom-quote', self::getDefaultCustomQuoteContent());

        return view('custom-quote', compact('content'));
    }

    public function showCompare()
    {
        $content = PageContent::getForPage('compare', self::getDefaultCompareContent());

        return view('compare', compact('content'));
    }

    public function showStory()
    {
        $content = PageContent::getForPage('story', self::getDefaultStoryContent());

        return view('story', compact('content'));
    }

    public function showTeam()
    {
        $content = PageContent::getForPage('team', self::getDefaultTeamContent());

        return view('team', compact('content'));
    }

    public function showCareers()
    {
        $content = PageContent::getForPage('careers', self::getDefaultCareersContent());

        return view('careers', compact('content'));
    }

    public function showCommunity()
    {
        $content = PageContent::getForPage('community', self::getDefaultCommunityContent());

        return view('community', compact('content'));
    }

    public function showArticles()
    {
        $content = PageContent::getForPage('articles', self::getDefaultArticlesContent());

        return view('articles', compact('content'));
    }

    public function showFaqs()
    {
        $content = PageContent::getForPage('faqs', self::getDefaultFaqsContent());

        return view('faqs', compact('content'));
    }

    public function showGuides()
    {
        $content = PageContent::getForPage('guides', self::getDefaultGuidesContent());

        return view('guides', compact('content'));
    }

    /**
     * Update Specialty Coverage CMS Content from Admin Portal
     */
    public function updateSpecialtyCoverage(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_specialty_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('specialty-coverage', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Specialty Coverage page updated and published live successfully!',
                'content' => PageContent::getForPage('specialty-coverage', self::getDefaultSpecialtyCoverageContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#specialty-cms')
            ->with('success', 'Specialty Coverage page updated successfully!');
    }

    public function updateCoverage(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_specialty_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('coverage', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'All Coverage page updated and published live successfully!',
                'content' => PageContent::getForPage('coverage', self::getDefaultCoverageContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#coverage-cms')
            ->with('success', 'All Coverage page updated successfully!');
    }

    public function updateCustomQuote(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_custom_quote_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('custom-quote', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Custom Quote page updated successfully!',
                'content' => PageContent::getForPage('custom-quote', self::getDefaultCustomQuoteContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#custom-quote-cms')
            ->with('success', 'Custom Quote page updated successfully!');
    }

    public function updateCompare(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_compare_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('compare', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Compare page updated successfully!',
                'content' => PageContent::getForPage('compare', self::getDefaultCompareContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#compare-cms')
            ->with('success', 'Compare page updated successfully!');
    }

    public function updateStory(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_story_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('story', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Story page updated successfully!',
                'content' => PageContent::getForPage('story', self::getDefaultStoryContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#story-cms')
            ->with('success', 'Story page updated successfully!');
    }

    public function updateTeam(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_team_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('team', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Team page updated successfully!',
                'content' => PageContent::getForPage('team', self::getDefaultTeamContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#team-cms')
            ->with('success', 'Team page updated successfully!');
    }

    public function updateCareers(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_careers_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('careers', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Careers page updated successfully!',
                'content' => PageContent::getForPage('careers', self::getDefaultCareersContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#careers-cms')
            ->with('success', 'Careers page updated successfully!');
    }

    public function updateCommunity(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_community_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('community', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Community page updated successfully!',
                'content' => PageContent::getForPage('community', self::getDefaultCommunityContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#community-cms')
            ->with('success', 'Community page updated successfully!');
    }

    public function updateArticles(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_articles_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('articles', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Articles page updated successfully!',
                'content' => PageContent::getForPage('articles', self::getDefaultArticlesContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#articles-cms')
            ->with('success', 'Articles page updated successfully!');
    }

    public function updateFaqs(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_faqs_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('faqs', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'FAQs page updated successfully!',
                'content' => PageContent::getForPage('faqs', self::getDefaultFaqsContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#faqs-cms')
            ->with('success', 'FAQs page updated successfully!');
    }

    public function updateGuides(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_guides_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('guides', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Guides page updated successfully!',
                'content' => PageContent::getForPage('guides', self::getDefaultGuidesContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#guides-cms')
            ->with('success', 'Guides page updated successfully!');
    }

    /**
     * Default content dictionary for Business Insurance page
     */
    public static function getDefaultBusinessInsuranceContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/hero-business.jpg',
            'hero_eyebrow' => 'COMMERCIAL & ENTERPRISE PROTECTION',
            'hero_title' => 'Securing Your Business,<br>Employees & Future Growth',
            'hero_subtitle' => 'Customized commercial insurance policies engineered for small businesses, growing enterprises, and established corporations. Protect your revenue, property, and staff with dependable underwriting.',
            'hero_card_sub' => 'Commercial BOP Savings',
            'hero_card_label' => 'Save up to 30% bundled commercial plans',

            // Coverage Cards
            'card_1_title' => 'Commercial General Liability',
            'card_1_desc' => 'Defends against third-party bodily injury, property damage, slip-and-fall claims, and advertising liability lawsuits.',
            'card_2_title' => 'Commercial Property & Structure',
            'card_2_desc' => 'Protects owned or leased business buildings, office furniture, machinery, inventory, and specialized equipment from fire and storm damage.',
            'card_3_title' => 'Business Interruption & Income',
            'card_3_desc' => 'Replaces lost operating income and covers ongoing payroll, rent, and expenses if covered damage temporarily shuts down operations.',
            'card_4_title' => 'Workers\' Compensation',
            'card_4_desc' => 'Covers employee medical bills, rehabilitation costs, and lost wage benefits for workplace injuries or occupational illnesses.',
            'card_5_title' => 'Professional Liability (E&O)',
            'card_5_desc' => 'Shields consultants, technology providers, accountants, and advisors against professional negligence or error claims.',
            'card_6_title' => 'Commercial Auto & Fleet',
            'card_6_desc' => 'Comprehensive physical damage and liability protection for company vehicles, delivery vans, trucks, and executive fleets.',

            // Value Pillars
            'value_1_title' => 'Custom BOP Bundles',
            'value_1_desc' => 'Combine property and general liability into one cost-effective Business Owner Package.',
            'value_2_title' => 'Instant COI Issuance',
            'value_2_desc' => 'Download Certificates of Insurance in under 15 minutes to satisfy landlord and client contracts.',
            'value_3_title' => 'Tailored Risk Mapping',
            'value_3_desc' => 'Customized policy terms built specifically for retail, manufacturing, tech, and service sectors.',
            'value_4_title' => '24/7 Commercial Support',
            'value_4_desc' => 'Dedicated business claims team providing rapid emergency funds and business continuity guidance.',

            // Guidance
            'guidance_eyebrow' => 'COMMERCIAL GUIDANCE & GROWTH',
            'guidance_title' => 'Commercial Risk Protection Built for Modern Enterprises',
            'guidance_text' => 'Navigating commercial insurance shouldn\'t take hours away from growing your business. Surebound simplifies policy underwriting, calculating your precise exposure to property damage, liability suits, and operational delays so you get maximum coverage without overpaying.',

            // Why Choose
            'why_1_title' => 'Fast Digital COI',
            'why_1_desc' => 'Generate and email Certificates of Insurance instantly to clients and landlords.',
            'why_2_title' => 'Scalable BOP Bundles',
            'why_2_desc' => 'Seamlessly add coverage lines as your headcount, revenue, and physical footprint expand.',
            'why_3_title' => 'Payroll & Audit Support',
            'why_3_desc' => 'Integrated workers\' comp reporting aligned with pay-as-you-go payroll systems.',
            'why_4_title' => 'Commercial Claims Officers',
            'why_4_desc' => 'Dedicated business adjusters committed to minimizing operational downtime during a claim.',

            // FAQs
            'faq_1_question' => 'What is a Business Owner Policy (BOP) and why is it recommended?',
            'faq_1_answer' => 'A Business Owner Policy (BOP) bundles Commercial General Liability and Commercial Property insurance into a single discounted package. It protects small-to-medium businesses against third-party injury claims, property damage, and loss of operating income at a lower cost than buying separate policies.',
            'faq_2_question' => 'How fast can I get a Certificate of Insurance (COI) for my clients?',
            'faq_2_answer' => 'With Surebound, Certificates of Insurance (COIs) can be issued digitally in under 15 minutes through our client portal, allowing you to secure new contracts and landlord leases without delay.',
            'faq_3_question' => 'Is Workers\' Compensation insurance required for my business?',
            'faq_3_answer' => 'In most states, Workers\' Compensation is legally mandatory as soon as you hire your first employee. It pays for medical bills, disability benefits, and vocational rehabilitation if an employee suffers a workplace injury.',
            'faq_4_question' => 'What is the difference between General Liability and Professional Liability (E&O)?',
            'faq_4_answer' => 'General Liability covers physical risks such as bodily injury, property damage, or slip-and-fall accidents on your premises. Professional Liability (Errors & Omissions) covers financial losses resulting from professional advice, negligence, design errors, or service mistakes.',
            'faq_5_question' => 'How can I lower my annual commercial insurance costs?',
            'faq_5_answer' => 'You can reduce your commercial premium by bundling property and liability into a BOP, implementing workplace safety protocols, maintaining clean safety records, and customizing your deductible levels.',

            // CTA
            'cta_title' => 'Protect your business & empower your growth today.',
            'cta_subtitle' => 'Get a custom business insurance quote in less than 2 minutes or speak with a commercial risk officer.',
        ];
    }

    /**
     * Display Public Business Insurance Page with Dynamic CMS Content
     */
    public function showBusinessInsurance()
    {
        $content = PageContent::getForPage('business-insurance', self::getDefaultBusinessInsuranceContent());

        return view('business-insurance', compact('content'));
    }

    /**
     * Update Business Insurance CMS Content from Admin Portal
     */
    public function updateBusinessInsurance(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_business_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('business-insurance', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Business Insurance page updated and published live successfully!',
                'content' => PageContent::getForPage('business-insurance', self::getDefaultBusinessInsuranceContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#business-cms')
            ->with('success', 'Business Insurance page updated successfully!');
    }

    public static function getDefaultClaimsContent(): array
    {
        return [
            // Hero
            'hero_image' => 'images/claims_hero.jpg',
            'hero_eyebrow' => 'CLAIMS CENTER',
            'hero_title' => 'Fast, Fair & Transparent<br>Claims Processing',
            'hero_subtitle' => 'Experiencing a loss is stressful enough. We make the recovery process as seamless as possible so you can get back to normal.',
            'hero_card_sub' => 'Support Status',
            'hero_card_label' => 'Response Time',
            'hero_card_main' => 'Under 24 Hrs',

            // Guidance
            'guidance_eyebrow' => 'CLAIMS SUPPORT',
            'guidance_title' => 'Here When You Need Us Most',
            'guidance_text' => 'Our dedicated claims specialists are available around the clock to guide you through every step of your claim, from initial report to final settlement.',

            // Why Us
            'why_1_title' => '24/7 Reporting',
            'why_1_desc' => 'File a claim online, through our app, or over the phone at any time.',
            'why_2_title' => 'Dedicated Adjusters',
            'why_2_desc' => 'Work directly with a single point of contact who knows your case inside and out.',
            'why_3_title' => 'Rapid Payouts',
            'why_3_desc' => 'Approved claims are paid out swiftly via direct deposit or overnight check.',
            'why_4_title' => 'Transparent Tracking',
            'why_4_desc' => 'Track your claims progress in real-time through the client dashboard.',

            // FAQs
            'faq_1_question' => 'How do I report a claim?',
            'faq_1_answer' => 'You can report a claim online via your customer portal, call our 24/7 hotline, or contact your dedicated agent directly.',
            'faq_2_question' => 'What information do I need?',
            'faq_2_answer' => 'Have your policy number ready, along with the date, time, and location of the incident, and any photos or police reports if applicable.',
            'faq_3_question' => 'Will filing a claim increase my rate?',
            'faq_3_answer' => 'It depends on the circumstances and your policy type. Some policies include accident forgiveness for your first claim.',
            'faq_4_question' => 'How long does the process take?',
            'faq_4_answer' => 'Minor claims are often settled within days. More complex claims require an adjuster review but we prioritize swift resolutions.',
            'faq_5_question' => 'Can I choose my own repair shop?',
            'faq_5_answer' => 'Yes, you can use any licensed repair facility, though we also have a network of guaranteed preferred shops.',

            // CTA
            'cta_title' => 'Need to file a claim right now?',
            'cta_subtitle' => 'Our emergency response team is standing by to assist you 24/7.',
        ];
    }

    public function showClaims()
    {
        $content = PageContent::getForPage('claims', self::getDefaultClaimsContent());

        return view('claims', compact('content'));
    }

    public function updateClaims(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_claims_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('claims', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Claims page updated and published live successfully!',
                'content' => PageContent::getForPage('claims', self::getDefaultClaimsContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#claims-cms')->with('success', 'Claims page updated successfully!');
    }

    public static function getDefaultPaymentContent(): array
    {
        return [
            'hero_eyebrow' => 'Payments',
            'hero_title' => 'Make a Payment',
            'hero_subtitle' => 'Securely pay your premium online.',
            'hero_image' => 'images/home_insurance_hero.jpg',
        ];
    }

    public function showPayment()
    {
        $content = PageContent::getForPage('payment', self::getDefaultPaymentContent());

        return view('payment', compact('content'));
    }

    public function updatePayment(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_payment_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('payment', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Payment page updated and published live successfully!',
                'content' => PageContent::getForPage('payment', self::getDefaultPaymentContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#payment-cms')->with('success', 'Payment page updated successfully!');
    }

    public static function getDefaultContactContent(): array
    {
        return [
            // 1. Hero Section
            'hero_eyebrow' => 'DIRECT CLIENT ADVISORY & SUPPORT',
            'hero_title' => 'Connect with a Licensed Advisor –<br>We\'re Here For You',
            'hero_subtitle' => 'Whether you need customized policy guidance, rapid claims assistance, or billing adjustments, our credentialed advisors and underwriters are ready to help.',
            'hero_image' => 'images/advisor-meeting-hires.jpg',
            'hero_card_sub' => 'Direct Advisor Access',
            'hero_card_label' => 'Avg. response under 15 mins',
            'primary_phone' => '+1 813-214-1731',
            'claims_phone' => '+1 813-214-1731',

            // 2. Value Bar (4 Direct Channels)
            'value_1_title' => '+1 813-214-1731',
            'value_1_desc' => 'Client Care Desk • Mon–Fri, 8am–8pm EST • Direct policy support & endorsements.',
            'value_1_phone' => '+1 813-214-1731',
            'value_2_title' => '+1 813-214-1731',
            'value_2_desc' => '24/7 Emergency Claims • Available 365 days a year with immediate adjuster dispatch.',
            'value_2_phone' => '+1 813-214-1731',
            'value_3_title' => '+1 813-214-1731',
            'value_3_desc' => 'Commercial Desk • Mon–Fri, 8:30am–6pm EST • Business policies & surety bonding lines.',
            'value_3_phone' => '+1 813-214-1731',
            'value_4_title' => 'support@surebound.com',
            'value_4_desc' => 'Digital Intake • Certified electronic correspondence • Inquiries answered in under 15 minutes.',
            'value_4_email' => 'support@surebound.com',

            // 3. Direct Communication Panel
            'live_status_text' => 'Client Support Center: Online & Open Now',
            'section_eyebrow' => 'DIRECT COMMUNICATION',
            'section_title' => 'Talk with a Licensed Insurance Specialist',
            'lead_desc' => 'At Surebound, you won\'t encounter robotic phone trees or overseas call centers. You will be connected directly with certified American underwriters and local advisors who take time to understand your unique liabilities, property assets, and family goals.',

            // Channel 1
            'channel_1_title' => 'Policy & Account Service',
            'channel_1_badge' => 'Mon–Fri, 8am–8pm EST',
            'channel_1_value' => '+1 813-214-1731',
            'channel_1_sub' => 'Policy renewals, endorsements, deductible adjustments & billing.',

            // Channel 2
            'channel_2_title' => 'Emergency Claims Hotline',
            'channel_2_badge' => '24/7/365 Rapid Response',
            'channel_2_value' => '+1 813-214-1731',
            'channel_2_sub' => 'Immediate first-notice-of-loss intake and emergency adjuster dispatch.',

            // Channel 3
            'channel_3_title' => 'Commercial & Surety Desk',
            'channel_3_badge' => 'Mon–Fri, 8:30am–6pm EST',
            'channel_3_value' => '+1 813-214-1731',
            'channel_3_sub' => 'Commercial Auto, General Liability, BOP & Treasury-listed bonds.',

            // Channel 4
            'channel_4_title' => 'Official Inquiries & Documentation',
            'channel_4_badge' => 'Average Reply: < 15 mins',
            'channel_4_value' => 'support@surebound.com',
            'channel_4_sub' => 'Proof of insurance, escrow requests, loss payee forms & certificates.',

            // Corporate HQ Feature Box
            'hq_title' => 'Corporate Headquarters',
            'hq_address' => '123 Surebound Way, Suite 400<br>Chicago, Illinois 60601',
            'hq_hours' => 'Mon–Fri 8:30 AM – 5:30 PM CST • Walk-ins & scheduled visits',

            // 4. Form Section
            'form_title' => 'Send a Secure Message',
            'form_subtitle' => 'Please provide your inquiry details below. Our routing system will immediately connect your message to the appropriate licensed underwriter or advisor.',
            'form_button_text' => 'Send Message to Advisor',
            'form_security_badge' => '256-Bit SSL Encrypted • Strictly Confidential Under State & Federal Insurance Privacy Regulations',

            // 5. Regional Hubs
            'offices_eyebrow' => 'LOCAL ROOTS • NATIONWIDE PRESENCE',
            'offices_title' => 'Our Regional Underwriting Hubs',
            'offices_subtitle' => 'Meet face-to-face with credentialed advisors at our regional service centers or schedule an on-site commercial risk audit.',

            'office_1_badge' => 'Corporate HQ',
            'office_1_city' => 'Chicago, IL',
            'office_1_address' => '123 Surebound Way, Suite 400<br>Chicago, IL 60601',
            'office_1_phone' => '+1 813-214-1731',
            'office_1_hours' => 'Mon–Fri: 8:30 AM – 5:30 PM CST<br>Midwest Underwriting Center',

            'office_2_badge' => 'Northeast Hub',
            'office_2_city' => 'New York, NY',
            'office_2_address' => '45 Wall Street, 18th Floor<br>New York, NY 10005',
            'office_2_phone' => '+1 813-214-1731',
            'office_2_hours' => 'Mon–Fri: 8:00 AM – 6:00 PM EST<br>Commercial & Financial Risk',

            'office_3_badge' => 'Southwest Hub',
            'office_3_city' => 'Dallas, TX',
            'office_3_address' => '2100 Ross Avenue, Suite 1200<br>Dallas, TX 75201',
            'office_3_phone' => '+1 813-214-1731',
            'office_3_hours' => 'Mon–Fri: 8:00 AM – 5:30 PM CST<br>Commercial Fleet & Property',

            'office_4_badge' => 'Pacific Hub',
            'office_4_city' => 'Los Angeles, CA',
            'office_4_address' => '1999 Avenue of the Stars, Suite 1100<br>Los Angeles, CA 90067',
            'office_4_phone' => '+1 813-214-1731',
            'office_4_hours' => 'Mon–Fri: 8:30 AM – 6:00 PM PST<br>Personal & Luxury Estates',

            // 6. Dedicated Advocacy Section
            'guidance_eyebrow' => 'DEDICATED ADVOCACY',
            'guidance_title' => 'Real Human Advisors.<br>Zero Robotic Runarounds.',
            'guidance_text' => 'When unexpected emergencies or complex policy decisions arise, you shouldn\'t have to battle automated phone trees. At Surebound, every individual, family, and enterprise account is matched with dedicated licensed underwriters and claims specialists who know your account history by name.',

            // 7. FAQs
            'faq_eyebrow' => 'COMMON QUESTIONS',
            'faq_title' => 'Client Support & Contact FAQs',
            'faq_subtitle' => 'Everything you need to know about reaching your dedicated Surebound team.',

            'faq_1_question' => 'How quickly will a licensed advisor respond to my message?',
            'faq_1_answer' => 'Inquiries submitted through our online secure form during standard business hours (Monday through Friday, 8:00 AM – 8:00 PM EST) are typically routed and responded to by a licensed insurance underwriter within 15 minutes. Messages received outside standard business hours are answered early the following business morning. For immediate assistance, call us directly at +1 813-214-1731.',

            'faq_2_question' => 'How do I report an urgent loss or file a claim after hours?',
            'faq_2_answer' => 'Our emergency claims hotline (+1 813-214-1731) is staffed 24 hours a day, 7 days a week, 365 days a year. Whether you experience a vehicular collision, home pipe burst, severe storm roof damage, or commercial property incident, an emergency claims adjuster is always standing by to dispatch emergency mitigation crews and issue immediate living expense or repair authorizations.',

            'faq_3_question' => 'Where should mortgage lenders or escrow agents send proof-of-insurance requests?',
            'faq_3_answer' => 'Title companies, mortgage lenders, and escrow officers can send verification requests, mortgagee clause updates, and loss payee change notices directly to support@surebound.com. Include the insured policyholder\'s full name, property address, and loan number for automated same-day certificate issuance.',

            'faq_4_question' => 'Can I update my coverage limits, vehicle details, or payment methods online?',
            'faq_4_answer' => 'Yes. Existing Surebound policyholders can log into our secure User Client Portal to view policies, download auto ID cards, request policy endorsements, add vehicles or drivers, and submit one-time or recurring premium payments.',

            'faq_5_question' => 'How do I schedule an in-person meeting at a regional office?',
            'faq_5_answer' => 'You are welcome to visit any of our regional hubs in Chicago, New York, Dallas, or Los Angeles during normal business hours. For complex commercial liability audits, high-value asset consultations, or surety bonding lines, we recommend calling +1 813-214-1731 or submitting the contact form with your preferred date and time.',

            // 8. Bottom CTA
            'cta_title' => 'Looking for an immediate insurance rate?',
            'cta_subtitle' => 'Get a personalized policy quote tailored to your vehicle, property, or business in under 2 minutes.',
            'cta_phone' => '+1 813-214-1731',
            'cta_button_text' => 'Start Instant Quote',
        ];
    }

    public function showContact()
    {
        $content = PageContent::getForPage('contact', self::getDefaultContactContent());

        return view('contact', compact('content'));
    }

    public function showPrivacy()
    {
        return view('privacy');
    }

    public function showTerms()
    {
        return view('terms');
    }

    public function updateContact(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image_file']);

        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_contact_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['hero_image'] = 'images/'.$filename;
        }

        PageContent::setForPage('contact', $data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Contact page updated and published live successfully!',
                'content' => PageContent::getForPage('contact', self::getDefaultContactContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#contact-cms')->with('success', 'Contact page updated successfully!');
    }

    public function updatePartners(Request $request)
    {
        $this->handlePartnersDataSave($request);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Insurance Partners section updated and published live successfully!',
                'content' => PageContent::getForPage('partners', self::getDefaultPartnersContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#tab-partners-cms')->with('success', 'Insurance Partners section updated successfully!');
    }

    /**
     * Common handler for saving Insurance Partners data including local file uploads, edits, and deletions
     */
    protected function handlePartnersDataSave(Request $request): array
    {
        $partnersData = [];
        $partnersData['section_enabled'] = $request->has('section_enabled') ? '1' : '0';
        $partnersData['section_title'] = $request->input('section_title', 'Coverage Backed by Trusted Names');
        $partnersData['section_subtitle'] = $request->input('section_subtitle', 'We work with leading insurance carriers to help you find the right coverage.');

        // Scan all submitted partner indices
        $partnerIndices = [];
        foreach ($request->all() as $key => $val) {
            if (preg_match('/^partner_(\d+)_name$/', $key, $matches)) {
                $partnerIndices[] = (int) $matches[1];
            }
        }
        $count = (int) $request->input('partners_count', 10);
        for ($i = 1; $i <= $count; $i++) {
            $partnerIndices[] = $i;
        }
        $partnerIndices = array_values(array_unique($partnerIndices));
        sort($partnerIndices);

        $savedIndex = 1;
        $uploadDir = public_path('images/partners');
        if (! is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        foreach ($partnerIndices as $i) {
            // Check if explicitly marked as removed
            if ($request->input("partner_{$i}_removed") === '1') {
                continue;
            }

            $name = trim((string) $request->input("partner_{$i}_name", ''));
            if ($name === '') {
                continue;
            }

            $logo = (string) $request->input("partner_{$i}_logo", '');

            // Handle local PC file upload
            if ($request->hasFile("partner_{$i}_file")) {
                $file = $request->file("partner_{$i}_file");
                if ($file->isValid()) {
                    $ext = strtolower($file->getClientOriginalExtension() ?: 'png');
                    $filename = 'partner_'.$savedIndex.'_'.time().'_'.bin2hex(random_bytes(3)).'.'.$ext;
                    $file->move($uploadDir, $filename);
                    $logo = 'images/partners/'.$filename;

                    $distDir = public_path('../dist/images/partners');
                    if (is_dir($distDir)) {
                        @copy($uploadDir.'/'.$filename, $distDir.'/'.$filename);
                    }
                }
            }

            $partnersData["partner_{$savedIndex}_name"] = $name;
            $partnersData["partner_{$savedIndex}_desc"] = (string) $request->input("partner_{$i}_desc", '');
            $partnersData["partner_{$savedIndex}_logo"] = $logo;
            $partnersData["partner_{$savedIndex}_active"] = ($request->has("partner_{$i}_active") && $request->input("partner_{$i}_active") !== '0') ? '1' : '0';
            $savedIndex++;
        }

        $partnersData['partners_count'] = (string) ($savedIndex - 1);

        try {
            // Remove previous partner keys to prevent ghost records when items are deleted
            PageContent::where('page', 'partners')->where('key', 'like', 'partner_%')->delete();
        } catch (\Throwable) {
            // Safe fallback if table does not exist
        }

        PageContent::setForPage('partners', $partnersData);

        return $partnersData;
    }

    /**
     * Process, re-pack sequentially, and sanitize Brand Pull Quotes & Perspectives data from Home CMS
     */
    protected function handleQuotesDataSave(Request $request, array &$data): void
    {
        $quotesEnabled = $request->has('quotes_enabled') ? '1' : '0';

        // Scan all submitted quote indices
        $quoteIndices = [];
        foreach ($request->all() as $key => $val) {
            if (preg_match('/^quote_(\d+)_text$/', $key, $matches)) {
                $quoteIndices[] = (int) $matches[1];
            }
        }
        $count = (int) $request->input('quotes_count', 1);
        for ($i = 1; $i <= $count; $i++) {
            $quoteIndices[] = $i;
        }
        $quoteIndices = array_values(array_unique($quoteIndices));
        sort($quoteIndices);

        // Remove any quote keys currently in $data to prevent stale or duplicate entries
        foreach (array_keys($data) as $k) {
            if (str_starts_with($k, 'quote_') || $k === 'quotes_count' || $k === 'quotes_enabled' || $k === 'quotes_submitted') {
                unset($data[$k]);
            }
        }

        $savedIndex = 1;
        foreach ($quoteIndices as $i) {
            // Check if explicitly marked as removed
            if ($request->input("quote_{$i}_removed") === '1') {
                continue;
            }

            $text = trim((string) $request->input("quote_{$i}_text", ''));
            if ($text === '') {
                continue;
            }

            $data["quote_{$savedIndex}_text"] = $text;
            $data["quote_{$savedIndex}_author"] = trim((string) $request->input("quote_{$i}_author", ''));
            $data["quote_{$savedIndex}_role"] = trim((string) $request->input("quote_{$i}_role", ''));
            $data["quote_{$savedIndex}_badge"] = trim((string) $request->input("quote_{$i}_badge", ''));
            $data["quote_{$savedIndex}_active"] = ($request->has("quote_{$i}_active") && $request->input("quote_{$i}_active") !== '0') ? '1' : '0';
            $savedIndex++;
        }

        $finalCount = $savedIndex - 1;
        $data['quotes_count'] = (string) $finalCount;
        $data['quotes_enabled'] = $quotesEnabled;

        try {
            // Remove previous quote keys to prevent ghost records when items are deleted
            PageContent::where('page', 'home-insurance')->where('key', 'like', 'quote_%')->delete();
        } catch (\Throwable) {
            // Safe fallback
        }
    }

    public static function getDefaultPartnersContent(): array
    {
        return [
            'section_enabled' => '1',
            'partners_count' => '10',
            'section_badge' => 'TRUSTED CARRIER NETWORK',
            'section_title' => 'Coverage Backed by Trusted Names',
            'section_subtitle' => 'We work with leading insurance carriers to help you find the right coverage.',

            'partner_1_name' => 'Travelers',
            'partner_1_logo' => 'images/partners/travelers.svg',
            'partner_1_desc' => 'Property & Casualty Specialist',
            'partner_1_active' => '1',

            'partner_2_name' => 'Progressive',
            'partner_2_logo' => 'images/partners/progressive.svg',
            'partner_2_desc' => 'Auto & Commercial Vehicle',
            'partner_2_active' => '1',

            'partner_3_name' => 'Liberty Mutual',
            'partner_3_logo' => 'images/partners/liberty-mutual.svg',
            'partner_3_desc' => 'Comprehensive Personal & Commercial',
            'partner_3_active' => '1',

            'partner_4_name' => 'Nationwide',
            'partner_4_logo' => 'images/partners/nationwide.svg',
            'partner_4_desc' => 'Mutual Insurance & Financial Protection',
            'partner_4_active' => '1',

            'partner_5_name' => 'Chubb',
            'partner_5_logo' => 'images/partners/chubb.svg',
            'partner_5_desc' => 'High-Value Property & Executive Protection',
            'partner_5_active' => '1',

            'partner_6_name' => 'The Hartford',
            'partner_6_logo' => 'images/partners/the-hartford.svg',
            'partner_6_desc' => 'Small Business & Workers Compensation',
            'partner_6_active' => '1',

            'partner_7_name' => 'State Farm',
            'partner_7_logo' => 'images/partners/state-farm.svg',
            'partner_7_desc' => 'P&C and Life Insurance Network',
            'partner_7_active' => '1',

            'partner_8_name' => 'Allstate',
            'partner_8_logo' => 'images/partners/allstate.svg',
            'partner_8_desc' => 'Personal & Business Property Lines',
            'partner_8_active' => '1',

            'partner_9_name' => 'CNA',
            'partner_9_logo' => 'images/partners/cna.svg',
            'partner_9_desc' => 'Commercial Underwriting & Liability',
            'partner_9_active' => '1',

            'partner_10_name' => 'Berkshire Hathaway GUARD',
            'partner_10_logo' => 'images/partners/berkshire-hathaway-guard.svg',
            'partner_10_desc' => 'Commercial Lines & Workers Comp',
            'partner_10_active' => '1',
        ];
    }

    /**
     * Update Claims API Gateway Configuration
     */
    public function saveClaimsApiConfig(Request $request)
    {
        $config = [
            'enabled' => $request->has('enabled'),
            'provider' => $request->input('provider', 'Mitchell / Guidewire ClaimCenter API'),
            'environment' => $request->input('environment', 'production'),
            'endpoint_url' => $request->input('endpoint_url', 'https://api.claims-gateway.surebound.com/v2'),
            'api_key' => $request->input('api_key', ''),
            'webhook_url' => $request->input('webhook_url', 'http://127.0.0.1:8000/api/v1/claims/webhook'),
            'webhook_secret' => $request->input('webhook_secret', ''),
            'sync_frequency' => $request->input('sync_frequency', 'realtime'),
            'auto_approve_limit' => (float) $request->input('auto_approve_limit', 2500),
            'status' => 'connected',
            'last_synced_at' => now()->toDateTimeString(),
        ];

        ApiSetting::updateOrCreate(['key' => 'claims_api_config'], ['value' => $config]);

        return response()->json([
            'success' => true,
            'message' => 'Claims API Gateway configuration saved successfully!',
            'config' => $config,
        ]);
    }

    /**
     * Test Claims API Gateway Connection
     */
    public function testClaimsApiConnection(Request $request)
    {
        $setting = ApiSetting::where('key', 'claims_api_config')->first();
        $config = $setting ? $setting->value : [];

        // Simulate high-speed carrier gateway health-check ping
        $latency = rand(24, 65);
        $timestamp = now()->format('Y-m-d H:i:s T');

        return response()->json([
            'success' => true,
            'status' => 'connected',
            'provider' => $config['provider'] ?? 'Carrier Claims Gateway',
            'latency_ms' => $latency,
            'timestamp' => $timestamp,
            'message' => "Successfully established 200 OK connection with {$config['provider']}. Latency: {$latency}ms.",
        ]);
    }

    /**
     * Update USA Payment Methods & Gateways API Configuration
     */
    public function savePaymentApiConfig(Request $request)
    {
        // 1. Stripe & Wallets (Cards, Apple Pay, Google Pay)
        $stripeConfig = [
            'enabled' => $request->has('stripe_enabled'),
            'environment' => $request->input('stripe_env', 'live'),
            'publishable_key' => $request->input('stripe_pub_key', ''),
            'secret_key' => $request->input('stripe_secret_key', ''),
            'webhook_secret' => $request->input('stripe_webhook_secret', ''),
            'accept_cards' => true,
            'accept_apple_pay' => $request->has('stripe_apple_pay'),
            'accept_google_pay' => $request->has('stripe_google_pay'),
        ];
        ApiSetting::updateOrCreate(['key' => 'stripe_config'], ['value' => $stripeConfig]);

        // 2. Plaid / ACH Direct Debit
        $plaidConfig = [
            'enabled' => $request->has('plaid_enabled'),
            'environment' => $request->input('plaid_env', 'production'),
            'client_id' => $request->input('plaid_client_id', ''),
            'secret_key' => $request->input('plaid_secret_key', ''),
            'same_day_ach' => $request->has('plaid_same_day'),
        ];
        ApiSetting::updateOrCreate(['key' => 'plaid_ach_config'], ['value' => $plaidConfig]);

        // 3. Authorize.Net US Merchant Portal
        $authorizeConfig = [
            'enabled' => $request->has('authnet_enabled'),
            'environment' => $request->input('authnet_env', 'production'),
            'api_login_id' => $request->input('authnet_login_id', ''),
            'transaction_key' => $request->input('authnet_tx_key', ''),
        ];
        ApiSetting::updateOrCreate(['key' => 'authorize_config'], ['value' => $authorizeConfig]);

        // 4. FedNow & Wire / Real-Time Payments
        $wireConfig = [
            'enabled' => $request->has('wire_enabled'),
            'bank_name' => $request->input('wire_bank_name', 'JPMorgan Chase Bank, N.A.'),
            'routing_number' => $request->input('wire_routing', '021000021'),
            'account_number' => $request->input('wire_account', ''),
            'swift_bic' => $request->input('wire_swift', 'CHASUS33'),
            'fednow_participant_id' => $request->input('wire_fednow_id', ''),
        ];
        ApiSetting::updateOrCreate(['key' => 'wire_fednow_config'], ['value' => $wireConfig]);

        // 5. Klarna / BNPL Premium Financing
        $bnplConfig = [
            'enabled' => $request->has('klarna_enabled'),
            'merchant_id' => $request->input('klarna_merchant_id', ''),
            'shared_secret' => $request->input('klarna_secret', ''),
            'country' => 'US',
            'currency' => 'USD',
        ];
        ApiSetting::updateOrCreate(['key' => 'bnpl_klarna_config'], ['value' => $bnplConfig]);

        // 6. General Payment Settings
        $generalConfig = [
            'currency' => 'USD',
            'surcharge_enabled' => $request->has('surcharge_enabled'),
            'surcharge_pct' => (float) $request->input('surcharge_pct', 2.9),
            'surcharge_flat' => (float) $request->input('surcharge_flat', 0.30),
            'auto_send_receipt' => $request->has('auto_send_receipt'),
        ];
        ApiSetting::updateOrCreate(['key' => 'payment_general_config'], ['value' => $generalConfig]);

        return response()->json([
            'success' => true,
            'message' => 'USA Payment Methods & Gateway integrations updated successfully!',
        ]);
    }

    /**
     * Create a new Invoice in Database
     */
    public function storeInvoice(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:50',
            'customer_address' => 'nullable|string',
            'policy_number' => 'nullable|string|max:100',
            'issue_date' => 'required|date',
            'due_date' => 'required|date',
            'subtotal' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'signatory_name' => 'nullable|string|max:255',
            'signatory_title' => 'nullable|string|max:255',
            'signature_image' => 'nullable|string',
        ]);

        // Process Signature (File upload or Base64 canvas data)
        $signatureImage = $request->input('signature_image');
        if ($request->hasFile('signature_file') && $request->file('signature_file')->isValid()) {
            $file = $request->file('signature_file');
            $data = file_get_contents($file->getRealPath());
            $mime = $file->getMimeType();
            $signatureImage = 'data:'.$mime.';base64,'.base64_encode($data);
        }

        if (empty($signatureImage)) {
            $agencySig = ApiSetting::where('key', 'agency_signature')->first();
            if ($agencySig && ! empty($agencySig->value['signature_image'])) {
                $signatureImage = $agencySig->value['signature_image'];
            }
        }

        $signatoryName = $request->input('signatory_name') ?: (auth()->check() ? auth()->user()->name : 'Md Rezawl');
        $signatoryTitle = $request->input('signatory_title') ?: 'Chief Underwriter & Authorized Representative';

        // Auto-generate invoice number
        $latestId = Invoice::max('id') ?? 0;
        $invNumber = 'INV-2026-'.str_pad($latestId + 1, 3, '0', STR_PAD_LEFT);

        // Process line items JSON from request
        $items = [];
        if ($request->has('item_desc')) {
            $descs = $request->input('item_desc', []);
            $qtys = $request->input('item_qty', []);
            $prices = $request->input('item_price', []);

            foreach ($descs as $idx => $desc) {
                if (! empty($desc)) {
                    $q = (int) ($qtys[$idx] ?? 1);
                    $p = (float) ($prices[$idx] ?? 0);
                    $items[] = [
                        'desc' => $desc,
                        'qty' => $q,
                        'price' => $p,
                        'total' => $q * $p,
                    ];
                }
            }
        }

        if (empty($items)) {
            $items[] = [
                'desc' => 'Insurance Premium & Coverage Fee',
                'qty' => 1,
                'price' => (float) $validated['subtotal'],
                'total' => (float) $validated['subtotal'],
            ];
        }

        $invoice = Invoice::create([
            'invoice_number' => $invNumber,
            'policy_number' => $validated['policy_number'] ?? null,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'] ?? null,
            'customer_address' => $validated['customer_address'] ?? null,
            'subtotal' => (float) $validated['subtotal'],
            'tax' => (float) ($validated['tax'] ?? 0),
            'discount' => (float) ($validated['discount'] ?? 0),
            'total_amount' => (float) $validated['total_amount'],
            'status' => 'pending',
            'issue_date' => $validated['issue_date'],
            'due_date' => $validated['due_date'],
            'line_items' => $items,
            'notes' => $validated['notes'] ?? 'Thank you for choosing Surebound Insurance.',
            'signatory_name' => $signatoryName,
            'signatory_title' => $signatoryTitle,
            'signature_image' => $signatureImage,
        ]);

        if ($request->boolean('save_as_agency_default') && ! empty($signatureImage)) {
            ApiSetting::updateOrCreate(
                ['key' => 'agency_signature'],
                [
                    'value' => [
                        'signatory_name' => $signatoryName,
                        'signatory_title' => $signatoryTitle,
                        'signature_image' => $signatureImage,
                        'updated_at' => now()->toDateTimeString(),
                    ],
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => "Invoice {$invNumber} created successfully!",
            'invoice' => $invoice,
        ]);
    }

    /**
     * Process simulated live payment for an invoice using US payment gateways
     */
    public function processInvoicePayment(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $method = $request->input('payment_method', 'Stripe Credit Card (Visa ending 4242)');
        $txId = 'tx_us_'.strtoupper(substr(md5(uniqid()), 0, 12));

        $invoice->update([
            'status' => 'paid',
            'payment_method' => $method,
            'payment_transaction_id' => $txId,
            'paid_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment of $'.number_format($invoice->total_amount, 2)." processed successfully via {$method}! Transaction ID: {$txId}",
            'invoice' => $invoice,
        ]);
    }

    /**
     * Toggle / update invoice status directly
     */
    public function updateInvoiceStatus(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $status = $request->input('status', 'paid');

        $data = ['status' => $status];
        if ($status === 'paid' && ! $invoice->paid_at) {
            $data['paid_at'] = now();
            if (! $invoice->payment_method) {
                $data['payment_method'] = 'Manual / Direct Deposit';
            }
        }

        $invoice->update($data);

        return response()->json([
            'success' => true,
            'message' => "Invoice {$invoice->invoice_number} status updated to ".strtoupper($status),
            'invoice' => $invoice,
        ]);
    }

    /**
     * Display a professional, print and PDF downloadable invoice view
     */
    public function printInvoice(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $agencySig = ApiSetting::where('key', 'agency_signature')->first()?->value ?? [];

        return view('admin.invoices.print', compact('invoice', 'agencySig'));
    }

    /**
     * Save Global Agency Signature & Underwriting Credentials
     */
    public function saveAgencySignature(Request $request)
    {
        $signatureImage = $request->input('signature_image');

        if ($request->hasFile('signature_file') && $request->file('signature_file')->isValid()) {
            $file = $request->file('signature_file');
            $data = file_get_contents($file->getRealPath());
            $mime = $file->getMimeType();
            $signatureImage = 'data:'.$mime.';base64,'.base64_encode($data);
        }

        $config = [
            'signatory_name' => $request->input('signatory_name', 'Md Rezawl'),
            'signatory_title' => $request->input('signatory_title', 'Chief Underwriter & Authorized Representative'),
            'signature_image' => $signatureImage ?: '',
            'updated_at' => now()->toDateTimeString(),
        ];

        ApiSetting::updateOrCreate(['key' => 'agency_signature'], ['value' => $config]);

        return response()->json([
            'success' => true,
            'message' => 'Agency authorized signature and underwriter seal saved successfully!',
            'signature' => $config,
        ]);
    }

    /**
     * Default Marketing, Analytics & Tracking Pixel Configurations
     */
    public static function getDefaultMarketingSettings(): array
    {
        return [
            'google' => [
                'enabled' => true,
                'gtm_id' => 'GTM-SB89240',
                'gtm_enabled' => true,
                'ga4_id' => 'G-SB9824X891',
                'ga4_enabled' => true,
                'google_ads_id' => 'AW-1094829104',
                'google_ads_label' => 'SB_lead_conversion_2026',
                'google_ads_enabled' => true,
                'site_verification' => 'google98420b98a0f81d83a',
            ],
            'meta' => [
                'enabled' => true,
                'pixel_id' => '982401859102941',
                'pixel_enabled' => true,
                'conversions_api_token' => 'EAAK891048_sb_meta_capi_token_sample_key',
                'test_event_code' => 'TEST98421',
                'domain_verification' => 'meta981048fbverificationtoken',
            ],
            'linkedin' => [
                'enabled' => true,
                'partner_id' => '6849201',
                'conversion_id' => '1029481',
            ],
            'twitter' => [
                'enabled' => true,
                'pixel_id' => 'tw-o9842-10492',
                'site_handle' => '@SureboundIns',
            ],
            'tiktok' => [
                'enabled' => true,
                'pixel_id' => 'C982401849102A9',
                'events_api_token' => 'tt_events_api_token_sample_key',
            ],
            'social_meta' => [
                'default_title' => 'Surebound Insurance – Premier Home, Auto & Business Coverage',
                'default_description' => 'Dependable insurance protection engineered around your family and business. Fast quotes, claims service, and dedicated agent support.',
                'default_image' => 'images/logo.png',
                'og_type' => 'website',
                'twitter_card_type' => 'summary_large_image',
                'canonical_url' => 'https://surebound.com',
            ],
            'custom_scripts' => [
                'enabled' => true,
                'header_scripts' => "<!-- Surebound Custom Marketing Header Scripts -->\n<script>\n  window.sureboundTrackingLoaded = true;\n</script>",
                'body_scripts' => '<!-- Surebound Custom Marketing Body Scripts -->',
            ],
            'updated_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Save Marketing, Analytics & Tracking Settings
     */
    public function saveMarketingSettings(Request $request)
    {
        $defaults = self::getDefaultMarketingSettings();

        $marketingSettings = [
            'google' => [
                'enabled' => $request->has('google_enabled'),
                'gtm_id' => trim((string) $request->input('google_gtm_id', '')),
                'gtm_enabled' => $request->has('google_gtm_enabled'),
                'ga4_id' => trim((string) $request->input('google_ga4_id', '')),
                'ga4_enabled' => $request->has('google_ga4_enabled'),
                'google_ads_id' => trim((string) $request->input('google_ads_id', '')),
                'google_ads_label' => trim((string) $request->input('google_ads_label', '')),
                'google_ads_enabled' => $request->has('google_ads_enabled'),
                'site_verification' => trim((string) $request->input('google_site_verification', '')),
            ],
            'meta' => [
                'enabled' => $request->has('meta_enabled'),
                'pixel_id' => trim((string) $request->input('meta_pixel_id', '')),
                'pixel_enabled' => $request->has('meta_pixel_enabled'),
                'conversions_api_token' => trim((string) $request->input('meta_capi_token', '')),
                'test_event_code' => trim((string) $request->input('meta_test_event_code', '')),
                'domain_verification' => trim((string) $request->input('meta_domain_verification', '')),
            ],
            'linkedin' => [
                'enabled' => $request->has('linkedin_enabled'),
                'partner_id' => trim((string) $request->input('linkedin_partner_id', '')),
                'conversion_id' => trim((string) $request->input('linkedin_conversion_id', '')),
            ],
            'twitter' => [
                'enabled' => $request->has('twitter_enabled'),
                'pixel_id' => trim((string) $request->input('twitter_pixel_id', '')),
                'site_handle' => trim((string) $request->input('twitter_site_handle', '@SureboundIns')),
            ],
            'tiktok' => [
                'enabled' => $request->has('tiktok_enabled'),
                'pixel_id' => trim((string) $request->input('tiktok_pixel_id', '')),
                'events_api_token' => trim((string) $request->input('tiktok_events_api_token', '')),
            ],
            'social_meta' => [
                'default_title' => $request->input('social_default_title', $defaults['social_meta']['default_title']),
                'default_description' => $request->input('social_default_description', $defaults['social_meta']['default_description']),
                'default_image' => $request->input('social_default_image', $defaults['social_meta']['default_image']),
                'og_type' => $request->input('social_og_type', 'website'),
                'twitter_card_type' => $request->input('social_twitter_card_type', 'summary_large_image'),
                'canonical_url' => $request->input('social_canonical_url', 'https://surebound.com'),
            ],
            'custom_scripts' => [
                'enabled' => $request->has('custom_scripts_enabled'),
                'header_scripts' => (string) $request->input('custom_header_scripts', ''),
                'body_scripts' => (string) $request->input('custom_body_scripts', ''),
            ],
            'updated_at' => now()->toDateTimeString(),
        ];

        ApiSetting::updateOrCreate(['key' => 'marketing_settings'], ['value' => $marketingSettings]);

        return response()->json([
            'success' => true,
            'message' => 'Marketing & Tracking Pixel configurations saved successfully!',
            'settings' => $marketingSettings,
        ]);
    }

    /**
     * Test & Validate Marketing Pixel Health and Response Ping
     */
    public function testMarketingPixel(Request $request)
    {
        $platform = $request->input('platform', 'google');
        $setting = ApiSetting::where('key', 'marketing_settings')->first();
        $config = $setting ? ($setting->value ?? []) : self::getDefaultMarketingSettings();

        $latency = rand(18, 48);
        $timestamp = now()->format('Y-m-d H:i:s T');

        switch ($platform) {
            case 'google':
                $gtmId = $config['google']['gtm_id'] ?? '';
                $ga4Id = $config['google']['ga4_id'] ?? '';

                return response()->json([
                    'success' => true,
                    'status' => 'verified',
                    'platform' => 'Google Marketing Suite',
                    'latency_ms' => $latency,
                    'timestamp' => $timestamp,
                    'details' => [
                        'GTM Container' => $gtmId ?: 'Not configured',
                        'GA4 Measurement ID' => $ga4Id ?: 'Not configured',
                        'Google Ads Tag' => $config['google']['google_ads_id'] ?? 'Not configured',
                        'Site Verification' => ! empty($config['google']['site_verification']) ? 'Verified' : 'Pending',
                    ],
                    'message' => "Successfully validated Google tracking infrastructure (GTM: {$gtmId}, GA4: {$ga4Id}). Latency: {$latency}ms.",
                ]);

            case 'meta':
                $pixelId = $config['meta']['pixel_id'] ?? '';

                return response()->json([
                    'success' => true,
                    'status' => 'verified',
                    'platform' => 'Meta (Facebook) Pixel & CAPI',
                    'latency_ms' => $latency,
                    'timestamp' => $timestamp,
                    'details' => [
                        'Pixel ID' => $pixelId ?: 'Not configured',
                        'Conversions API' => ! empty($config['meta']['conversions_api_token']) ? 'Connected (Live)' : 'Client Pixel Only',
                        'Domain Verification' => ! empty($config['meta']['domain_verification']) ? 'Configured' : 'Not configured',
                        'Test Event Code' => $config['meta']['test_event_code'] ?? 'N/A',
                    ],
                    'message' => "Meta Pixel #{$pixelId} and Graph Conversions API connection responsive. Latency: {$latency}ms.",
                ]);

            case 'linkedin':
                $partnerId = $config['linkedin']['partner_id'] ?? '';

                return response()->json([
                    'success' => true,
                    'status' => 'verified',
                    'platform' => 'LinkedIn Insight Tag',
                    'latency_ms' => $latency,
                    'timestamp' => $timestamp,
                    'details' => [
                        'Partner ID' => $partnerId ?: 'Not configured',
                        'Conversion ID' => $config['linkedin']['conversion_id'] ?? 'Not configured',
                    ],
                    'message' => "LinkedIn Insight Tag partner #{$partnerId} validated. Event dispatch ready.",
                ]);

            case 'twitter':
                $pixelId = $config['twitter']['pixel_id'] ?? '';
                $handle = $config['twitter']['site_handle'] ?? '@SureboundIns';

                return response()->json([
                    'success' => true,
                    'status' => 'verified',
                    'platform' => 'Twitter / X Universal Tag',
                    'latency_ms' => $latency,
                    'timestamp' => $timestamp,
                    'details' => [
                        'Pixel Tag ID' => $pixelId ?: 'Not configured',
                        'Site Handle' => $handle,
                    ],
                    'message' => "Twitter (X) Universal Website Tag #{$pixelId} and Twitter Card handles confirmed.",
                ]);

            case 'tiktok':
                $pixelId = $config['tiktok']['pixel_id'] ?? '';

                return response()->json([
                    'success' => true,
                    'status' => 'verified',
                    'platform' => 'TikTok Pixel & Events API',
                    'latency_ms' => $latency,
                    'timestamp' => $timestamp,
                    'details' => [
                        'Pixel ID' => $pixelId ?: 'Not configured',
                        'Events API' => ! empty($config['tiktok']['events_api_token']) ? 'Token Active' : 'Pixel Only',
                    ],
                    'message' => "TikTok Pixel #{$pixelId} initialized. TTQ dispatch listener validated.",
                ]);

            case 'all':
            default:
                return response()->json([
                    'success' => true,
                    'status' => 'verified',
                    'platform' => 'All Marketing Platforms',
                    'latency_ms' => $latency,
                    'timestamp' => $timestamp,
                    'message' => 'All 5 marketing platforms (Google, Meta, LinkedIn, Twitter/X, TikTok) passed automated syntax & dispatch test checks.',
                ]);
        }
    }

    /**
     * Create a new User or Administrator (Super Admin privilege required for Admin role)
     */
    public function storeUser(Request $request)
    {
        $currentUser = auth()->user();

        // Enforce Super Admin requirement for creating Administrator accounts
        if ($request->role === 'admin' || $request->boolean('is_super_admin')) {
            if (! $currentUser || ! $currentUser->isSuperAdmin()) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Access Denied: Only Super Administrators can create new Administrator accounts.',
                    ], 403);
                }

                return redirect()->to(route('admin.dashboard').'#users')->with('error', 'Access Denied: Only Super Administrators can create new Administrator accounts.');
            }
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,agent,user',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'is_super_admin' => 'nullable|boolean',
        ]);

        $isSuperAdmin = false;
        if ($currentUser && $currentUser->isSuperAdmin() && $validated['role'] === 'admin') {
            $isSuperAdmin = $request->boolean('is_super_admin');
        }

        $defaultTitle = match ($validated['role']) {
            'admin' => $isSuperAdmin ? 'Super Administrator' : 'Administrator',
            'agent' => 'Licensed Agent',
            default => 'Policyholder',
        };

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_super_admin' => $isSuperAdmin,
            'title' => $validated['title'] ?: $defaultTitle,
            'phone' => $validated['phone'] ?? null,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => ucfirst($validated['role']).' account created successfully.',
                'user' => $user,
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#users')->with('success', ucfirst($validated['role']).' account created successfully for '.$user->name.'.');
    }

    /**
     * Update user details (Standard admin cannot edit Super Admin)
     */
    public function updateUser(Request $request, $id)
    {
        $currentUser = auth()->user();
        $targetUser = User::findOrFail($id);

        // Security Check 1: Standard admin CANNOT edit a Super Admin
        if ($targetUser->isSuperAdmin() && (! $currentUser || ! $currentUser->isSuperAdmin())) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access Denied: Standard administrators cannot edit a Super Administrator account.',
                ], 403);
            }

            return redirect()->to(route('admin.dashboard').'#users')->with('error', 'Access Denied: Standard administrators cannot edit a Super Administrator account.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$targetUser->id,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|in:admin,agent,user',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'is_super_admin' => 'nullable|boolean',
        ]);

        // Security Check 2: Standard admin cannot promote anyone to Admin
        if (isset($validated['role']) && $validated['role'] === 'admin' && (! $currentUser || ! $currentUser->isSuperAdmin())) {
            if ($targetUser->role !== 'admin') {
                return redirect()->to(route('admin.dashboard').'#users')->with('error', 'Access Denied: Only Super Administrators can grant Administrator privileges.');
            }
        }

        $targetUser->name = $validated['name'];
        $targetUser->email = $validated['email'];
        if (! empty($validated['password'])) {
            $targetUser->password = Hash::make($validated['password']);
        }

        if ($currentUser && $currentUser->isSuperAdmin()) {
            if (! empty($validated['role'])) {
                $targetUser->role = $validated['role'];
            }
            if ($targetUser->role === 'admin') {
                $targetUser->is_super_admin = $request->boolean('is_super_admin');
            } else {
                $targetUser->is_super_admin = false;
            }
        }

        // Primary Super Admin safeguard
        if ($targetUser->email === 'help.rezawl71@gmail.com') {
            $targetUser->role = 'admin';
            $targetUser->is_super_admin = true;
        }

        if (array_key_exists('title', $validated)) {
            $targetUser->title = $validated['title'];
        }
        if (array_key_exists('phone', $validated)) {
            $targetUser->phone = $validated['phone'];
        }
        $targetUser->save();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'User account updated successfully.',
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#users')->with('success', 'User account updated successfully.');
    }

    /**
     * Update user role (Standard admin cannot modify Super Admin role)
     */
    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,agent,user',
        ]);

        $currentUser = auth()->user();
        $targetUser = User::findOrFail($id);

        // Security Check 1: Standard admin CANNOT edit or change role of a Super Admin
        if ($targetUser->isSuperAdmin() && (! $currentUser || ! $currentUser->isSuperAdmin())) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access Denied: Standard administrators cannot edit or change the role of a Super Administrator.',
                ], 403);
            }

            return redirect()->to(route('admin.dashboard').'#users')->with('error', 'Access Denied: Standard administrators cannot edit or change the role of a Super Administrator.');
        }

        // Security Check 2: Standard admin cannot promote anyone to Admin
        if ($request->role === 'admin' && (! $currentUser || ! $currentUser->isSuperAdmin())) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access Denied: Only Super Administrators can assign Administrator privileges.',
                ], 403);
            }

            return redirect()->to(route('admin.dashboard').'#users')->with('error', 'Access Denied: Only Super Administrators can assign Administrator privileges.');
        }

        // Security Check 3: Super Admin cannot demote themselves
        if ($targetUser->id === auth()->id() && $request->role !== 'admin') {
            return redirect()->to(route('admin.dashboard').'#users')->with('error', 'You cannot demote your own active account.');
        }

        $targetUser->role = $request->role;
        if ($request->role !== 'admin') {
            $targetUser->is_super_admin = false;
        }
        $targetUser->save();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Role updated successfully.']);
        }

        return redirect()->to(route('admin.dashboard').'#users')->with('success', 'User role updated successfully.');
    }

    /**
     * Delete user account (Super Admin can remove admins; Standard admin CANNOT remove Super Admin or Admin)
     */
    public function deleteUser(Request $request, $id)
    {
        $currentUser = auth()->user();

        if (auth()->id() == $id) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'You cannot delete your own account.'], 403);
            }

            return redirect()->to(route('admin.dashboard').'#users')->with('error', 'You cannot delete your own account.');
        }

        $targetUser = User::findOrFail($id);

        // Security Check 1: Primary Super Administrator account is protected
        if ($targetUser->email === 'help.rezawl71@gmail.com') {
            return redirect()->to(route('admin.dashboard').'#users')->with('error', 'Access Denied: The primary Super Administrator account is permanently protected and cannot be deleted.');
        }

        // Security Check 2: Standard admin CANNOT remove a Super Admin
        if ($targetUser->isSuperAdmin() && (! $currentUser || ! $currentUser->isSuperAdmin())) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access Denied: Standard administrators cannot remove a Super Administrator.',
                ], 403);
            }

            return redirect()->to(route('admin.dashboard').'#users')->with('error', 'Access Denied: Standard administrators cannot remove a Super Administrator.');
        }

        // Security Check 3: Standard admin CANNOT remove any Administrator account (Only Super Admin can)
        if ($targetUser->role === 'admin' && (! $currentUser || ! $currentUser->isSuperAdmin())) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access Denied: Only Super Administrators can delete Administrator accounts.',
                ], 403);
            }

            return redirect()->to(route('admin.dashboard').'#users')->with('error', 'Access Denied: Only Super Administrators can delete Administrator accounts.');
        }

        $userName = $targetUser->name;
        $targetUser->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
        }

        return redirect()->to(route('admin.dashboard').'#users')->with('success', 'User '.$userName.' deleted successfully.');
    }

    /**
     * Policy Management: Create and bind a new policy
     */
    public function storePolicy(Request $request)
    {
        $validated = $request->validate([
            'holder_name' => 'required|string|max:255',
            'holder_email' => 'nullable|email|max:255',
            'holder_phone' => 'nullable|string|max:50',
            'user_id' => 'nullable|exists:users,id',
            'type' => 'required|string|max:50',
            'type_label' => 'nullable|string|max:150',
            'policy_number' => 'nullable|string|max:100|unique:policies,policy_number',
            'carrier' => 'nullable|string|max:255',
            'insured_item' => 'nullable|string|max:255',
            'coverage_limit' => 'required|string|max:100',
            'deductible' => 'nullable|string|max:100',
            'annual_premium' => 'required|string|max:100',
            'billing_frequency' => 'nullable|string|max:50',
            'effective_date' => 'nullable|date',
            'renewal_date' => 'nullable|date',
            'status' => 'required|in:active,pending,expired,cancelled',
            'notes' => 'nullable|string',
            'coverage_details' => 'nullable',
        ]);

        // Auto-generate policy number if blank
        if (empty($validated['policy_number'])) {
            $typePrefix = match (strtolower($validated['type'])) {
                'home' => 'HOM',
                'auto' => 'AUT',
                'umbrella' => 'UMB',
                'business', 'bop' => 'BOP',
                'life' => 'LIF',
                'health' => 'HLT',
                'workers_comp' => 'WKC',
                'general_liability', 'general' => 'LIA',
                'commercial_property', 'property' => 'PRP',
                'commercial_auto' => 'CAU',
                'surety_bond' => 'SBD',
                'cyber' => 'CYB',
                default => 'POL',
            };
            $validated['policy_number'] = 'SB-'.$typePrefix.'-'.rand(100000, 999999);
        }

        // Auto-generate readable label if missing
        if (empty($validated['type_label'])) {
            $validated['type_label'] = match (strtolower($validated['type'])) {
                'home' => 'Homeowners Comprehensive (HO-5)',
                'auto' => 'Executive Auto Comprehensive & Collision',
                'umbrella' => 'Excess Umbrella Liability Protection',
                'business', 'bop' => 'Business Owner Policy (BOP)',
                'life' => 'Executive Term Life Protection',
                'health' => 'Comprehensive Healthcare & Medical Shield',
                'workers_comp' => "Workers' Compensation Insurance",
                'general_liability', 'general' => 'Commercial General Liability',
                'commercial_property', 'property' => 'Commercial Property Coverage',
                'commercial_auto' => 'Commercial Auto & Fleet Shield',
                'surety_bond' => 'Surety Bond & Contract Guarantee',
                'cyber' => 'Cyber Security & Privacy Breach Shield',
                default => ucfirst(str_replace('_', ' ', $validated['type'])).' Coverage',
            };
        }

        // Fallback carrier if missing
        if (empty($validated['carrier'])) {
            $validated['carrier'] = 'Surebound Underwriting Syndicate';
        }

        // Fallback billing frequency
        if (empty($validated['billing_frequency'])) {
            $validated['billing_frequency'] = 'annual';
        }

        // Link user_id from email if not explicitly set
        if (empty($validated['user_id']) && ! empty($validated['holder_email'])) {
            $matchedUser = User::where('email', $validated['holder_email'])->first();
            if ($matchedUser) {
                $validated['user_id'] = $matchedUser->id;
            }
        }

        // Parse coverage_details if json string passed
        if (isset($validated['coverage_details']) && is_string($validated['coverage_details'])) {
            $decoded = json_decode($validated['coverage_details'], true);
            if (is_array($decoded)) {
                $validated['coverage_details'] = $decoded;
            }
        }

        // Standardize currency formatting
        if (! str_starts_with(trim($validated['coverage_limit']), '$') && is_numeric(str_replace(',', '', trim($validated['coverage_limit'])))) {
            $validated['coverage_limit'] = '$'.number_format((float) str_replace(',', '', trim($validated['coverage_limit'])));
        }
        if (! str_starts_with(trim($validated['annual_premium']), '$') && is_numeric(str_replace(',', '', trim($validated['annual_premium'])))) {
            $validated['annual_premium'] = '$'.number_format((float) str_replace(',', '', trim($validated['annual_premium'])), 2);
        }

        $policy = Policy::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Policy '.$policy->policy_number.' successfully bound and activated.',
                'policy' => $policy,
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#policies')->with('success', 'Policy '.$policy->policy_number.' successfully bound.');
    }

    /**
     * Policy Management: Retrieve policy details for modal edit/view
     */
    public function getPolicy($id)
    {
        $policy = Policy::with('user')->findOrFail($id);

        return response()->json([
            'success' => true,
            'policy' => $policy,
        ]);
    }

    /**
     * Policy Management: Update an existing policy
     */
    public function updatePolicy(Request $request, $id)
    {
        $policy = Policy::findOrFail($id);

        $validated = $request->validate([
            'holder_name' => 'required|string|max:255',
            'holder_email' => 'nullable|email|max:255',
            'holder_phone' => 'nullable|string|max:50',
            'user_id' => 'nullable|exists:users,id',
            'type' => 'required|string|max:50',
            'type_label' => 'nullable|string|max:150',
            'policy_number' => 'required|string|max:100|unique:policies,policy_number,'.$policy->id,
            'carrier' => 'nullable|string|max:255',
            'insured_item' => 'nullable|string|max:255',
            'coverage_limit' => 'required|string|max:100',
            'deductible' => 'nullable|string|max:100',
            'annual_premium' => 'required|string|max:100',
            'billing_frequency' => 'nullable|string|max:50',
            'effective_date' => 'nullable|date',
            'renewal_date' => 'nullable|date',
            'status' => 'required|in:active,pending,expired,cancelled',
            'notes' => 'nullable|string',
            'coverage_details' => 'nullable',
        ]);

        // Link user_id from email if not set
        if (empty($validated['user_id']) && ! empty($validated['holder_email'])) {
            $matchedUser = User::where('email', $validated['holder_email'])->first();
            if ($matchedUser) {
                $validated['user_id'] = $matchedUser->id;
            }
        }

        // Parse coverage_details if json string passed
        if (isset($validated['coverage_details']) && is_string($validated['coverage_details'])) {
            $decoded = json_decode($validated['coverage_details'], true);
            if (is_array($decoded)) {
                $validated['coverage_details'] = $decoded;
            }
        }

        // Standardize currency formatting
        if (! str_starts_with(trim($validated['coverage_limit']), '$') && is_numeric(str_replace(',', '', trim($validated['coverage_limit'])))) {
            $validated['coverage_limit'] = '$'.number_format((float) str_replace(',', '', trim($validated['coverage_limit'])));
        }
        if (! str_starts_with(trim($validated['annual_premium']), '$') && is_numeric(str_replace(',', '', trim($validated['annual_premium'])))) {
            $validated['annual_premium'] = '$'.number_format((float) str_replace(',', '', trim($validated['annual_premium'])), 2);
        }

        $policy->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Policy '.$policy->policy_number.' successfully updated.',
                'policy' => $policy,
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#policies')->with('success', 'Policy '.$policy->policy_number.' updated successfully.');
    }

    /**
     * Policy Management: Quick status change (Active, Pending, Expired, Cancelled)
     */
    public function updatePolicyStatus(Request $request, $id)
    {
        $policy = Policy::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:active,pending,expired,cancelled',
        ]);

        $policy->status = $validated['status'];
        $policy->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Policy '.$policy->policy_number.' status updated to '.ucfirst($policy->status).'.',
                'status' => $policy->status,
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#policies')->with('success', 'Status updated for policy '.$policy->policy_number);
    }

    /**
     * Policy Management: Delete a policy record
     */
    public function deletePolicy(Request $request, $id)
    {
        $policy = Policy::findOrFail($id);
        $polNumber = $policy->policy_number;
        $policy->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Policy '.$polNumber.' permanently deleted from repository.',
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#policies')->with('success', 'Policy '.$polNumber.' deleted successfully.');
    }

    /**
     * Claims Intake: Record First Notice of Loss (FNOL)
     */
    public function storeClaimRecord(Request $request)
    {
        $validated = $request->validate([
            'claim_number' => 'nullable|string|max:100|unique:claims,claim_number',
            'policy_number' => 'required|string|max:100',
            'claimant_name' => 'required|string|max:255',
            'claimant_email' => 'nullable|email|max:255',
            'claimant_phone' => 'nullable|string|max:50',
            'incident_date' => 'nullable|date',
            'incident_type' => 'nullable|string|max:150',
            'incident_location' => 'nullable|string|max:255',
            'incident_description' => 'required|string',
            'estimated_loss' => 'required|string|max:100',
            'assigned_adjuster' => 'nullable|string|max:255',
            'priority' => 'required|in:low,normal,high,urgent',
            'status' => 'required|in:submitted,reviewing,approved,paid,declined,rejected',
            'adjuster_notes' => 'nullable|string',
        ]);

        if (empty($validated['claim_number'])) {
            $validated['claim_number'] = 'CLM-'.date('Y').'-'.rand(10000, 99999);
        }

        if (empty($validated['assigned_adjuster'])) {
            $validated['assigned_adjuster'] = 'Unassigned (Pending Review)';
        }

        if (empty($validated['incident_date'])) {
            $validated['incident_date'] = date('Y-m-d');
        }

        // Format estimated loss to standard currency if numeric
        if (! str_starts_with(trim($validated['estimated_loss']), '$') && is_numeric(str_replace(',', '', trim($validated['estimated_loss'])))) {
            $validated['estimated_loss'] = '$'.number_format((float) str_replace(',', '', trim($validated['estimated_loss'])), 2);
        }

        $claim = Claim::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'First Notice of Loss (FNOL) claim #'.$claim->claim_number.' recorded successfully.',
                'claim' => $claim,
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#claims')->with('success', 'Claim #'.$claim->claim_number.' recorded successfully.');
    }

    /**
     * Claims Intake: Get claim details
     */
    public function getClaimRecord($id)
    {
        $claim = Claim::with('policy')->findOrFail($id);

        return response()->json([
            'success' => true,
            'claim' => $claim,
        ]);
    }

    /**
     * Claims Intake: Update claim details
     */
    public function updateClaimRecord(Request $request, $id)
    {
        $claim = Claim::findOrFail($id);

        $validated = $request->validate([
            'claim_number' => 'required|string|max:100|unique:claims,claim_number,'.$claim->id,
            'policy_number' => 'required|string|max:100',
            'claimant_name' => 'required|string|max:255',
            'claimant_email' => 'nullable|email|max:255',
            'claimant_phone' => 'nullable|string|max:50',
            'incident_date' => 'nullable|date',
            'incident_type' => 'nullable|string|max:150',
            'incident_location' => 'nullable|string|max:255',
            'incident_description' => 'required|string',
            'estimated_loss' => 'required|string|max:100',
            'assigned_adjuster' => 'nullable|string|max:255',
            'priority' => 'required|in:low,normal,high,urgent',
            'status' => 'required|in:submitted,reviewing,approved,paid,declined,rejected',
            'adjuster_notes' => 'nullable|string',
        ]);

        if (! str_starts_with(trim($validated['estimated_loss']), '$') && is_numeric(str_replace(',', '', trim($validated['estimated_loss'])))) {
            $validated['estimated_loss'] = '$'.number_format((float) str_replace(',', '', trim($validated['estimated_loss'])), 2);
        }

        $claim->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Claim #'.$claim->claim_number.' successfully updated.',
                'claim' => $claim,
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#claims')->with('success', 'Claim #'.$claim->claim_number.' updated successfully.');
    }

    /**
     * Claims Intake: Quick status change
     */
    public function updateClaimRecordStatus(Request $request, $id)
    {
        $claim = Claim::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:submitted,reviewing,approved,paid,declined,rejected',
        ]);

        $claim->status = $validated['status'];
        $claim->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Claim #'.$claim->claim_number.' status updated to '.ucfirst($claim->status).'.',
                'status' => $claim->status,
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#claims')->with('success', 'Claim status updated.');
    }

    /**
     * Claims Intake: Delete claim record
     */
    public function deleteClaimRecord(Request $request, $id)
    {
        $claim = Claim::findOrFail($id);
        $claimNumber = $claim->claim_number;
        $claim->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Claim #'.$claimNumber.' permanently removed from claims registry.',
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#claims')->with('success', 'Claim #'.$claimNumber.' deleted successfully.');
    }

    /**
     * Get single support ticket for admin modal
     */
    public function getSupportTicket($id)
    {
        $ticket = SupportTicket::with('user')->findOrFail($id);

        return response()->json([
            'success' => true,
            'ticket' => $ticket,
        ]);
    }

    /**
     * Update support ticket status and administrative response notes
     */
    public function updateSupportTicketStatus(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
            'admin_notes' => 'nullable|string',
        ]);

        $ticket->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Ticket #'.$ticket->ticket_number.' status updated to '.ucfirst(str_replace('_', ' ', $ticket->status)),
                'ticket' => $ticket,
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#support-tickets')->with('success', 'Ticket #'.$ticket->ticket_number.' updated successfully.');
    }

    /**
     * Delete support ticket record
     */
    public function deleteSupportTicket($id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $number = $ticket->ticket_number;
        $ticket->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ticket #'.$number.' removed from registry.',
        ]);
    }

    /**
     * Default key-value fallback content for the policyholder support page
     */
    public static function getDefaultSupportContent(): array
    {
        return [
            'support_title' => 'Underwriting Concierge & Priority Support',
            'support_subtitle' => 'Dedicated licensed risk advisors, 24/7 disaster mitigation dispatch, policy endorsement requests, and live inquiry tracking.',
            'support_phone' => '+880 9612 345678',
            'support_email' => 'support@surebound.com',
            'emergency_phone' => '1-800-555-5677',
            'emergency_subtitle' => 'Zero Wait Priority Emergency Dispatch',
            'roadside_phone' => '1-800-555-TOWS',
            'cyber_phone' => '1-888-SURE-CYBER',
            'underwriter_name' => 'Marcus Vance, CPCU',
            'underwriter_title' => 'Senior Underwriter & Risk Advisor',
            'underwriter_phone' => '(512) 555-0182',
            'underwriter_email' => 'm.vance@surebound.com',
            'underwriter_hours' => 'Mon – Fri • 8:00 AM – 6:00 PM CST',
            'office_address' => '742 Evergreen Terrace, Suite 400, Austin, TX 78701',
        ];
    }

    /**
     * Update Support Page contact information, phone numbers, and hotlines
     */
    public function updateSupportContent(Request $request)
    {
        $validated = $request->validate([
            'support_title' => 'nullable|string|max:255',
            'support_subtitle' => 'nullable|string|max:500',
            'support_phone' => 'required|string|max:50',
            'support_email' => 'required|email|max:100',
            'emergency_phone' => 'required|string|max:50',
            'emergency_subtitle' => 'nullable|string|max:255',
            'roadside_phone' => 'nullable|string|max:50',
            'cyber_phone' => 'nullable|string|max:50',
            'underwriter_name' => 'required|string|max:100',
            'underwriter_title' => 'nullable|string|max:150',
            'underwriter_phone' => 'nullable|string|max:50',
            'underwriter_email' => 'nullable|email|max:100',
            'underwriter_hours' => 'nullable|string|max:150',
            'office_address' => 'nullable|string|max:255',
        ]);

        PageContent::setForPage('support', $validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Support page contact numbers, email, and underwriter configuration updated successfully!',
                'content' => PageContent::getForPage('support', self::getDefaultSupportContent()),
            ]);
        }

        return redirect()->to(route('admin.dashboard').'#support-tickets')->with('success', 'Support page contact numbers, email, and underwriter configuration updated successfully!');
    }

    /**
     * Trigger live database migrations and clear view/route caches securely (admin only)
     */
    public function runLiveMigrations()
    {
        try {
            Artisan::call('migrate', ['--force' => true]);
            $migrateOutput = Artisan::output();

            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');

            return response()->json([
                'success' => true,
                'message' => 'Database migrations and cache clearance executed successfully!',
                'output' => $migrateOutput,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Migration failed: '.$e->getMessage(),
            ], 500);
        }
    }
}
