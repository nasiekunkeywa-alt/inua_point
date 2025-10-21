<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $officerRole = Role::where('name', 'loan_officer')->first();
        $memberRole = Role::where('name', 'member')->first();

        User::firstOrCreate([
            'email' => 'admin@inua.com'
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'role_id' => $adminRole?->id,
        ]);

        User::firstOrCreate([
            'email' => 'officer@inua.com'
        ], [
            'name' => 'Loan Officer',
            'password' => Hash::make('password'),
            'role_id' => $officerRole?->id,
        ]);

        User::firstOrCreate([
            'email' => 'member@inua.com'
        ], [
            'name' => 'Member',
            'password' => Hash::make('password'),
            'role_id' => $memberRole?->id,
        ]);
    }
}
