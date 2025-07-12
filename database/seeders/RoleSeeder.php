<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Đảm bảo tạo các role cố định
        Role::firstOrCreate(['id' => 1], ['name' => 'User']);
        Role::firstOrCreate(['id' => 2], ['name' => 'Admin']);
        Role::firstOrCreate(['id' => 3], ['name' => 'Staff']);
        Role::firstOrCreate(['id' => 4], ['name' => 'Guest']);
        Role::firstOrCreate(['id' => 5], ['name' => 'Manager']);
    }
}
