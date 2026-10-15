<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Proof of Insurance - {{ $policy->policy_number }} - Surebound</title>
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
            max-width: 680px;
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
            font-size: 0.9375rem;
            box-shadow: 0 4px 6px -1px rgba(29, 78, 216, 0.25);
            transition: background 0.2s;
        }
        .print-btn:hover {
            background: #1e40af;
        }

        /* CARD CONTAINER */
        .id-card-wrapper {
            width: 100%;
            max-width: 680px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            border: 2px solid #e2e8f0;
            overflow: hidden;
            position: relative;
        }
        .id-card-header {
            background: linear-gradient(135deg, #09132e 0%, #1e3a8a 100%);
            color: #ffffff;
            padding: 22px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #3b82f6;
        }
        .brand-block {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .brand-title {
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .brand-subtitle {
            font-size: 0.75rem;
            color: #93c5fd;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2px;
        }
        .naic-pill {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #e0f2fe;
            text-align: right;
            font-family: 'JetBrains Mono', monospace;
        }

        .id-card-body {
            padding: 28px;
        }

        .card-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
            padding-bottom: 18px;
            border-bottom: 1px solid #f1f5f9;
        }
        .card-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .field-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.75px;
            color: var(--text-muted);
        }
        .field-value {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
        }
        .field-value.mono {
            font-family: 'JetBrains Mono', monospace;
            color: var(--brand-blue);
            font-size: 1.15rem;
        }
        .field-subtext {
            font-size: 0.8125rem;
            color: var(--text-muted);
        }

        .coverage-badge {
            display: inline-block;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 0.8125rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #bfdbfe;
        }

        /* FOOTER / VERIFICATION */
        .id-card-footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 20px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75rem;
            color: var(--text-muted);
        }
        .hotline-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .hotline-num {
            font-weight: 700;
            color: #0f172a;
            font-size: 0.875rem;
            font-family: 'JetBrains Mono', monospace;
        }
        .qr-placeholder {
            width: 58px;
            height: 58px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
        }
        .legal-notice {
            max-width: 680px;
            margin-top: 18px;
            font-size: 0.75rem;
            color: #64748b;
            text-align: center;
            line-height: 1.5;
        }

        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .actions-bar, .legal-notice {
                display: none !important;
            }
            .id-card-wrapper {
                box-shadow: none;
                border: 1px solid #94a3b8;
                max-width: 100%;
                page-break-inside: avoid;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 16px 12px;
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
            .id-card-header {
                padding: 18px 16px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .naic-pill {
                align-self: flex-start;
            }
            .id-card-body {
                padding: 18px 16px;
            }
            .card-row {
                grid-template-columns: 1fr;
                gap: 14px;
            }
            .id-card-footer {
                padding: 18px 16px;
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="actions-bar">
        <a href="{{ route('user.policies') }}" class="back-link">
            &larr; Back to My Policies
        </a>
        <button onclick="window.print()" class="print-btn">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Print / Save Digital Card
        </button>
    </div>

    <div class="id-card-wrapper">
        <div class="id-card-header">
            <div class="brand-block">
                <svg viewBox="0 0 40 48" fill="none" xmlns="http://www.w3.org/2000/svg" style="height: 34px; width: auto;">
                    <path d="M19.4 1.2a1.8 1.8 0 0 1 1.2 0L37.2 7c.5.3.8.8.8 1.3v15c0 10.7-7 20.6-17.1 24.3a2.5 2.5 0 0 1-1.8 0C9 43.9 2 34 2 23.3v-15c0-.5.3-1 .8-1.3L19.4 1.2Z" fill="#3B82F6"/>
                    <path d="M14 16.5h7c2 0 3.5 1.5 3.5 3.5s-1.5 3.5-3.5 3.5h-5.5v5h-1.5v-12Zm1.5 1.5v4h5.5c1.1 0 2-.9 2-2s-.9-2-2-2h-5.5Z" fill="#fff"/>
                </svg>
                <div>
                    <div class="brand-title">SUREBOUND</div>
                    <div class="brand-subtitle">Official Insurance Card &bull; State of Texas</div>
                </div>
            </div>
            <div class="naic-pill">
                NAIC #24819<br>
                <span>{{ strtoupper($policy->carrier ?: 'Surebound Syndicate') }}</span>
            </div>
        </div>

        <div class="id-card-body">
            <div class="card-row">
                <div class="field-group">
                    <span class="field-label">Policy Number</span>
                    <span class="field-value mono">{{ $policy->policy_number }}</span>
                    <span class="field-subtext">{{ $policy->type_label ?: ucfirst($policy->type).' Insurance' }}</span>
                </div>
                <div class="field-group">
                    <span class="field-label">Policyholder (Named Insured)</span>
                    <span class="field-value">{{ $policy->holder_name }}</span>
                    <span class="field-subtext">{{ $policy->holder_email }} &bull; {{ $policy->holder_phone ?: '(512) 840-2918' }}</span>
                </div>
            </div>

            <div class="card-row">
                <div class="field-group">
                    <span class="field-label">Insured Asset / Subject of Insurance</span>
                    <span class="field-value" style="font-size: 0.9375rem;">{{ $policy->insured_item ?: 'Listed Insured Schedule on File' }}</span>
                </div>
                <div class="field-group">
                    <span class="field-label">Coverage &amp; Deductible Terms</span>
                    <span class="field-value" style="color: #1e3a8a;">{{ $policy->coverage_limit }}</span>
                    <span class="field-subtext">Deductible: <strong>{{ $policy->deductible ?: '$1,000 standard' }}</strong></span>
                </div>
            </div>

            <div class="card-row">
                <div class="field-group">
                    <span class="field-label">Effective Date</span>
                    <span class="field-value" style="font-size: 0.9375rem;">{{ $policy->effective_date ? \Carbon\Carbon::parse($policy->effective_date)->format('M d, Y') : 'Active' }}</span>
                </div>
                <div class="field-group">
                    <span class="field-label">Expiration / Renewal Date</span>
                    <span class="field-value" style="font-size: 0.9375rem; color: #047857;">{{ $policy->renewal_date ? \Carbon\Carbon::parse($policy->renewal_date)->format('M d, Y') : 'Continuous' }}</span>
                </div>
            </div>
        </div>

        <div class="id-card-footer">
            <div class="hotline-item">
                <span>24/7 ROADSIDE &amp; EMERGENCY:</span>
                <span class="hotline-num">1-800-555-0199</span>
            </div>
            <div class="hotline-item">
                <span>CLAIMS FIRST NOTICE (FNOL):</span>
                <span class="hotline-num">1-800-555-CLAIM</span>
            </div>
            <div class="qr-placeholder" title="Digital Verification QR Code">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="width: 44px; height: 44px; color: #1e3a8a;">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                    <rect x="14" y="14" width="4" height="4"></rect>
                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                    <line x1="17" y1="7" x2="17.01" y2="7"></line>
                    <line x1="7" y1="17" x2="7.01" y2="17"></line>
                    <line x1="20" y1="18" x2="20.01" y2="18"></line>
                    <line x1="18" y1="21" x2="21" y2="21"></line>
                </svg>
            </div>
        </div>
    </div>

    <div class="legal-notice">
        This document serves as official digital evidence of continuous insurance coverage underwritten by Surebound Syndicate. Keep this card in your vehicle or on your mobile device as proof of financial responsibility required by state law.
    </div>

</body>
</html>
