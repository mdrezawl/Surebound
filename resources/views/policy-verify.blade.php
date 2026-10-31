<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $policy ? 'Verified: '.$policy->policy_number.' - Surebound Proof of Insurance' : 'Digital Policy Verification - Surebound' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-navy: #09132e;
            --brand-blue: #1d4ed8;
            --brand-light-blue: #3b82f6;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --emerald: #059669;
            --emerald-bg: #ecfdf5;
            --emerald-border: #a7f3d0;
            --card-border: #e2e8f0;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(180deg, #f8fafc 0%, #eef2f6 100%);
            color: var(--text-dark);
            min-height: 100vh;
            padding: 40px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .verify-container {
            width: 100%;
            max-width: 640px;
        }
        .verify-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px -15px rgba(9, 19, 46, 0.12), 0 0 1px 1px rgba(9, 19, 46, 0.05);
            border: 1px solid var(--card-border);
            overflow: hidden;
        }
        .verify-header {
            background: linear-gradient(135deg, #09132e 0%, #1e3a8a 100%);
            color: #ffffff;
            padding: 24px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px solid #3b82f6;
        }
        .brand-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-title {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .brand-subtitle {
            font-size: 0.72rem;
            color: #93c5fd;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2px;
        }
        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(52, 211, 153, 0.5);
            color: #6ee7b7;
            padding: 6px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .verified-badge svg {
            width: 14px;
            height: 14px;
        }
        .verify-body {
            padding: 28px;
        }
        .status-banner {
            background: var(--emerald-bg);
            border: 1px solid var(--emerald-border);
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
        }
        .status-icon {
            width: 44px;
            height: 44px;
            background: #10b981;
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
        }
        .status-icon svg {
            width: 24px;
            height: 24px;
        }
        .status-title {
            font-size: 1rem;
            font-weight: 800;
            color: #065f46;
        }
        .status-sub {
            font-size: 0.8125rem;
            color: #047857;
            margin-top: 2px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f1f5f9;
        }
        .info-cell {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .info-cell.full-width {
            grid-column: 1 / -1;
        }
        .cell-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.75px;
            color: var(--text-muted);
        }
        .cell-value {
            font-size: 0.95rem;
            font-weight: 700;
            color: #0f172a;
        }
        .cell-value.mono {
            font-family: 'JetBrains Mono', monospace;
            color: var(--brand-blue);
            font-size: 1.125rem;
        }
        .cell-sub {
            font-size: 0.8125rem;
            color: var(--text-muted);
        }
        .statute-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 16px;
            margin-top: 20px;
            font-size: 0.75rem;
            color: var(--text-muted);
            line-height: 1.5;
        }
        .statute-box strong {
            color: #0f172a;
        }
        .verify-actions {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 18px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        .action-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--brand-blue);
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.15s;
        }
        .action-link:hover {
            color: #1e40af;
            text-decoration: underline;
        }
        .action-btn {
            background: var(--brand-blue);
            color: #ffffff;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 6px -1px rgba(29, 78, 216, 0.2);
            transition: background 0.15s;
        }
        .action-btn:hover {
            background: #1e40af;
        }
        .not-found-card {
            padding: 40px 28px;
            text-align: center;
        }
        .not-found-icon {
            width: 60px;
            height: 60px;
            background: #fee2e2;
            color: #dc2626;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        .search-form {
            display: flex;
            gap: 8px;
            max-width: 380px;
            margin: 20px auto 0;
        }
        .search-input {
            flex: 1;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.9375rem;
            font-family: 'JetBrains Mono', monospace;
            outline: none;
        }
        .search-input:focus {
            border-color: var(--brand-blue);
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.15);
        }
        .search-btn {
            background: var(--brand-blue);
            color: #ffffff;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }
        @media (max-width: 580px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .verify-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .verify-actions {
                flex-direction: column;
                align-items: stretch;
            }
            .action-btn, .action-link {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <div class="verify-container">
        <div class="verify-card">
            <div class="verify-header">
                <div class="brand-group">
                    <svg viewBox="0 0 40 48" fill="none" xmlns="http://www.w3.org/2000/svg" style="height: 32px; width: auto;">
                        <path d="M19.4 1.2a1.8 1.8 0 0 1 1.2 0L37.2 7c.5.3.8.8.8 1.3v15c0 10.7-7 20.6-17.1 24.3a2.5 2.5 0 0 1-1.8 0C9 43.9 2 34 2 23.3v-15c0-.5.3-1 .8-1.3L19.4 1.2Z" fill="#3B82F6"/>
                        <path d="M14 16.5h7c2 0 3.5 1.5 3.5 3.5s-1.5 3.5-3.5 3.5h-5.5v5h-1.5v-12Zm1.5 1.5v4h5.5c1.1 0 2-.9 2-2s-.9-2-2-2h-5.5Z" fill="#fff"/>
                    </svg>
                    <div>
                        <div class="brand-title">SUREBOUND</div>
                        <div class="brand-subtitle">State of Texas &bull; Verification Registry</div>
                    </div>
                </div>
                @if($policy)
                    <div class="verified-badge">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Official Proof Active
                    </div>
                @endif
            </div>

            @if($policy)
                <div class="verify-body">
                    <div class="status-banner">
                        <div class="status-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <div class="status-title">Valid Insurance Coverage In Force</div>
                            <div class="status-sub">Verified in Surebound Syndicate Policy Registry on {{ now()->format('M d, Y') }}</div>
                        </div>
                    </div>

                    <div class="info-grid">
                        <div class="info-cell">
                            <span class="cell-label">Policy Number</span>
                            <span class="cell-value mono">{{ $policy->policy_number }}</span>
                            <span class="cell-sub">{{ $policy->type_label ?: ucfirst($policy->type).' Insurance' }}</span>
                        </div>
                        <div class="info-cell">
                            <span class="cell-label">Named Insured (Policyholder)</span>
                            <span class="cell-value">{{ $policy->holder_name }}</span>
                            <span class="cell-sub">{{ $policy->holder_phone ?: '(512) 840-2918' }}</span>
                        </div>
                        <div class="info-cell">
                            <span class="cell-label">Underwriting Carrier</span>
                            <span class="cell-value">{{ $policy->carrier ?: 'Surebound Mutual Underwriting Co.' }}</span>
                            <span class="cell-sub">NAIC #24819 &bull; State of Texas</span>
                        </div>
                        <div class="info-cell">
                            <span class="cell-label">Coverage &amp; Deductible</span>
                            <span class="cell-value" style="color: #1e3a8a;">{{ $policy->coverage_limit }}</span>
                            <span class="cell-sub">Deductible: {{ $policy->deductible ?: '$1,000' }}</span>
                        </div>
                        <div class="info-cell">
                            <span class="cell-label">Effective Date</span>
                            <span class="cell-value">{{ $policy->effective_date ? \Carbon\Carbon::parse($policy->effective_date)->format('M d, Y') : 'Active' }}</span>
                        </div>
                        <div class="info-cell">
                            <span class="cell-label">Expiration / Renewal</span>
                            <span class="cell-value" style="color: #047857;">{{ $policy->renewal_date ? \Carbon\Carbon::parse($policy->renewal_date)->format('M d, Y') : 'Continuous' }}</span>
                        </div>
                        <div class="info-cell full-width">
                            <span class="cell-label">Insured Asset / Subject of Insurance</span>
                            <span class="cell-value">{{ $policy->insured_item ?: 'Listed Insured Schedule on File' }}</span>
                        </div>
                    </div>

                    <div class="statute-box">
                        <strong>Statutory Compliance:</strong> This verification constitutes official digital proof of financial responsibility satisfying Texas Transportation Code &sect; 601.051. Continuous electronic verification confirmed by Surebound Underwriting Syndicate.
                    </div>
                </div>

                <div class="verify-actions">
                    <a href="{{ route('home') }}" class="action-link">
                        &larr; Surebound Home
                    </a>
                    <a href="{{ route('user.policies.id-card', $policy->id) }}" class="action-btn" target="_blank">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        View Official ID Card
                    </a>
                </div>
            @else
                <div class="not-found-card">
                    <div class="not-found-icon">
                        <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 8px;">
                        {{ $policyNumber ? 'Policy Not Found' : 'Verify Insurance Coverage' }}
                    </h2>
                    <p style="font-size: 0.875rem; color: #64748b; max-width: 440px; margin: 0 auto 16px;">
                        @if($policyNumber)
                            No active insurance policy was found matching number <strong>{{ htmlspecialchars($policyNumber) }}</strong>. Please check the policy number and try again.
                        @else
                            Enter an official Surebound policy number to verify coverage status in the Texas Financial Responsibility Registry.
                        @endif
                    </p>
                    <form method="GET" action="{{ route('policy.verify') }}" class="search-form">
                        <input type="text" name="number" class="search-input" placeholder="e.g. SB-P0L-51928" value="{{ $policyNumber }}" required>
                        <button type="submit" class="search-btn">Verify</button>
                    </form>
                </div>
                <div class="verify-actions">
                    <a href="{{ route('home') }}" class="action-link">
                        &larr; Return to Surebound Home
                    </a>
                    <span style="font-size: 0.8125rem; color: #64748b;">
                        Assistance: 1-800-555-0199
                    </span>
                </div>
            @endif
        </div>
    </div>

</body>
</html>
