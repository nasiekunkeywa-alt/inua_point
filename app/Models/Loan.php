<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    // Minimal fillable fields; adjust as needed for your domain
    protected $fillable = ['user_id', 'amount', 'term', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
