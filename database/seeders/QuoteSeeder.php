<?php

namespace Database\Seeders;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds for customer quote proposals.
     */
    public function run(): void
    {
        $primaryUser = User::where('role', 'user')->first() ?? User::where('email', 'rezawl71@gmail.com')->first();
        $name = $primaryUser?->name ?? 'IT BD WEB IT BD WEB';
        $email = $primaryUser?->email ?? 'rezawl71@gmail.com';
        $phone = $primaryUser?->phone ?: '(512) 840-2918';

        $quotes = [
            [
                'quote_ref' => 'SB-Q-74892',
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'type' => 'business',
                'type_label' => 'Cyber Security, Ransomware & Data Breach',
                'coverage' => '$1,000,000 Aggregate / $25,000 Deductible',
                'premium' => '$1,420.00 / yr',
                'location' => 'Austin, TX 78701',
                'zip_code' => '78701',
                'status' => 'quoted',
                'notes' => 'Underwriter proposal completed with Lloyd\'s Syndicate. Includes ransomware negotiation reimbursement, forensic investigation coverage, and business interruption extra expense.',
            ],
            [
                'quote_ref' => 'SB-Q-55102',
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'type' => 'umbrella',
                'type_label' => 'Excess Umbrella & Worldwide Liability',
                'coverage' => '$5,000,000 Excess Coverage',
                'premium' => '$1,850.00 / yr',
                'location' => 'Austin, TX 78701',
                'zip_code' => '78701',
                'status' => 'reviewing',
                'notes' => 'Actuarial underwriter evaluating underlying primary auto & homeowners limit verifications. Proposal scheduled within 24 hours.',
            ],
            [
                'quote_ref' => 'SB-Q-31904',
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'type' => 'home',
                'type_label' => 'Luxury Watercraft & Marine Hull',
                'coverage' => '$350,000 Agreed Hull Value',
                'premium' => '$2,100.00 / yr',
                'location' => 'Lake Austin Marina, TX',
                'zip_code' => '78734',
                'status' => 'converted',
                'notes' => 'Customer accepted quote proposal on Oct 01, 2026. Successfully bound and issued under active policy schedule.',
            ],
            [
                'quote_ref' => 'SB-Q-89021',
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'type' => 'home',
                'type_label' => 'Fine Jewelry & Valuables Scheduled Floater',
                'coverage' => '$150,000 Agreed Valuation (Zero Deductible)',
                'premium' => '$980.00 / yr',
                'location' => 'Austin, TX 78701',
                'zip_code' => '78701',
                'status' => 'new',
                'notes' => 'GIA appraisal certificates uploaded by customer. Awaiting senior underwriter rate binding.',
            ],
        ];

        foreach ($quotes as $q) {
            Quote::updateOrCreate(['quote_ref' => $q['quote_ref']], $q);
        }
    }
}
