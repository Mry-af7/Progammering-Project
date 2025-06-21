<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MakeAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'admin:create 
                            {email : The admin email address}
                            {name? : The admin name (optional)}
                            {--password= : Set a specific password (optional)}
                            {--promote : Promote existing user instead of creating new one}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new admin user or promote an existing user to admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $name = $this->argument('name');
        $password = $this->option('password');
        $promote = $this->option('promote');

        // Validate email format
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            $this->error('Invalid email format!');
            return 1;
        }

        // Check if user already exists
        $existingUser = User::where('email', $email)->first();

        if ($promote && !$existingUser) {
            $this->error("User with email {$email} not found! Cannot promote non-existing user.");
            return 1;
        }

        if (!$promote && $existingUser) {
            if ($existingUser->is_admin) {
                $this->info("User {$email} is already an admin!");
                return 0;
            }
            
            if ($this->confirm("User {$email} already exists. Do you want to promote them to admin instead?")) {
                $promote = true;
            } else {
                $this->error('User already exists. Use --promote flag to promote existing user.');
                return 1;
            }
        }

        if ($promote) {
            // Promote existing user
            $user = $existingUser;
            $user->update([
                'is_admin' => true,
                'admin_granted_at' => now(),
                'admin_granted_by' => null // Command line promotion
            ]);

            $this->info("✅ Successfully promoted {$user->name} ({$email}) to admin!");
            $this->line("   Granted at: " . $user->admin_granted_at);
            
        } else {
            // Create new admin user
            if (!$name) {
                $name = $this->ask('What is the admin\'s name?');
            }

            if (!$password) {
                $password = $this->secret('What is the admin password? (leave empty for auto-generated)');
                
                if (empty($password)) {
                    $password = $this->generateSecurePassword();
                    $this->line("Auto-generated password: <fg=yellow>{$password}</fg=yellow>");
                    $this->line("<fg=red>⚠️  Save this password securely!</fg=red>");
                }
            }

            // Validate password strength
            $validator = Validator::make(['password' => $password], [
                'password' => 'required|min:8'
            ]);

            if ($validator->fails()) {
                $this->error('Password must be at least 8 characters long!');
                return 1;
            }

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'user_type' => 'company', // Use company type for admins (they manage companies)
                'is_admin' => true,
                'admin_granted_at' => now(),
                'email_verified_at' => now(), // Auto-verify admin emails
            ]);

            $this->info("✅ Successfully created admin user!");
            $this->line("   Name: {$user->name}");
            $this->line("   Email: {$user->email}");
            $this->line("   User Type: {$user->user_type}");
            $this->line("   Admin Since: {$user->admin_granted_at}");
        }

        // Show admin stats
        $totalAdmins = User::where('is_admin', true)->count();
        $this->line("");
        $this->line("📊 Total admins in system: {$totalAdmins}");

        return 0;
    }

    /**
     * Generate a secure random password
     */
    private function generateSecurePassword(): string
    {
        $length = 12;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        $password = '';
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
        
        return $password;
    }
}