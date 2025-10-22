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
        $officer = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'loan_officer'))->first();
        foreach ($loans as $index => $loan) {
            LoanVerification::create([
                'loan_id' => $loan->id,
                'officer_id' => $officer?->id,
                'remarks' => $index % 2 === 0 ? 'approved by seeder' : 'pending verification',
                'verification_photos' => null,
            ]);
        }
    }
}
