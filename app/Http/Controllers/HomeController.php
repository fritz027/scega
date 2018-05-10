<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = Member::find(Auth::user()->member_no);

        $data = [
            'member' => $member
        ];
        return view('home',compact('member'));

    }

    public function login()
    {
        return view('auth/login');
    }
}
