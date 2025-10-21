<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanVerification extends Model
{
    // Minimal fillable fields; adjust as needed for your domain
    protected $fillable = ['loan_id', 'verified_by', 'status', 'notes'];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
