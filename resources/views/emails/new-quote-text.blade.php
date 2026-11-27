SUREBOUND INSURANCE - NEW LEAD INQUIRY
============================================================

Reference: #{{ $quote->quote_ref }}
Submitted: {{ $quote->created_at ? $quote->created_at->format('M d, Y - h:i A') : now()->format('M d, Y - h:i A') }}
Status: New Client Lead

@if(!empty($quote->tags) && is_array($quote->tags))
LEAD UNDERWRITING TAGS
------------------------------------------------------------
{{ implode(' | ', $quote->tags) }}
@endif

REQUESTED COVERAGES
------------------------------------------------------------
@if(!empty($quote->coverages) && is_array($quote->coverages))
{{ implode(' + ', array_map(function($c) {
    return match($c) {
        'bop' => 'Business Owner Policy',
        'gl' => 'General Liability',
        'wc' => "Workers' Comp",
        'auto' => 'Commercial Auto',
        'prop' => 'Commercial Property',
        'life' => 'Life Insurance',
        default => ucfirst(str_replace('_', ' ', (string) $c))
    };
}, $quote->coverages)) }}
@else
{{ $quote->type_label ?? ucfirst(str_replace('_', ' ', $quote->type)) }}
@endif

CUSTOMER CONTACT INFORMATION
------------------------------------------------------------
Full Name: {{ $quote->name ?: 'Not Provided' }}
@if(!empty($quote->business_name))
Business Name: {{ $quote->business_name }}
@endif
Email: {{ (!empty($quote->email) && !str_contains($quote->email, '@surebound-inquiry.com')) ? $quote->email : 'No personal email provided' }}
Phone: {{ $quote->phone ?: 'Not Provided' }}
Location / ZIP: {{ $quote->location ?: ($quote->zip_code ? 'ZIP: '.$quote->zip_code : 'N/A') }}
@if(!empty($quote->tags) && is_array($quote->tags))
Lead Tags: {{ implode(', ', $quote->tags) }}
@endif

@if(!empty($quote->notes))
CLIENT MESSAGE / REQUEST DETAILS
------------------------------------------------------------
{{ $quote->notes }}
@endif

QUICK ACTIONS
------------------------------------------------------------
@if(!empty($quote->email) && !str_contains($quote->email, '@surebound-inquiry.com'))
Reply directly: mailto:{{ $quote->email }}?subject=Your%20Surebound%20Insurance%20Quote%20Request%20%28{{ $quote->quote_ref }}%29
@endif
@if(!empty($quote->phone))
Call client: tel:{{ preg_replace('/[^0-9+]/', '', $quote->phone) }}
@endif
Admin Portal: {{ url('/admin#quotes') }}

============================================================
This notification was dispatched to karry@sureboundinsurance.com & info@sureboundinsurance.com.
Surebound Insurance Agency LLC | 100 N Tampa St, Suite 2500, Tampa, FL 33602 | (813) 214-1731
License #FL-L114920 | https://sureboundinsurance.com
