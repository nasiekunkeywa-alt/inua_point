<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::latest()->paginate(15);
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        return view('loans.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'amount' => 'required|numeric',
            'term' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        Loan::create($data);
        return redirect()->route('loans.index')->with('success', 'Loan created.');
    }

    public function edit(Loan $loan)
    {
        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, Loan $loan)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'amount' => 'required|numeric',
            'term' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $loan->update($data);
        return redirect()->route('loans.index')->with('success', 'Loan updated.');
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Loan deleted.');
    }
}
