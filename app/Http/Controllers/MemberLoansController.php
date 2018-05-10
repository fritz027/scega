<?php

namespace App\Http\Controllers;
use App\User;
use App\Loan_Payments;
use App\Loan;
use App\Loan_Type;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberLoansController extends Controller
{
    public function ShowLoans($loan){



      $loan_payments = DB::table('loan_payments')->where('loan_id', $loan)->get();

        $loans = Loan::find($loan);

        $users =  Auth::user();

        $loan_type = Loan_Type::findOrFail($loans->loan_type);
            $data = [

                'users' => $users,
                'loan_payments' => $loan_payments,
                'loan_type' => $loan_type,
                'loans' => $loans,
            ];

        return view('loanprofile',$data);

    }
}
