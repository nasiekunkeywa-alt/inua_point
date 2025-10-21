<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            \Database\Seeders\RoleSeeder::class,
            \Database\Seeders\UserSeeder::class,
            \Database\Seeders\LoanSeeder::class,
            \Database\Seeders\LoanPaymentSeeder::class,
            \Database\Seeders\LoanVerificationSeeder::class,
        ]);
    }
}
