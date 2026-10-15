<?php

namespace Database\Seeders;

use App\Models\SupportTicket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SupportTicketSeeder extends Seeder
{
    /**
     * Run the database seeds for customer support tickets.
     */
    public function run(): void
    {
        $primaryUser = User::where('role', 'user')->first() ?? User::where('email', 'rezawl71@gmail.com')->first();
        $name = $primaryUser?->name ?? 'IT BD WEB IT BD WEB';
        $email = $primaryUser?->email ?? 'rezawl71@gmail.com';
        $phone = $primaryUser?->phone ?: '(512) 840-2918';
        $userId = $primaryUser?->id;

        $tickets = [
            [
                'ticket_number' => 'TCK-2026-88192',
                'user_id' => $userId,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'policy_number' => 'SB-HOM-883921',
                'category' => 'policy_change',
                'subject' => 'Request to add smart water leak detector alarm discount endorsement',
                'message' => 'We installed a Moen Flo smart water shutoff system with certified central station monitoring. Please add the underwriting alarm mitigation discount to our homeowners policy.',
                'priority' => 'normal',
                'status' => 'resolved',
                'admin_notes' => 'Smart water monitoring certificate verified. 10% premium credit applied to renewal schedule.',
                'created_at' => Carbon::now()->subWeeks(2),
            ],
            [
                'ticket_number' => 'TCK-2026-90412',
                'user_id' => $userId,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'policy_number' => 'SB-BUS-105829',
                'category' => 'certificate',
                'subject' => 'Mortgagee / Certificate of Insurance (COI) Request for Lease Renewal',
                'message' => 'Our landlord requires an updated Certificate of Insurance naming Austin Commercial Holdings LLC as an Additional Insured with a 30-day notice of cancellation.',
                'priority' => 'high',
                'status' => 'in_progress',
                'admin_notes' => 'Underwriter generating ACORD 25 Certificate of Liability with waiver of subrogation. Dispatching to landlord today.',
                'created_at' => Carbon::now()->subDays(2),
            ],
        ];

        foreach ($tickets as $t) {
            SupportTicket::updateOrCreate(['ticket_number' => $t['ticket_number']], $t);
        }
    }
}
