<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh pembuatan user admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // ganti dengan password yang diinginkan
            'subscription_id' => null, // Sesuaikan dengan ID subscription yang valid jika diperlukan
            'trial_end_date' => null,
            'signatures_count' => 0,
            'remember_token' => Str::random(10),
        ]);

        // Contoh pembuatan user biasa
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // ganti dengan password yang diinginkan
            'subscription_id' => null, // Sesuaikan dengan ID subscription yang valid jika diperlukan
            'trial_end_date' => null,
            'signatures_count' => 0,
            'remember_token' => Str::random(10),
        ]);

        // Contoh tambahan user menggunakan factory
        User::factory(10)->create(); // Membuat 10 user dengan data acak
    }
}
