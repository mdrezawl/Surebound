<?php

namespace App\Console\Commands;

use App\Models\Claim;
use App\Models\Invoice;
use App\Models\Policy;
use App\Models\Quote;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Console\Command;

class ClearDemoDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-demo-data {--force : Force the operation without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all demo invoices, payments, policies, claims, tickets, demo users, and demo quotes from the database.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting removal of demo data from Surebound database...');

        // 1. Invoices & Payments ("admin e akhono kono real payment hoi ni eigula remove koro")
        $invoiceCount = Invoice::count();
        Invoice::query()->delete();
        $this->line("✓ Removed {$invoiceCount} demo invoice(s) and payment transaction(s).");

        // 2. Demo Policies
        $policyCount = Policy::count();
        Policy::query()->delete();
        $this->line("✓ Removed {$policyCount} demo policy/policies.");

        // 3. Claims
        $claimCount = Claim::count();
        Claim::query()->delete();
        $this->line("✓ Removed {$claimCount} claim(s).");

        // 4. Support Tickets
        $ticketCount = SupportTicket::count();
        SupportTicket::query()->delete();
        $this->line("✓ Removed {$ticketCount} support ticket(s).");

        // 5. Demo Users (Sarah Jenkins, David Miller, Eleanor Vance, Michael Chen)
        $demoEmails = [
            'admin@surebound.com',
            'dmiller@surebound.com',
            'eleanor.vance@gmail.com',
            'michael.chen@apexlogistics.com',
        ];
        $deletedUsers = User::whereIn('email', $demoEmails)->delete();
        $this->line("✓ Removed {$deletedUsers} demo staff/client user account(s).");

        // Ensure Super Admin exists and has proper permissions
        $superAdmin = User::where('email', 'help.rezawl71@gmail.com')->first();
        if ($superAdmin) {
            $superAdmin->update([
                'is_super_admin' => true,
                'role' => 'admin',
            ]);
            $this->line("✓ Verified Super Admin account for {$superAdmin->email} (Super Admin: true).");
        }

        // 6. Demo Quotes & Test Leads
        $demoQuoteRefs = [
            'Q-10492', 'Q-10491', 'Q-10490', 'Q-10489', 'Q-10488', 'Q-10487', 'Q-10486',
        ];
        $demoQuoteEmails = [
            'sarah.j@example.com',
            'm.chang@example.com',
            'emma.w@example.com',
            'fleet@apexlogistics.io',
            'dmiller@example.com',
            'jessica.a@example.com',
            'admin@cascaderoasters.com',
            'alan-baker424245242@gmx.com',
            'ktadros@test.com',
            'test@gmail.com',
        ];
        $deletedQuotes = Quote::whereIn('quote_ref', $demoQuoteRefs)
            ->orWhereIn('email', $demoQuoteEmails)
            ->delete();
        $this->line("✓ Removed {$deletedQuotes} demo quote proposal(s) and test lead(s).");

        $this->info('Demo data successfully purged. Admin panel is now in a clean production state.');

        return Command::SUCCESS;
    }
}
