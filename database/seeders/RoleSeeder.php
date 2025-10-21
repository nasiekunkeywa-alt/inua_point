<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'loan_officer', 'member'];
        foreach ($roles as $r) {
            Role::firstOrCreate(['name' => $r]);
        }
    }
}
