<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Lead: {{ $quote->name ?: 'Customer' }} - {{ $quote->type_label ?? 'Insurance' }} (#{{ $quote->quote_ref }})</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f8fafc; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #0f172a; -webkit-font-smoothing: antialiased; line-height: 1.5;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f8fafc; padding: 32px 12px;">
        <tr>
            <td align="center">
                <!-- Main Email Card -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 620px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.08); border: 1px solid #e2e8f0;">
                    
                    <!-- Top Brand Header Bar -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #0b192c 0%, #1e3a8a 100%); padding: 28px 32px; text-align: left;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td>
                                        <div style="display: inline-block; padding: 4px 10px; background-color: rgba(251, 191, 36, 0.18); border: 1px solid rgba(251, 191, 36, 0.45); border-radius: 9999px; color: #fbbf24; font-size: 11px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 10px;">
                                            New Lead Inquiry
                                        </div>
                                        <h1 style="margin: 0; color: #ffffff; font-size: 22px; font-weight: 800; letter-spacing: -0.02em;">
                                            Surebound Insurance
                                        </h1>
                                        <p style="margin: 6px 0 0 0; color: #cbd5e1; font-size: 13.5px; line-height: 1.4;">
                                            A new prospective client submitted a quote request on your website.
                                        </p>
                                    </td>
                                    <td align="right" valign="top" style="display: none;">
                                        <!-- Optional logo space -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Reference & Timestamp Ribbon -->
                    <tr>
                        <td style="background-color: #f1f5f9; padding: 14px 32px; border-bottom: 1px solid #e2e8f0;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="font-size: 13px; color: #475569;">
                                        Lead Reference: <strong style="color: #0f172a; font-family: monospace; font-size: 14px;">#{{ $quote->quote_ref }}</strong>
                                    </td>
                                    <td align="right" style="font-size: 12.5px; color: #64748b;">
                                        {{ $quote->created_at ? $quote->created_at->format('M d, Y • h:i A') : now()->format('M d, Y • h:i A') }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 28px 32px;">
                            
                            @if(!empty($quote->tags) && is_array($quote->tags))
                            <!-- Lead Tags (Top Placement) -->
                            <div style="margin-bottom: 20px; padding: 12px 16px; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
                                <div style="font-size: 11px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 8px;">
                                    Lead Underwriting Tags
                                </div>
                                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                    @foreach($quote->tags as $tag)
                                        <span style="display: inline-block; background-color: #0b192c; color: #fbbf24; font-size: 11px; font-weight: 700; padding: 3px 9px; border-radius: 4px; font-family: monospace; letter-spacing: 0.03em;">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Coverage Highlight Banner -->
                            <div style="background-color: #f0f7ff; border: 1px solid #bfdbfe; border-left: 4px solid #2563eb; border-radius: 8px; padding: 16px 20px; margin-bottom: 24px;">
                                <div style="font-size: 11.5px; font-weight: 700; color: #1d4ed8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">
                                    Requested Coverages
                                </div>
                                <div style="font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 4px;">
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
                                </div>
                                <div style="font-size: 13px; color: #334155;">
                                    Reference: <strong>#{{ $quote->quote_ref }}</strong>
                                    @if(!empty($quote->zip_code))
                                        &nbsp;•&nbsp; Location: <strong>ZIP {{ $quote->zip_code }}</strong>
                                    @endif
                                </div>
                            </div>

                            <!-- Customer Information Table -->
                            <h3 style="margin: 0 0 12px 0; font-size: 13.5px; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
                                Customer Contact Information
                            </h3>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 24px; border-collapse: collapse; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td width="35%" style="padding: 11px 14px; font-size: 13px; color: #64748b; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 600;">
                                        Full Name
                                    </td>
                                    <td width="65%" style="padding: 11px 14px; font-size: 14px; color: #0f172a; border-bottom: 1px solid #e2e8f0; font-weight: 700;">
                                        {{ $quote->name ?: 'Not Provided' }}
                                    </td>
                                </tr>
                                @if(!empty($quote->business_name))
                                <tr>
                                    <td style="padding: 11px 14px; font-size: 13px; color: #64748b; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 600;">
                                        Business Name
                                    </td>
                                    <td style="padding: 11px 14px; font-size: 14px; color: #0f172a; border-bottom: 1px solid #e2e8f0; font-weight: 700;">
                                        {{ $quote->business_name }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding: 11px 14px; font-size: 13px; color: #64748b; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 600;">
                                        Email Address
                                    </td>
                                    <td style="padding: 11px 14px; font-size: 14px; border-bottom: 1px solid #e2e8f0;">
                                        @if(!empty($quote->email) && !str_contains($quote->email, '@surebound-inquiry.com'))
                                            <a href="mailto:{{ $quote->email }}" style="color: #2563eb; text-decoration: none; font-weight: 600;">
                                                {{ $quote->email }}
                                            </a>
                                        @else
                                            <span style="color: #94a3b8; font-style: italic;">No personal email provided</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 11px 14px; font-size: 13px; color: #64748b; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 600;">
                                        Phone Number
                                    </td>
                                    <td style="padding: 11px 14px; font-size: 14px; border-bottom: 1px solid #e2e8f0;">
                                        @if(!empty($quote->phone))
                                            <a href="tel:{{ $quote->phone }}" style="color: #2563eb; text-decoration: none; font-weight: 600;">
                                                {{ $quote->phone }}
                                            </a>
                                        @else
                                            <span style="color: #94a3b8; font-style: italic;">Not provided</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 11px 14px; font-size: 13px; color: #64748b; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 600;">
                                        Location / ZIP
                                    </td>
                                    <td style="padding: 11px 14px; font-size: 14px; color: #0f172a; border-bottom: 1px solid #e2e8f0;">
                                        {{ $quote->location ?: ($quote->zip_code ? 'ZIP: '.$quote->zip_code : 'Tampa, FL') }}
                                    </td>
                                </tr>
                                @if(!empty($quote->tags) && is_array($quote->tags))
                                <tr>
                                    <td style="padding: 11px 14px; font-size: 13px; color: #64748b; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 600;">
                                        Lead Tags
                                    </td>
                                    <td style="padding: 11px 14px; font-size: 13px; border-bottom: 1px solid #e2e8f0;">
                                        @foreach($quote->tags as $tag)
                                            <span style="display: inline-block; background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; font-size: 11px; font-weight: 700; padding: 2px 7px; border-radius: 4px; margin-right: 4px; margin-bottom: 3px; font-family: monospace;">{{ $tag }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding: 11px 14px; font-size: 13px; color: #64748b; background-color: #f8fafc; font-weight: 600;">
                                        Submission Status
                                    </td>
                                    <td style="padding: 11px 14px; font-size: 13.5px; color: #166534; font-weight: 700;">
                                        Active Lead (Ready for Review)
                                    </td>
                                </tr>
                            </table>

                            @if(!empty($quote->notes))
                            <!-- Customer Message & Details Box -->
                            <div style="margin-bottom: 26px;">
                                <h3 style="margin: 0 0 10px 0; font-size: 13.5px; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Client Message &amp; Requirements
                                </h3>
                                <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0f172a; border-radius: 8px; padding: 16px 18px; color: #1e293b; font-size: 14px; line-height: 1.6; white-space: pre-wrap;">{{ $quote->notes }}</div>
                            </div>
                            @endif

                            <!-- Quick Action Buttons -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 26px;">
                                <tr>
                                    <td align="center">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                @if(!empty($quote->email) && !str_contains($quote->email, '@surebound-inquiry.com'))
                                                <td style="padding-right: 10px;">
                                                    <a href="mailto:{{ $quote->email }}?subject=Your%20Surebound%20Insurance%20Quote%20Request%20%28{{ $quote->quote_ref }}%29" style="display: inline-block; background: #2563eb; color: #ffffff; font-size: 13.5px; font-weight: 700; text-decoration: none; padding: 11px 20px; border-radius: 6px;">
                                                        Reply by Email &rarr;
                                                    </a>
                                                </td>
                                                @endif
                                                @if(!empty($quote->phone))
                                                <td style="padding-right: 10px;">
                                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $quote->phone) }}" style="display: inline-block; background: #ffffff; color: #1e3a8a; border: 1.5px solid #cbd5e1; font-size: 13.5px; font-weight: 700; text-decoration: none; padding: 9.5px 18px; border-radius: 6px;">
                                                        Call {{ $quote->phone }}
                                                    </a>
                                                </td>
                                                @endif
                                                <td>
                                                    <a href="{{ url('/admin#quotes') }}" style="display: inline-block; background: #0b192c; color: #ffffff; font-size: 13.5px; font-weight: 700; text-decoration: none; padding: 11px 20px; border-radius: 6px;">
                                                        Open in Portal &rarr;
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Clean Corporate Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 22px 32px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0; font-size: 12px; color: #64748b; line-height: 1.5;">
                                This lead notification was generated automatically for <strong>karry@sureboundinsurance.com</strong> &amp; <strong>info@sureboundinsurance.com</strong> because a quote request was submitted on Surebound Insurance.
                            </p>
                            <p style="margin: 6px 0 0 0; font-size: 11.5px; color: #94a3b8;">
                                Surebound Insurance Agency LLC • 100 N Tampa St, Suite 2500, Tampa, FL 33602 • Phone: (813) 214-1731 • License #FL-L114920
                            </p>
                            <p style="margin: 4px 0 0 0; font-size: 11px; color: #cbd5e1;">
                                &copy; {{ date('Y') }} Surebound Insurance Services. All rights reserved. Confidential agency communication.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
