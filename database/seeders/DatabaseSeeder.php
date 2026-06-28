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
        // 1. Buat Akun Admin
        User::firstOrCreate(
            ['email' => 'admin@usb.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. Buat Akun Editor
        User::firstOrCreate(
            ['email' => 'editor@usb.com'],
            [
                'name' => 'Editor Konten',
                'password' => Hash::make('password'),
                'role' => 'editor',
            ]
        );

        // 3. Buat Akun Author 1
        User::firstOrCreate(
            ['email' => 'author1@usb.com'],
            [
                'name' => 'Author Satu',
                'password' => Hash::make('password'),
                'role' => 'author',
            ]
        );

        // 4. Buat Akun Author 2
        User::firstOrCreate(
            ['email' => 'author2@usb.com'],
            [
                'name' => 'Author Dua',
                'password' => Hash::make('password'),
                'role' => 'author',
            ]
        );
    }
}
