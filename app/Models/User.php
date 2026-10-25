<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'is_super_admin', 'title', 'phone', 'address', 'city', 'state', 'zip_code', 'paperless_billing', 'notification_preferences'])]
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
     * Check if user has specific SEO capability.
     */
    public function hasSeoPermission(string $permission): bool
    {
        if ($this->isSuperAdmin() || $this->role === 'admin') {
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
