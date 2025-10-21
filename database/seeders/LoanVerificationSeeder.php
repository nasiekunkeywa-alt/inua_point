<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\LoanVerification;
use Illuminate\Database\Seeder;

class LoanVerificationSeeder extends Seeder
{
    public function run(): void
    {
        $loans = Loan::take(5)->get();
        foreach ($loans as $index => $loan) {
            LoanVerification::create([
                'loan_id' => $loan->id,
                'verified_by' => null,
                'status' => $index % 2 === 0 ? 'approved' : 'pending',
                'notes' => 'Seeded verification',
            ]);
        }
    }
}
