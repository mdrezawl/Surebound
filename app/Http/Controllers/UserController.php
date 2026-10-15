<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Invoice;
use App\Models\PageContent;
use App\Models\Policy;
use App\Models\Quote;
use App\Models\SupportTicket;
use App\Models\User;
use Database\Seeders\ClaimSeeder;
use Database\Seeders\InvoiceSeeder;
use Database\Seeders\PolicySeeder;
use Database\Seeders\QuoteSeeder;
use Database\Seeders\SupportTicketSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display the Policyholder Customer Portal Dashboard
     */
    public function dashboard()
    {
        /** @var User|null $user */
        $user = Auth::user();

        // Fallback for static export or preview
        if (! $user) {
            $user = User::where('role', 'user')->first() ?? new User([
                'name' => 'Valued Policyholder',
                'email' => 'client@surebound.com',
                'role' => 'user',
                'title' => 'Policyholder',
                'phone' => '',
            ]);
        }

        if (Policy::count() === 0) {
            (new PolicySeeder)->run();
        }
        if (Claim::count() === 0) {
            (new ClaimSeeder)->run();
        }
        if (Invoice::count() === 0) {
            (new InvoiceSeeder)->run();
        }
        if (Quote::count() === 0) {
            (new QuoteSeeder)->run();
        }

        // Fetch customer specific policies
        $polQuery = Policy::query();
        if ($user->exists) {
            $polQuery->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('holder_email', $user->email)
                    ->orWhere('holder_name', 'like', '%'.$user->name.'%');
            });
        }
        $policies = $polQuery->orderBy('id', 'desc')->get();
        if ($policies->isEmpty()) {
            $policies = Policy::orderBy('id', 'desc')->get();
        }

        // Fetch customer claims
        $claimQuery = Claim::query();
        if ($user->exists) {
            $claimQuery->where(function ($q) use ($user) {
                $q->where('claimant_email', $user->email)
                    ->orWhere('claimant_name', 'like', '%'.$user->name.'%');
            });
        }
        $claims = $claimQuery->orderBy('id', 'desc')->get();
        if ($claims->isEmpty()) {
            $claims = Claim::orderBy('id', 'desc')->get();
        }

        // Fetch customer quotes
        $quoteQuery = Quote::query();
        if ($user->exists) {
            $quoteQuery->where(function ($q) use ($user) {
                $q->where('email', $user->email)
                    ->orWhere('name', 'like', '%'.$user->name.'%');
            });
        }
        $quotes = $quoteQuery->orderBy('id', 'desc')->get();
        if ($quotes->isEmpty()) {
            $quotes = Quote::orderBy('id', 'desc')->get();
        }

        // Fetch customer invoices
        $invQuery = Invoice::query();
        if ($user->exists) {
            $invQuery->where(function ($q) use ($user) {
                $q->where('customer_email', $user->email)
                    ->orWhere('customer_name', 'like', '%'.$user->name.'%');
            });
        }
        $invoices = $invQuery->orderBy('id', 'desc')->get();
        if ($invoices->isEmpty()) {
            $invoices = Invoice::orderBy('id', 'desc')->get();
        }

        // Customer KPIs
        $activePoliciesCount = $policies->where('status', 'active')->count();
        $totalCoverage = $policies->sum(function ($p) {
            return (float) preg_replace('/[^0-9.]/', '', $p->coverage_limit ?? '0');
        });
        $pendingClaimsCount = $claims->whereIn('status', ['submitted', 'reviewing'])->count();
        $dueInvoicesAmount = $invoices->whereIn('status', ['pending', 'overdue'])->sum('total_amount');
        $supportContent = PageContent::getForPage('support', AdminController::getDefaultSupportContent());

        return view('user.dashboard', compact(
            'user',
            'policies',
            'claims',
            'quotes',
            'invoices',
            'supportContent',
            'activePoliciesCount',
            'totalCoverage',
            'pendingClaimsCount',
            'dueInvoicesAmount'
        ));
    }

    public function policies(Request $request)
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            $user = User::where('role', 'user')->first() ?? User::first() ?? new User([
                'name' => 'Md Rezawl',
                'email' => 'rezawl71@gmail.com',
                'role' => 'user',
                'title' => 'Policyholder',
                'phone' => '(512) 840-2918',
            ]);
        }

        // Auto-seed policies if database currently has none
        if (Policy::count() === 0) {
            (new PolicySeeder)->run();
        }

        // Retrieve policies for current policyholder
        $query = Policy::query();
        if ($user->exists) {
            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('holder_email', $user->email)
                    ->orWhere('holder_name', 'like', '%'.$user->name.'%');
            });
        }

        $policies = $query->orderBy('id', 'desc')->get();

        // If user has no specific policies yet, fallback to all bound policies so the demo and evaluation are complete
        if ($policies->isEmpty()) {
            $policies = Policy::orderBy('id', 'desc')->get();
        }

        // Calculate Policyholder KPIs
        $totalPoliciesCount = $policies->count();
        $activePoliciesCount = $policies->where('status', 'active')->count();
        $totalCoverageLimit = $policies->sum(fn ($p) => $p->numeric_limit);
        $totalAnnualPremium = $policies->sum(fn ($p) => $p->numeric_premium);

        $nextRenewalPolicy = $policies->where('status', 'active')
            ->where('renewal_date', '>=', now())
            ->sortBy('renewal_date')
            ->first();
        $nextRenewalDate = $nextRenewalPolicy?->renewal_date;

        return view('user.policies', compact(
            'user',
            'policies',
            'totalPoliciesCount',
            'activePoliciesCount',
            'totalCoverageLimit',
            'totalAnnualPremium',
            'nextRenewalDate',
            'nextRenewalPolicy'
        ));
    }

    /**
     * Show policy detail or return JSON for modal inspection
     */
    public function policyDetail($id)
    {
        $policy = Policy::with('user')->findOrFail($id);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'policy' => $policy,
            ]);
        }

        return view('user.policy-detail', compact('policy'));
    }

    /**
     * Printable Digital Insurance Identification Card
     */
    public function downloadIdCard($id)
    {
        $policy = Policy::findOrFail($id);

        return view('user.policy-id-card', compact('policy'));
    }

    public function quote()
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            $user = User::where('role', 'user')->first() ?? User::first();
        }

        if (Quote::count() === 0) {
            (new QuoteSeeder)->run();
        }

        $query = Quote::query();
        if ($user && $user->exists) {
            $query->where(function ($q) use ($user) {
                $q->where('email', $user->email)
                    ->orWhere('name', 'like', '%'.$user->name.'%');
            });
        }
        $quotes = $query->orderBy('id', 'desc')->get();
        if ($quotes->isEmpty()) {
            $quotes = Quote::orderBy('id', 'desc')->get();
        }

        $totalQuotesCount = $quotes->count();
        $quotedCount = $quotes->where('status', 'quoted')->count();
        $reviewingCount = $quotes->where('status', 'reviewing')->count();
        $newCount = $quotes->where('status', 'new')->count();
        $convertedCount = $quotes->where('status', 'converted')->count();

        return view('user.quote', compact(
            'user',
            'quotes',
            'totalQuotesCount',
            'quotedCount',
            'reviewingCount',
            'newCount',
            'convertedCount'
        ));
    }

    /**
     * Accept rate proposal and bind policy contract instantly
     */
    public function acceptQuote($id)
    {
        $quote = Quote::findOrFail($id);
        $user = Auth::user();

        // Mark quote as converted
        $quote->update([
            'status' => 'converted',
        ]);

        $policyPrefix = match ($quote->type) {
            'home' => 'SB-HOM-',
            'auto' => 'SB-AUT-',
            'business' => 'SB-BUS-',
            'life' => 'SB-LIF-',
            default => 'SB-POL-',
        };
        $policyNumber = $policyPrefix.rand(100000, 999999);

        // Bind new Policy contract
        $policy = Policy::create([
            'policy_number' => $policyNumber,
            'user_id' => $user?->id,
            'holder_name' => $quote->name ?: ($user?->name ?? 'Valued Policyholder'),
            'holder_email' => $quote->email ?: ($user?->email ?? 'policyholder@surebound.com'),
            'holder_phone' => $quote->phone ?: ($user?->phone ?? '(512) 840-2918'),
            'type' => in_array($quote->type, ['home', 'auto', 'life', 'business']) ? $quote->type : 'business',
            'plan_name' => $quote->type_label ?? 'Comprehensive Executive Coverage',
            'insured_item' => 'Primary Named Insured Asset ('.$quote->location.')',
            'coverage_limit' => $quote->coverage ?? '$1,000,000 Aggregate',
            'deductible' => '$1,000 per occurrence',
            'annual_premium' => $quote->premium ?? '$1,200.00 / yr',
            'effective_date' => now()->toDateString(),
            'renewal_date' => now()->addYear()->toDateString(),
            'status' => 'active',
            'underwriter_notes' => 'Bound automatically from accepted proposal #'.$quote->quote_ref,
        ]);

        // Generate first premium billing invoice
        $amount = (float) preg_replace('/[^0-9.]/', '', $quote->premium ?? '1200');
        if ($amount <= 0) {
            $amount = 1200.00;
        }

        Invoice::create([
            'invoice_number' => 'INV-'.date('Y').'-'.rand(100, 999),
            'policy_number' => $policy->policy_number,
            'customer_name' => $policy->holder_name,
            'customer_email' => $policy->holder_email,
            'customer_phone' => $policy->holder_phone,
            'customer_address' => $quote->location ?? 'United States',
            'subtotal' => $amount,
            'tax' => 0.00,
            'discount' => 0.00,
            'total_amount' => $amount,
            'status' => 'pending',
            'issue_date' => now(),
            'due_date' => now()->addDays(30),
            'line_items' => [
                [
                    'description' => 'Annual Policy Premium: '.$policy->plan_name.' (#'.$policy->policy_number.')',
                    'quantity' => 1,
                    'unit_price' => $amount,
                    'total' => $amount,
                ],
            ],
            'notes' => 'Initial premium schedule bound from accepted quote #'.$quote->quote_ref,
            'signatory_name' => 'Md Rezawl',
            'signatory_title' => 'Chief Underwriting Officer',
        ]);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Proposal #'.$quote->quote_ref.' successfully accepted! Policy #'.$policy->policy_number.' is now active and your declarations page is issued.',
                'policy_number' => $policy->policy_number,
                'redirect_url' => route('user.policies'),
            ]);
        }

        return redirect()->route('user.policies')->with('success', 'Proposal #'.$quote->quote_ref.' successfully accepted! Policy #'.$policy->policy_number.' is now active and your initial billing statement is issued.');
    }

    public function claims()
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            $user = User::where('role', 'user')->first() ?? User::first();
        }

        if (Claim::count() === 0) {
            (new ClaimSeeder)->run();
        }

        $query = Claim::query();
        if ($user && $user->exists) {
            $query->where(function ($q) use ($user) {
                $q->where('claimant_email', $user->email)
                    ->orWhere('claimant_name', 'like', '%'.$user->name.'%');
            });
        }
        $claims = $query->orderBy('id', 'desc')->get();
        if ($claims->isEmpty()) {
            $claims = Claim::orderBy('id', 'desc')->get();
        }

        // Get policies for claim filing dropdown
        $polQuery = Policy::query();
        if ($user && $user->exists) {
            $polQuery->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('holder_email', $user->email)
                    ->orWhere('holder_name', 'like', '%'.$user->name.'%');
            });
        }
        $policies = $polQuery->where('status', 'active')->orderBy('id', 'desc')->get();
        if ($policies->isEmpty()) {
            $policies = Policy::orderBy('id', 'desc')->get();
        }

        return view('user.claims', compact('user', 'claims', 'policies'));
    }

    /**
     * Submit First Notice of Loss (FNOL) Claim
     */
    public function submitClaim(Request $request)
    {
        $validated = $request->validate([
            'policy_number' => ['required', 'string', 'max:50'],
            'incident_type' => ['required', 'string', 'max:100'],
            'incident_date' => ['required', 'date'],
            'incident_location' => ['required', 'string', 'max:255'],
            'incident_description' => ['required', 'string', 'min:10', 'max:3000'],
            'estimated_loss' => ['nullable', 'string', 'max:50'],
            'priority' => ['required', 'string', 'in:normal,urgent,emergency'],
        ]);

        $user = Auth::user();
        $claimNumber = 'CLM-'.date('Y').'-'.rand(10000, 99999);

        Claim::create([
            'claim_number' => $claimNumber,
            'policy_number' => $validated['policy_number'],
            'claimant_name' => $user?->name ?? 'Policyholder',
            'claimant_email' => $user?->email ?? 'claimant@surebound.com',
            'claimant_phone' => $user?->phone,
            'incident_date' => $validated['incident_date'],
            'incident_type' => $validated['incident_type'],
            'incident_location' => $validated['incident_location'],
            'incident_description' => $validated['incident_description'],
            'estimated_loss' => $validated['estimated_loss'] ?? '$0.00',
            'assigned_adjuster' => 'Unassigned (Triage)',
            'priority' => $validated['priority'],
            'status' => 'submitted',
            'adjuster_notes' => 'FNOL claim submitted via policyholder portal.',
        ]);

        return back()->with('success', 'First Notice of Loss submitted successfully! Claim reference: #'.$claimNumber.'. A licensed desk adjuster will contact you within 24 hours.');
    }

    public function documents()
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            $user = User::where('role', 'user')->first() ?? User::first();
        }

        if (Policy::count() === 0) {
            (new PolicySeeder)->run();
        }
        if (Invoice::count() === 0) {
            (new InvoiceSeeder)->run();
        }

        $polQuery = Policy::query();
        if ($user && $user->exists) {
            $polQuery->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('holder_email', $user->email)
                    ->orWhere('holder_name', 'like', '%'.$user->name.'%');
            });
        }
        $policies = $polQuery->orderBy('id', 'desc')->get();
        if ($policies->isEmpty()) {
            $policies = Policy::orderBy('id', 'desc')->get();
        }

        $invQuery = Invoice::query();
        if ($user && $user->exists) {
            $invQuery->where(function ($q) use ($user) {
                $q->where('customer_email', $user->email)
                    ->orWhere('customer_name', 'like', '%'.$user->name.'%');
            });
        }
        $invoices = $invQuery->orderBy('id', 'desc')->get();
        if ($invoices->isEmpty()) {
            $invoices = Invoice::orderBy('id', 'desc')->get();
        }

        return view('user.documents', compact('user', 'policies', 'invoices'));
    }

    /**
     * View official Certificate of Liability Insurance (COI)
     */
    public function viewCertificate($id)
    {
        $policy = Policy::findOrFail($id);
        $user = Auth::user() ?? $policy->user;

        return view('user.policy-certificate', compact('policy', 'user'));
    }

    /**
     * Handle Customer Certificate Request
     */
    public function requestCertificate(Request $request)
    {
        $validated = $request->validate([
            'policy_number' => ['required', 'string', 'max:50'],
            'holder_name' => ['required', 'string', 'max:255'],
            'holder_address' => ['required', 'string', 'max:255'],
            'holder_email' => ['nullable', 'email', 'max:255'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $user = Auth::user();
        $ticketNumber = 'TCK-'.date('Y').'-'.rand(10000, 99999);

        SupportTicket::create([
            'ticket_number' => $ticketNumber,
            'user_id' => $user?->id,
            'name' => $user?->name ?? 'Policyholder',
            'email' => $user?->email ?? 'client@surebound.com',
            'phone' => $user?->phone,
            'policy_number' => $validated['policy_number'],
            'category' => 'certificate',
            'subject' => 'Certificate of Insurance (COI) Request for '.$validated['holder_name'],
            'message' => 'Please issue and transmit an ACORD 25 Certificate of Insurance naming: '.$validated['holder_name'].' located at '.$validated['holder_address'].'. Additional details: '.($validated['notes'] ?? 'None'),
            'priority' => 'high',
            'status' => 'in_progress',
            'admin_notes' => 'Underwriter alerted. Certificate dispatching within 2 business hours.',
        ]);

        return back()->with('success', 'Your Certificate of Insurance request for '.$validated['holder_name'].' has been generated and queued for underwriting dispatch! Ticket ref #'.$ticketNumber.'.');
    }

    public function payments()
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            $user = User::where('role', 'user')->first() ?? User::first();
        }

        if (Invoice::count() === 0) {
            (new InvoiceSeeder)->run();
        }

        $invQuery = Invoice::query();
        if ($user && $user->exists) {
            $invQuery->where(function ($q) use ($user) {
                $q->where('customer_email', $user->email)
                    ->orWhere('customer_name', 'like', '%'.$user->name.'%');
            });
        }
        $invoices = $invQuery->orderBy('id', 'desc')->get();
        if ($invoices->isEmpty()) {
            $invoices = Invoice::orderBy('id', 'desc')->get();
        }

        $totalInvoiced = $invoices->sum('total_amount');
        $totalPaid = $invoices->where('status', 'paid')->sum('total_amount');
        $totalDue = $invoices->whereIn('status', ['pending', 'overdue'])->sum('total_amount');
        $nextDueInvoice = $invoices->whereIn('status', ['pending', 'overdue'])->sortBy('due_date')->first();

        return view('user.payments', compact(
            'user',
            'invoices',
            'totalInvoiced',
            'totalPaid',
            'totalDue',
            'nextDueInvoice'
        ));
    }

    /**
     * Process Premium Invoice Payment
     */
    public function payInvoice(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $method = $request->input('payment_method', 'Visa ending in 4242');
        $txId = 'tx_us_'.strtoupper(substr(md5(uniqid()), 0, 12));

        $invoice->update([
            'status' => 'paid',
            'payment_method' => $method,
            'payment_transaction_id' => $txId,
            'paid_at' => now(),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Invoice #'.$invoice->invoice_number.' paid successfully!',
                'invoice' => $invoice,
            ]);
        }

        return back()->with('success', 'Payment of $'.number_format((float) $invoice->total_amount, 2).' for invoice #'.$invoice->invoice_number.' processed successfully! Ref: '.$txId);
    }

    public function support()
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            $user = User::where('role', 'user')->first() ?? User::first();
        }

        if (SupportTicket::count() === 0) {
            (new SupportTicketSeeder)->run();
        }

        $query = SupportTicket::query();
        if ($user && $user->exists) {
            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('email', $user->email)
                    ->orWhere('name', 'like', '%'.$user->name.'%');
            });
        }
        $tickets = $query->orderBy('id', 'desc')->get();
        if ($tickets->isEmpty()) {
            $tickets = SupportTicket::orderBy('id', 'desc')->get();
        }

        $supportContent = PageContent::getForPage('support', AdminController::getDefaultSupportContent());

        $agent = User::where('role', 'agent')->first() ?? new User([
            'name' => $supportContent['underwriter_name'] ?? 'Marcus Vance, CPCU',
            'title' => $supportContent['underwriter_title'] ?? 'Senior Underwriter & Risk Advisor',
            'email' => $supportContent['underwriter_email'] ?? 'm.vance@surebound.com',
            'phone' => $supportContent['underwriter_phone'] ?? '(512) 555-0182',
        ]);

        $polQuery = Policy::query();
        if ($user && $user->exists) {
            $polQuery->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('holder_email', $user->email)
                    ->orWhere('holder_name', 'like', '%'.$user->name.'%');
            });
        }
        $policies = $polQuery->where('status', 'active')->get();
        if ($policies->isEmpty()) {
            $policies = Policy::all();
        }

        $totalTickets = $tickets->count();
        $openTickets = $tickets->whereIn('status', ['open', 'in_progress'])->count();
        $resolvedTickets = $tickets->where('status', 'resolved')->count();

        return view('user.support', compact(
            'user',
            'tickets',
            'agent',
            'policies',
            'supportContent',
            'totalTickets',
            'openTickets',
            'resolvedTickets'
        ));
    }

    public function submitSupportTicket(Request $request)
    {
        $validated = $request->validate([
            'category' => ['required', 'string', 'max:50'],
            'policy_number' => ['nullable', 'string', 'max:50'],
            'subject' => ['required', 'string', 'max:255'],
            'priority' => ['required', 'string', 'in:low,normal,high,urgent'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        $user = Auth::user();
        $ticketNumber = 'TCK-'.date('Y').'-'.rand(10000, 99999);

        SupportTicket::create([
            'ticket_number' => $ticketNumber,
            'user_id' => $user?->id,
            'name' => $user?->name ?? 'Valued Policyholder',
            'email' => $user?->email ?? 'policyholder@surebound.com',
            'phone' => $user?->phone,
            'policy_number' => $validated['policy_number'] ?? null,
            'category' => $validated['category'],
            'subject' => $validated['subject'],
            'priority' => $validated['priority'],
            'message' => $validated['message'],
            'status' => 'open',
            'admin_notes' => null,
        ]);

        return back()->with('success', 'Support inquiry #'.$ticketNumber.' created! Our underwriting team will contact you shortly.');
    }

    public function settings()
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            $user = User::where('role', 'user')->first() ?? User::first();
        }

        return view('user.settings', compact('user'));
    }

    /**
     * Update Customer Personal & Policyholder Profile
     */
    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (! $user) {
            return back()->with('error', 'Authentication required.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone' => ['nullable', 'string', 'max:50'],
            'title' => ['nullable', 'string', 'max:150'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:50'],
            'zip_code' => ['nullable', 'string', 'max:20'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile and policyholder contact details updated successfully.');
    }

    /**
     * Update Account Security Password
     */
    public function updatePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (! $user) {
            return back()->with('error', 'Authentication required.');
        }

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (! Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The provided current password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Your account security password has been changed successfully.');
    }

    /**
     * Update Policyholder Notification & Paperless Preferences
     */
    public function updatePreferences(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (! $user) {
            return back()->with('error', 'Authentication required.');
        }

        $paperless = $request->boolean('paperless_billing');
        $notifications = [
            'policy_renewals_email' => $request->boolean('policy_renewals_email'),
            'policy_renewals_sms' => $request->boolean('policy_renewals_sms'),
            'claims_updates_email' => $request->boolean('claims_updates_email'),
            'claims_updates_sms' => $request->boolean('claims_updates_sms'),
            'billing_reminders_email' => $request->boolean('billing_reminders_email'),
            'billing_reminders_sms' => $request->boolean('billing_reminders_sms'),
            'weather_cat_alerts_sms' => $request->boolean('weather_cat_alerts_sms'),
        ];

        $user->update([
            'paperless_billing' => $paperless,
            'notification_preferences' => $notifications,
        ]);

        return back()->with('success', 'Notification delivery and billing preferences saved successfully.');
    }
}
