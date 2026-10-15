<?php

namespace Database\Seeders;

use App\Models\ApiSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Super Admin Account (Real Account)
        User::updateOrCreate(
            ['email' => 'help.rezawl71@gmail.com'],
            [
                'name' => 'Md Rezawl',
                'password' => Hash::make('@Freelancer#71%'),
                'role' => 'admin',
                'is_super_admin' => true,
                'title' => 'Chief Underwriter & Super Admin',
                'phone' => '(206) 555-0142',
            ]
        );

        // 2. Default API Integrations & Gateway Setup (Clean initial state for real configuration)
        $defaultApiSettings = [
            'claims_api_config' => [
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
            ],
            'stripe_config' => [
                'enabled' => false,
                'environment' => 'live',
                'publishable_key' => '',
                'secret_key' => '',
                'webhook_secret' => '',
                'accept_cards' => true,
                'accept_apple_pay' => true,
                'accept_google_pay' => true,
            ],
            'plaid_ach_config' => [
                'enabled' => false,
                'environment' => 'production',
                'client_id' => '',
                'secret_key' => '',
                'same_day_ach' => true,
            ],
            'authorize_config' => [
                'enabled' => false,
                'environment' => 'production',
                'api_login_id' => '',
                'transaction_key' => '',
            ],
            'wire_fednow_config' => [
                'enabled' => false,
                'bank_name' => '',
                'routing_number' => '',
                'account_number' => '',
                'swift_bic' => '',
                'fednow_participant_id' => '',
            ],
            'bnpl_klarna_config' => [
                'enabled' => false,
                'merchant_id' => '',
                'shared_secret' => '',
                'country' => 'US',
                'currency' => 'USD',
            ],
            'payment_general_config' => [
                'currency' => 'USD',
                'surcharge_enabled' => false,
                'surcharge_pct' => 2.9,
                'surcharge_flat' => 0.30,
                'auto_send_receipt' => true,
            ],
        ];

        foreach ($defaultApiSettings as $key => $val) {
            ApiSetting::updateOrCreate(['key' => $key], ['value' => $val]);
        }

        // 3. Seed Realistic Insurance Policies
        $this->call(PolicySeeder::class);
    }
}
