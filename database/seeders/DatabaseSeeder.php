<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo tài khoản admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Kiểm tra nếu email đã tồn tại
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin123'), // Mật khẩu bảo mật
                'role_id' => 1, // Giả sử role_id = 1 là admin
                'role_name' => 'admin',
            ]
        );

        // Tạo user bình thường
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => 2, // Giả sử role_id = 2 là user
        ]);
    }
}
