<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Loan;
use Illuminate\Support\Facades\File;
use App\Table_Update;
use Carbon\Carbon;
use App\Mail\FileSizeConfirmation;

class loanseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $filename;
    protected $uploadfile;

    public function run()
    {
        $this->filename = base_path('EDI/loan.csv');
        $this->uploadfile = base_path('EDI/Uploaded/loan.csv');


        if (File::exists($this->filename)) {

          $size = File::size($this->filename);
          $upsize = File::size($this->uploadfile);
          $upsize = $upsize *.8;

          if ($size > $upsize) {


            DB::table('loan')->delete();
            try {

                $this->UploadData($this->filename);

                $filepath = base_path('EDI/Uploaded');


                if(!File::exists($filepath)){
                    File::makeDirectory($filepath, 0777, true,true);
                }
                $newpath = $filepath . '/loan.csv';
                File::move($this->filename, $newpath);

                $tbl_up = Table_Update::Where('table_name','loan')->count();

                if ($tbl_up > 0){
                    DB::table('table_updates')
                        ->where('table_name','loan')
                        ->update(['record_date' => Carbon::now()]);
                }else{
                    Table_Update::Create([
                        'table_name' => 'loan',
                        'record_date' => Carbon::now(),
                    ]);
                }

            }Catch (Exception $e){
                echo 'Exception Caught: '. $e->getMessage() . "\n";
            }

          }else{
                $update = [
                  'filename' => 'Please check FTP for Loan table insufficient data!',
                ];

                Mail::to('vandongenfritz@gmail.com')
                      ->cc('cxss1963@gmail.com')
                      ->send(new FileSizeConfirmation($update));

                  }

              }else{
                $update = [
                  'filename' => 'Please check FTP Loan table was not uploaded!',
                ];

                Mail::to('vandongenfritz@gmail.com')
                      ->cc('cxss1963@gmail.com')
                      ->send(new FileSizeConfirmation($update));
              }


        }

    private function UploadData($filename){
        echo 'Processing Loan File: ' . $filename . "\n";

        $query = "LOAD DATA LOCAL INFILE '" . $filename . "'
    INTO TABLE loan FIELDS TERMINATED BY ','
    OPTIONALLY ENCLOSED BY '\"'
    LINES TERMINATED BY '\r\n'
    IGNORE 0 LINES
        ( loan_id,
        member_no,
        loan_date,
        loan_type,
        loan_amount,
        term,
        int_rate,
        status,
        loan_vchno,
        interest,
        fines,
        payments,
        last_tran_dt,
        pb_lineno,
        installment_type,
        service_fee,
        add_on_flag,
        add_on_pert,
        int_type,
        overdue_comptd,
        class_code,
        req_crdt_chk,
        prepaid_int,
        collector,
        add_on_sva,
        ins_prem,
        taxes_prem,
        doc_stamp,
        notrl_fee,
        op_id,
        dday_colmn,
        sched_lamt,
        int_factor,
        no_of_payments,
        start_dt,
        cdt_status,
        prepaid_prin,
        filling_fee,
        last_ws,
        last_user,
        last_update,
        active_date,
        cisa_payment_method,
        cisa_collateral)";
        DB::connection()->getpdo()->exec($query);


    }
}
