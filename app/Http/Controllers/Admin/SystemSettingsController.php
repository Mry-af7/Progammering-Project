<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SystemSettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'general' => $this->getGeneralSettings(),
            'security' => $this->getSecuritySettings(),
            'email' => $this->getEmailSettings(),
            'storage' => $this->getStorageSettings(),
            'performance' => $this->getPerformanceSettings(),
            'integrations' => $this->getIntegrationSettings(),
        ];

        $systemInfo = [
            'laravel_version' => app()->version(),
            'php_version' => PHP_VERSION,
            'database_type' => DB::connection()->getDriverName(),
            'cache_driver' => config('cache.default'),
            'queue_driver' => config('queue.default'),
            'mail_driver' => config('mail.default'),
            'storage_driver' => config('filesystems.default'),
            'app_env' => config('app.env'),
            'app_debug' => config('app.debug'),
            'timezone' => config('app.timezone'),
            'locale' => config('app.locale'),
        ];

        $logs = ActivityLog::latest()->take(20)->get();

        return Inertia::render('Admin/SystemSettings', [
            'settings' => $settings,
            'systemInfo' => $systemInfo,
            'recentLogs' => $logs,
            'diskUsage' => $this->getDiskUsage(),
            'systemHealth' => $this->getSystemHealth(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'category' => 'required|in:general,security,email,storage,performance,integrations',
            'settings' => 'required|array',
        ]);

        $category = $request->category;
        $settings = $request->settings;

        // Validate settings based on category
        $this->validateSettings($category, $settings);

        // Update settings
        foreach ($settings as $key => $value) {
            $this->updateSetting($category . '.' . $key, $value);
        }

        // Special handling for certain settings
        $this->handleSpecialSettings($category, $settings);

        // Log the settings update
        \Log::info('System settings updated by admin', [
            'admin_id' => auth()->id(),
            'category' => $category,
            'updated_settings' => array_keys($settings)
        ]);

        // Clear relevant caches
        $this->clearRelevantCaches($category);

        return back()->with('success', ucfirst($category) . ' settings updated successfully');
    }

    public function clearCache(Request $request)
    {
        $request->validate([
            'type' => 'required|in:all,config,route,view,application'
        ]);

        $type = $request->type;

        try {
            switch ($type) {
                case 'all':
                    Artisan::call('cache:clear');
                    Artisan::call('config:clear');
                    Artisan::call('route:clear');
                    Artisan::call('view:clear');
                    break;
                case 'config':
                    Artisan::call('config:clear');
                    break;
                case 'route':
                    Artisan::call('route:clear');
                    break;
                case 'view':
                    Artisan::call('view:clear');
                    break;
                case 'application':
                    Artisan::call('cache:clear');
                    break;
            }

            // Log the cache clear
            \Log::info('Cache cleared by admin', [
                'admin_id' => auth()->id(),
                'cache_type' => $type
            ]);

            return back()->with('success', ucfirst($type) . ' cache cleared successfully');
        } catch (\Exception $e) {
            \Log::error('Failed to clear cache', [
                'admin_id' => auth()->id(),
                'cache_type' => $type,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Failed to clear cache: ' . $e->getMessage());
        }
    }

    public function runMaintenance(Request $request)
    {
        $request->validate([
            'action' => 'required|in:optimize,migrate,seed,storage_link,queue_restart'
        ]);

        $action = $request->action;

        try {
            switch ($action) {
                case 'optimize':
                    Artisan::call('optimize');
                    $message = 'Application optimized successfully';
                    break;
                case 'migrate':
                    Artisan::call('migrate', ['--force' => true]);
                    $message = 'Database migrations run successfully';
                    break;
                case 'seed':
                    Artisan::call('db:seed', ['--force' => true]);
                    $message = 'Database seeded successfully';
                    break;
                case 'storage_link':
                    Artisan::call('storage:link');
                    $message = 'Storage link created successfully';
                    break;
                case 'queue_restart':
                    Artisan::call('queue:restart');
                    $message = 'Queue workers restarted successfully';
                    break;
            }

            // Log the maintenance action
            \Log::info('Maintenance action performed by admin', [
                'admin_id' => auth()->id(),
                'action' => $action
            ]);

            return back()->with('success', $message);
        } catch (\Exception $e) {
            \Log::error('Maintenance action failed', [
                'admin_id' => auth()->id(),
                'action' => $action,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Maintenance action failed: ' . $e->getMessage());
        }
    }

    public function backupDatabase()
    {
        try {
            // You can implement database backup logic here
            // This could use a package like spatie/laravel-backup or custom logic
            
            $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
            
            // Example backup command (adjust based on your database)
            $command = sprintf(
                'mysqldump --user=%s --password=%s --host=%s %s > %s',
                config('database.connections.mysql.username'),
                config('database.connections.mysql.password'),
                config('database.connections.mysql.host'),
                config('database.connections.mysql.database'),
                storage_path('backups/' . $filename)
            );

            // Make sure backups directory exists
            if (!Storage::disk('local')->exists('backups')) {
                Storage::disk('local')->makeDirectory('backups');
            }

            exec($command, $output, $returnCode);

            if ($returnCode === 0) {
                // Log the backup
                \Log::info('Database backup created by admin', [
                    'admin_id' => auth()->id(),
                    'filename' => $filename
                ]);

                return back()->with('success', "Database backup created: {$filename}");
            } else {
                throw new \Exception('Backup command failed');
            }
        } catch (\Exception $e) {
            \Log::error('Database backup failed', [
                'admin_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Database backup failed: ' . $e->getMessage());
        }
    }

    public function testEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        try {
            // Send test email
            \Mail::raw('This is a test email from your application.', function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Test Email from ' . config('app.name'));
            });

            // Log the test
            \Log::info('Test email sent by admin', [
                'admin_id' => auth()->id(),
                'recipient' => $request->email
            ]);

            return back()->with('success', "Test email sent to {$request->email}");
        } catch (\Exception $e) {
            \Log::error('Test email failed', [
                'admin_id' => auth()->id(),
                'recipient' => $request->email,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Test email failed: ' . $e->getMessage());
        }
    }

    public function systemHealth()
    {
        $health = [
            'database' => $this->checkDatabaseConnection(),
            'cache' => $this->checkCacheConnection(),
            'queue' => $this->checkQueueConnection(),
            'storage' => $this->checkStorageAccess(),
            'mail' => $this->checkMailConfiguration(),
        ];

        return response()->json([
            'health' => $health,
            'overall_status' => collect($health)->every(fn($status) => $status === 'healthy') ? 'healthy' : 'issues_detected'
        ]);
    }

    private function getGeneralSettings()
    {
        return [
            'app_name' => config('app.name'),
            'app_url' => config('app.url'),
            'app_timezone' => config('app.timezone'),
            'app_locale' => config('app.locale'),
            'maintenance_mode' => $this->getSetting('general.maintenance_mode', false),
            'maintenance_message' => $this->getSetting('general.maintenance_message', 'The site is currently under maintenance.'),
            'allow_registration' => $this->getSetting('general.allow_registration', true),
            'require_email_verification' => $this->getSetting('general.require_email_verification', true),
            'default_user_role' => $this->getSetting('general.default_user_role', 'student'),
        ];
    }

    private function getSecuritySettings()
    {
        return [
            'password_min_length' => $this->getSetting('security.password_min_length', 8),
            'password_require_uppercase' => $this->getSetting('security.password_require_uppercase', true),
            'password_require_numbers' => $this->getSetting('security.password_require_numbers', true),
            'password_require_symbols' => $this->getSetting('security.password_require_symbols', false),
            'session_lifetime' => $this->getSetting('security.session_lifetime', 120),
            'max_login_attempts' => $this->getSetting('security.max_login_attempts', 5),
            'lockout_duration' => $this->getSetting('security.lockout_duration', 60),
            'two_factor_enabled' => $this->getSetting('security.two_factor_enabled', false),
            'force_https' => $this->getSetting('security.force_https', false),
        ];
    }

    private function getEmailSettings()
    {
        return [
            'mail_driver' => config('mail.default'),
            'mail_host' => config('mail.mailers.smtp.host'),
            'mail_port' => config('mail.mailers.smtp.port'),
            'mail_username' => config('mail.mailers.smtp.username'),
            'mail_from_address' => config('mail.from.address'),
            'mail_from_name' => config('mail.from.name'),
            'mail_encryption' => config('mail.mailers.smtp.encryption'),
            'notifications_enabled' => $this->getSetting('email.notifications_enabled', true),
            'welcome_email_enabled' => $this->getSetting('email.welcome_email_enabled', true),
        ];
    }

    private function getStorageSettings()
    {
        return [
            'default_disk' => config('filesystems.default'),
            'max_upload_size' => $this->getSetting('storage.max_upload_size', 10240), // KB
            'allowed_file_types' => $this->getSetting('storage.allowed_file_types', 'jpg,jpeg,png,gif,pdf,doc,docx'),
            'storage_quota_per_user' => $this->getSetting('storage.quota_per_user', 100), // MB
            'auto_cleanup_enabled' => $this->getSetting('storage.auto_cleanup_enabled', false),
            'cleanup_after_days' => $this->getSetting('storage.cleanup_after_days', 30),
        ];
    }

    private function getPerformanceSettings()
    {
        return [
            'cache_driver' => config('cache.default'),
            'cache_lifetime' => $this->getSetting('performance.cache_lifetime', 3600),
            'queue_driver' => config('queue.default'),
            'enable_query_caching' => $this->getSetting('performance.enable_query_caching', true),
            'compress_responses' => $this->getSetting('performance.compress_responses', true),
            'minify_assets' => $this->getSetting('performance.minify_assets', false),
        ];
    }

    private function getIntegrationSettings()
    {
        return [
            'google_analytics_id' => $this->getSetting('integrations.google_analytics_id', ''),
            'stripe_enabled' => $this->getSetting('integrations.stripe_enabled', false),
            'paypal_enabled' => $this->getSetting('integrations.paypal_enabled', false),
            'slack_webhook_url' => $this->getSetting('integrations.slack_webhook_url', ''),
            'discord_webhook_url' => $this->getSetting('integrations.discord_webhook_url', ''),
            'api_rate_limit' => $this->getSetting('integrations.api_rate_limit', 60),
        ];
    }

    private function validateSettings($category, $settings)
    {
        $rules = [];

        switch ($category) {
            case 'general':
                $rules = [
                    'app_name' => 'string|max:255',
                    'app_url' => 'url',
                    'maintenance_mode' => 'boolean',
                    'allow_registration' => 'boolean',
                ];
                break;
            case 'security':
                $rules = [
                    'password_min_length' => 'integer|min:6|max:20',
                    'session_lifetime' => 'integer|min:5|max:1440',
                    'max_login_attempts' => 'integer|min:1|max:10',
                ];
                break;
            // Add more validation rules for other categories
        }

        request()->validate($rules);
    }

    private function handleSpecialSettings($category, $settings)
    {
        if ($category === 'general' && isset($settings['maintenance_mode'])) {
            if ($settings['maintenance_mode']) {
                Artisan::call('down');
            } else {
                Artisan::call('up');
            }
        }
    }

    private function clearRelevantCaches($category)
    {
        switch ($category) {
            case 'general':
            case 'performance':
                Cache::flush();
                break;
            case 'security':
                Cache::forget('security_settings');
                break;
        }
    }

    private function getSetting($key, $default = null)
    {
        // Implement your settings retrieval logic here
        // This could be from database, config, cache, etc.
        return config($key, $default);
    }

    private function updateSetting($key, $value)
    {
        // Implement your settings storage logic here
        // This could be database, config files, cache, etc.
    }

    private function getDiskUsage()
    {
        return [
            'total' => disk_total_space('/'),
            'free' => disk_free_space('/'),
            'used' => disk_total_space('/') - disk_free_space('/'),
        ];
    }

    private function getSystemHealth()
    {
        return [
            'database' => $this->checkDatabaseConnection(),
            'cache' => $this->checkCacheConnection(),
            'queue' => $this->checkQueueConnection(),
            'storage' => $this->checkStorageAccess(),
            'mail' => $this->checkMailConfiguration(),
        ];
    }

    private function checkDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return 'healthy';
        } catch (\Exception $e) {
            return 'unhealthy';
        }
    }

    private function checkCacheConnection()
    {
        try {
            Cache::put('health_check', 'test', 10);
            $value = Cache::get('health_check');
            Cache::forget('health_check');
            return $value === 'test' ? 'healthy' : 'unhealthy';
        } catch (\Exception $e) {
            return 'unhealthy';
        }
    }

    private function checkQueueConnection()
    {
        try {
            // Simple check - you might want to implement a more sophisticated check
            return config('queue.default') !== null ? 'healthy' : 'unhealthy';
        } catch (\Exception $e) {
            return 'unhealthy';
        }
    }

    private function checkStorageAccess()
    {
        try {
            Storage::put('health_check.txt', 'test');
            $content = Storage::get('health_check.txt');
            Storage::delete('health_check.txt');
            return $content === 'test' ? 'healthy' : 'unhealthy';
        } catch (\Exception $e) {
            return 'unhealthy';
        }
    }

    private function checkMailConfiguration()
    {
        try {
            return config('mail.default') !== null && 
                   config('mail.from.address') !== null ? 'healthy' : 'configuration_incomplete';
        } catch (\Exception $e) {
            return 'unhealthy';
        }
    }
}