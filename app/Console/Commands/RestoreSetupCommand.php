<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class RestoreSetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:restore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore Setup Wizard and installer files from backup for development testing';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $backupDir = storage_path('app/installer_backup');

        if (! File::isDirectory($backupDir)) {
            $this->error('No installer backup directory found at: '.$backupDir);

            return Command::FAILURE;
        }

        $this->info('Restoring setup files from backup...');

        // 1. Remove storage/installed lock
        if (File::exists(storage_path('installed'))) {
            File::delete(storage_path('installed'));
            $this->line('  ✓ Removed storage/installed lock');
        }

        // 2. Restore SetupController.php
        $controllerBackup = $backupDir.'/SetupController.php';
        if (File::exists($controllerBackup)) {
            File::copy($controllerBackup, app_path('Http/Controllers/SetupController.php'));
            $this->line('  ✓ Restored app/Http/Controllers/SetupController.php');
        }

        // 3. Restore setup.blade.php
        $viewBackup = $backupDir.'/setup.blade.php';
        if (File::exists($viewBackup)) {
            File::copy($viewBackup, resource_path('views/setup.blade.php'));
            $this->line('  ✓ Restored resources/views/setup.blade.php');
        }

        // 4. Restore routes/setup.php
        $routesBackup = $backupDir.'/routes_setup.php';
        if (File::exists($routesBackup)) {
            File::copy($routesBackup, base_path('routes/setup.php'));
            $this->line('  ✓ Restored routes/setup.php');
        }

        // 5. Clear caches
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        $this->line('  ✓ Flushed application caches');

        $this->newLine();
        $this->info('🎉 Setup Wizard has been successfully restored! You can now visit /setup in your browser.');

        return Command::SUCCESS;
    }
}
