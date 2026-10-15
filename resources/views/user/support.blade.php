@extends('layouts.user')

@section('content')
<div class="support-page-wrapper">

    <!-- TOP HEADER -->
    <div class="section-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
        <div>
            <h1 class="section-title" style="font-size: 1.75rem; font-weight: 800; color: var(--brand-navy); margin-bottom: 4px;">{{ $supportContent['support_title'] ?? 'Underwriting Concierge & Priority Support' }}</h1>
            <p class="section-subtitle" style="font-size: 0.9375rem; color: var(--text-muted);">
                {{ $supportContent['support_subtitle'] ?? 'Dedicated licensed risk advisors, 24/7 disaster mitigation dispatch, policy endorsement requests, and live inquiry tracking.' }}
            </p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <button type="button" onclick="openNewTicketModal()" class="btn-primary-action" style="display: inline-flex; align-items: center; gap: 8px; background: var(--brand-blue); color: #fff; padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: var(--shadow-sm); border: none; cursor: pointer; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Submit Service Inquiry</span>
            </button>
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $supportContent['emergency_phone'] ?? '18005555677') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #dc2626; color: #ffffff; border: none; padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 700; font-size: 0.875rem; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25); text-decoration: none; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span>24/7 Emergency: {{ $supportContent['emergency_phone'] ?? '1-800-555-5677' }}</span>
            </a>
        </div>
    </div>

    <!-- METRICS / KPI CARDS -->
    <div class="metrics-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; margin-bottom: 28px;">
        
        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Assigned Advisor</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; color: var(--brand-blue); display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.125rem; font-weight: 800; color: var(--brand-navy); line-height: 1.2;">
                {{ $agent->name }}
            </div>
            <div style="font-size: 0.8125rem; color: #059669; font-weight: 600; margin-top: 4px; display: flex; align-items: center; gap: 6px;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: #059669; display: inline-block;"></span>
                <span>Active &bull; Direct Line</span>
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Total Inquiries</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #f8fafc; color: var(--text-muted); display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); line-height: 1.2;">
                {{ $totalTickets }}
            </div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Lifetime service requests
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">In Review / Active</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #fffbeb; color: #d97706; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #d97706; line-height: 1.2;">
                {{ $openTickets }}
            </div>
            <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 4px;">
                Underwriting review in progress
            </div>
        </div>

        <div class="metric-card" style="background: #ffffff; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Resolved / Settled</span>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #059669; line-height: 1.2;">
                {{ $resolvedTickets }}
            </div>
            <div style="font-size: 0.8125rem; color: #059669; font-weight: 500; margin-top: 4px;">
                Completed with underwriter notes
            </div>
        </div>

    </div>

    <!-- CONCIERGE & HOTLINES GRID -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 20px; margin-bottom: 30px;">
        
        <!-- CARD 1: DEDICATED UNDERWRITER -->
        <div style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: 24px; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 18px;">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: linear-gradient(135deg, var(--brand-navy) 0%, var(--brand-blue) 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; font-weight: 800; border: 3px solid #eff6ff; box-shadow: var(--shadow-sm);">
                        MV
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--brand-blue); letter-spacing: 0.5px;">Your Assigned Underwriter</div>
                        <h3 style="font-size: 1.125rem; font-weight: 800; color: var(--brand-navy); margin: 0;">{{ $agent->name }}</h3>
                        <div style="font-size: 0.8125rem; color: var(--text-muted);">{{ $agent->title ?: 'Senior Underwriter & Risk Advisor' }}</div>
                    </div>
                </div>

                <div style="background: #f8fafc; border-radius: var(--radius-sm); padding: 14px; font-size: 0.8125rem; margin-bottom: 18px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span style="color: var(--text-muted);">Direct Desk:</span>
                        <a href="tel:{{ $supportContent['underwriter_phone'] ?? ($agent->phone ?: '(512) 555-0182') }}" style="font-weight: 700; color: var(--brand-blue); text-decoration: none;">{{ $supportContent['underwriter_phone'] ?? ($agent->phone ?: '(512) 555-0182') }}</a>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span style="color: var(--text-muted);">Confidential Email:</span>
                        <a href="mailto:{{ $supportContent['underwriter_email'] ?? $agent->email }}" style="font-weight: 600; color: var(--text-main); text-decoration: none;">{{ $supportContent['underwriter_email'] ?? $agent->email }}</a>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--text-muted);">Availability:</span>
                        <span style="font-weight: 600; color: #059669;">{{ $supportContent['underwriter_hours'] ?? 'Mon – Fri • 8:00 AM – 6:00 PM CST' }}</span>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 10px;">
                <a href="tel:{{ $supportContent['underwriter_phone'] ?? ($agent->phone ?: '(512) 555-0182') }}" style="flex: 1; text-align: center; background: var(--brand-blue); color: #ffffff; padding: 10px 14px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>Direct Call</span>
                </a>
                <button type="button" onclick="openNewTicketModal('Policy Consultation with Underwriter')" style="flex: 1; text-align: center; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 10px 14px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; cursor: pointer;">
                    Schedule Review
                </button>
            </div>
        </div>

        <!-- CARD 2: 24/7 EMERGENCY HOTLINES -->
        <div style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: 24px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h3 style="font-size: 1.0625rem; font-weight: 800; color: var(--brand-navy); margin: 0;">24/7 Immediate Incident Response</h3>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $supportContent['emergency_subtitle'] ?? 'Zero Wait Priority Emergency Dispatch' }}</div>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $supportContent['emergency_phone'] ?? '18005555677') }}" style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding: 10px 14px; text-decoration: none; color: inherit; transition: all 0.2s;">
                    <div>
                        <div style="font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy);">National Emergency Claims &amp; Loss Intake</div>
                        <div style="font-size: 0.6875rem; color: var(--text-muted);">Immediate disaster loss recording</div>
                    </div>
                    <span style="font-weight: 800; font-family: monospace; color: #dc2626; font-size: 0.875rem;">{{ $supportContent['emergency_phone'] ?? '1-800-555-5677' }}</span>
                </a>

                <a href="tel:{{ preg_replace('/[^0-9]/', '', $supportContent['roadside_phone'] ?? '18005558697') }}" style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding: 10px 14px; text-decoration: none; color: inherit; transition: all 0.2s;">
                    <div>
                        <div style="font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy);">Roadside Towing &amp; Auto Assistance</div>
                        <div style="font-size: 0.6875rem; color: var(--text-muted);">Flat tire, lockout, battery &amp; winching</div>
                    </div>
                    <span style="font-weight: 800; font-family: monospace; color: var(--brand-blue); font-size: 0.875rem;">{{ $supportContent['roadside_phone'] ?? '1-800-555-TOWS' }}</span>
                </a>

                <a href="tel:{{ preg_replace('/[^0-9]/', '', $supportContent['cyber_phone'] ?? '18887873292') }}" style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding: 10px 14px; text-decoration: none; color: inherit; transition: all 0.2s;">
                    <div>
                        <div style="font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy);">Cyber Incident &amp; Ransomware Hotline</div>
                        <div style="font-size: 0.6875rem; color: var(--text-muted);">Forensic response &amp; extortion triage</div>
                    </div>
                    <span style="font-weight: 800; font-family: monospace; color: #7c3aed; font-size: 0.875rem;">{{ $supportContent['cyber_phone'] ?? '1-888-SURE-CYBER' }}</span>
                </a>
            </div>
        </div>

        <!-- CARD 3: CLIENT CONCIERGE & HEADQUARTERS -->
        <div style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: 24px; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                    <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; color: var(--brand-blue); display: flex; align-items: center; justify-content: center;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div>
                        <h3 style="font-size: 1.0625rem; font-weight: 800; color: var(--brand-navy); margin: 0;">Client Concierge &amp; HQ</h3>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">Direct corporate office &amp; account relations</div>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px;">
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $supportContent['support_phone'] ?? '+8809612345678') }}" style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding: 10px 14px; text-decoration: none; color: inherit; transition: all 0.2s;">
                        <div>
                            <div style="font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy);">Main Desk Phone</div>
                            <div style="font-size: 0.6875rem; color: var(--text-muted);">Toll-free customer helpline</div>
                        </div>
                        <span style="font-weight: 800; font-family: monospace; color: var(--brand-blue); font-size: 0.875rem;">{{ $supportContent['support_phone'] ?? '+880 9612 345678' }}</span>
                    </a>

                    <a href="mailto:{{ $supportContent['support_email'] ?? 'support@surebound.com' }}" style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding: 10px 14px; text-decoration: none; color: inherit; transition: all 0.2s;">
                        <div>
                            <div style="font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy);">Concierge Email</div>
                            <div style="font-size: 0.6875rem; color: var(--text-muted);">Documentation &amp; inquiries</div>
                        </div>
                        <span style="font-weight: 700; color: var(--brand-navy); font-size: 0.8125rem;">{{ $supportContent['support_email'] ?? 'support@surebound.com' }}</span>
                    </a>
                </div>

                @if(!empty($supportContent['office_address']))
                    <div style="background: #f8fafc; border-radius: var(--radius-sm); padding: 10px 14px; border: 1px solid var(--border-light); font-size: 0.75rem; color: var(--text-muted); display: flex; align-items: flex-start; gap: 8px;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink: 0; color: var(--brand-navy); margin-top: 1px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ $supportContent['office_address'] }}</span>
                    </div>
                @endif
            </div>

            <div style="display: flex; gap: 10px; margin-top: 14px;">
                <a href="mailto:{{ $supportContent['support_email'] ?? 'support@surebound.com' }}" style="flex: 1; text-align: center; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 10px 14px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Email Support</span>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $supportContent['support_phone'] ?? '+8809612345678') }}" style="flex: 1; text-align: center; background: var(--brand-blue); color: #ffffff; padding: 10px 14px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>Call Concierge</span>
                </a>
            </div>
        </div>
    </div>

    <!-- SUPPORT TICKETS TABLE / HISTORY -->
    <div style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 30px;">
        
        <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
            <div>
                <h2 style="font-size: 1.125rem; font-weight: 800; color: var(--brand-navy); margin: 0;">Policyholder Service Tickets &amp; Inquiries</h2>
                <p style="font-size: 0.8125rem; color: var(--text-muted); margin: 2px 0 0 0;">
                    Live tracking of endorsement changes, billing inquiries, and underwriting responses.
                </p>
            </div>
            <button type="button" onclick="openNewTicketModal()" style="background: var(--brand-blue); color: #ffffff; border: none; padding: 8px 16px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>New Ticket</span>
            </button>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid var(--border-light); color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                        <th style="padding: 14px 20px;">Ticket Ref</th>
                        <th style="padding: 14px 20px;">Category</th>
                        <th style="padding: 14px 20px;">Subject &amp; Inquiry</th>
                        <th style="padding: 14px 20px;">Priority</th>
                        <th style="padding: 14px 20px;">Status</th>
                        <th style="padding: 14px 20px;">Underwriter Notes</th>
                        <th style="padding: 14px 20px; text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody style="divide-y: 1px solid var(--border-light);">
                    @forelse($tickets as $t)
                        <tr style="border-bottom: 1px solid var(--border-light); transition: background 0.15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#ffffff'">
                            
                            <!-- Ticket Ref -->
                            <td style="padding: 16px 20px; font-family: 'JetBrains Mono', monospace; font-weight: 700; color: var(--brand-navy); white-space: nowrap;">
                                {{ $t->ticket_number }}
                                @if($t->policy_number)
                                    <div style="font-size: 0.6875rem; color: var(--text-muted); font-family: monospace;">{{ $t->policy_number }}</div>
                                @endif
                            </td>

                            <!-- Category -->
                            <td style="padding: 16px 20px; white-space: nowrap;">
                                <span style="background: #eff6ff; color: var(--brand-blue); font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; text-transform: uppercase;">
                                    {{ str_replace('_', ' ', $t->category) }}
                                </span>
                            </td>

                            <!-- Subject & Inquiry -->
                            <td style="padding: 16px 20px; max-width: 320px;">
                                <div style="font-weight: 700; color: var(--brand-navy); margin-bottom: 2px;">{{ $t->subject }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $t->message }}
                                </div>
                            </td>

                            <!-- Priority -->
                            <td style="padding: 16px 20px; white-space: nowrap;">
                                @if($t->priority === 'urgent' || $t->priority === 'high')
                                    <span style="color: #dc2626; font-weight: 700; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 4px;">
                                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #dc2626;"></span>
                                        {{ ucfirst($t->priority) }}
                                    </span>
                                @else
                                    <span style="color: var(--text-muted); font-weight: 600; font-size: 0.75rem;">
                                        {{ ucfirst($t->priority) }}
                                    </span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td style="padding: 16px 20px; white-space: nowrap;">
                                @if($t->status === 'resolved' || $t->status === 'closed')
                                    <span style="background: #ecfdf5; color: #059669; font-size: 0.6875rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; border: 1px solid rgba(5, 150, 105, 0.2); text-transform: uppercase;">
                                        Resolved
                                    </span>
                                @elseif($t->status === 'in_progress')
                                    <span style="background: #fffbeb; color: #d97706; font-size: 0.6875rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; border: 1px solid rgba(217, 119, 6, 0.2); text-transform: uppercase;">
                                        In Progress
                                    </span>
                                @else
                                    <span style="background: #eff6ff; color: var(--brand-blue); font-size: 0.6875rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; border: 1px solid rgba(29, 78, 216, 0.2); text-transform: uppercase;">
                                        Open
                                    </span>
                                @endif
                            </td>

                            <!-- Underwriter Notes (Real-time from Admin) -->
                            <td style="padding: 16px 20px; max-width: 280px;">
                                @if($t->admin_notes)
                                    <div style="background: #f1f5f9; border-left: 3px solid var(--brand-blue); padding: 6px 10px; border-radius: 4px; font-size: 0.75rem; color: #1e293b;">
                                        <strong>Underwriter:</strong> {{ $t->admin_notes }}
                                    </div>
                                @else
                                    <span style="font-size: 0.75rem; color: var(--text-muted); font-style: italic;">
                                        In queue for underwriter review
                                    </span>
                                @endif
                            </td>

                            <!-- Action -->
                            <td style="padding: 16px 20px; text-align: right; white-space: nowrap;">
                                <button type="button" onclick="viewTicketModal({{ json_encode($t) }})" style="background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 6px 12px; border-radius: var(--radius-sm); font-size: 0.75rem; font-weight: 600; cursor: pointer;">
                                    View Thread
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 40px; text-align: center; color: var(--text-muted);">
                                No support inquiries found. Submit your first ticket above!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- FREQUENTLY ASKED QUESTIONS ACCORDION -->
    <div style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: 24px;">
        <h3 style="font-size: 1.125rem; font-weight: 800; color: var(--brand-navy); margin-bottom: 6px;">Knowledge Base &amp; Frequently Asked Questions</h3>
        <p style="font-size: 0.8125rem; color: var(--text-muted); margin-bottom: 20px;">Quick guidance on common policy administration and claims procedures.</p>

        <div style="display: flex; flex-direction: column; gap: 12px;">
            <div style="border: 1px solid var(--border-light); border-radius: var(--radius-sm); overflow: hidden;">
                <button type="button" onclick="toggleFaq(this)" style="width: 100%; text-align: left; padding: 14px 18px; background: #f8fafc; border: none; font-weight: 700; font-size: 0.875rem; color: var(--brand-navy); display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                    <span>How quickly will an adjuster review my newly submitted claim?</span>
                    <span style="font-size: 1.25rem; line-height: 1;">+</span>
                </button>
                <div style="display: none; padding: 14px 18px; font-size: 0.8125rem; color: var(--text-main); line-height: 1.5; border-top: 1px solid var(--border-light);">
                    First notice of loss filings are triaged immediately by our automated intake engine. A certified senior field adjuster is assigned within 4 business hours, and initial field contact or digital inspection scheduling occurs within 24 hours.
                </div>
            </div>

            <div style="border: 1px solid var(--border-light); border-radius: var(--radius-sm); overflow: hidden;">
                <button type="button" onclick="toggleFaq(this)" style="width: 100%; text-align: left; padding: 14px 18px; background: #f8fafc; border: none; font-weight: 700; font-size: 0.875rem; color: var(--brand-navy); display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                    <span>Can I download an official ACORD 25 Certificate of Liability Insurance?</span>
                    <span style="font-size: 1.25rem; line-height: 1;">+</span>
                </button>
                <div style="display: none; padding: 14px 18px; font-size: 0.8125rem; color: var(--text-main); line-height: 1.5; border-top: 1px solid var(--border-light);">
                    Yes! You can instantly download a standardized ACORD 25 Certificate from your <a href="{{ route('user.documents') }}" style="color: var(--brand-blue); font-weight: 600;">Digital Document Locker</a>. If your lender or landlord requires specialized Additional Insured wording or a specific cancellation notice, click "Request Certificate (COI)" to generate an underwriter-endorsed certificate.
                </div>
            </div>

            <div style="border: 1px solid var(--border-light); border-radius: var(--radius-sm); overflow: hidden;">
                <button type="button" onclick="toggleFaq(this)" style="width: 100%; text-align: left; padding: 14px 18px; background: #f8fafc; border: none; font-weight: 700; font-size: 0.875rem; color: var(--brand-navy); display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                    <span>What happens when I accept an insurance quote proposal online?</span>
                    <span style="font-size: 1.25rem; line-height: 1;">+</span>
                </button>
                <div style="display: none; padding: 14px 18px; font-size: 0.8125rem; color: var(--text-main); line-height: 1.5; border-top: 1px solid var(--border-light);">
                    When you click "Accept &amp; Bind Policy" on any completed underwriting proposal in your <a href="{{ route('user.quote') }}" style="color: var(--brand-blue); font-weight: 600;">Quotes Center</a>, our platform instantaneously binds your contract, generates your official policy number, produces your Declarations page, and opens your digital ID cards.
                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL: SUBMIT SUPPORT TICKET -->
<div id="modalNewTicket" style="display: none; position: fixed; inset: 0; background: rgba(9, 19, 46, 0.7); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: var(--radius-md); max-width: 580px; width: 100%; box-shadow: var(--shadow-lg); border: 1px solid var(--border-light); overflow: hidden; animation: modalPop 0.2s ease-out;">
        
        <div style="background: var(--brand-navy); padding: 20px 24px; color: #ffffff; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 32px; height: 32px; border-radius: 6px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 700; margin: 0;">Submit Underwriting Service Inquiry</h3>
            </div>
            <button type="button" onclick="closeNewTicketModal()" style="background: transparent; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer; line-height: 1;">&times;</button>
        </div>

        <form action="{{ route('user.support.ticket') }}" method="POST" style="padding: 24px;">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Category *</label>
                    <select name="category" required style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem; background: #fff;">
                        <option value="policy_change">Policy Endorsement / Change</option>
                        <option value="certificate">Certificate of Insurance (COI)</option>
                        <option value="billing">Billing &amp; Payment Inquiry</option>
                        <option value="claim_followup">Claims Followup</option>
                        <option value="general">General Coverage Inquiry</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Priority Level *</label>
                    <select name="priority" required style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem; background: #fff;">
                        <option value="normal">Normal (Response within 24h)</option>
                        <option value="high">High (Response within 4h)</option>
                        <option value="urgent">Urgent (Immediate Underwriting Review)</option>
                        <option value="low">Low Priority</option>
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Related Policy (Optional)</label>
                <select name="policy_number" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem; background: #fff;">
                    <option value="">-- General Account / Not Policy Specific --</option>
                    @foreach($policies as $pol)
                        <option value="{{ $pol->policy_number }}">{{ $pol->policy_number }} &ndash; {{ ucfirst($pol->type) }} ({{ $pol->plan_name }})</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Subject *</label>
                <input type="text" name="subject" id="ticketSubjectInput" required placeholder="Brief summary of inquiry" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Inquiry Details &amp; Specifics *</label>
                <textarea name="message" rows="4" required placeholder="Describe what changes or information you require..." style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;"></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" onclick="closeNewTicketModal()" style="padding: 10px 18px; border: 1px solid var(--border-light); background: #ffffff; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 10px 22px; background: var(--brand-blue); color: #ffffff; border: none; border-radius: var(--radius-sm); font-weight: 700; font-size: 0.875rem; cursor: pointer; box-shadow: var(--shadow-sm);">Submit Inquiry</button>
            </div>
        </form>

    </div>
</div>

<!-- MODAL: VIEW TICKET THREAD -->
<div id="modalViewTicket" style="display: none; position: fixed; inset: 0; background: rgba(9, 19, 46, 0.7); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: var(--radius-md); max-width: 600px; width: 100%; box-shadow: var(--shadow-lg); border: 1px solid var(--border-light); overflow: hidden; animation: modalPop 0.2s ease-out;">
        
        <div style="background: var(--brand-navy); padding: 20px 24px; color: #ffffff; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 0.75rem; color: #94a3b8; text-transform: uppercase; font-weight: 700;">Service Ticket Details</div>
                <h3 id="modalTicketRef" style="font-size: 1.125rem; font-weight: 800; font-family: monospace; margin: 0;">TCK-2026-00000</h3>
            </div>
            <button type="button" onclick="closeViewTicketModal()" style="background: transparent; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer; line-height: 1;">&times;</button>
        </div>

        <div style="padding: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                <span id="modalTicketCategory" style="background: #eff6ff; color: var(--brand-blue); font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; text-transform: uppercase;">Category</span>
                <span id="modalTicketStatus" style="font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; text-transform: uppercase;">Status</span>
            </div>

            <h4 id="modalTicketSubject" style="font-size: 1.0625rem; font-weight: 800; color: var(--brand-navy); margin-bottom: 12px;">Subject</h4>

            <div style="background: #f8fafc; border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding: 14px; margin-bottom: 16px;">
                <div style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px;">YOUR ORIGINAL INQUIRY:</div>
                <p id="modalTicketMessage" style="font-size: 0.875rem; color: var(--text-main); line-height: 1.5; margin: 0;"></p>
            </div>

            <div id="modalTicketAdminNotesBox" style="background: #eff6ff; border: 1px solid var(--brand-blue); border-radius: var(--radius-sm); padding: 14px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <div style="width: 20px; height: 20px; border-radius: 50%; background: var(--brand-blue); color: #fff; font-size: 0.65rem; display: flex; align-items: center; justify-content: center; font-weight: 800;">SB</div>
                    <strong style="font-size: 0.8125rem; color: var(--brand-navy);">UNDERWRITING TEAM RESPONSE:</strong>
                </div>
                <p id="modalTicketAdminNotes" style="font-size: 0.875rem; color: var(--brand-navy); line-height: 1.5; margin: 0; font-weight: 500;"></p>
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="button" onclick="closeViewTicketModal()" style="padding: 10px 20px; background: var(--brand-navy); color: #ffffff; border: none; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; cursor: pointer;">Close</button>
            </div>
        </div>

    </div>
</div>

<script>
function openNewTicketModal(subject = '') {
    const modal = document.getElementById('modalNewTicket');
    if (subject) {
        document.getElementById('ticketSubjectInput').value = subject;
    }
    modal.style.display = 'flex';
}
function closeNewTicketModal() {
    document.getElementById('modalNewTicket').style.display = 'none';
}

function viewTicketModal(ticket) {
    document.getElementById('modalTicketRef').textContent = ticket.ticket_number;
    document.getElementById('modalTicketCategory').textContent = ticket.category.replace('_', ' ');
    document.getElementById('modalTicketSubject').textContent = ticket.subject;
    document.getElementById('modalTicketMessage').textContent = ticket.message;

    const statusEl = document.getElementById('modalTicketStatus');
    statusEl.textContent = ticket.status.replace('_', ' ');
    if (ticket.status === 'resolved' || ticket.status === 'closed') {
        statusEl.style.background = '#ecfdf5';
        statusEl.style.color = '#059669';
    } else if (ticket.status === 'in_progress') {
        statusEl.style.background = '#fffbeb';
        statusEl.style.color = '#d97706';
    } else {
        statusEl.style.background = '#eff6ff';
        statusEl.style.color = 'var(--brand-blue)';
    }

    const notesBox = document.getElementById('modalTicketAdminNotesBox');
    const notesEl = document.getElementById('modalTicketAdminNotes');
    if (ticket.admin_notes) {
        notesEl.textContent = ticket.admin_notes;
        notesBox.style.display = 'block';
    } else {
        notesEl.textContent = 'Our underwriting concierge is currently reviewing your file. An update will be posted shortly.';
        notesBox.style.display = 'block';
    }

    document.getElementById('modalViewTicket').style.display = 'flex';
}
function closeViewTicketModal() {
    document.getElementById('modalViewTicket').style.display = 'none';
}

function toggleFaq(btn) {
    const content = btn.nextElementSibling;
    const icon = btn.querySelector('span:last-child');
    if (content.style.display === 'block') {
        content.style.display = 'none';
        icon.textContent = '+';
    } else {
        content.style.display = 'block';
        icon.textContent = '−';
    }
}
</script>
@endsection
