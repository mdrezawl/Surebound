<?php

namespace Database\Seeders;

use App\Models\Policy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds for realistic insurance policies.
     */
    public function run(): void
    {
        // Find existing users
        $primaryUser = User::where('role', 'user')->first() ?? User::where('email', 'rezawl71@gmail.com')->first();
        $adminUser = User::where('email', 'help.rezawl71@gmail.com')->first();

        $userId = $primaryUser?->id ?? $adminUser?->id;
        $holderName = $primaryUser?->name ?? 'Md Rezawl';
        $holderEmail = $primaryUser?->email ?? 'rezawl71@gmail.com';
        $holderPhone = $primaryUser?->phone ?: '(512) 840-2918';

        $policies = [
            [
                'user_id' => $userId,
                'policy_number' => 'SB-HOM-883921',
                'holder_name' => $holderName,
                'holder_email' => $holderEmail,
                'holder_phone' => $holderPhone,
                'type' => 'home',
                'type_label' => 'Homeowners Comprehensive (HO-5)',
                'carrier' => 'Surebound Syndicate & Travelers',
                'insured_item' => '742 Evergreen Terrace, Austin, TX 78701',
                'coverage_limit' => '$1,450,000',
                'deductible' => '$1,000 All Perils / 1% Wind & Hail',
                'annual_premium' => '$2,850.00',
                'billing_frequency' => 'annual',
                'effective_date' => Carbon::now()->subMonths(3)->format('Y-m-d'),
                'renewal_date' => Carbon::now()->addMonths(9)->format('Y-m-d'),
                'status' => 'active',
                'coverage_details' => [
                    'Dwelling (Coverage A)' => '$1,450,000',
                    'Other Structures (Coverage B)' => '$145,000',
                    'Personal Property (Coverage C)' => '$725,000',
                    'Loss of Use (Coverage D)' => '$290,000',
                    'Personal Liability (Coverage E)' => '$1,000,000',
                    'Medical Payments to Others' => '$10,000',
                    'Water Backup & Sump Overflow' => '$50,000',
                    'Equipment Breakdown' => '$100,000',
                ],
                'notes' => 'High-value architectural dwelling with smart water shutoff and central station fire & burglary alarm discount applied.',
            ],
            [
                'user_id' => $userId,
                'policy_number' => 'SB-AUT-492015',
                'holder_name' => $holderName,
                'holder_email' => $holderEmail,
                'holder_phone' => $holderPhone,
                'type' => 'auto',
                'type_label' => 'Executive Auto Comprehensive & Collision',
                'carrier' => 'Surebound Syndicate & Progressive',
                'insured_item' => '2024 Tesla Model S Plaid & 2023 Porsche 911 GT3',
                'coverage_limit' => '$500,000 CSL',
                'deductible' => '$500 Collision / $250 Comprehensive',
                'annual_premium' => '$2,140.00',
                'billing_frequency' => 'semi-annual',
                'effective_date' => Carbon::now()->subMonths(1)->format('Y-m-d'),
                'renewal_date' => Carbon::now()->addMonths(11)->format('Y-m-d'),
                'status' => 'active',
                'coverage_details' => [
                    'Combined Single Limit (Bodily Injury & Property)' => '$500,000',
                    'Uninsured / Underinsured Motorist' => '$500,000',
                    'Comprehensive (Other than Collision)' => 'Actual Cash Value ($250 ded)',
                    'Collision Protection' => 'Full Replacement Cost ($500 ded)',
                    'Roadside Assistance & Towing' => 'Included (Premier 100 miles)',
                    'Rental Vehicle Reimbursement' => '$100 / day (up to $3,000 max)',
                    'OEM Replacement Parts Endorsement' => 'Active',
                    'Full Glass Repair Waiver' => '$0 Deductible',
                ],
                'notes' => 'Multi-vehicle safe driver telematics discount verified (Score: 96/100).',
            ],
            [
                'user_id' => $userId,
                'policy_number' => 'SB-UMB-739104',
                'holder_name' => $holderName,
                'holder_email' => $holderEmail,
                'holder_phone' => $holderPhone,
                'type' => 'umbrella',
                'type_label' => 'Personal & Excess Umbrella Liability',
                'carrier' => 'Surebound Syndicate & Chubb Premier',
                'insured_item' => 'Worldwide Excess Liability Protection',
                'coverage_limit' => '$3,000,000',
                'deductible' => '$0 Self-Insured Retention (SIR)',
                'annual_premium' => '$890.00',
                'billing_frequency' => 'annual',
                'effective_date' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'renewal_date' => Carbon::now()->addMonths(10)->format('Y-m-d'),
                'status' => 'active',
                'coverage_details' => [
                    'Excess Bodily Injury & Property Damage' => '$3,000,000',
                    'Personal Injury & Libel / Slander' => '$3,000,000',
                    'Defense Legal Costs' => 'Covered Outside Policy Limits',
                    'Worldwide Territorial Scope' => 'Global Coverage 24/7',
                ],
                'notes' => 'Underlying homeowners and auto liability limits certified and verified.',
            ],
            [
                'user_id' => $userId,
                'policy_number' => 'SB-BUS-105829',
                'holder_name' => $holderName,
                'holder_email' => $holderEmail,
                'holder_phone' => $holderPhone,
                'type' => 'business',
                'type_label' => 'Business Owner Policy (BOP)',
                'carrier' => 'Surebound Syndicate & The Hartford',
                'insured_item' => 'Corporate Office Suite - 1200 Tech Ridge Blvd, Ste 400',
                'coverage_limit' => '$2,000,000',
                'deductible' => '$2,500 General Property Deductible',
                'annual_premium' => '$3,400.00',
                'billing_frequency' => 'quarterly',
                'effective_date' => Carbon::now()->subMonths(4)->format('Y-m-d'),
                'renewal_date' => Carbon::now()->addMonths(8)->format('Y-m-d'),
                'status' => 'active',
                'coverage_details' => [
                    'General Liability Aggregate' => '$2,000,000',
                    'Business Personal Property' => '$500,000',
                    'Business Interruption & Extra Expense' => '12 Months Actual Loss Sustained',
                    'Cyber Extortion & Ransomware' => '$1,000,000',
                    'Data Breach Response & Notification' => '$500,000',
                ],
                'notes' => 'Annual risk assessment verified. SOC2 Type II certified cloud infrastructure endorsement.',
            ],
        ];

        foreach ($policies as $data) {
            Policy::updateOrCreate(
                ['policy_number' => $data['policy_number']],
                $data
            );
        }
    }
}
