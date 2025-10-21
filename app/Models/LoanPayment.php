<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    // Minimal fillable fields; adjust as needed for your domain
    protected $fillable = ['loan_id', 'amount', 'paid_at', 'method'];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
