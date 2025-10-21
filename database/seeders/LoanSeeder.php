<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        $members = User::whereHas('role', function ($q) { $q->where('name', 'member'); })->get();
        if ($members->isEmpty()) {
            return;
        }

        foreach ($members as $member) {
            for ($i = 0; $i < 2; $i++) {
                Loan::create([
                    'user_id' => $member->id,
                    'amount' => rand(1000, 10000),
                    'term' => '6 months',
                    'status' => 'active',
                ]);
            }
        }
    }
}
