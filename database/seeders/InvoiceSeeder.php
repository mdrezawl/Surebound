<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds for customer billing and invoices.
     */
    public function run(): void
    {
        $primaryUser = User::where('role', 'user')->first() ?? User::where('email', 'rezawl71@gmail.com')->first();
        $name = $primaryUser?->name ?? 'IT BD WEB IT BD WEB';
        $email = $primaryUser?->email ?? 'rezawl71@gmail.com';
        $phone = $primaryUser?->phone ?: '(512) 840-2918';
        $address = '742 Evergreen Terrace, Austin, TX 78701';

        $invoices = [
            [
                'invoice_number' => 'INV-2026-001',
                'policy_number' => 'SB-HOM-883921',
                'customer_name' => $name,
                'customer_email' => $email,
                'customer_phone' => $phone,
                'customer_address' => $address,
                'subtotal' => 2850.00,
                'tax' => 0.00,
                'discount' => 0.00,
                'total_amount' => 2850.00,
                'status' => 'paid',
                'issue_date' => Carbon::now()->subMonths(3)->format('Y-m-d'),
                'due_date' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'payment_method' => 'Credit Card (Visa ending in 4242)',
                'payment_transaction_id' => 'TXN-SB-8849201',
                'paid_at' => Carbon::now()->subMonths(2)->subDays(3),
                'line_items' => [
                    ['desc' => 'Homeowners Comprehensive (HO-5) Annual Premium', 'qty' => 1, 'price' => 2850.00, 'total' => 2850.00],
                ],
                'notes' => 'Annual policy premium paid in full. State regulatory fees and catastrophic windstorm surcharge included.',
                'signatory_name' => 'Md Rezawl',
                'signatory_title' => 'Chief Underwriting Officer',
            ],
            [
                'invoice_number' => 'INV-2026-002',
                'policy_number' => 'SB-AUT-492015',
                'customer_name' => $name,
                'customer_email' => $email,
                'customer_phone' => $phone,
                'customer_address' => $address,
                'subtotal' => 2450.00,
                'tax' => 0.00,
                'discount' => 0.00,
                'total_amount' => 2450.00,
                'status' => 'paid',
                'issue_date' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'due_date' => Carbon::now()->subMonth()->format('Y-m-d'),
                'payment_method' => 'ACH Direct Debit (JPMorgan Chase)',
                'payment_transaction_id' => 'TXN-ACH-1920491',
                'paid_at' => Carbon::now()->subMonth()->subDays(5),
                'line_items' => [
                    ['desc' => 'Auto Elite Comprehensive & Collision Coverage (Tesla Model S Plaid)', 'qty' => 1, 'price' => 2450.00, 'total' => 2450.00],
                ],
                'notes' => 'Includes 24/7 OEM roadside assistance, loan/lease gap coverage, and zero deductible windshield repair endorsement.',
                'signatory_name' => 'Md Rezawl',
                'signatory_title' => 'Chief Underwriting Officer',
            ],
            [
                'invoice_number' => 'INV-2026-003',
                'policy_number' => 'SB-BUS-105829',
                'customer_name' => $name,
                'customer_email' => $email,
                'customer_phone' => $phone,
                'customer_address' => $address,
                'subtotal' => 4800.00,
                'tax' => 0.00,
                'discount' => 0.00,
                'total_amount' => 4800.00,
                'status' => 'pending',
                'issue_date' => Carbon::now()->format('Y-m-d'),
                'due_date' => Carbon::now()->addDays(28)->format('Y-m-d'),
                'payment_method' => null,
                'payment_transaction_id' => null,
                'paid_at' => null,
                'line_items' => [
                    ['desc' => 'Commercial Business Owners Policy (BOP) Q4 Installment', 'qty' => 1, 'price' => 4800.00, 'total' => 4800.00],
                ],
                'notes' => 'Quarterly insurance premium installment. Due on or before '.Carbon::now()->addDays(28)->format('M d, Y').'. Pay securely via online portal or wire.',
                'signatory_name' => 'Md Rezawl',
                'signatory_title' => 'Chief Underwriting Officer',
            ],
        ];

        foreach ($invoices as $inv) {
            Invoice::updateOrCreate(['invoice_number' => $inv['invoice_number']], $inv);
        }
    }
}
