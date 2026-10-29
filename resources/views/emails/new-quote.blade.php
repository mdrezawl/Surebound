<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Quote Inquiry - Surebound Insurance</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08); border: 1px solid #e2e8f0;">
                    
                    <!-- Header Banner -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #0b192c 0%, #1e3a8a 100%); padding: 32px 30px; text-align: left;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td>
                                        <div style="display: inline-block; padding: 4px 12px; background-color: rgba(251, 191, 36, 0.15); border: 1px solid rgba(251, 191, 36, 0.4); border-radius: 9999px; color: #fbbf24; font-size: 11px; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 12px;">
                                            ⚡ New Quote Lead Alert
                                        </div>
                                        <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: 800; letter-spacing: -0.02em;">
                                            Surebound Insurance
                                        </h1>
                                        <p style="margin: 6px 0 0 0; color: #94a3b8; font-size: 13px;">
                                            A new insurance quote request has just been recorded in your system.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Key Info Badge Bar -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 16px 30px; border-bottom: 1px solid #e2e8f0;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="font-size: 13px; color: #64748b;">
                                        Reference: <strong style="color: #0f172a; font-family: monospace; font-size: 14px;">{{ $quote->quote_ref }}</strong>
                                    </td>
                                    <td align="right" style="font-size: 12px; color: #64748b;">
                                        {{ $quote->created_at ? $quote->created_at->format('M d, Y • h:i A') : now()->format('M d, Y • h:i A') }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content Body -->
                    <tr>
                        <td style="padding: 30px;">
                            
                            <!-- Coverage Highlight Box -->
                            <div style="background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 18px 20px; margin-bottom: 24px;">
                                <div style="font-size: 11px; font-weight: 700; color: #1d4ed8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">
                                    Policy Requested
                                </div>
                                <div style="font-size: 18px; font-weight: 700; color: #1e3a8a; margin-bottom: 4px;">
                                    {{ $quote->type_label ?? ucfirst(str_replace('_', ' ', $quote->type)) }}
                                </div>
                                <div style="font-size: 13px; color: #3b82f6;">
                                    Coverage Tier: <strong>{{ $quote->coverage ?? 'Standard' }}</strong>
                                    @if(!empty($quote->premium))
                                        &nbsp;•&nbsp; Est. Premium: <strong>{{ $quote->premium }}</strong>
                                    @endif
                                </div>
                            </div>

                            <!-- Customer Information Table -->
                            <h3 style="margin: 0 0 14px 0; font-size: 14px; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
                                Customer Contact Information
                            </h3>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 24px; border-collapse: collapse;">
                                <tr>
                                    <td width="35%" style="padding: 10px 12px; font-size: 13px; color: #64748b; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 600;">
                                        Full Name
                                    </td>
                                    <td width="65%" style="padding: 10px 12px; font-size: 14px; color: #0f172a; border-bottom: 1px solid #e2e8f0; font-weight: 600;">
                                        {{ $quote->name ?: 'Not Provided' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 12px; font-size: 13px; color: #64748b; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 600;">
                                        Email Address
                                    </td>
                                    <td style="padding: 10px 12px; font-size: 14px; border-bottom: 1px solid #e2e8f0;">
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
                                    <td style="padding: 10px 12px; font-size: 13px; color: #64748b; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 600;">
                                        Phone Number
                                    </td>
                                    <td style="padding: 10px 12px; font-size: 14px; border-bottom: 1px solid #e2e8f0;">
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
                                    <td style="padding: 10px 12px; font-size: 13px; color: #64748b; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 600;">
                                        Location / ZIP
                                    </td>
                                    <td style="padding: 10px 12px; font-size: 14px; color: #0f172a; border-bottom: 1px solid #e2e8f0;">
                                        {{ $quote->location ?: ($quote->zip_code ? 'ZIP: '.$quote->zip_code : 'N/A') }}
                                    </td>
                                </tr>
                                @if(!empty($quote->notes))
                                <tr>
                                    <td style="padding: 10px 12px; font-size: 13px; color: #64748b; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 600; vertical-align: top;">
                                        Form Details / Notes
                                    </td>
                                    <td style="padding: 10px 12px; font-size: 13px; color: #334155; border-bottom: 1px solid #e2e8f0; line-height: 1.5;">
                                        {{ $quote->notes }}
                                    </td>
                                </tr>
                                @endif
                            </table>

                            <!-- Call to Action Buttons -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 26px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/admin#quotes') }}" style="display: inline-block; background: linear-gradient(135deg, #1e3a8a 0%, #0b192c 100%); color: #ffffff; font-size: 14px; font-weight: 700; text-decoration: none; padding: 13px 28px; border-radius: 8px; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);">
                                            View Quote in Admin Panel &rarr;
                                        </a>
                                        @if(!empty($quote->email) && !str_contains($quote->email, '@surebound-inquiry.com'))
                                            <div style="margin-top: 12px;">
                                                <a href="mailto:{{ $quote->email }}?subject=Your%20Surebound%20Insurance%20Quote%20Request%20%28{{ $quote->quote_ref }}%29" style="font-size: 13px; color: #2563eb; text-decoration: underline;">
                                                    Or click here to reply directly to {{ $quote->name ?: 'Customer' }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 22px 30px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0; font-size: 12px; color: #94a3b8; line-height: 1.5;">
                                This automated notification was generated for <strong>karry@sureboundinsurance.com</strong> because a new quote inquiry was submitted on Surebound Insurance.
                            </p>
                            <p style="margin: 6px 0 0 0; font-size: 11px; color: #cbd5e1;">
                                &copy; {{ date('Y') }} Surebound Insurance Services. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
