<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::where('name', 'admin')->first();

        User::create([
            'name' => 'Admin',
            'email' => 'super@admin.com',
            'password' => 'password',
            'role_id' => $userRole->id,
        ]);
    }
}
