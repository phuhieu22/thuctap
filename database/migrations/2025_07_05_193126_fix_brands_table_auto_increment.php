<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix the auto increment for brands table
        DB::statement('ALTER TABLE brands MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
        
        // Fix other tables if they have the same issue
        DB::statement('ALTER TABLE categories MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE laptops MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove auto increment
        DB::statement('ALTER TABLE brands MODIFY id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE categories MODIFY id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE laptops MODIFY id BIGINT UNSIGNED NOT NULL');
    }
};
