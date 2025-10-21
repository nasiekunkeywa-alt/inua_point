<?php

namespace App\Http\Controllers;

use App\Models\LoanVerification;
use Illuminate\Http\Request;

class LoanVerificationController extends Controller
{
    public function index()
    {
        $verifications = LoanVerification::latest()->paginate(20);
        return view('verifications.index', compact('verifications'));
    }

    public function approve(LoanVerification $verification)
    {
        $verification->update(['status' => 'approved']);
        return redirect()->route('verifications.index')->with('success', 'Verification approved.');
    }

    public function reject(LoanVerification $verification)
    {
        $verification->update(['status' => 'rejected']);
        return redirect()->route('verifications.index')->with('success', 'Verification rejected.');
    }
}
