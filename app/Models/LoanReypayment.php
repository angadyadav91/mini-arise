<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanReypayment extends Model
{
    protected $fillable = [
        'loan_id', 'repayment_amount', 'scheduled_date', 'status_id'
    ];
}
