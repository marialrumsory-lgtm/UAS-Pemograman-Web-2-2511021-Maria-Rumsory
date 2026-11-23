<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun pengelola awal. Segera ganti kata sandinya setelah dipakai.
        User::updateOrCreate(
            ['email' => 'admin@rakbuku.test'],
            ['name' => 'Admin Rak Buku', 'password' => Hash::make('admin12345')]
        );

        $this->call(BookSeeder::class);
    }
}
