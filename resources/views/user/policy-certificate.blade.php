<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Insurance - {{ $policy->policy_number }} - Surebound</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-navy: #09132e;
            --brand-blue: #1d4ed8;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #cbd5e1;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f1f5f9;
            color: var(--text-dark);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .actions-bar {
            width: 100%;
            max-width: 820px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--brand-blue);
            font-weight: 600;
            font-size: 0.9375rem;
            text-decoration: none;
        }
        .print-btn {
            background: var(--brand-blue);
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.25);
            transition: all 0.2s;
        }
        .print-btn:hover {
            background: #1e40af;
            transform: translateY(-1px);
        }
        .cert-container {
            width: 100%;
            max-width: 820px;
            background: #ffffff;
            border: 2px solid #0f172a;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 24px;
        }
        .cert-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #0f172a;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }
        .cert-title {
            font-size: 1.25rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
        }
        .cert-disclaimer {
            font-size: 0.65rem;
            line-height: 1.25;
            color: #475569;
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            padding: 8px;
            margin-bottom: 12px;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 12px;
        }
        .info-box {
            border: 1px solid #0f172a;
            padding: 8px 10px;
            font-size: 0.75rem;
        }
        .info-box-header {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            background: #f1f5f9;
            margin: -8px -10px 6px -10px;
            padding: 4px 10px;
            border-bottom: 1px solid #cbd5e1;
        }
        .coverages-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.7rem;
            margin-bottom: 12px;
            border: 1px solid #0f172a;
        }
        .coverages-table th {
            background: #0f172a;
            color: #fff;
            padding: 6px 8px;
            text-align: left;
            font-size: 0.6875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .coverages-table td {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
            vertical-align: top;
        }
        .limits-col {
            background: #f8fafc;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 600;
        }
        .holder-box {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 12px;
            margin-top: 12px;
        }
        .signature-box {
            border: 1px solid #0f172a;
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .cert-seal {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 8px;
            border: 1px solid #059669;
            color: #059669;
            font-weight: 700;
            font-size: 0.65rem;
            text-transform: uppercase;
            border-radius: 4px;
            background: #ecfdf5;
        }
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .actions-bar {
                display: none;
            }
            .cert-container {
                border: 2px solid #000;
                box-shadow: none;
                max-width: 100%;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 16px 10px;
            }
            .actions-bar {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }
            .back-link, .print-btn {
                width: 100%;
                justify-content: center;
                text-align: center;
            }
            .cert-container {
                padding: 14px;
            }
            .cert-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .cert-header > div:last-child {
                text-align: left !important;
            }
            .grid-2 {
                grid-template-columns: 1fr;
            }
            .coverages-table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                width: 100%;
                margin-bottom: 12px;
            }
            .coverages-table {
                min-width: 480px;
            }
        }
    </style>
</head>
<body>

    <div class="actions-bar">
        <a href="{{ route('user.documents') }}" class="back-link">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Digital Document Locker</span>
        </a>
        <button type="button" onclick="window.print()" class="print-btn">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            <span>Print / Save Certificate PDF</span>
        </button>
    </div>

    <div class="cert-container">
        <!-- HEADER -->
        <div class="cert-header">
            <div>
                <div class="cert-title">CERTIFICATE OF LIABILITY INSURANCE</div>
                <div style="font-size: 0.75rem; color: #475569; margin-top: 2px; font-weight: 600;">ACORD FORM 25 (2026/01) &bull; VERIFIED UNDERWRITING CERTIFICATE</div>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 0.75rem; font-weight: 700; color: #0f172a;">DATE (MM/DD/YYYY)</div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 0.8125rem; font-weight: 700;">{{ now()->format('m/d/Y') }}</div>
                <div class="cert-seal" style="margin-top: 4px;">
                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>Surebound Verified</span>
                </div>
            </div>
        </div>

        <!-- DISCLAIMER -->
        <div class="cert-disclaimer">
            <strong>IMPORTANT:</strong> THIS CERTIFICATE IS ISSUED AS A MATTER OF INFORMATION ONLY AND CONFERS NO RIGHTS UPON THE CERTIFICATE HOLDER. THIS CERTIFICATE DOES NOT AMEND, EXTEND OR ALTER THE COVERAGE AFFORDED BY THE POLICIES BELOW. THIS CERTIFICATE OF INSURANCE DOES NOT CONSTITUTE A CONTRACT BETWEEN THE ISSUING INSURER(S), AUTHORIZED REPRESENTATIVE OR PRODUCER, AND THE CERTIFICATE HOLDER.
        </div>

        <!-- PRODUCER & INSURED -->
        <div class="grid-2">
            <div class="info-box">
                <div class="info-box-header">PRODUCER / MANAGING GENERAL AGENCY</div>
                <strong>Surebound Underwriting &amp; Risk Insurance Agency LLC</strong><br>
                100 Congress Avenue, Suite 1900<br>
                Austin, TX 78701<br>
                Phone: (512) 840-2918 &bull; Email: underwriting@surebound.com<br>
                National Producer License: #TX-98401923
            </div>

            <div class="info-box">
                <div class="info-box-header">INSURERS AFFORDING COVERAGE &bull; NAIC #</div>
                <strong>INSURER A:</strong> Surebound Indemnity Casualty Corp (NAIC #29482)<br>
                <strong>INSURER B:</strong> Lloyd's of London Underwriting Syndicate #0033<br>
                <strong>INSURER C:</strong> National Fire &amp; Marine Underwriters (NAIC #10521)<br>
                <strong>INSURER D:</strong> Travelers Risk Syndicate
            </div>
        </div>

        <div class="grid-2">
            <div class="info-box">
                <div class="info-box-header">INSURED (NAMED POLICYHOLDER)</div>
                <strong style="font-size: 0.875rem;">{{ $policy->holder_name }}</strong><br>
                Contact Email: {{ $policy->holder_email }}<br>
                Phone: {{ $policy->holder_phone ?: '(512) 840-2918' }}<br>
                Insured Asset/Location: {{ $policy->insured_item ?: 'Primary Domicile on File' }}
            </div>

            <div class="info-box">
                <div class="info-box-header">POLICY CONTRACT IDENTIFIERS</div>
                <strong>Policy Number:</strong> <span style="font-family: 'JetBrains Mono', monospace; font-weight: 700; color: var(--brand-blue);">{{ $policy->policy_number }}</span><br>
                <strong>Coverage Line:</strong> {{ strtoupper($policy->type) }} INSURANCE ({{ $policy->plan_name }})<br>
                <strong>Policy Status:</strong> <span style="color: #059669; font-weight: 700;">{{ strtoupper($policy->status) }}</span><br>
                <strong>Effective Term:</strong> {{ \Carbon\Carbon::parse($policy->effective_date)->format('m/d/Y') }} to {{ \Carbon\Carbon::parse($policy->renewal_date)->format('m/d/Y') }}
            </div>
        </div>

        <!-- COVERAGES TABLE -->
        <div class="coverages-table-wrap">
            <table class="coverages-table">
                <thead>
                    <tr>
                        <th style="width: 20%;">TYPE OF INSURANCE</th>
                        <th style="width: 25%;">POLICY NUMBER</th>
                        <th style="width: 15%;">EFFECTIVE</th>
                        <th style="width: 15%;">EXPIRATION</th>
                        <th style="width: 25%;">LIMITS OF LIABILITY</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>COMMERCIAL / GENERAL LIABILITY</strong><br>
                            <span style="font-size: 0.65rem; color: #475569;">[X] Commercial General Liability<br>[X] Occurrence Basis</span>
                        </td>
                        <td style="font-family: 'JetBrains Mono', monospace; font-weight: 700;">
                            {{ $policy->policy_number }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($policy->effective_date)->format('m/d/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($policy->renewal_date)->format('m/d/Y') }}</td>
                        <td class="limits-col">
                            EACH OCCURRENCE: {{ $policy->coverage_limit }}<br>
                            DAMAGE TO PREMISES: $500,000<br>
                            MED EXP (Any one person): $10,000<br>
                            GENERAL AGGREGATE: {{ $policy->coverage_limit }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>PROPERTY &amp; CASUALTY SCHEDULE</strong><br>
                            <span style="font-size: 0.65rem; color: #475569;">[X] Special Perils / Replacement Cost</span>
                        </td>
                        <td style="font-family: 'JetBrains Mono', monospace; font-weight: 700;">
                            {{ $policy->policy_number }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($policy->effective_date)->format('m/d/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($policy->renewal_date)->format('m/d/Y') }}</td>
                        <td class="limits-col">
                            STIPULATED DEDUCTIBLE: {{ $policy->deductible }}<br>
                            ANNUAL RATE SCHEDULE: {{ $policy->annual_premium }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- DESCRIPTION OF OPERATIONS / SPECIAL PROVISIONS -->
        <div class="info-box" style="margin-bottom: 12px;">
            <div class="info-box-header">DESCRIPTION OF OPERATIONS / LOCATIONS / VEHICLES / ADDITIONAL REMARKS / SPECIAL PROVISIONS</div>
            <p style="font-size: 0.72rem; line-height: 1.4; color: #334155;">
                Certificate holder is included as an Additional Insured with respects to General Liability operations of the named insured as required by written contract or agreement. 
                Coverage afforded is Primary and Non-Contributory. Waiver of Subrogation applies in favor of Certificate Holder where allowable by state statute. 
                30-day written Notice of Cancellation applies in accordance with policy conditions (10 days for non-payment of premium).
            </p>
        </div>

        <!-- HOLDER & AUTHORIZED SIGNATURE -->
        <div class="holder-box">
            <div class="info-box">
                <div class="info-box-header">CERTIFICATE HOLDER</div>
                <strong>FOR LEASE, MORTGAGE, LENDER &amp; COMMERCIAL USE:</strong><br>
                <div style="margin-top: 6px; font-size: 0.75rem; color: #1e293b;">
                    Attn: Certificate Verification Unit<br>
                    Additional Insured / Loss Payee / Mortgagee of Record<br>
                    United States of America
                </div>
            </div>

            <div class="signature-box">
                <div>
                    <div style="font-size: 0.6875rem; font-weight: 800; text-transform: uppercase; color: #475569; margin-bottom: 4px;">CANCELLATION &amp; AUTHORIZATION</div>
                    <div style="font-size: 0.625rem; color: #64748b; line-height: 1.2;">
                        SHOULD ANY OF THE ABOVE DESCRIBED POLICIES BE CANCELLED BEFORE THE EXPIRATION DATE THEREOF, NOTICE WILL BE DELIVERED IN ACCORDANCE WITH THE POLICY PROVISIONS.
                    </div>
                </div>

                <div style="margin-top: 16px; border-top: 1px solid #cbd5e1; padding-top: 6px;">
                    <div style="font-family: 'Brush Script MT', cursive, sans-serif; font-size: 1.5rem; color: #09132e; line-height: 1;">
                        Md Rezawl
                    </div>
                    <div style="font-size: 0.6875rem; font-weight: 700; color: #0f172a; margin-top: 2px;">
                        AUTHORIZED REPRESENTATIVE &bull; CHIEF UNDERWRITER
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 14px; text-align: center; font-size: 0.65rem; color: #94a3b8;">
            &copy; 1988-2026 ACORD CORPORATION. All rights reserved. &bull; Generated digitally by Surebound Underwriting Platform &bull; Policy Reference: {{ $policy->policy_number }}
        </div>
    </div>

</body>
</html>
