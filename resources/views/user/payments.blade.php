@extends('layouts.user')

@section('content')
<div class="payments-page-wrapper">

    <!-- TOP HEADER -->
    <div class="section-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
        <div>
            <h1 class="section-title" style="font-size: 1.75rem; font-weight: 800; color: var(--brand-navy); margin-bottom: 4px;">Premium Billing &amp; Payment Gateway</h1>
            <p class="section-subtitle" style="font-size: 0.9375rem; color: var(--text-muted);">
                Review itemized insurance premium invoices, schedule automated electronic payments, and download certified tax receipts.
            </p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            @if($totalDue > 0 && $nextDueInvoice)
                <button type="button" onclick="openPayInvoiceModal({{ $nextDueInvoice->id }}, '{{ $nextDueInvoice->invoice_number }}', '{{ $nextDueInvoice->policy_number }}', '{{ number_format($nextDueInvoice->total_amount, 2) }}')" class="btn-primary-action" style="display: inline-flex; align-items: center; gap: 8px; background: #059669; color: #fff; padding: 10px 20px; border-radius: var(--radius-sm); font-weight: 700; font-size: 0.875rem; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25); border: none; cursor: pointer; transition: all 0.2s;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span>Pay Due Balance (${{ number_format($totalDue, 2) }})</span>
                </button>
            @endif
            <a href="{{ route('user.documents') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: var(--shadow-sm); text-decoration: none; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Billing Statements Archive</span>
            </a>
        </div>
    </div>

    <!-- METRICS / KPI CARDS -->
    <div class="metrics-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; margin-bottom: 28px;">
        
        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Total Invoiced</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; color: var(--brand-blue); display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); line-height: 1.2;">
                ${{ number_format($totalInvoiced, 2) }}
            </div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                All-time policy premium billings
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Settled / Paid YTD</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #059669; line-height: 1.2;">
                ${{ number_format($totalPaid, 2) }}
            </div>
            <div style="font-size: 0.8125rem; color: #059669; font-weight: 500; margin-top: 4px;">
                {{ $invoices->where('status', 'paid')->count() }} cleared premium transactions
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Outstanding Balance</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: {{ $totalDue > 0 ? '#fffbeb' : '#f8fafc' }}; color: {{ $totalDue > 0 ? '#d97706' : '#64748b' }}; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: {{ $totalDue > 0 ? '#d97706' : '#059669' }}; line-height: 1.2;">
                ${{ number_format($totalDue, 2) }}
            </div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                {{ $invoices->whereIn('status', ['pending', 'overdue'])->count() }} open statement(s)
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Next Payment Due</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; color: var(--brand-blue); display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.375rem; font-weight: 800; color: var(--brand-navy); line-height: 1.2;">
                @if($nextDueInvoice)
                    {{ \Carbon\Carbon::parse($nextDueInvoice->due_date)->format('M d, Y') }}
                @else
                    All Paid Up
                @endif
            </div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                @if($nextDueInvoice)
                    Policy #{{ $nextDueInvoice->policy_number }}
                @else
                    Zero pending liabilities
                @endif
            </div>
        </div>

    </div>

    <!-- FILTER BAR & SEARCH -->
    <div class="filter-search-container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; background: #ffffff; padding: 14px 20px; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); margin-bottom: 24px;">
        
        <!-- Filter Pills -->
        <div class="filter-pills" style="display: flex; gap: 8px; flex-wrap: wrap;">
            <button type="button" class="pay-filter-btn active" data-filter="all" onclick="filterInvoices('all')" style="padding: 7px 15px; border-radius: 20px; font-size: 0.8125rem; font-weight: 600; border: 1px solid var(--brand-blue); background: var(--brand-blue); color: #ffffff; cursor: pointer; transition: all 0.2s;">
                All Statements ({{ $invoices->count() }})
            </button>
            <button type="button" class="pay-filter-btn" data-filter="pending" onclick="filterInvoices('pending')" style="padding: 7px 15px; border-radius: 20px; font-size: 0.8125rem; font-weight: 600; border: 1px solid var(--border-light); background: #ffffff; color: var(--text-muted); cursor: pointer; transition: all 0.2s;">
                Due / Pending ({{ $invoices->where('status', 'pending')->count() }})
            </button>
            <button type="button" class="pay-filter-btn" data-filter="paid" onclick="filterInvoices('paid')" style="padding: 7px 15px; border-radius: 20px; font-size: 0.8125rem; font-weight: 600; border: 1px solid var(--border-light); background: #ffffff; color: var(--text-muted); cursor: pointer; transition: all 0.2s;">
                Paid &amp; Settled ({{ $invoices->where('status', 'paid')->count() }})
            </button>
            <button type="button" class="pay-filter-btn" data-filter="overdue" onclick="filterInvoices('overdue')" style="padding: 7px 15px; border-radius: 20px; font-size: 0.8125rem; font-weight: 600; border: 1px solid var(--border-light); background: #ffffff; color: var(--text-muted); cursor: pointer; transition: all 0.2s;">
                Overdue ({{ $invoices->where('status', 'overdue')->count() }})
            </button>
        </div>

        <!-- Search Input -->
        <div style="position: relative; min-width: 260px;">
            <input type="text" id="paySearchInput" onkeyup="searchInvoices()" placeholder="Search invoice #, policy, amount..." style="width: 100%; padding: 8px 14px 8px 36px; font-size: 0.875rem; border: 1px solid var(--border-light); border-radius: var(--radius-sm); outline: none; transition: border-color 0.2s;">
            <svg style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--text-muted);" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>

    </div>

    <!-- INVOICE LIST / CARDS -->
    <div class="invoices-list" id="invoicesContainer" style="display: flex; flex-direction: column; gap: 16px;">
        @forelse($invoices as $inv)
            <div class="invoice-card" data-status="{{ $inv->status }}" style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: 22px; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 20px; transition: all 0.2s;">
                
                <!-- Left: Details -->
                <div style="display: flex; align-items: flex-start; gap: 16px; min-width: 300px; flex: 1;">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: {{ $inv->status === 'paid' ? '#ecfdf5' : ($inv->status === 'overdue' ? '#fef2f2' : '#fffbeb') }}; color: {{ $inv->status === 'paid' ? '#059669' : ($inv->status === 'overdue' ? '#dc2626' : '#d97706') }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"/></svg>
                    </div>

                    <div>
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                            <span style="font-family: 'JetBrains Mono', monospace; font-size: 1.0625rem; font-weight: 800; color: var(--brand-navy);">
                                {{ $inv->invoice_number }}
                            </span>
                            @if($inv->status === 'paid')
                                <span style="background: #ecfdf5; color: #059669; font-size: 0.6875rem; font-weight: 700; padding: 3px 9px; border-radius: 20px; border: 1px solid rgba(5, 150, 105, 0.2); text-transform: uppercase;">
                                    Cleared &bull; {{ $inv->paid_at ? \Carbon\Carbon::parse($inv->paid_at)->format('M d, Y') : 'Paid' }}
                                </span>
                            @elseif($inv->status === 'overdue')
                                <span style="background: #fef2f2; color: #dc2626; font-size: 0.6875rem; font-weight: 700; padding: 3px 9px; border-radius: 20px; border: 1px solid rgba(220, 38, 38, 0.2); text-transform: uppercase;">
                                    Overdue
                                </span>
                            @else
                                <span style="background: #fffbeb; color: #d97706; font-size: 0.6875rem; font-weight: 700; padding: 3px 9px; border-radius: 20px; border: 1px solid rgba(217, 119, 6, 0.2); text-transform: uppercase;">
                                    Payment Due
                                </span>
                            @endif
                        </div>

                        <div style="font-size: 0.875rem; color: var(--text-main); font-weight: 600; margin-bottom: 6px;">
                            Policy Ref: <a href="{{ route('user.policies') }}" style="color: var(--brand-blue); text-decoration: none; font-family: monospace;">{{ $inv->policy_number }}</a>
                        </div>

                        <div style="display: flex; gap: 16px; font-size: 0.75rem; color: var(--text-muted); flex-wrap: wrap;">
                            <span>Issued: {{ \Carbon\Carbon::parse($inv->issue_date)->format('M d, Y') }}</span>
                            <span>&bull;</span>
                            <span style="font-weight: 600; color: {{ $inv->status !== 'paid' ? '#d97706' : 'inherit' }};">
                                Due Date: {{ \Carbon\Carbon::parse($inv->due_date)->format('M d, Y') }}
                            </span>
                            @if($inv->payment_transaction_id)
                                <span>&bull;</span>
                                <span>TXN: <span style="font-family: monospace;">{{ $inv->payment_transaction_id }}</span></span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right: Financial amount & Action Buttons -->
                <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap; justify-content: flex-end;">
                    
                    <div style="text-align: right; min-width: 140px;">
                        <div style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Premium Amount</div>
                        <div style="font-size: 1.5rem; font-weight: 800; color: var(--brand-navy); line-height: 1.2;">
                            ${{ number_format($inv->total_amount, 2) }}
                        </div>
                        <div style="font-size: 0.6875rem; color: var(--text-muted);">
                            {{ $inv->payment_method ?: 'Electronic ACH / Card' }}
                        </div>
                    </div>

                    <div style="display: flex; gap: 8px;">
                        @if($inv->status !== 'paid')
                            <button type="button" onclick="openPayInvoiceModal({{ $inv->id }}, '{{ $inv->invoice_number }}', '{{ $inv->policy_number }}', '{{ number_format($inv->total_amount, 2) }}')" style="background: #059669; color: #ffffff; border: none; padding: 10px 18px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(5, 150, 105, 0.25); transition: all 0.2s;">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <span>Pay Premium Now</span>
                            </button>
                        @else
                            <a href="{{ route('admin.invoices.pdf', $inv->id) }}" target="_blank" style="background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 9px 15px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span>Receipt PDF</span>
                            </a>
                        @endif

                        <a href="{{ route('admin.invoices.print', $inv->id) }}" target="_blank" style="background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 9px 12px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        </a>
                    </div>

                </div>

            </div>
        @empty
            <div style="background: #ffffff; border-radius: var(--radius-md); padding: 48px; text-align: center; border: 1px solid var(--border-light);">
                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--text-muted); margin: 0 auto 16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">No Billing Records Found</h3>
                <p style="font-size: 0.875rem; color: var(--text-muted);">You do not currently have any invoices issued under your customer account.</p>
            </div>
        @endforelse
    </div>

</div>

<!-- MODAL: PAY INVOICE -->
<div id="modalPayInvoice" style="display: none; position: fixed; inset: 0; background: rgba(9, 19, 46, 0.7); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: var(--radius-md); max-width: 540px; width: 100%; box-shadow: var(--shadow-lg); border: 1px solid var(--border-light); overflow: hidden; animation: modalPop 0.2s ease-out;">
        
        <div style="background: var(--brand-navy); padding: 20px 24px; color: #ffffff; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 32px; height: 32px; border-radius: 6px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <h3 style="font-size: 1.125rem; font-weight: 700; margin: 0;">Online Premium Payment</h3>
                    <div style="font-size: 0.75rem; color: #94a3b8;">256-Bit Encrypted Merchant Gateway</div>
                </div>
            </div>
            <button type="button" onclick="closePayInvoiceModal()" style="background: transparent; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer; line-height: 1;">&times;</button>
        </div>

        <form id="payInvoiceForm" action="" method="POST" style="padding: 24px;">
            @csrf

            <!-- Payment Summary Card -->
            <div style="background: #f8fafc; border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding: 14px 18px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Paying Statement</div>
                    <div id="modalPayInvoiceNum" style="font-size: 1rem; font-weight: 800; font-family: monospace; color: var(--brand-navy);">INV-2026-003</div>
                    <div id="modalPayPolicyNum" style="font-size: 0.75rem; color: var(--brand-blue); font-family: monospace;">SB-BUS-105829</div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Total Amount</div>
                    <div id="modalPayAmount" style="font-size: 1.5rem; font-weight: 900; color: #059669;">$0.00</div>
                </div>
            </div>

            <!-- Payment Method Tabs -->
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 8px;">Select Payment Instrument</label>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <button type="button" id="tabBtnCard" onclick="switchPayTab('card')" style="padding: 10px; border-radius: var(--radius-sm); border: 2px solid var(--brand-blue); background: #eff6ff; font-weight: 700; font-size: 0.8125rem; color: var(--brand-blue); cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        <span>Credit / Debit Card</span>
                    </button>
                    <button type="button" id="tabBtnAch" onclick="switchPayTab('ach')" style="padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); background: #ffffff; font-weight: 600; font-size: 0.8125rem; color: var(--text-muted); cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>Bank ACH Transfer</span>
                    </button>
                </div>
            </div>

            <input type="hidden" name="payment_method" id="inputPaymentMethod" value="Visa / Mastercard (Credit Card)">

            <!-- TAB 1: CARD FIELDS -->
            <div id="payFieldsCard">
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Cardholder Name</label>
                    <input type="text" value="{{ $user->name }}" placeholder="Full Name on Card" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Card Number</label>
                    <input type="text" value="•••• •••• •••• 4242" placeholder="4000 1234 5678 9010" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem; font-family: monospace;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Expiration (MM/YY)</label>
                        <input type="text" value="12/28" placeholder="MM/YY" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem; font-family: monospace;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">CVC / Security Code</label>
                        <input type="password" value="•••" placeholder="CVC" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem; font-family: monospace;">
                    </div>
                </div>
            </div>

            <!-- TAB 2: ACH FIELDS -->
            <div id="payFieldsAch" style="display: none;">
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Bank Account Holder</label>
                    <input type="text" value="{{ $user->name }}" placeholder="Account Holder Name" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Routing (ABA) Number</label>
                        <input type="text" value="121000358" placeholder="9-Digit Routing #" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem; font-family: monospace;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 6px;">Account Number</label>
                        <input type="text" value="••••••••8910" placeholder="Account #" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem; font-family: monospace;">
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" onclick="closePayInvoiceModal()" style="padding: 10px 18px; border: 1px solid var(--border-light); background: #ffffff; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 10px 24px; background: #059669; color: #ffffff; border: none; border-radius: var(--radius-sm); font-weight: 700; font-size: 0.875rem; cursor: pointer; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);">Authorize &amp; Pay Statement</button>
            </div>
        </form>

    </div>
</div>

<script>
function openPayInvoiceModal(invoiceId, invoiceNum, policyNum, amount) {
    const modal = document.getElementById('modalPayInvoice');
    const form = document.getElementById('payInvoiceForm');
    
    form.action = `/dashboard/invoices/${invoiceId}/pay`;
    document.getElementById('modalPayInvoiceNum').textContent = invoiceNum;
    document.getElementById('modalPayPolicyNum').textContent = policyNum;
    document.getElementById('modalPayAmount').textContent = `$${amount}`;

    modal.style.display = 'flex';
}

function closePayInvoiceModal() {
    document.getElementById('modalPayInvoice').style.display = 'none';
}

function switchPayTab(tab) {
    const tabCard = document.getElementById('tabBtnCard');
    const tabAch = document.getElementById('tabBtnAch');
    const fieldsCard = document.getElementById('payFieldsCard');
    const fieldsAch = document.getElementById('payFieldsAch');
    const methodInput = document.getElementById('inputPaymentMethod');

    if (tab === 'card') {
        tabCard.style.borderColor = 'var(--brand-blue)';
        tabCard.style.background = '#eff6ff';
        tabCard.style.color = 'var(--brand-blue)';
        tabCard.style.fontWeight = '700';

        tabAch.style.borderColor = 'var(--border-light)';
        tabAch.style.background = '#ffffff';
        tabAch.style.color = 'var(--text-muted)';
        tabAch.style.fontWeight = '600';

        fieldsCard.style.display = 'block';
        fieldsAch.style.display = 'none';
        methodInput.value = 'Visa / Mastercard (Credit Card)';
    } else {
        tabAch.style.borderColor = 'var(--brand-blue)';
        tabAch.style.background = '#eff6ff';
        tabAch.style.color = 'var(--brand-blue)';
        tabAch.style.fontWeight = '700';

        tabCard.style.borderColor = 'var(--border-light)';
        tabCard.style.background = '#ffffff';
        tabCard.style.color = 'var(--text-muted)';
        tabCard.style.fontWeight = '600';

        fieldsCard.style.display = 'none';
        fieldsAch.style.display = 'block';
        methodInput.value = 'Direct ACH Bank Electronic Debit';
    }
}

function filterInvoices(filter) {
    document.querySelectorAll('.pay-filter-btn').forEach(btn => {
        if (btn.getAttribute('data-filter') === filter) {
            btn.classList.add('active');
            btn.style.background = 'var(--brand-blue)';
            btn.style.borderColor = 'var(--brand-blue)';
            btn.style.color = '#ffffff';
        } else {
            btn.classList.remove('active');
            btn.style.background = '#ffffff';
            btn.style.borderColor = 'var(--border-light)';
            btn.style.color = 'var(--text-muted)';
        }
    });

    const cards = document.querySelectorAll('.invoice-card');
    cards.forEach(card => {
        if (filter === 'all' || card.getAttribute('data-status') === filter) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

function searchInvoices() {
    const query = document.getElementById('paySearchInput').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.invoice-card');

    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = (!query || text.includes(query)) ? 'flex' : 'none';
    });
}
</script>
@endsection
