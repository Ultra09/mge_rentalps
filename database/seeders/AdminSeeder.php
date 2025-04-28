<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'username' => 'admin1',
            'name' => 'Admin Satu',
            'email' => 'admin1@example.com',
            'phone' => '08123456782',
            'password' => Hash::make('passwordadmin'),
            'role' => 'admin', // bisa admin atau superadmin sesuai kebutuhan
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
