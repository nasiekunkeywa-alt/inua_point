<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\LoanVerification;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalLoans = Loan::count();
        $pendingVerifications = LoanVerification::where('status', 'pending')->count();
        $totalPayments = LoanPayment::sum('amount');

        return view('dashboard', compact('totalUsers', 'totalLoans', 'pendingVerifications', 'totalPayments'));
    }
}
