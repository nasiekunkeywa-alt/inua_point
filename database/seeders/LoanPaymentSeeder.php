<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\LoanPayment;
use Illuminate\Database\Seeder;

class LoanPaymentSeeder extends Seeder
{
    public function run(): void
    {
        $loans = Loan::all();
        foreach ($loans as $loan) {
            $payments = rand(1, 3);
            for ($i = 0; $i < $payments; $i++) {
                LoanPayment::create([
                    'loan_id' => $loan->id,
                    'amount' => rand(100, 1000),
                    'paid_at' => now()->subDays(rand(0, 30)),
                    'method' => 'cash',
                ]);
            }
        }
    }
}
