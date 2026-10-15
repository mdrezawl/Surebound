<?php

namespace App\Providers;

use App\Http\Controllers\AdminController;
use App\Models\ApiSetting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Auto-check and execute pending migrations on live host if tables are missing
        if (! $this->app->runningInConsole()) {
            try {
                if (! Schema::hasTable('support_tickets') || ! Schema::hasTable('page_contents')) {
                    Artisan::call('migrate', ['--force' => true]);
                }
            } catch (\Throwable $e) {
                // Ignore if DB connection is not initialized yet
            }
        }

        View::composer('layouts.app', function ($view) {
            $config = null;
            try {
                if (Schema::hasTable('api_settings')) {
                    $setting = ApiSetting::where('key', 'marketing_settings')->first();
                    $config = $setting ? $setting->value : AdminController::getDefaultMarketingSettings();
                }
            } catch (\Throwable $e) {
                $config = AdminController::getDefaultMarketingSettings();
            }

            $view->with('marketingConfig', $config ?? AdminController::getDefaultMarketingSettings());
        });
    }
}
