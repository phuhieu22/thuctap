<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laptop_variants', function (Blueprint $table) {
            $table->foreignId('laptop_id')
                ->nullable() // 👉 để tránh lỗi khi table chưa có dữ liệu
                ->constrained('laptops')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('laptop_variants', function (Blueprint $table) {
            $table->dropForeign(['laptop_id']);
            $table->dropColumn('laptop_id');
        });
    }
};
