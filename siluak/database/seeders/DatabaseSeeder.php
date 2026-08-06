<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin UMPEG',
            'email' => 'umpeg@example.com',
            'password' => Hash::make('adminumpeg'),
            'role' => 'umpeg',
        ]);
    }
}
    