<?php

namespace Database\Seeders;

use App\Models\Claim;
use App\Models\Policy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClaimSeeder extends Seeder
{
    /**
     * Run the database seeds for realistic insurance claims.
     */
    public function run(): void
    {
        $primaryUser = User::where('role', 'user')->first() ?? User::where('email', 'rezawl71@gmail.com')->first();
        $claimantName = $primaryUser?->name ?? 'Md Rezawl';
        $claimantEmail = $primaryUser?->email ?? 'rezawl71@gmail.com';
        $claimantPhone = $primaryUser?->phone ?: '(512) 840-2918';

        $homePolicy = Policy::where('type', 'home')->first();
        $autoPolicy = Policy::where('type', 'auto')->first();
        $businessPolicy = Policy::where('type', 'business')->first();

        $claims = [
            [
                'claim_number' => 'CLM-2026-48192',
                'policy_number' => $homePolicy?->policy_number ?? 'SB-HOM-883921',
                'claimant_name' => $claimantName,
                'claimant_email' => $claimantEmail,
                'claimant_phone' => $claimantPhone,
                'incident_date' => Carbon::now()->subDays(12)->format('Y-m-d'),
                'incident_type' => 'Water Damage & Plumbing Rupture',
                'incident_location' => $homePolicy?->insured_item ?? '742 Evergreen Terrace, Austin, TX',
                'incident_description' => 'Sudden upstairs master bathroom pressurized supply line rupture causing ceiling dry-wall collapse, master bedroom floor flooding, and insulation saturation.',
                'estimated_loss' => '$18,500.00',
                'assigned_adjuster' => 'David Miller (Senior Property Adjuster)',
                'priority' => 'urgent',
                'status' => 'reviewing',
                'adjuster_notes' => 'Emergency water mitigation contractor dispatched. Moisture logs and 3D Matterport scan received.',
            ],
            [
                'claim_number' => 'CLM-2026-72910',
                'policy_number' => $autoPolicy?->policy_number ?? 'SB-AUT-492015',
                'claimant_name' => $claimantName,
                'claimant_email' => $claimantEmail,
                'claimant_phone' => $claimantPhone,
                'incident_date' => Carbon::now()->subDays(25)->format('Y-m-d'),
                'incident_type' => 'Vehicle Collision / Rear Bumper Impact',
                'incident_location' => 'I-35 Northbound at 6th Street Exit, Austin, TX',
                'incident_description' => 'Low speed rear-end collision at traffic signal during evening commute. Rear bumper, carbon fiber diffuser, and parking sonar sensors damaged. No injuries reported.',
                'estimated_loss' => '$4,750.00',
                'assigned_adjuster' => 'Sarah Jenkins (Auto Physical Damage Appraiser)',
                'priority' => 'normal',
                'status' => 'approved',
                'adjuster_notes' => 'Certified OEM collision center repair estimate verified and authorized for direct settlement.',
            ],
            [
                'claim_number' => 'CLM-2026-10543',
                'policy_number' => $businessPolicy?->policy_number ?? 'SB-BUS-105829',
                'claimant_name' => $claimantName,
                'claimant_email' => $claimantEmail,
                'claimant_phone' => $claimantPhone,
                'incident_date' => Carbon::now()->subDays(60)->format('Y-m-d'),
                'incident_type' => 'Severe Hail & Windstorm Loss',
                'incident_location' => 'Corporate Suite - 1200 Tech Ridge Blvd, Austin, TX',
                'incident_description' => 'Severe convective storm producing 2-inch hail resulting in commercial roof membrane punctures and rooftop HVAC condenser fin crushing.',
                'estimated_loss' => '$32,000.00',
                'assigned_adjuster' => 'Michael Vance (Executive Field Investigator)',
                'priority' => 'high',
                'status' => 'paid',
                'adjuster_notes' => 'Settlement draft $32,000.00 disbursed via FedNow wire to contractor escrow account. Proof of satisfaction signed.',
            ],
        ];

        foreach ($claims as $c) {
            Claim::updateOrCreate(
                ['claim_number' => $c['claim_number']],
                $c
            );
        }
    }
}
