<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;


class LoanApplicationInformation extends Mailable
{
    use Queueable, SerializesModels;


    public $loan_app,$comaker,$data,$member_name;

    public function __construct($loan_app,$comaker)
    {
        $this->loan_app = $loan_app;
        $this->comaker = $comaker;

        foreach ($this->loan_app as $loan_app)
        {
            $member_no = $loan_app->member_no;
            $lt = $loan_app->loan_type;
            $li = $loan_app->loan_id;
            $loan_app_date = $loan_app->loan_app_date;
            $loan_amount = $loan_app->loan_amount_app;
            $lp = $loan_app->loan_purpose;
            $term = $loan_app->term;
            $status = $loan_app->status;


        }

        //$member_name = DB::table('member')->select('member_name')->where('member_no', $member_no)->get();

        $member_name = DB::table('member')->select(DB::raw('member_name'))->where('member_no', $member_no)->get();


        $loan_type = DB::table('loan_type')->select('loan_desc')->where('loan_type', $lt)->get();

        //$status = DB::table('wloan_app')->select('status')->where('loan_id', $li)->get();




        $datas =[
            'loan_id' => $li,
            'loan_type' => $loan_type,
            'member_no' => $member_no,
            'loan_date' => $loan_app_date,
            'loan_type_id' => $li,
            'loan_amount' => $loan_amount,
            'loan_purpose' => $lp,
            'loan_term' => $term,
            'status' => $status,
        ];


            $this->$member_name = $member_name;
            $this->data = $datas;

    }


    public function build()
    {
        return $this->view('emails.LoanApplication');

    }
}
