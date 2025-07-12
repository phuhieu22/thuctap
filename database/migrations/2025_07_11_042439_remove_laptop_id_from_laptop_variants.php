<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laptop_variants', function (Blueprint $table) {
            $table->dropForeign(['laptop_id']);
            $table->dropColumn('laptop_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laptop_variants', function (Blueprint $table) {
            $table->unsignedBigInteger('laptop_id')->nullable();
            $table->foreign('laptop_id')->references('id')->on('laptops')->onDelete('cascade');
        });
    }
};
