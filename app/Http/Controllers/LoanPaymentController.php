<?php

namespace App\Http\Controllers;

use App\Models\LoanPayment;
use Illuminate\Http\Request;

class LoanPaymentController extends Controller
{
    public function index()
    {
        $payments = LoanPayment::latest()->paginate(20);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'loan_id' => 'required|integer',
            'amount' => 'required|numeric',
            'paid_at' => 'nullable|date',
            'method' => 'nullable|string',
        ]);

        LoanPayment::create($data);
        return redirect()->route('payments.index')->with('success', 'Payment recorded.');
    }
}
