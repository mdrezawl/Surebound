<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SetupController extends Controller
{
    /**
     * Check if application is already installed.
     */
    private function isInstalled(): bool
    {
        return File::exists(storage_path('installed'));
    }

    /**
     * Return list of temporary installer and unnecessary files to auto-purge.
     *
     * @return array<string, string>
     */
    public function getRemovableFiles(): array
    {
        $files = [
            'app/Http/Controllers/SetupController.php' => app_path('Http/Controllers/SetupController.php'),
            'resources/views/setup.blade.php' => resource_path('views/setup.blade.php'),
            'routes/setup.php' => base_path('routes/setup.php'),
        ];

        // Also detect and include any temporary development patch files in root
        foreach (File::glob(base_path('patch_*.py')) as $patchFile) {
            $relativePath = str_replace(base_path().'/', '', $patchFile);
            $files[$relativePath] = $patchFile;
        }

        return $files;
    }

    /**
     * Create a secure backup of installer files in storage/app/installer_backup
     * so that the developer can restore them with `php artisan setup:restore` if needed.
     */
    private function backupFilesBeforePurge(): void
    {
        try {
            $backupDir = storage_path('app/installer_backup');
            if (! File::isDirectory($backupDir)) {
                File::makeDirectory($backupDir, 0755, true);
            }

            if (File::exists(app_path('Http/Controllers/SetupController.php'))) {
                File::copy(app_path('Http/Controllers/SetupController.php'), $backupDir.'/SetupController.php');
            }

            if (File::exists(resource_path('views/setup.blade.php'))) {
                File::copy(resource_path('views/setup.blade.php'), $backupDir.'/setup.blade.php');
            }

            if (File::exists(base_path('routes/setup.php'))) {
                File::copy(base_path('routes/setup.php'), $backupDir.'/routes_setup.php');
            }
        } catch (\Throwable $e) {
            // Silently ignore backup errors so purge proceeds regardless
        }
    }

    /**
     * Auto-remove all installer files, routes, temporary scripts, and clear caches.
     *
     * @param  array<string, string>  $filesToPurge
     */
    public function autoPurgeInstallerFiles(array $filesToPurge): void
    {
        // 1. Back up files first in protected storage so developers can restore if desired
        $this->backupFilesBeforePurge();

        // 2. Delete Blade setup view
        if (File::exists(resource_path('views/setup.blade.php'))) {
            File::delete(resource_path('views/setup.blade.php'));
        }

        // 3. Delete setup routes file
        if (File::exists(base_path('routes/setup.php'))) {
            File::delete(base_path('routes/setup.php'));
        }

        // 4. Delete temporary root patch scripts
        foreach (File::glob(base_path('patch_*.py')) as $patchFile) {
            if (File::exists($patchFile)) {
                File::delete($patchFile);
            }
        }

        // 5. Clear compiled views, routes, and config caches
        try {
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');
        } catch (\Throwable $e) {
            // Continue purging even if artisan command fails
        }

        // 6. Delete this Controller file (SetupController.php)
        $controllerPath = app_path('Http/Controllers/SetupController.php');
        if (File::exists($controllerPath)) {
            File::delete($controllerPath);
        }
    }

    /**
     * Step 1: System Requirements & Permissions Check.
     */
    public function welcome()
    {
        if ($this->isInstalled()) {
            return redirect()->route('login');
        }

        $requirements = [
            'PHP >= 8.2 (Current: '.PHP_VERSION.')' => version_compare(PHP_VERSION, '8.2.0', '>='),
            'BCMath Extension' => extension_loaded('bcmath'),
            'Ctype Extension' => extension_loaded('ctype'),
            'cURL Extension' => extension_loaded('curl'),
            'JSON Extension' => extension_loaded('json'),
            'Mbstring Extension' => extension_loaded('mbstring'),
            'OpenSSL Extension' => extension_loaded('openssl'),
            'PDO MySQL Extension' => extension_loaded('pdo') && extension_loaded('pdo_mysql'),
            'Tokenizer Extension' => extension_loaded('tokenizer'),
            'XML Extension' => extension_loaded('xml'),
            '.env File Writable' => File::isWritable(base_path('.env')) || File::isWritable(base_path()),
            'storage/ Directory Writable' => File::isWritable(storage_path()),
            'bootstrap/cache/ Writable' => File::isWritable(base_path('bootstrap/cache')),
        ];

        $allRequirementsPassed = ! in_array(false, $requirements, true);

        return view('setup', [
            'step' => 1,
            'requirements' => $requirements,
            'allRequirementsPassed' => $allRequirementsPassed,
        ]);
    }

    /**
     * Step 2: Database Configuration form.
     */
    public function database()
    {
        if ($this->isInstalled()) {
            return redirect()->route('login');
        }

        $currentConfig = [
            'host' => env('DB_HOST', config('database.connections.mysql.host', '127.0.0.1')),
            'port' => env('DB_PORT', config('database.connections.mysql.port', '3306')),
            'database' => env('DB_DATABASE', config('database.connections.mysql.database', 'Surebound')),
            'username' => env('DB_USERNAME', config('database.connections.mysql.username', 'root')),
            'password' => env('DB_PASSWORD', config('database.connections.mysql.password', '')),
        ];

        return view('setup', [
            'step' => 2,
            'currentConfig' => $currentConfig,
        ]);
    }

    /**
     * Step 2 POST: Test connection and save database details to .env.
     */
    public function saveDatabase(Request $request)
    {
        if ($this->isInstalled()) {
            return redirect()->route('login');
        }

        $request->validate([
            'db_host' => 'required|string',
            'db_port' => 'required|numeric',
            'db_database' => 'required|string',
            'db_username' => 'required|string',
            'db_password' => 'nullable|string',
        ]);

        try {
            // Test connection dynamically first
            config([
                'database.connections.mysql.host' => $request->db_host,
                'database.connections.mysql.port' => $request->db_port,
                'database.connections.mysql.database' => $request->db_database,
                'database.connections.mysql.username' => $request->db_username,
                'database.connections.mysql.password' => $request->db_password ?? '',
            ]);
            DB::purge('mysql');
            DB::connection()->getPdo();

            // Connection successful, write to .env file
            $this->setEnvironmentValue([
                'DB_HOST' => $request->db_host,
                'DB_PORT' => $request->db_port,
                'DB_DATABASE' => $request->db_database,
                'DB_USERNAME' => $request->db_username,
                'DB_PASSWORD' => $request->db_password ? '"'.$request->db_password.'"' : '',
            ]);

            return redirect()->route('setup.migrations')
                ->with('success', 'Database connection established and verified successfully!');

        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Could not connect to database. Please check credentials. Error: '.$e->getMessage());
        }
    }

    /**
     * Step 3: Database Migrations & Seeds view.
     */
    public function migrations()
    {
        if ($this->isInstalled()) {
            return redirect()->route('login');
        }

        return view('setup', ['step' => 3]);
    }

    /**
     * Step 3 POST: Execute migrations and seeders.
     */
    public function runMigrations(Request $request)
    {
        if ($this->isInstalled()) {
            return redirect()->route('login');
        }

        try {
            // Run fresh database migrations
            Artisan::call('migrate:fresh', ['--force' => true]);

            // Seed realistic demo data if requested or by default
            if ($request->boolean('seed_demo_data', true)) {
                Artisan::call('db:seed', ['--force' => true]);
            }

            return redirect()->route('setup.admin')
                ->with('success', 'Database tables and sample data created successfully!');
        } catch (\Throwable $e) {
            return back()->with('error', 'Database migration failed: '.$e->getMessage());
        }
    }

    /**
     * Step 4: Administrator Account creation view.
     */
    public function admin()
    {
        if ($this->isInstalled()) {
            return redirect()->route('login');
        }

        return view('setup', ['step' => 4]);
    }

    /**
     * Step 4 POST: Save admin account, mark application as installed.
     */
    public function saveAdmin(Request $request)
    {
        if ($this->isInstalled()) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Create or update Super Admin account
            User::updateOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'role' => 'admin',
                    'title' => 'Chief Underwriter & Super Admin',
                ]
            );

            // Create installed lock file with timestamp and metadata
            $installData = [
                'installed_at' => now()->toIso8601String(),
                'admin_email' => $request->email,
                'app_name' => config('app.name', 'Surebound'),
                'app_url' => config('app.url', url('/')),
                'php_version' => PHP_VERSION,
                'auto_purge_enabled' => true,
                'status' => 'Production Locked',
            ];
            File::put(storage_path('installed'), json_encode($installData, JSON_PRETTY_PRINT));

            // Secure .env for production deployment
            $this->setEnvironmentValue([
                'APP_ENV' => 'production',
                'APP_DEBUG' => 'false',
                'APP_URL' => url('/'),
            ]);

            // Store admin email in session for Step 5 summary
            session([
                'setup_admin_email' => $request->email,
                'setup_admin_name' => $request->name,
            ]);

            return redirect()->route('setup.complete');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create Super Administrator: '.$e->getMessage());
        }
    }

    /**
     * Step 5: Setup Complete & Auto-Purge execution.
     * Renders completion page in memory, then automatically deletes installer files.
     */
    public function complete(): Response
    {
        if (! $this->isInstalled()) {
            return redirect()->route('setup.welcome');
        }

        $adminEmail = session('setup_admin_email', 'admin@surebound.com');
        $adminName = session('setup_admin_name', 'Administrator');

        // 1. Get list of files scheduled for auto-removal
        $filesToPurge = $this->getRemovableFiles();

        // 2. Render Step 5 HTML into memory before deleting the Blade file
        $renderedHtml = view('setup', [
            'step' => 5,
            'adminEmail' => $adminEmail,
            'adminName' => $adminName,
            'purgedFiles' => array_keys($filesToPurge),
        ])->render();

        // 3. Automatically and permanently remove the installer files from the server
        $this->autoPurgeInstallerFiles($filesToPurge);

        // 4. Return response to user
        return response($renderedHtml);
    }

    /**
     * Helper to update values in .env safely.
     *
     * @param  array<string, string>  $values
     */
    private function setEnvironmentValue(array $values): void
    {
        $envFile = app()->environmentFilePath();
        if (! File::exists($envFile)) {
            return;
        }

        $str = file_get_contents($envFile);

        foreach ($values as $envKey => $envValue) {
            $keyPosition = strpos($str, "{$envKey}=");
            if ($keyPosition !== false) {
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                if ($endOfLinePosition === false) {
                    $endOfLinePosition = strlen($str);
                }
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
            } else {
                $str .= "\n{$envKey}={$envValue}";
            }
        }

        file_put_contents($envFile, $str);
    }
}
