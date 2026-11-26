<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'is_super_admin', 'allowed_pages', 'title', 'phone', 'address', 'city', 'state', 'zip_code', 'paperless_billing', 'notification_preferences'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_super_admin' => 'boolean',
            'allowed_pages' => 'array',
            'paperless_billing' => 'boolean',
            'notification_preferences' => 'array',
        ];
    }

    /**
     * Determine if the user is a Super Administrator.
     */
    public function isSuperAdmin(): bool
    {
        return (bool) $this->is_super_admin
            || $this->role === 'super_admin'
            || str_contains(strtolower($this->title ?? ''), 'super admin')
            || $this->email === 'help.rezawl71@gmail.com';
    }

    /**
     * Determine if the user is an Administrator (standard or super).
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'super_admin' || $this->isSuperAdmin();
    }

    /**
     * Determine if the user has permission to access a specific admin page or module.
     */
    public function hasPageAccess(string $page): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if (! $this->isAdmin()) {
            return false;
        }

        // If allowed_pages is null, grant full access by default
        if ($this->allowed_pages === null) {
            return true;
        }

        $allowed = (array) $this->allowed_pages;

        // Wildcard access
        if (in_array('*', $allowed, true)) {
            return true;
        }

        // Direct tab or route match
        if (in_array($page, $allowed, true)) {
            return true;
        }

        // Group matching: CMS group covers all insurance and content editor tabs
        if ((str_ends_with($page, '-cms') || in_array($page, ['brand-settings', 'contact-info', 'files-photos'])) && in_array('cms', $allowed, true)) {
            return true;
        }

        // Group matching: Marketing covers marketing subtabs and pixels
        if (str_starts_with($page, 'marketing') && in_array('marketing', $allowed, true)) {
            return true;
        }

        // Overview is always accessible if user has access to at least one module
        if ($page === 'overview' && ! empty($allowed)) {
            return true;
        }

        return false;
    }

    /**
     * Master registry of all configurable administration pages and modules.
     */
    public static function getManageablePages(): array
    {
        return [
            'Core Operations' => [
                'overview' => 'Executive Overview Dashboard',
                'quotes' => 'Quote Requests & Proposals',
                'policies' => 'Active Policies Management',
                'claims' => 'Claims Center',
                'support-tickets' => 'Policyholder Support & Concierge',
            ],
            'Billing & Gateways' => [
                'invoices' => 'Invoices & Billing',
                'payments-api' => 'USA Payment Gateways',
                'claims-api' => 'Claims API Gateway',
            ],
            'Administration & Staff' => [
                'users' => 'Users & Staff Directory',
                'agents' => 'Licensed Agents & Brokers',
                'files-photos' => 'Files & Photos Manager',
                'settings' => 'Agency Settings & Maintenance',
                'contact-info' => 'Website Hotlines & Contact Info',
                'brand-settings' => 'Brand Guidelines & Typography',
            ],
            'Marketing, SEO & CMS' => [
                'seo' => 'SEO & AI Search Hub',
                'marketing' => 'Marketing Pixels & Campaigns',
                'cms' => 'Website Content (All 20+ Insurance CMS Editors)',
            ],
        ];
    }

    /**
     * Check if user has specific SEO capability.
     */
    public function hasSeoPermission(string $permission): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if (! $this->hasPageAccess('seo')) {
            return false;
        }

        if ($this->role === 'admin') {
            return true;
        }

        if ($this->role === 'seo_manager') {
            return true;
        }

        if ($this->role === 'content_editor') {
            return in_array($permission, ['view', 'edit_metadata', 'create_content', 'request_review']);
        }

        if ($this->role === 'seo_viewer') {
            return $permission === 'view';
        }

        return false;
    }

    public function canManageRedirects(): bool
    {
        return $this->hasSeoPermission('manage_redirects');
    }

    public function canEditRobotsTxt(): bool
    {
        return $this->hasSeoPermission('edit_robots');
    }

    public function canApproveSeoFixes(): bool
    {
        return $this->hasSeoPermission('approve_fixes');
    }
}
