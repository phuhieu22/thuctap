<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // List of tables that need AUTO_INCREMENT fix on their id column
        $tables = [
            'promotions',
            'laptop_images',
            'laptop_promotions',
            'orders',
            'order_items',
            'payments',
            'reviews',
            'roles',
            'shipping_addresses'
        ];
        
        foreach ($tables as $table) {
            try {
                // Check if table exists before trying to modify it
                if (Schema::hasTable($table)) {
                    DB::statement("ALTER TABLE {$table} MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT");
                }
            } catch (Exception $e) {
                // Log error but continue with other tables
                Log::warning("Could not fix AUTO_INCREMENT for table {$table}: " . $e->getMessage());
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // List of tables to revert
        $tables = [
            'promotions',
            'laptop_images', 
            'laptop_promotions',
            'orders',
            'order_items',
            'payments',
            'reviews',
            'roles',
            'shipping_addresses'
        ];
        
        foreach ($tables as $table) {
            try {
                if (Schema::hasTable($table)) {
                    DB::statement("ALTER TABLE {$table} MODIFY id BIGINT UNSIGNED NOT NULL");
                }
            } catch (Exception $e) {
                Log::warning("Could not revert AUTO_INCREMENT for table {$table}: " . $e->getMessage());
            }
        }
    }
};
