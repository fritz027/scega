<?php

namespace App\Http\Controllers;

use App\Table_Update;
use App\Time_Depo;
use Illuminate\Http\Request;
use App\Member;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberProfileController extends Controller
{
    public function index()
    {

        if (Auth::check()) {

            $checkuser = Auth::user();

            $count = DB::table('member')->where('member_no', $checkuser->member_no)->count();

            if ($count > 0) {

                $users = Auth::user();

                $time_depo = Time_Depo::where('member_no', $users->member_no)->get();

                $tbl_update = Table_Update::all();

                $data = [
                    'users' => $users,
                    'depo' => $time_depo,
                    'tbl_update' => $tbl_update,
                ];

                return view('profile', $data);
            }
            else{
                return view('/profilewithdraw');
            }

            } else {
                return view('/auth/login');
            }


    }

    public function ResetPassword()
    {

    }



}
