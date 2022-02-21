<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanReypayment;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    
    public function updateStatus(Request $request, $id)
    {
        $status = DB::table('statuses')
        ->select('statuses.id')->where('title', 'Paid')->first();
        if (Loan::where('id', $id)->exists()) {
            $loan = Loan::find($id);
            $loan->status_id = $status->id;
            $loan->save();         
            return response()->json([
                'status' => 'success',
                'message' => 'Loan approved successfully'
            ], 201);
        }else {
            return response()->json([
                "message" => "Loan not found in records"
            ], 404);
            
        }
    }


}
