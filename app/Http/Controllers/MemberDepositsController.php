<?php
/**
 * Created by PhpStorm.
 * User: Aspire
 * Date: 3/28/2017
 * Time: 10:58 PM
 */

namespace App\Http\Controllers;
use App\Table_Update;
use Illuminate\Http\Request;
use App\Member;
use App\User;
use App\Deposit;
use App\Deposit_Dtl;
use App\Deposit_Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MemberDepositsController extends Controller
{
    public function ShowDeposits($dep_type){


        $users = Auth::user();

        $dtype = Deposit_Type::find($dep_type);

        $deposit = Deposit::where('member_no',$users->member_no)->where('deposit_type',$dep_type)->get();

//        $deposit = DB::table('member')
//                    ->select('member.member_no','member.member_name','deposit_type.deposit_desc','deposit.beg_bal','deposit.beg_bal_dt','deposit.withdrawble','deposit.balance')
//                    ->join('deposit','deposit.member_no','=','member.member_no' )
//                    ->join('deposit_type','deposit_type.deposit_type', '=','deposit.deposit_type')
//                    ->where(['member.member_no' => Auth::user()->member_no])
//                    ->where(['deposit.deposit_type' => $dep_type])
//                    ->get();


//        $deposit_dtl = DB::table('deposit_dtl')
//                        ->where('member_no','=',$users->member_no )
//                        ->where('deposit_type','=',$dep_type)
//                        ->get();

            $deposit_dtl = Deposit_Dtl::where('member_no',$users->member_no)->where('deposit_type',$dep_type)->get();


            $tbl_update = Table_Update::Where('table_name','deposit_dtl')->first();


        $data = [

            'dep' => $deposit,
            'users' => $users,
            'dtype' => $dtype,
            'depdtl' => $deposit_dtl,
            'tbl_update' => $tbl_update,
        ];

        return view('deposit',$data);
}
}