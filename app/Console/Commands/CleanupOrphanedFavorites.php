<?php

namespace App\Console\Commands;

use App\Models\Favorite;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanupOrphanedFavorites extends Command
{
    protected $signature = 'favorites:cleanup';
    protected $description = 'Clean up orphaned favorites';

    public function handle()
    {
        $this->info('Starting cleanup of orphaned favorites...');

        $count = 0;
        Favorite::chunk(100, function ($favorites) use (&$count) {
            foreach ($favorites as $favorite) {
                if (!$favorite->favoritable) {
                    try {
                        DB::beginTransaction();
                        $favorite->delete();
                        DB::commit();
                        $count++;
                    } catch (\Exception $e) {
                        DB::rollBack();
                        $this->error("Error deleting favorite {$favorite->id}: {$e->getMessage()}");
                    }
                }
            }
        });

        $this->info("Cleanup completed. Removed {$count} orphaned favorites.");
    }
} 