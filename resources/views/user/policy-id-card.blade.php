<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Proof of Insurance - {{ $policy->policy_number }} - Surebound</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-navy: #09132e;
            --brand-navy-dark: #050b1d;
            --brand-navy-light: #162447;
            --brand-blue: #1d4ed8;
            --brand-blue-hover: #1e40af;
            --brand-light-blue: #3b82f6;
            --accent-cyan: #38bdf8;
            --emerald: #059669;
            --emerald-light: #ecfdf5;
            --emerald-border: #a7f3d0;
            --text-dark: #0f172a;
            --text-secondary: #334155;
            --text-muted: #64748b;
            --border-subtle: #e2e8f0;
            --card-border: #cbd5e1;
            --card-radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            background-image:
                radial-gradient(circle at 50% 0%, rgba(29, 78, 216, 0.08) 0%, transparent 60%),
                radial-gradient(circle at 100% 100%, rgba(14, 165, 233, 0.04) 0%, transparent 40%);
            color: var(--text-dark);
            padding: 32px 16px 48px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* SCREEN ACTIONS BAR */
        .actions-bar {
            width: 100%;
            max-width: 720px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.9375rem;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 8px;
            background: #ffffff;
            border: 1px solid var(--border-subtle);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            transition: all 0.2s ease;
        }

        .back-link:hover {
            color: var(--brand-blue);
            border-color: #bfdbfe;
            background: #eff6ff;
            transform: translateX(-2px);
        }

        .btn-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-secondary-btn {
            background: #ffffff;
            color: var(--text-dark);
            border: 1px solid var(--border-subtle);
            padding: 9px 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 0.875rem;
            text-decoration: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            transition: all 0.15s ease;
        }

        .action-secondary-btn:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: var(--brand-blue);
        }

        .print-btn {
            background: linear-gradient(135deg, var(--brand-blue) 0%, #1e40af 100%);
            color: #ffffff;
            border: 1px solid #1d4ed8;
            padding: 9px 18px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.875rem;
            box-shadow: 0 4px 12px -2px rgba(29, 78, 216, 0.35);
            transition: all 0.2s ease;
        }

        .print-btn:hover {
            background: linear-gradient(135deg, #1e40af 0%, #172554 100%);
            box-shadow: 0 6px 16px -2px rgba(29, 78, 216, 0.45);
            transform: translateY(-1px);
        }

        .kbd-shortcut {
            background: rgba(255, 255, 255, 0.22);
            border: 1px solid rgba(255, 255, 255, 0.35);
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 600;
            color: #ffffff;
        }

        /* MAIN DIGITAL CARD (SCREEN) */
        .id-card-wrapper {
            width: 100%;
            max-width: 720px;
            background: #ffffff;
            border-radius: var(--card-radius);
            box-shadow:
                0 20px 35px -10px rgba(9, 19, 46, 0.12),
                0 1px 3px rgba(0, 0, 0, 0.04),
                inset 0 0 0 1px rgba(255, 255, 255, 0.8);
            border: 1px solid #cbd5e1;
            overflow: hidden;
            position: relative;
        }

        /* HEADER */
        .id-card-header {
            background: linear-gradient(135deg, #09132e 0%, #0f204b 55%, #1e3a8a 100%);
            color: #ffffff;
            padding: 24px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #3b82f6;
            position: relative;
            overflow: hidden;
        }

        .id-card-header::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 280px;
            background: radial-gradient(circle at 100% 50%, rgba(59, 130, 246, 0.2) 0%, transparent 70%);
            pointer-events: none;
        }

        .brand-block {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
            position: relative;
            z-index: 1;
        }

        .screen-main-logo {
            height: 36px;
            max-width: 180px;
            width: auto;
            object-fit: contain;
            display: block;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.25));
        }

        .brand-subtitle {
            font-size: 0.725rem;
            color: #93c5fd;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 600;
        }

        .header-meta {
            text-align: right;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 6px;
            position: relative;
            z-index: 1;
        }

        .naic-pill {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 0.725rem;
            font-weight: 600;
            color: #f1f5f9;
            text-align: right;
            font-family: 'JetBrains Mono', monospace;
            line-height: 1.35;
        }

        .naic-pill span {
            color: #93c5fd;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .active-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(52, 211, 153, 0.5);
            color: #6ee7b7;
            padding: 3px 10px;
            border-radius: 9999px;
            font-size: 0.6875rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 6px #10b981;
        }

        /* CARD BODY */
        .id-card-body {
            padding: 28px 30px;
            position: relative;
            background: #ffffff;
        }

        /* Watermark Background */
        .card-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 260px;
            height: 260px;
            opacity: 0.035;
            pointer-events: none;
            z-index: 0;
        }

        .card-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 22px;
            padding-bottom: 18px;
            border-bottom: 1px solid #f1f5f9;
            position: relative;
            z-index: 1;
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
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.85px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .field-value {
            font-size: 1.0625rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.2px;
            line-height: 1.35;
        }

        .field-value.mono {
            font-family: 'JetBrains Mono', monospace;
            color: var(--brand-blue);
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .copy-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 2px 4px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            transition: all 0.15s;
        }

        .copy-btn:hover {
            color: var(--brand-blue);
            background: #eff6ff;
        }

        .field-subtext {
            font-size: 0.8125rem;
            color: var(--text-muted);
            line-height: 1.4;
        }

        .field-highlight {
            color: #1e3a8a;
            font-weight: 800;
        }

        .date-active {
            color: #047857;
            font-weight: 700;
        }

        /* CARD FOOTER */
        .id-card-footer {
            background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
            border-top: 1px solid var(--border-subtle);
            padding: 20px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hotline-group {
            display: flex;
            gap: 28px;
            flex-wrap: wrap;
        }

        .hotline-item {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .hotline-label {
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.75px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .hotline-num {
            font-weight: 700;
            color: #0f172a;
            font-size: 0.9375rem;
            font-family: 'JetBrains Mono', monospace;
            text-decoration: none;
        }

        .hotline-num:hover {
            color: var(--brand-blue);
        }

        /* QR CODE BOX */
        .qr-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .qr-box {
            width: 64px;
            height: 64px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3px;
            position: relative;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .qr-box:hover {
            transform: scale(1.08);
            border-color: #3b82f6;
            box-shadow: 0 6px 14px rgba(29, 78, 216, 0.2);
        }

        .qr-link {
            display: block;
            width: 100%;
            height: 100%;
            line-height: 0;
            text-decoration: none;
        }

        .qr-link svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .qr-caption {
            font-size: 0.625rem;
            font-weight: 700;
            color: var(--brand-blue);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* LEGAL NOTICE BELOW CARD (SCREEN) */
        .legal-notice {
            max-width: 720px;
            margin-top: 20px;
            font-size: 0.75rem;
            color: #64748b;
            text-align: center;
            line-height: 1.55;
            padding: 0 16px;
        }

        .legal-notice strong {
            color: #334155;
        }

        /* TOAST NOTIFICATION */
        .toast-msg {
            position: fixed;
            bottom: 24px;
            background: #09132e;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            display: flex;
            align-items: center;
            gap: 8px;
            opacity: 0;
            transform: translateY(12px);
            transition: all 0.25s ease;
            pointer-events: none;
            z-index: 100;
        }

        .toast-msg.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* ==============================================================
           OFFICIAL PRINTABLE SHEET (HIDDEN ON SCREEN, SHOWN ON PRINT)
           ============================================================== */
        .print-document {
            display: none;
        }

        @media (max-width: 640px) {
            body {
                padding: 16px 12px 32px;
            }
            .actions-bar {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }
            .btn-group {
                width: 100%;
                justify-content: stretch;
            }
            .back-link, .action-secondary-btn, .print-btn {
                flex: 1;
                justify-content: center;
                text-align: center;
            }
            .id-card-header {
                padding: 20px 18px;
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            .header-meta {
                align-items: flex-start;
                text-align: left;
                width: 100%;
            }
            .naic-pill {
                text-align: left;
                align-self: flex-start;
            }
            .id-card-body {
                padding: 20px 18px;
            }
            .card-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .id-card-footer {
                padding: 18px;
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            .hotline-group {
                gap: 16px;
                width: 100%;
            }
            .qr-section {
                align-self: flex-end;
            }
        }

        /* ==============================================================
           EXECUTIVE HIGH-RESOLUTION PRINT STYLING (@media print)
           ============================================================== */
        @page {
            size: letter portrait;
            margin: 10mm 12mm 10mm 12mm;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }

            html, body {
                height: 100% !important;
                min-height: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                background: #ffffff !important;
                background-image: none !important;
                color: #000000 !important;
                display: block !important;
            }

            /* Hide all interactive screen-only elements */
            .actions-bar,
            .toast-msg,
            .id-card-wrapper,
            .legal-notice,
            .copy-btn {
                display: none !important;
            }

            /* Show official Texas Printable Certificate Sheet - FULL PAGE HEIGHT */
            .print-document {
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 auto !important;
                min-height: 242mm !important;
                height: 242mm !important;
                max-height: 246mm !important;
                box-sizing: border-box !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
                font-size: 8.5pt;
                line-height: 1.35;
                color: #0f172a;
            }

            /* PRINT LETTERHEAD - MAIN LOGO AT TOP CORNER */
            .print-letterhead {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-bottom: 10px;
                border-bottom: 2px solid #09132e;
                margin-bottom: 0;
            }

            .print-brand {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .print-main-logo {
                height: 44px;
                max-width: 190px;
                width: auto;
                object-fit: contain;
                display: block;
            }

            .print-brand-divider {
                width: 1.5px;
                height: 38px;
                background: #cbd5e1;
            }

            .print-brand-title {
                font-size: 13pt;
                font-weight: 800;
                color: #09132e;
                letter-spacing: 0.5px;
                line-height: 1.15;
            }

            .print-brand-sub {
                font-size: 7pt;
                font-weight: 700;
                color: #475569;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                margin-top: 2px;
            }

            .print-doc-meta {
                text-align: right;
                font-size: 7.5pt;
                color: #334155;
                line-height: 1.35;
            }

            .print-doc-meta strong {
                font-size: 9pt;
                color: #09132e;
                letter-spacing: 0.3px;
            }

            /* INSTRUCTIONS CALLOUT */
            .print-instructions {
                background: #f8fafc;
                border: 1px solid #cbd5e1;
                border-left: 4px solid #1d4ed8;
                border-radius: 4px;
                padding: 8px 12px;
                font-size: 7.5pt;
                line-height: 1.35;
                color: #334155;
            }

            .print-instructions strong {
                color: #0f172a;
            }

            /* CUT-OUT SECTION WITH SCISSORS GUIDE (TOP & BOTTOM) */
            .cutout-guide-header,
            .cutout-guide-footer {
                display: flex;
                align-items: center;
                gap: 10px;
                color: #64748b;
                font-size: 7pt;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.8px;
            }

            .cutout-guide-line {
                flex: 1;
                border-top: 1.5px dashed #94a3b8;
            }

            .cutout-scissors {
                display: inline-flex;
                align-items: center;
                gap: 4px;
            }

            /* SINGLE OFFICIAL CARD CONTAINER */
            .single-card-container {
                max-width: 550px;
                width: 100%;
                margin: 0 auto;
                page-break-inside: avoid;
                break-inside: avoid;
            }

            /* OFFICIAL WALLET CARD SPECIFICATIONS */
            .wallet-card {
                border: 2px solid #09132e;
                border-radius: 8px;
                overflow: hidden;
                background: #ffffff;
                page-break-inside: avoid;
                break-inside: avoid;
                display: flex;
                flex-direction: column;
                box-sizing: border-box;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            }

            .wallet-header {
                background: #09132e !important;
                color: #ffffff !important;
                padding: 10px 14px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 2px solid #1d4ed8;
            }

            .wallet-brand-logo {
                height: 20px;
                max-width: 110px;
                width: auto;
                object-fit: contain;
                display: block;
            }

            .wallet-header-title {
                font-size: 10pt;
                font-weight: 800;
                letter-spacing: 0.4px;
                line-height: 1.15;
            }

            .wallet-header-sub {
                font-size: 5.5pt;
                color: #93c5fd !important;
                text-transform: uppercase;
                letter-spacing: 0.6px;
            }

            .wallet-header-tag {
                font-size: 5.5pt;
                font-weight: 700;
                text-align: right;
                font-family: 'JetBrains Mono', monospace;
                color: #f1f5f9 !important;
                line-height: 1.25;
            }

            .wallet-body {
                padding: 10px 14px;
                flex: 1;
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .wallet-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 6px 14px;
            }

            .w-field {
                display: flex;
                flex-direction: column;
            }

            .w-label {
                font-size: 5.5pt;
                font-weight: 700;
                text-transform: uppercase;
                color: #475569;
                letter-spacing: 0.4px;
            }

            .w-val {
                font-size: 7.5pt;
                font-weight: 700;
                color: #0f172a;
                line-height: 1.25;
            }

            .w-val.mono {
                font-family: 'JetBrains Mono', monospace;
                font-size: 8.5pt;
                color: #1d4ed8;
            }

            .w-val-accent {
                color: #047857;
                font-weight: 700;
            }

            .wallet-footer {
                background: #f8fafc !important;
                border-top: 1px solid #cbd5e1;
                padding: 7px 14px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
            }

            .w-hotlines {
                font-size: 6pt;
                color: #334155;
                line-height: 1.35;
            }

            .w-hotlines strong {
                color: #09132e;
                font-family: 'JetBrains Mono', monospace;
                font-size: 7pt;
            }

            .w-qr-box {
                width: 48px;
                height: 48px;
                background: #ffffff !important;
                border: 1px solid #000000;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2px;
                flex-shrink: 0;
            }

            .w-qr-box svg {
                width: 100% !important;
                height: 100% !important;
                display: block !important;
            }

            .wallet-copy-tag {
                font-size: 5.5pt;
                font-weight: 700;
                color: #64748b;
                text-transform: uppercase;
                text-align: center;
                background: #f1f5f9;
                padding: 3px 6px;
                border-top: 1px dashed #cbd5e1;
            }

            /* LOWER HALF: ACCIDENT CHECKLIST & STATUTORY COMPLIANCE */
            .print-lower-section {
                border-top: 1.5px solid #09132e;
                padding-top: 10px;
                display: grid;
                grid-template-columns: 1.2fr 1fr;
                gap: 14px;
                font-size: 7pt;
                color: #334155;
                page-break-inside: avoid;
            }

            .print-box-title {
                font-size: 8pt;
                font-weight: 800;
                color: #09132e;
                margin-bottom: 5px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .accident-steps {
                list-style: none;
                counter-reset: accident-counter;
                display: flex;
                flex-direction: column;
                gap: 3px;
            }

            .accident-steps li {
                counter-increment: accident-counter;
                display: flex;
                align-items: flex-start;
                gap: 6px;
                line-height: 1.3;
            }

            .accident-steps li::before {
                content: counter(accident-counter);
                background: #09132e;
                color: #ffffff;
                width: 13px;
                height: 13px;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 6.5pt;
                font-weight: 700;
                flex-shrink: 0;
                margin-top: 1px;
            }

            .statute-print-box {
                background: #f8fafc;
                border: 1px solid #cbd5e1;
                border-radius: 4px;
                padding: 7px 9px;
                line-height: 1.35;
                font-size: 6.8pt;
            }

            .statute-print-box strong {
                color: #0f172a;
            }

            /* NATIONWIDE ASSISTANCE & VERIFICATION BAR */
            .print-assistance-bar {
                background: #f8fafc;
                border: 1px solid #cbd5e1;
                border-radius: 6px;
                padding: 6px 14px;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
                text-align: center;
                page-break-inside: avoid;
            }

            .assist-item {
                display: flex;
                flex-direction: column;
                gap: 1px;
            }

            .assist-title {
                font-size: 5.5pt;
                font-weight: 700;
                text-transform: uppercase;
                color: #64748b;
                letter-spacing: 0.4px;
            }

            .assist-val {
                font-size: 7.5pt;
                font-weight: 800;
                color: #09132e;
                font-family: 'JetBrains Mono', monospace;
            }

            .assist-desc {
                font-size: 5.5pt;
                color: #475569;
            }

            .print-footer-notice {
                text-align: center;
                font-size: 6.5pt;
                color: #64748b;
                border-top: 1px solid #e2e8f0;
                padding-top: 6px;
                line-height: 1.3;
            }
        }
    </style>
</head>
<body>

    @php
        $verificationUrl = route('policy.verify', $policy->policy_number);
        $qrSvg = \App\Services\QrCodeService::svg($verificationUrl, 64, '#09132e', 2);
    @endphp

    <!-- ==========================================
         SCREEN ACTIONS BAR
         ========================================== -->
    <div class="actions-bar">
        <a href="{{ route('user.policies') }}" class="back-link">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to My Policies
        </a>
        <div class="btn-group">
            <a href="{{ $verificationUrl }}" target="_blank" class="action-secondary-btn" title="View Public Online Verification Page">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Verify Online
            </a>
            <button onclick="window.print()" class="print-btn" title="Print Wallet ID Card or Save as Official PDF">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Print / Save Digital Card
                <span class="kbd-shortcut">⌘P</span>
            </button>
        </div>
    </div>

    <!-- ==========================================
         OFFICIAL DIGITAL INSURANCE CARD (SCREEN)
         ========================================== -->
    <div class="id-card-wrapper">
        <div class="id-card-header">
            <div class="brand-block">
                <img src="{{ asset('images/logo-white.png') }}" alt="Surebound" class="screen-main-logo">
                <div class="brand-subtitle">Official Insurance Card &bull; State of Texas</div>
            </div>
            <div class="header-meta">
                <div class="naic-pill">
                    NAIC #24819<br>
                    <span>{{ strtoupper($policy->carrier ?: 'Surebound Syndicate') }}</span>
                </div>
                <div class="active-status-pill">
                    <span class="status-dot"></span>
                    {{ strtoupper($policy->status ?: 'Active') }} &bull; In Force
                </div>
            </div>
        </div>

        <div class="id-card-body">
            <!-- Subtle Security Seal Watermark -->
            <svg class="card-watermark" viewBox="0 0 200 200" fill="currentColor">
                <path d="M100 10 L180 40 L180 100 C180 150 140 185 100 195 C60 185 20 150 20 100 L20 40 Z" fill="none" stroke="#09132e" stroke-width="6"/>
                <polygon points="100,45 115,80 152,82 122,104 133,140 100,118 67,140 78,104 48,82 85,80" fill="#09132e"/>
            </svg>

            <div class="card-row">
                <div class="field-group">
                    <span class="field-label">Policy Number</span>
                    <span class="field-value mono">
                        {{ $policy->policy_number }}
                        <button type="button" class="copy-btn" onclick="copyPolicy('{{ $policy->policy_number }}')" title="Copy Policy Number">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        </button>
                    </span>
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
                    <span class="field-value field-highlight">{{ $policy->coverage_limit }}</span>
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
                    <span class="field-value date-active" style="font-size: 0.9375rem;">{{ $policy->renewal_date ? \Carbon\Carbon::parse($policy->renewal_date)->format('M d, Y') : 'Continuous' }}</span>
                </div>
            </div>
        </div>

        <div class="id-card-footer">
            <div class="hotline-group">
                <div class="hotline-item">
                    <span class="hotline-label">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        24/7 Roadside &amp; Emergency:
                    </span>
                    <a href="tel:18005550199" class="hotline-num">1-800-555-0199</a>
                </div>
                <div class="hotline-item">
                    <span class="hotline-label">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        Claims First Notice (FNOL):
                    </span>
                    <a href="tel:18005552524" class="hotline-num">1-800-555-CLAIM</a>
                </div>
            </div>

            <div class="qr-section">
                <div class="qr-box" title="Scan with Phone Camera to Verify Official Policy #{{ $policy->policy_number }}">
                    <a href="{{ $verificationUrl }}" target="_blank" rel="noopener noreferrer" class="qr-link" title="Click or Scan to Verify Coverage Online">
                        {!! $qrSvg !!}
                    </a>
                </div>
                <span class="qr-caption">Scan to Verify</span>
            </div>
        </div>
    </div>

    <!-- LEGAL NOTICE (SCREEN) -->
    <div class="legal-notice">
        This document serves as official digital evidence of continuous insurance coverage underwritten by Surebound Syndicate. Keep this card in your vehicle or on your mobile device as proof of financial responsibility required by Texas Transportation Code &sect; 601.051.
    </div>

    <!-- ==============================================================
         OFFICIAL HIGH-RESOLUTION PRINT DOCUMENT (PRINT ONLY)
         Contains Official Texas Letterhead + Two Cutout Wallet Cards (Vehicle & Driver)
         ============================================================== -->
    <div class="print-document">
        <!-- PRINT LETTERHEAD -->
        <div class="print-letterhead">
            <div class="print-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Surebound Insurance" class="print-main-logo">
                <div class="print-brand-divider"></div>
                <div class="print-brand-text">
                    <div class="print-brand-title">MUTUAL UNDERWRITING</div>
                    <div class="print-brand-sub">Texas Motor Vehicle Financial Responsibility Identification Card</div>
                </div>
            </div>
            <div class="print-doc-meta">
                <strong>OFFICIAL EVIDENCE OF COVERAGE</strong><br>
                Issued Date: {{ now()->format('M d, Y') }}<br>
                Underwriter: {{ strtoupper($policy->carrier ?: 'Surebound Syndicate') }} &bull; NAIC #24819
            </div>
        </div>

        <!-- INSTRUCTIONS BANNER -->
        <div class="print-instructions">
            <strong>IMPORTANT TEXAS DRIVER NOTICE:</strong> Texas law (Texas Transportation Code &sect; 601.051) requires financial responsibility to be maintained on all operating motor vehicles. Keep this official insurance identification card in your vehicle's glovebox or driver wallet. Law enforcement and vehicle inspection stations accept both printed and digital representations of this card.
        </div>

        <!-- CUT-OUT GUIDE LINE TOP -->
        <div class="cutout-guide-header">
            <span class="cutout-scissors">&#9986; Fold or Cut Along Dashed Lines to Carry in Vehicle or Wallet</span>
            <span class="cutout-guide-line"></span>
            <span>Official Texas Proof of Insurance</span>
        </div>

        <!-- SINGLE OFFICIAL CARD -->
        <div class="single-card-container">
            <div class="wallet-card">
                <div class="wallet-header">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="{{ asset('images/logo-white.png') }}" alt="Surebound" class="wallet-brand-logo">
                        <div>
                            <div class="wallet-header-title">MUTUAL UNDERWRITING</div>
                            <div class="wallet-header-sub">Official Proof of Insurance &bull; State of Texas</div>
                        </div>
                    </div>
                    <div class="wallet-header-tag">
                        NAIC #24819<br>
                        ACTIVE &bull; IN FORCE
                    </div>
                </div>
                <div class="wallet-body">
                    <div class="wallet-grid">
                        <div class="w-field">
                            <span class="w-label">Policy Number</span>
                            <span class="w-val mono">{{ $policy->policy_number }}</span>
                        </div>
                        <div class="w-field">
                            <span class="w-label">Named Insured (Policyholder)</span>
                            <span class="w-val">{{ $policy->holder_name }}</span>
                        </div>
                        <div class="w-field">
                            <span class="w-label">Coverage Terms &amp; Limits</span>
                            <span class="w-val">{{ $policy->coverage_limit }}</span>
                        </div>
                        <div class="w-field">
                            <span class="w-label">Deductible Terms</span>
                            <span class="w-val">{{ $policy->deductible ?: '$1,000 standard' }}</span>
                        </div>
                        <div class="w-field">
                            <span class="w-label">Effective Date</span>
                            <span class="w-val">{{ $policy->effective_date ? \Carbon\Carbon::parse($policy->effective_date)->format('m/d/Y') : 'Active' }}</span>
                        </div>
                        <div class="w-field">
                            <span class="w-label">Expiration / Renewal Date</span>
                            <span class="w-val w-val-accent">{{ $policy->renewal_date ? \Carbon\Carbon::parse($policy->renewal_date)->format('m/d/Y') : 'Continuous' }}</span>
                        </div>
                    </div>
                    <div class="w-field" style="margin-top: 2px;">
                        <span class="w-label">Insured Vehicle / Asset Schedule</span>
                        <span class="w-val">{{ $policy->insured_item ?: 'Listed Insured Schedule on File' }}</span>
                    </div>
                </div>
                <div class="wallet-footer">
                    <div class="w-hotlines">
                        24/7 Roadside Assistance: <strong>1-800-555-0199</strong><br>
                        Claims Notice (FNOL): <strong>1-800-555-CLAIM</strong>
                    </div>
                    <div class="w-qr-box" title="Verification QR Code">
                        {!! $qrSvg !!}
                    </div>
                </div>
                <div class="wallet-copy-tag">
                    Official Evidence of Financial Responsibility &bull; Texas Department of Insurance
                </div>
            </div>
        </div>

        <!-- CUT-OUT GUIDE LINE BOTTOM -->
        <div class="cutout-guide-footer">
            <span class="cutout-scissors">&#9986; Cut Line</span>
            <span class="cutout-guide-line"></span>
            <span>Texas Transportation Code &sect; 601.051 Compliant</span>
        </div>

        <!-- LOWER SECTION: ACCIDENT PROTOCOL & TEXAS STATUTORY NOTICE -->
        <div class="print-lower-section">
            <div>
                <div class="print-box-title">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    What To Do In Case of an Accident or Claim
                </div>
                <ul class="accident-steps">
                    <li><strong>Safety First:</strong> Check for injuries. If anyone is injured or road is blocked, immediately call 911.</li>
                    <li><strong>Exchange Information:</strong> Collect other driver's name, phone, address, vehicle plate number, insurer name, and policy number.</li>
                    <li><strong>Document the Scene:</strong> Take photos of vehicle damage, road position, signs, and exchange contact with any witnesses.</li>
                    <li><strong>Notify Surebound FNOL Claims:</strong> Call <strong>1-800-555-CLAIM</strong> or report online at <strong>surebound.com/claims</strong>.</li>
                </ul>
            </div>
            <div>
                <div class="print-box-title">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Texas Statutory Financial Responsibility Notice
                </div>
                <div class="statute-print-box">
                    This identification card certifies continuous motor vehicle liability insurance coverage meeting or exceeding the minimum limits prescribed by Texas Transportation Code &sect; 601.072. Underwriting carrier is registered with the Texas Department of Insurance. Electronic policy status verified via digital QR code scanner.
                </div>
            </div>
        </div>

        <!-- NATIONWIDE ASSISTANCE & VERIFICATION BAR -->
        <div class="print-assistance-bar">
            <div class="assist-item">
                <span class="assist-title">24/7 Roadside Assistance</span>
                <span class="assist-val">1-800-555-0199</span>
                <span class="assist-desc">Towing &bull; Lockout &bull; Jumpstart</span>
            </div>
            <div class="assist-item">
                <span class="assist-title">Claims Notice (FNOL)</span>
                <span class="assist-val">1-800-555-CLAIM</span>
                <span class="assist-desc">24/7 Dispatch &bull; surebound.com</span>
            </div>
            <div class="assist-item">
                <span class="assist-title">Instant QR Verification</span>
                <span class="assist-val">Digital Policy Record</span>
                <span class="assist-desc">Official TDI Active Status</span>
            </div>
        </div>

        <div class="print-footer-notice">
            Surebound Syndicate &bull; 100 Congress Avenue, Suite 2000, Austin, TX 78701 &bull; 24/7 Roadside Assistance: 1-800-555-0199 &bull; Verification URL: {{ $verificationUrl }}
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div id="toast" class="toast-msg">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
        <span id="toast-text">Copied to clipboard</span>
    </div>

    <script>
        function copyPolicy(text) {
            navigator.clipboard.writeText(text).then(() => {
                showToast('Policy #' + text + ' copied to clipboard');
            }).catch(() => {
                showToast('Copied: ' + text);
            });
        }

        function showToast(text) {
            const toast = document.getElementById('toast');
            const toastText = document.getElementById('toast-text');
            toastText.textContent = text;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }

        // Support keyboard shortcut for printing (Cmd+P or Ctrl+P)
        document.addEventListener('keydown', function(e) {
            if ((e.metaKey || e.ctrlKey) && e.key === 'p') {
                // native print is fine, button provides visual cue
            }
        });
    </script>
</body>
</html>
