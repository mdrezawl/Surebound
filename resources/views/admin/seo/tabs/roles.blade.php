<!-- ==========================================
     MODULE 25: USER ROLES & PERMISSIONS
     ========================================== -->
<div class="seo-tab-panel" id="tab-roles">
    <div class="seo-card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95)); border-color: rgba(59, 130, 246, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">User Roles, Least-Privilege &amp; SEO Governance</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Granular permission controls distinguishing Super Administrators, SEO Technical Directors, Content Editors, and read-only Underwriting Auditors.
                </p>
            </div>
            <div>
                <span class="seo-badge seo-badge-success" style="padding: 6px 12px; font-size: 0.85rem;">Role-Based Access Control</span>
            </div>
        </div>
    </div>

    {{-- Permissions Matrix Table --}}
    <div class="seo-card" style="margin-bottom: 24px;">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span>Permission Matrix by User Role</span>
            </div>
        </div>

        <div class="seo-table-container">
            <table class="seo-table">
                <thead>
                    <tr>
                        <th>Capability / Permission</th>
                        <th>Super Admin</th>
                        <th>SEO Director</th>
                        <th>Content Editor</th>
                        <th>Auditor / Viewer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">View Analytics &amp; Reports</td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Trigger Technical Audits</td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-neutral">&mdash; Restricted</span></td>
                        <td><span class="seo-badge seo-badge-neutral">&mdash; Restricted</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Edit On-Page SEO Metadata</td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-neutral">&mdash; Restricted</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Manage 301/302 Redirects</td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-neutral">&mdash; Restricted</span></td>
                        <td><span class="seo-badge seo-badge-neutral">&mdash; Restricted</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Edit Robots.txt &amp; Crawlers</td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-neutral">&mdash; Restricted</span></td>
                        <td><span class="seo-badge seo-badge-neutral">&mdash; Restricted</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #f8fafc;">Configure API Credentials</td>
                        <td><span class="seo-badge seo-badge-success">&check; Allowed</span></td>
                        <td><span class="seo-badge seo-badge-neutral">&mdash; Restricted</span></td>
                        <td><span class="seo-badge seo-badge-neutral">&mdash; Restricted</span></td>
                        <td><span class="seo-badge seo-badge-neutral">&mdash; Restricted</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- System Users Table --}}
    <div class="seo-card">
        <div class="seo-card-header">
            <div class="seo-card-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span>Authorized Administrative Users ({{ $users->count() }})</span>
            </div>
        </div>

        <div class="seo-table-container">
            <table class="seo-table">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email Address</th>
                        <th>Assigned Role</th>
                        <th>SEO Privileges</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td style="font-weight: 600; color: #f8fafc;">
                                {{ $user->name }}
                            </td>
                            <td style="font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; color: #cbd5e1;">
                                {{ $user->email }}
                            </td>
                            <td>
                                <span class="seo-badge {{ in_array($user->role ?? '', ['admin', 'superadmin']) ? 'seo-badge-success' : 'seo-badge-info' }}">
                                    {{ ucfirst($user->role ?? 'admin') }}
                                </span>
                            </td>
                            <td style="font-size: 0.85rem; color: #a7f3d0;">
                                Full Administrative Control
                            </td>
                            <td style="font-size: 0.8rem; color: #64748b;">
                                {{ $user->created_at?->diffForHumans() ?? 'Active' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
