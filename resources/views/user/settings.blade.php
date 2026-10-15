@extends('layouts.user')

@section('content')
<div class="settings-page-wrapper">

    <!-- TOP HEADER -->
    <div class="section-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
        <div>
            <h1 class="section-title" style="font-size: 1.75rem; font-weight: 800; color: var(--brand-navy); margin-bottom: 4px;">Account &amp; Policyholder Profile Settings</h1>
            <p class="section-subtitle" style="font-size: 0.9375rem; color: var(--text-muted);">
                Manage legal named insured identity, verified telephone &amp; physical addresses, account security, and real-time claims notification preferences.
            </p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <a href="{{ route('user.policies') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: var(--brand-navy); border: 1px solid var(--border-light); padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: var(--shadow-sm); text-decoration: none; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>My Active Policies</span>
            </a>
            <a href="{{ route('user.support') }}" style="display: inline-flex; align-items: center; gap: 8px; background: var(--brand-blue); color: #fff; padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; box-shadow: var(--shadow-sm); text-decoration: none; transition: all 0.2s;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.375 12.739l-7.648 7.648a4.5 4.5 0 01-6.364-6.364l7.648-7.648a3 3 0 014.243 4.243L8.607 18.265a1.5 1.5 0 01-2.122-2.122l7.648-7.648"/></svg>
                <span>Contact Underwriter</span>
            </a>
        </div>
    </div>

    <!-- PROFILE HERO BANNER -->
    <div style="background: linear-gradient(135deg, var(--brand-navy) 0%, #1e3a8a 100%); border-radius: var(--radius-md); padding: 24px 28px; color: #ffffff; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; box-shadow: var(--shadow-md); margin-bottom: 28px;">
        <div style="display: flex; align-items: center; gap: 18px;">
            <div style="width: 68px; height: 68px; border-radius: 50%; background: rgba(255, 255, 255, 0.15); border: 3px solid rgba(255, 255, 255, 0.3); display: flex; align-items: center; justify-content: center; font-size: 1.625rem; font-weight: 800; color: #ffffff; flex-shrink: 0;">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                    <h2 style="font-size: 1.375rem; font-weight: 800; margin: 0; color: #ffffff;">{{ $user->name }}</h2>
                    <span style="background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.4); color: #34d399; font-size: 0.6875rem; font-weight: 700; padding: 2px 10px; border-radius: 20px; text-transform: uppercase;">
                        Verified Insured
                    </span>
                </div>
                <div style="font-size: 0.875rem; color: #93c5fd; margin-bottom: 4px;">
                    {{ $user->title ?: 'Primary Named Policyholder' }} &bull; {{ $user->email }}
                </div>
                <div style="font-size: 0.75rem; color: #cbd5e1;">
                    Member Since: {{ $user->created_at ? $user->created_at->format('F Y') : '2026' }} &bull; Account Reference: <span style="font-family: monospace;">SB-ACC-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 12px; align-items: center;">
            <div style="text-align: right; background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: var(--radius-sm); padding: 10px 16px;">
                <div style="font-size: 0.6875rem; color: #93c5fd; text-transform: uppercase; font-weight: 700;">Account Status</div>
                <div style="font-size: 0.9375rem; font-weight: 800; color: #34d399;">Active &bull; Good Standing</div>
            </div>
        </div>
    </div>

    <!-- MAIN TWO COLUMN SETTINGS GRID -->
    <div style="display: grid; grid-template-columns: 1.4fr 1fr; gap: 24px;">

        <!-- LEFT COLUMN: PROFILE & ADDRESS -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
            
            <!-- SECTION 1: PERSONAL & CONTACT INFORMATION -->
            <div style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden;">
                <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-light); display: flex; align-items: center; gap: 10px;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; color: var(--brand-blue); display: flex; align-items: center; justify-content: center;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h2 style="font-size: 1.0625rem; font-weight: 800; color: var(--brand-navy); margin: 0;">Policyholder Identity &amp; Contact</h2>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">Legal name on policies and certified certificates</div>
                    </div>
                </div>

                <form action="{{ route('user.settings.profile') }}" method="POST" style="padding: 24px;">
                    @csrf

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Legal Insured Name *</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Corporate / Account Title</label>
                            <input type="text" name="title" value="{{ old('title', $user->title) }}" placeholder="e.g. Managing Partner, Director" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Email Address *</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Primary Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="(512) 000-0000" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                        </div>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Physical / Mailing Address</label>
                        <input type="text" name="address" value="{{ old('address', $user->address) }}" placeholder="Street address or suite" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                    </div>

                    <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 12px; margin-bottom: 24px;">
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">City</label>
                            <input type="text" name="city" value="{{ old('city', $user->city) }}" placeholder="City" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">State</label>
                            <input type="text" name="state" value="{{ old('state', $user->state) }}" placeholder="TX" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">ZIP Code</label>
                            <input type="text" name="zip_code" value="{{ old('zip_code', $user->zip_code) }}" placeholder="78701" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                        </div>
                    </div>

                    <div style="display: flex; justify-content: flex-end;">
                        <button type="submit" style="background: var(--brand-blue); color: #ffffff; border: none; padding: 10px 22px; border-radius: var(--radius-sm); font-weight: 700; font-size: 0.875rem; cursor: pointer; box-shadow: var(--shadow-sm); transition: all 0.2s;">
                            Save Profile Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- SECTION 2: NOTIFICATION & PAPERLESS PREFERENCES -->
            <div style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden;">
                <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-light); display: flex; align-items: center; gap: 10px;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </div>
                    <div>
                        <h2 style="font-size: 1.0625rem; font-weight: 800; color: var(--brand-navy); margin: 0;">Communication &amp; Billing Delivery</h2>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">Real-time dispatch channels and paperless policy credits</div>
                    </div>
                </div>

                <form action="{{ route('user.settings.preferences') }}" method="POST" style="padding: 24px;">
                    @csrf
                    @php
                        $prefs = $user->notification_preferences ?? [];
                    @endphp

                    <!-- Paperless Billing Callout -->
                    <div style="background: #ecfdf5; border: 1px solid rgba(5, 150, 105, 0.3); border-radius: var(--radius-sm); padding: 14px 18px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <div style="font-weight: 800; color: #065f46; font-size: 0.875rem;">Paperless Electronic Policy Delivery</div>
                            <div style="font-size: 0.75rem; color: #047857; margin-top: 2px;">
                                Receive electronic Declarations, certificates, and billing invoices. $25 annual premium credit applied.
                            </div>
                        </div>
                        <label style="position: relative; display: inline-block; width: 44px; height: 24px; flex-shrink: 0;">
                            <input type="checkbox" name="paperless_billing" value="1" {{ ($user->paperless_billing ?? true) ? 'checked' : '' }} style="opacity: 0; width: 0; height: 0;" onchange="this.nextElementSibling.style.background = this.checked ? '#059669' : '#cbd5e1';">
                            <span style="position: absolute; cursor: pointer; inset: 0; background-color: {{ ($user->paperless_billing ?? true) ? '#059669' : '#cbd5e1' }}; border-radius: 24px; transition: .2s;">
                                <span style="position: absolute; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; border-radius: 50%; transition: .2s; transform: {{ ($user->paperless_billing ?? true) ? 'translateX(20px)' : 'none' }};"></span>
                            </span>
                        </label>
                    </div>

                    <!-- Notification Channels Table -->
                    <div style="border: 1px solid var(--border-light); border-radius: var(--radius-sm); overflow: hidden; margin-bottom: 20px;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 0.8125rem;">
                            <thead>
                                <tr style="background: #f8fafc; border-bottom: 1px solid var(--border-light); color: var(--text-muted); font-size: 0.6875rem; text-transform: uppercase;">
                                    <th style="padding: 10px 16px; text-align: left;">Notification Type</th>
                                    <th style="padding: 10px 16px; text-align: center; width: 90px;">Email</th>
                                    <th style="padding: 10px 16px; text-align: center; width: 90px;">SMS Text</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid var(--border-light);">
                                    <td style="padding: 12px 16px;">
                                        <div style="font-weight: 700; color: var(--brand-navy);">Policy Renewal Reminders</div>
                                        <div style="font-size: 0.6875rem; color: var(--text-muted);">Advance notification 30 days prior to contract renewal</div>
                                    </td>
                                    <td style="padding: 12px 16px; text-align: center;">
                                        <input type="checkbox" name="policy_renewals_email" value="1" {{ !empty($prefs['policy_renewals_email']) ? 'checked' : '' }}>
                                    </td>
                                    <td style="padding: 12px 16px; text-align: center;">
                                        <input type="checkbox" name="policy_renewals_sms" value="1" {{ !empty($prefs['policy_renewals_sms']) ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid var(--border-light);">
                                    <td style="padding: 12px 16px;">
                                        <div style="font-weight: 700; color: var(--brand-navy);">Claims &amp; Adjuster Status Updates</div>
                                        <div style="font-size: 0.6875rem; color: var(--text-muted);">Real-time dispatch and settlement disbursement notifications</div>
                                    </td>
                                    <td style="padding: 12px 16px; text-align: center;">
                                        <input type="checkbox" name="claims_updates_email" value="1" {{ !empty($prefs['claims_updates_email']) ? 'checked' : '' }}>
                                    </td>
                                    <td style="padding: 12px 16px; text-align: center;">
                                        <input type="checkbox" name="claims_updates_sms" value="1" {{ !empty($prefs['claims_updates_sms']) ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid var(--border-light);">
                                    <td style="padding: 12px 16px;">
                                        <div style="font-weight: 700; color: var(--brand-navy);">Premium Billing &amp; Invoice Due Dates</div>
                                        <div style="font-size: 0.6875rem; color: var(--text-muted);">Reminders 7 days before automated debit date</div>
                                    </td>
                                    <td style="padding: 12px 16px; text-align: center;">
                                        <input type="checkbox" name="billing_reminders_email" value="1" {{ !empty($prefs['billing_reminders_email']) ? 'checked' : '' }}>
                                    </td>
                                    <td style="padding: 12px 16px; text-align: center;">
                                        <input type="checkbox" name="billing_reminders_sms" value="1" {{ !empty($prefs['billing_reminders_sms']) ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px;">
                                        <div style="font-weight: 700; color: var(--brand-navy);">Severe Weather &amp; Disaster Advisories</div>
                                        <div style="font-size: 0.6875rem; color: var(--text-muted);">Proactive hail, hurricane, &amp; freeze mitigation alerts</div>
                                    </td>
                                    <td style="padding: 12px 16px; text-align: center;">
                                        <span style="color: var(--text-muted);">&ndash;</span>
                                    </td>
                                    <td style="padding: 12px 16px; text-align: center;">
                                        <input type="checkbox" name="weather_cat_alerts_sms" value="1" {{ !empty($prefs['weather_cat_alerts_sms']) ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="display: flex; justify-content: flex-end;">
                        <button type="submit" style="background: #059669; color: #ffffff; border: none; padding: 10px 22px; border-radius: var(--radius-sm); font-weight: 700; font-size: 0.875rem; cursor: pointer; box-shadow: var(--shadow-sm); transition: all 0.2s;">
                            Save Notification Preferences
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <!-- RIGHT COLUMN: SECURITY & ACCOUNT ACTIONS -->
        <div style="display: flex; flex-direction: column; gap: 24px;">

            <!-- SECTION 3: SECURITY & PASSWORD CHANGE -->
            <div style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden;">
                <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-light); display: flex; align-items: center; gap: 10px;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: #fffbeb; color: #d97706; display: flex; align-items: center; justify-content: center;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <div>
                        <h2 style="font-size: 1.0625rem; font-weight: 800; color: var(--brand-navy); margin: 0;">Account Security Credentials</h2>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">Manage your login access credentials</div>
                    </div>
                </div>

                <form action="{{ route('user.settings.password') }}" method="POST" style="padding: 24px;">
                    @csrf

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Current Password *</label>
                        <input type="password" name="current_password" required placeholder="••••••••" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">New Password * (Min 8 characters)</label>
                        <input type="password" name="password" required placeholder="••••••••" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: var(--brand-navy); margin-bottom: 6px;">Confirm New Password *</label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••" style="width: 100%; padding: 10px 12px; border: 1px solid var(--border-light); border-radius: var(--radius-sm); font-size: 0.875rem;">
                    </div>

                    <button type="submit" style="width: 100%; background: var(--brand-navy); color: #ffffff; border: none; padding: 10px 18px; border-radius: var(--radius-sm); font-weight: 700; font-size: 0.875rem; cursor: pointer; box-shadow: var(--shadow-sm); transition: all 0.2s;">
                        Update Security Password
                    </button>
                </form>
            </div>

            <!-- SECTION 4: 2FA & SECURITY STATUS -->
            <div style="background: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: 24px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #059669;"></span>
                        <strong style="font-size: 0.875rem; color: var(--brand-navy);">Two-Factor Authentication</strong>
                    </div>
                    <span style="background: #ecfdf5; color: #059669; font-size: 0.6875rem; font-weight: 700; padding: 2px 8px; border-radius: 12px;">Enabled</span>
                </div>
                <p style="font-size: 0.8125rem; color: var(--text-muted); line-height: 1.4; margin-bottom: 14px;">
                    Your policyholder account is guarded by multi-factor biometric &amp; SMS authentication when signing in from unrecognized browser sessions.
                </p>
                <div style="font-size: 0.75rem; color: var(--text-muted); font-family: monospace;">
                    Verified Phone: {{ $user->phone ?: '(512) 840-2918' }}
                </div>
            </div>

            <!-- SECTION 5: DATA PRIVACY & COMPLIANCE -->
            <div style="background: #f8fafc; border-radius: var(--radius-md); border: 1px solid var(--border-light); padding: 20px;">
                <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.5px; margin-bottom: 6px;">
                    Insurance Regulatory Compliance
                </div>
                <p style="font-size: 0.8125rem; color: var(--text-main); line-height: 1.4; margin-bottom: 12px;">
                    All personal identifying data, policy risk evaluations, and claims loss histories are safeguarded under state insurance department privacy regulations and federal Gramm-Leach-Bliley Act (GLBA) provisions.
                </p>
                <a href="{{ route('user.support') }}" style="font-size: 0.8125rem; font-weight: 700; color: var(--brand-blue); text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                    <span>Contact Compliance Officer</span>
                    <span>&rarr;</span>
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
