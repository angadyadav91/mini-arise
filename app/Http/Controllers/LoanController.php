<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Loan;
use App\Models\LoanReypayment;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use DB;
use Carbon\Carbon;

class LoanController extends Controller
{
     /**
     * Create loan for customer.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createLoan(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'loan_amount' => 'required',
            'loan_term' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors(), 'status' => 'fail']);
        }

        $data = $request->all();  

        $status = DB::table('statuses')
        ->select('statuses.id')->where('title', 'Pending')->first();
        
        //Inserting new loan record.
        $loan = Loan::create([
            'customer_id' => $data['customer_id'],
            'loan_amount' => $data['loan_amount'],
            'loan_term' => $data['loan_term'],
            'status_id' => $status->id          
        ]);

        $repayment_amount = $data['loan_amount']/$data['loan_term'];

        for($i = 1; $i<=$data['loan_term']; $i++){
            //Inserting new loanrepayment record.
            $scheduledrepayment = LoanReypayment::create([
                'loan_id' => $loan->id,
                'repayment_amount' => $repayment_amount,
                'scheduled_date' => Carbon::now()->addDays($i*7),
                'status_id' => $status->id        
            ]);
        }

        if($loan){         
            return response()->json([
                'status' => 'success',
                'message' => 'Item added into loan'
            ], 201);
        }else{
            return response()->json(['status' => 'fail'],401);
        }
    }
}
