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

class CustomerController extends Controller
{

    public function getLoanbyUserid(Request $request)
    {
        
        $allloan = DB::table('loans')
        ->select('loans.*', 'statuses.title as status')
        ->join('statuses', 'loans.status_id', '=', 'statuses.id')
        ->where(['loans.customer_id' => $request->customer_id])->get();


        $cartlistResponse = [];
        $sumoftokenamount = 0;

        foreach($allloan as $loan)
        {
            $scheduledrepayment = DB::table('loan_reypayments')
                ->select('loan_reypayments.*', 'statuses.title as status')
                ->join('statuses', 'loan_reypayments.status_id', '=', 'statuses.id')
                ->where(['loan_reypayments.loan_id' => $loan->id])->get();
            

            $loanlistResponse[] = [
                'loandetails' => collect($loan)->toArray(),
                'reypaymentdetails' => collect($scheduledrepayment)->toArray()
            ];

        
        }

        if(count($loanlistResponse) > 0){            
            return response()->json([
                'status' => 'success',
                'message' => 'User loans details',
                'loanlist' => $loanlistResponse
            ], 201);
        }else{          

            return response()->json([
                'status' => 'fail',
                'message' => 'No record found'
            ], 201);
        }

    }


    public function addRepaymentbyId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'repayment_id' => 'required',
            'amount' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors(), 'status' => 'fail']);
        }

        $data = $request->all();  
        //dd($data['repayment_amount']);


        //Fetching status ID here
        $status = DB::table('statuses')
        ->select('statuses.id')->where('title', 'Paid')->first();
        
        $loanrepayment = LoanReypayment::where(['id' => $data['repayment_id']])->first();

        if ($loanrepayment !== null  && (floatval($data['amount']) >= $loanrepayment->repayment_amount) ) {

            $reypayment = LoanReypayment::find($loanrepayment->id);
            $reypayment->status_id = $status->id;
            $reypayment->save();   
            
            //Here getting PENDING  status ID
            $pendingstatus = DB::table('statuses')
            ->select('statuses.id')->where('title', 'Pending')->first();

            if (LoanReypayment::where(['loan_id' => $loanrepayment->loan_id, 'status_id' => $pendingstatus->id])->count() == 0) {
                $loan = Loan::find($loanrepayment->loan_id);
                $loan->status_id = $status->id;
                $loan->save(); 
             }
            
            return response()->json([
                'status' => 'success',
                'message' => 'Loan repayment done'
            ], 201);
        }else {
            return response()->json([
                "message" => "Not a legal repayment"
            ], 404);
            
        }
    }


}
