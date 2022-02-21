<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'customer_id', 'loan_amount', 'loan_term', 'status_id'
    ];
}
