<?php

namespace App\Services;

use App\Models\Quote;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoHighLevelService
{
    /**
     * Dispatch quote lead to GoHighLevel as a new contact with all answers, tags, and custom fields.
     *
     * @return array{success: bool, method: string, message: string}
     */
    public static function sendContact(Quote $quote): array
    {
        $tags = is_array($quote->tags) ? $quote->tags : [];
        if (empty($tags)) {
            $tags = ['SOURCE-QUOTE-FLOW'];
        }

        // Format coverages label list
        $coverages = is_array($quote->coverages) ? $quote->coverages : [];
        $coverageLabels = array_map(function ($c) {
            return match ($c) {
                'bop' => 'Business Owner Policy (BOP)',
                'gl' => 'General Liability',
                'wc' => "Workers' Compensation",
                'auto' => 'Commercial Auto',
                'prop' => 'Commercial Property',
                'life' => 'Life Insurance',
                default => ucfirst(str_replace('_', ' ', (string) $c)),
            };
        }, $coverages);

        // Normalize first & last name
        $firstName = $quote->first_name;
        $lastName = $quote->last_name;
        if (empty($firstName) && ! empty($quote->name)) {
            $parts = explode(' ', trim($quote->name), 2);
            $firstName = $parts[0] ?? '';
            $lastName = $parts[1] ?? '';
        }

        // Prepare flat modular answers and custom fields
        $modular = is_array($quote->modular_data) ? $quote->modular_data : [];
        $raw = is_array($quote->raw_answers) ? $quote->raw_answers : [];

        $customFields = [
            'quote_ref' => $quote->quote_ref,
            'business_name' => $quote->business_name,
            'coverages_picked' => implode(', ', $coverageLabels),
            'business_type' => $quote->business_type,
            'business_type_other' => $quote->business_type_other,
            'business_description' => $quote->business_description,
            'employees' => $quote->employees,
            'years_in_business' => $quote->years_in_business,
            'annual_revenue' => $quote->annual_revenue,
            'business_address' => $quote->business_address,
            'location_ownership' => $quote->location_ownership,
            'renewal_timeline' => $quote->renewal_timeline,
            'current_carrier' => $quote->current_carrier,
            'claims_history' => $quote->claims_history,
            'bundle_preference' => $quote->bundle_preference,
            'quote_notes' => $quote->notes,
        ];

        // Merge modular and raw answers into custom fields
        foreach ($modular as $k => $v) {
            $customFields['modular_'.$k] = is_array($v) ? json_encode($v) : (string) $v;
        }

        // Comprehensive Contact Payload
        $payload = [
            'firstName' => $firstName ?: 'Valued',
            'lastName' => $lastName ?: 'Customer',
            'name' => $quote->name ?: trim(($firstName ?? '').' '.($lastName ?? '')),
            'email' => $quote->email,
            'phone' => $quote->phone,
            'companyName' => $quote->business_name,
            'address1' => $quote->business_address,
            'postalCode' => $quote->zip_code,
            'tags' => $tags,
            'source' => 'Surebound Quote Flow',
            'customFields' => $customFields,
            // Root-level fields for easy GHL Webhook Workflow trigger mapping
            'first_name' => $firstName,
            'last_name' => $lastName,
            'business_name' => $quote->business_name,
            'coverages' => $coverageLabels,
            'business_type' => $quote->business_type,
            'business_description' => $quote->business_description,
            'employees' => $quote->employees,
            'years_in_business' => $quote->years_in_business,
            'annual_revenue' => $quote->annual_revenue,
            'business_address' => $quote->business_address,
            'location_ownership' => $quote->location_ownership,
            'renewal_timeline' => $quote->renewal_timeline,
            'claims_history' => $quote->claims_history,
            'bundle_preference' => $quote->bundle_preference,
            'modular_answers' => $modular,
            'raw_answers' => $raw,
            'quote_ref' => $quote->quote_ref,
        ];

        $webhookUrl = config('services.gohighlevel.webhook_url');
        $apiKey = config('services.gohighlevel.api_key');
        $locationId = config('services.gohighlevel.location_id');

        // 1. Inbound Webhook (Recommended & Standard for GHL workflows)
        if (! empty($webhookUrl)) {
            try {
                $response = Http::timeout(10)
                    ->acceptJson()
                    ->post($webhookUrl, $payload);

                if ($response->successful()) {
                    Log::info("GoHighLevel webhook dispatch succeeded for quote [{$quote->quote_ref}]");

                    return [
                        'success' => true,
                        'method' => 'webhook',
                        'message' => 'Dispatched to GoHighLevel via webhook.',
                    ];
                }

                Log::warning("GoHighLevel webhook returned HTTP {$response->status()} for [{$quote->quote_ref}]: {$response->body()}");

                return [
                    'success' => false,
                    'method' => 'webhook',
                    'message' => "GHL Webhook HTTP {$response->status()}",
                ];
            } catch (\Throwable $e) {
                Log::error("GoHighLevel webhook failed for [{$quote->quote_ref}]: {$e->getMessage()}");

                return [
                    'success' => false,
                    'method' => 'webhook',
                    'message' => $e->getMessage(),
                ];
            }
        }

        // 2. Direct REST API (LeadConnector API)
        if (! empty($apiKey)) {
            try {
                $headers = [
                    'Authorization' => "Bearer {$apiKey}",
                    'Version' => '2021-07-28',
                ];

                $body = [
                    'firstName' => $payload['firstName'],
                    'lastName' => $payload['lastName'],
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                    'phone' => $payload['phone'],
                    'companyName' => $payload['companyName'],
                    'address1' => $payload['address1'],
                    'postalCode' => $payload['postalCode'],
                    'tags' => $tags,
                    'source' => 'Surebound Quote Flow',
                ];

                if (! empty($locationId)) {
                    $body['locationId'] = $locationId;
                }

                $response = Http::withHeaders($headers)
                    ->timeout(10)
                    ->post('https://services.leadconnectorhq.com/contacts/', $body);

                if ($response->successful()) {
                    Log::info("GoHighLevel API contact creation succeeded for quote [{$quote->quote_ref}]");

                    return [
                        'success' => true,
                        'method' => 'api',
                        'message' => 'Created GoHighLevel contact via API.',
                    ];
                }

                Log::warning("GoHighLevel API returned HTTP {$response->status()}: {$response->body()}");

                return [
                    'success' => false,
                    'method' => 'api',
                    'message' => "GHL API HTTP {$response->status()}",
                ];
            } catch (\Throwable $e) {
                Log::error("GoHighLevel API failed for [{$quote->quote_ref}]: {$e->getMessage()}");

                return [
                    'success' => false,
                    'method' => 'api',
                    'message' => $e->getMessage(),
                ];
            }
        }

        // Neither webhook nor API key configured (Localhost / Sandbox mode)
        Log::info("GoHighLevel payload prepared for quote [{$quote->quote_ref}] (No GHL_WEBHOOK_URL or GHL_API_KEY in .env):", [
            'ref' => $quote->quote_ref,
            'name' => $payload['name'],
            'email' => $payload['email'],
            'phone' => $payload['phone'],
            'tags' => $tags,
        ]);

        return [
            'success' => true,
            'method' => 'simulated_local',
            'message' => 'GHL payload ready. Set GHL_WEBHOOK_URL or GHL_API_KEY in .env to dispatch live.',
        ];
    }
}
