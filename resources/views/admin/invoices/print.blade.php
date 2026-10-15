<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surebound Invoice – {{ $invoice->invoice_number }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #0b1120;
            color: #0f172a;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        /* Top Action Bar (hidden on print) */
        .invoice-actions-bar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(15, 23, 42, 0.92);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .bar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .bar-brand {
            font-size: 1.0625rem;
            font-weight: 800;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            letter-spacing: -0.01em;
        }

        .bar-brand img {
            height: 28px;
            width: auto;
        }

        .bar-badge {
            font-size: 0.6875rem;
            font-weight: 800;
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.35);
            padding: 3px 10px;
            border-radius: 9999px;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .bar-badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 8px #10b981;
        }

        .bar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-download {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
        }

        .btn-download:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.45);
        }

        .btn-print {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .btn-print:hover {
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-back {
            background: transparent;
            color: #94a3b8;
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .btn-back:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.08);
        }

        /* Printable Sheet Paper */
        .sheet-container {
            padding: 40px 20px 80px;
            display: flex;
            justify-content: center;
        }

        .invoice-sheet {
            width: 100%;
            max-width: 880px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(255, 255, 255, 0.1);
            padding: 52px;
            position: relative;
            color: #0f172a;
            overflow: hidden;
        }

        /* Top Decorative Executive Accent Bar */
        .invoice-sheet::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #059669 0%, #0d9488 25%, #2563eb 70%, #1e3a8a 100%);
        }

        /* Invoice Header */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 26px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 28px;
        }

        .agency-brand {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .agency-logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .agency-logo {
            height: 48px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .agency-name {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .agency-tagline {
            font-size: 0.75rem;
            font-weight: 600;
            color: #059669;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .agency-contact {
            font-size: 0.8125rem;
            color: #64748b;
            line-height: 1.6;
        }

        .invoice-meta-block {
            text-align: right;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
        }

        .invoice-title {
            font-size: 1.875rem;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: 0.06em;
            line-height: 1;
        }

        .invoice-number-tag {
            font-family: 'JetBrains Mono', 'SFMono-Regular', Consolas, monospace;
            font-size: 1.125rem;
            font-weight: 700;
            color: #2563eb;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 4px 12px;
            border-radius: 6px;
            display: inline-block;
        }

        .invoice-dates-grid {
            margin-top: 4px;
            font-size: 0.8125rem;
            text-align: right;
            color: #475569;
            line-height: 1.6;
        }

        .invoice-dates-grid span {
            color: #64748b;
            margin-right: 4px;
        }

        .invoice-dates-grid strong {
            color: #0f172a;
        }

        /* Status Stamp */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-top: 4px;
        }

        .status-paid {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
            box-shadow: 0 2px 6px rgba(16, 185, 129, 0.12);
        }

        .status-pending {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fde68a;
            box-shadow: 0 2px 6px rgba(245, 158, 11, 0.1);
        }

        .status-overdue {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.1);
        }

        /* Billing 2-col info cards */
        .bill-info-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 20px;
            margin-bottom: 28px;
        }

        .info-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 18px 22px;
        }

        .info-col-title {
            font-size: 0.6875rem;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .customer-name {
            font-size: 1.125rem;
            font-weight: 800;
            color: #0f172a;
        }

        .customer-detail {
            font-size: 0.8125rem;
            color: #475569;
            margin-top: 3px;
            line-height: 1.5;
        }

        .policy-tag-box {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            padding: 8px 12px;
            border-radius: 6px;
            margin-top: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .policy-tag-number {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            color: #1e40af;
            font-size: 0.9375rem;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 24px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .items-table th {
            background: #f1f5f9;
            color: #334155;
            font-size: 0.6875rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 12px 16px;
            border-bottom: 1px solid #cbd5e1;
            text-align: left;
        }

        .items-table th.col-qty {
            width: 70px;
            text-align: center;
        }

        .items-table th.col-price {
            width: 150px;
            text-align: right;
        }

        .items-table th.col-total {
            width: 150px;
            text-align: right;
        }

        .items-table td {
            padding: 14px 16px;
            font-size: 0.875rem;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
        }

        .items-table tr:last-child td {
            border-bottom: none;
        }

        .items-table tr:nth-child(even) td {
            background: #fbfcfe;
        }

        .items-table td.col-qty {
            text-align: center;
            color: #64748b;
            font-weight: 600;
        }

        .items-table td.col-price {
            text-align: right;
            font-family: 'JetBrains Mono', monospace;
            color: #475569;
            font-size: 0.9375rem;
        }

        .items-table td.col-total {
            text-align: right;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            color: #0f172a;
            font-size: 0.9375rem;
        }

        /* Financial Summary Box */
        .calc-breakdown {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 28px;
        }

        .calc-card {
            width: 340px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
        }

        .calc-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 0;
            font-size: 0.875rem;
            color: #64748b;
        }

        .calc-row span.val {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9375rem;
        }

        .calc-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            padding-top: 12px;
            border-top: 2px solid #0f172a;
        }

        .calc-total-label {
            font-size: 1rem;
            font-weight: 800;
            color: #0f172a;
        }

        .calc-total-amount {
            font-size: 1.5rem;
            font-weight: 900;
            color: #059669;
            font-family: 'JetBrains Mono', monospace;
        }

        /* Remittance Instructions & Notes */
        .remittance-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 4px solid #10b981;
            padding: 16px 20px;
            border-radius: 8px;
            font-size: 0.8125rem;
            color: #166534;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .remittance-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px;
            margin-top: 8px;
            background: rgba(255, 255, 255, 0.6);
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #bbf7d0;
        }

        .remit-item {
            font-size: 0.75rem;
        }

        .remit-item span {
            color: #15803d;
            font-weight: 500;
        }

        .remit-item strong {
            font-family: 'JetBrains Mono', monospace;
            color: #0f172a;
        }

        .notes-box {
            border-top: 1px dashed #cbd5e1;
            padding-top: 16px;
            margin-bottom: 28px;
        }

        .notes-title {
            font-size: 0.6875rem;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 4px;
        }

        .notes-content {
            font-size: 0.8125rem;
            color: #475569;
            line-height: 1.55;
        }

        /* Signatory & Stamp Section */
        .signature-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            margin-top: 24px;
        }

        .seal-wrap {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* Premium Gold/Navy Vector Seal */
        .seal-badge {
            width: 72px;
            height: 72px;
            position: relative;
            flex-shrink: 0;
        }

        .seal-text {
            font-size: 0.75rem;
            color: #64748b;
            line-height: 1.45;
        }

        .seal-text strong {
            color: #0f172a;
            font-weight: 700;
        }

        .seal-security-code {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.6875rem;
            color: #059669;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .sign-box {
            text-align: right;
            min-width: 240px;
        }

        .sign-image-wrap {
            height: 64px;
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            margin-bottom: 6px;
        }

        .sign-image-render {
            max-height: 60px;
            max-width: 220px;
            object-fit: contain;
            display: block;
        }

        .sign-signature-fallback {
            font-family: 'Brush Script MT', 'Segoe Script', cursive;
            font-size: 2rem;
            color: #1e3a8a;
            line-height: 1;
            margin-bottom: 4px;
        }

        .sign-line {
            width: 220px;
            border-top: 1.5px solid #0f172a;
            margin-left: auto;
            margin-bottom: 6px;
        }

        .sign-name {
            font-size: 0.875rem;
            font-weight: 800;
            color: #0f172a;
        }

        .sign-title {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }

        /* Footer */
        .invoice-footer {
            margin-top: 36px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
            text-align: center;
            font-size: 0.6875rem;
            color: #94a3b8;
            line-height: 1.6;
        }

        /* PRINT MEDIA QUERIES */
        @media print {
            body {
                background: #ffffff !important;
                color: #000000 !important;
            }

            .invoice-actions-bar {
                display: none !important;
            }

            .sheet-container {
                padding: 0 !important;
                margin: 0 !important;
                display: block !important;
            }

            .invoice-sheet {
                box-shadow: none !important;
                border-radius: 0 !important;
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            @page {
                size: A4 portrait;
                margin: 8mm 12mm 10mm 12mm;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>
<body>

    <!-- Sticky Action Toolbar (Hidden during Print/PDF) -->
    <header class="invoice-actions-bar">
        <div class="bar-left">
            <a href="{{ route('admin.dashboard') }}#invoices" class="bar-brand">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #34d399;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                </svg>
                <span>Surebound Insurance</span>
            </a>
            <span class="bar-badge">
                <span class="bar-badge-dot"></span>
                Official Premium Invoice
            </span>
        </div>
        <div class="bar-right">
            <button type="button" class="btn-action btn-download" onclick="triggerPdfDownload()">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                </svg>
                <span>Download / Save PDF</span>
            </button>
            <button type="button" class="btn-action btn-print" onclick="window.print()">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m11.318-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.75A2.25 2.25 0 0015 1.5h-6a2.25 2.25 0 00-2.25 2.25v4.209"/>
                </svg>
                <span>Print</span>
            </button>
            <a href="{{ route('admin.dashboard') }}#invoices" class="btn-action btn-back">
                &larr; Back to Portal
            </a>
        </div>
    </header>

    <!-- Document Canvas Sheet -->
    <main class="sheet-container">
        <article class="invoice-sheet" id="invoiceSheetElement">

            <!-- Invoice Header -->
            <div class="invoice-header">
                <div class="agency-brand">
                    <div class="agency-logo-wrap">
                        @if(file_exists(public_path('images/logo-navy.png')))
                            <img src="{{ asset('images/logo-navy.png') }}" alt="Surebound Insurance" class="agency-logo">
                        @elseif(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="Surebound Insurance" class="agency-logo">
                        @else
                            <div style="font-size: 1.5rem; font-weight: 900; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                <span style="color: #059669;">🛡</span> Surebound
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="agency-name">Surebound Insurance Agency LLC</div>
                        <div class="agency-tagline">Licensed Commercial &amp; Personal Insurance Underwriters</div>
                        <div class="agency-contact" style="margin-top: 4px;">
                            1200 Fifth Avenue, Suite 2400 &bull; Seattle, WA 98101<br>
                            Phone: (206) 555-0142 &bull; Email: billing@surebound.com &bull; Web: www.surebound.com<br>
                            Washington State Commissioner License #WA-992418 &bull; NAIC CoCode #18492
                        </div>
                    </div>
                </div>

                <div class="invoice-meta-block">
                    <h1 class="invoice-title">INVOICE</h1>
                    <div class="invoice-number-tag">{{ $invoice->invoice_number }}</div>

                    <div class="invoice-dates-grid">
                        <div><span>Statement / Issue Date:</span> <strong>{{ $invoice->issue_date ? $invoice->issue_date->format('F d, Y') : date('F d, Y') }}</strong></div>
                        <div><span>Payment Due Date:</span> <strong>{{ $invoice->due_date ? $invoice->due_date->format('F d, Y') : date('F d, Y', strtotime('+30 days')) }}</strong></div>
                    </div>

                    @if($invoice->status === 'paid')
                        <span class="status-badge status-paid">
                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Paid in Full &bull; Verified
                        </span>
                    @elseif($invoice->status === 'overdue')
                        <span class="status-badge status-overdue">
                            &bull; OVERDUE STATEMENT
                        </span>
                    @else
                        <span class="status-badge status-pending">
                            &bull; Payment Due (Net 30)
                        </span>
                    @endif
                </div>
            </div>

            <!-- Billed To & Coverage Details Grid -->
            <div class="bill-info-grid">
                <div class="info-card">
                    <div class="info-col-title">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        <span>Billed To (Insured Policyholder):</span>
                    </div>
                    <div class="customer-name">{{ $invoice->customer_name }}</div>
                    <div class="customer-detail">
                        <strong>Email:</strong> {{ $invoice->customer_email }}
                    </div>
                    @if($invoice->customer_phone)
                    <div class="customer-detail">
                        <strong>Phone:</strong> {{ $invoice->customer_phone }}
                    </div>
                    @endif
                    @if($invoice->customer_address)
                    <div class="customer-detail" style="margin-top: 4px;">
                        <strong>Billing Address:</strong><br>
                        {{ $invoice->customer_address }}
                    </div>
                    @else
                    <div class="customer-detail" style="margin-top: 4px; color: #94a3b8;">
                        USA Billing Address on File
                    </div>
                    @endif
                </div>

                <div class="info-card">
                    <div class="info-col-title">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Coverage &amp; Policy Reference:</span>
                    </div>
                    <div class="policy-tag-box">
                        <span style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; font-weight: 600;">Policy Number:</span>
                        <span class="policy-tag-number">{{ $invoice->policy_number ?: 'DIRECT-ACCOUNT' }}</span>
                    </div>
                    <div class="customer-detail" style="margin-top: 8px;">
                        <strong>Invoice Account Ref:</strong> #USR-INV-{{ str_pad($invoice->id, 4, '0', STR_PAD_LEFT) }}<br>
                        <strong>Payment Terms:</strong> Net 30 Days &bull; <strong>Currency:</strong> United States Dollars ($ USD)
                    </div>
                    @if($invoice->status === 'paid')
                    <div class="customer-detail" style="color: #059669; font-weight: 700; margin-top: 6px; display: flex; align-items: center; gap: 4px;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Settled on {{ $invoice->paid_at ? $invoice->paid_at->format('M d, Y') : 'Record Verified' }} via {{ $invoice->payment_method ?: 'Electronic Gateway' }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Itemized Table -->
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 44px; text-align: center;">#</th>
                        <th>Coverage Description &amp; Itemized Specifications</th>
                        <th class="col-qty">Qty</th>
                        <th class="col-price">Unit Premium</th>
                        <th class="col-total">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $lineItems = $invoice->line_items;
                        if (is_string($lineItems)) {
                            $lineItems = json_decode($lineItems, true) ?: [];
                        }
                    @endphp

                    @if(!empty($lineItems) && count($lineItems) > 0)
                        @foreach($lineItems as $i => $item)
                        @php
                            $q = $item['qty'] ?? 1;
                            $p = (float)($item['price'] ?? 0);
                            $t = (float)($item['total'] ?? ($q * $p));
                        @endphp
                        <tr>
                            <td style="color: #94a3b8; font-weight: 700; text-align: center;">{{ $i + 1 }}</td>
                            <td>
                                <strong style="color: #0f172a; font-size: 0.9375rem;">{{ $item['desc'] ?? 'Insurance Premium & Coverage Policy' }}</strong>
                            </td>
                            <td class="col-qty">{{ $q }}</td>
                            <td class="col-price">${{ number_format($p, 2) }}</td>
                            <td class="col-total">${{ number_format($t, 2) }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td style="color: #94a3b8; font-weight: 700; text-align: center;">1</td>
                            <td>
                                <strong style="color: #0f172a; font-size: 0.9375rem;">Insurance Premium &amp; Policy Underwriting Coverage</strong>
                            </td>
                            <td class="col-qty">1</td>
                            <td class="col-price">${{ number_format($invoice->subtotal, 2) }}</td>
                            <td class="col-total">${{ number_format($invoice->subtotal, 2) }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <!-- Financial Calculation Card -->
            <div class="calc-breakdown">
                <div class="calc-card">
                    <div class="calc-row">
                        <span>Gross Subtotal:</span>
                        <span class="val">${{ number_format($invoice->subtotal, 2) }}</span>
                    </div>

                    @if($invoice->tax > 0)
                    <div class="calc-row">
                        <span>Surplus Tax &amp; State Fees:</span>
                        <span class="val">${{ number_format($invoice->tax, 2) }}</span>
                    </div>
                    @endif

                    @if($invoice->discount > 0)
                    <div class="calc-row">
                        <span>Multi-Policy Discount / Credit:</span>
                        <span class="val" style="color: #059669;">-${{ number_format($invoice->discount, 2) }}</span>
                    </div>
                    @endif

                    <div class="calc-total-row">
                        <span class="calc-total-label">Total Amount Due:</span>
                        <span class="calc-total-amount">${{ number_format($invoice->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Electronic Remittance & Payment Box -->
            <div class="remittance-box">
                <strong style="display: block; margin-bottom: 4px; font-size: 0.875rem; color: #065f46;">
                    🔒 Electronic Remittance &amp; Wire Payment Instructions:
                </strong>
                Payments may be remitted securely online via Credit Card (Visa/Mastercard/Amex) or ACH Direct Debit.
                For domestic FedWire or ACH electronic transfers, remit to:
                <div class="remittance-grid">
                    <div class="remit-item"><span>Bank:</span> <strong>JPMorgan Chase Bank, N.A.</strong></div>
                    <div class="remit-item"><span>Routing # (ABA):</span> <strong>021000021</strong></div>
                    <div class="remit-item"><span>Account #:</span> <strong>3892-019481</strong></div>
                    <div class="remit-item"><span>Swift Code:</span> <strong>CHASUS33</strong></div>
                </div>
                <div style="font-size: 0.75rem; margin-top: 6px; color: #047857;">
                    Please reference invoice number <strong>{{ $invoice->invoice_number }}</strong> on all remittance memos.
                </div>
            </div>

            @if($invoice->notes)
            <div class="notes-box">
                <div class="notes-title">Customer Terms &amp; Policy Notes:</div>
                <div class="notes-content">{{ $invoice->notes }}</div>
            </div>
            @endif

            <!-- Signatory & Official Agency Seal Section -->
            @php
                $activeSigImage = $invoice->signature_image ?: ($agencySig['signature_image'] ?? '');
                $signName = $invoice->signatory_name ?: ($agencySig['signatory_name'] ?? 'Md Rezawl');
                $signTitle = $invoice->signatory_title ?: ($agencySig['signatory_title'] ?? 'Chief Underwriter & Authorized Representative');
                $securityHash = strtoupper(substr(hash('sha256', $invoice->id.$invoice->invoice_number.$invoice->total_amount.'surebound2026'), 0, 16));
            @endphp
            <div class="signature-section">
                <div class="seal-wrap">
                    <!-- High-Resolution Vector Corporate Insurance Seal -->
                    <div class="seal-badge">
                        <svg viewBox="0 0 120 120" width="72" height="72">
                            <circle cx="60" cy="60" r="56" fill="#f8fafc" stroke="#1e3a8a" stroke-width="3" stroke-dasharray="3,2"/>
                            <circle cx="60" cy="60" r="48" fill="#ffffff" stroke="#059669" stroke-width="2"/>
                            <path id="sealTextPath" d="M 60,60 m -38,0 a 38,38 0 1,1 76,0 a 38,38 0 1,1 -76,0" fill="none"/>
                            <text font-size="7.5" font-family="'Inter', sans-serif" font-weight="800" fill="#1e3a8a" letter-spacing="1.5">
                                <textPath href="#sealTextPath" startOffset="50%" text-anchor="middle">
                                    SUREBOUND INSURANCE AGENCY LLC
                                </textPath>
                            </text>
                            <g transform="translate(60,60)">
                                <!-- Central Security Shield -->
                                <path d="M 0,-18 L 14,-10 L 14,4 C 14,14 0,22 0,22 C 0,22 -14,14 -14,4 L -14,-10 Z" fill="#059669"/>
                                <path d="M -5,-1 L -1,3 L 6,-5" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                        </svg>
                    </div>
                    <div class="seal-text">
                        <strong>Official Underwriting Certificate</strong><br>
                        Authorized by Surebound Insurance Agency LLC<br>
                        WA State Insurance Commissioner License #WA-992418
                        <div class="seal-security-code">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <span>SHA-256 Verified: {{ $securityHash }}</span>
                        </div>
                    </div>
                </div>

                <div class="sign-box">
                    <div class="sign-image-wrap">
                        @if(!empty($activeSigImage))
                            <img src="{{ $activeSigImage }}" alt="Authorized Signature" class="sign-image-render">
                        @else
                            <div class="sign-signature-fallback">{{ $signName }}</div>
                        @endif
                    </div>
                    <div class="sign-line"></div>
                    <div class="sign-name">{{ $signName }}</div>
                    <div class="sign-title">{{ $signTitle }}</div>
                </div>
            </div>

            <!-- Invoice Footer -->
            <footer class="invoice-footer">
                Thank you for choosing Surebound Insurance Agency LLC &bull; 1200 Fifth Avenue, Suite 2400, Seattle, WA 98101<br>
                For premium billing or endorsement inquiries, please call (206) 555-0142 or email billing@surebound.com.<br>
                Official Commercial Statement &bull; Page 1 of 1 &bull; Document Generated by Surebound Insurance Underwriting System
            </footer>

        </article>
    </main>

    <script>
        function triggerPdfDownload() {
            document.title = "Surebound-Invoice-{{ $invoice->invoice_number }}.pdf";
            window.print();
        }

        // Auto print/download trigger if ?download=1 or ?print=1
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('download') === '1' || urlParams.get('print') === '1') {
                setTimeout(() => {
                    triggerPdfDownload();
                }, 400);
            }
        });
    </script>
</body>
</html>
