<?php


use App\Loan_Payments;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Table_Update;
use Carbon\Carbon;
use App\Mail\FileSizeConfirmation;

class loan_paymentsseeder extends Seeder
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
        $this->filename = base_path('EDI/loan_payments.csv');
		    $this->uploadfile = base_path('EDI/Uploaded/loan_payments.csv');

        if (File::exists($this->filename)) {

            $size = File::size($this->filename);
            $upsize = File::size($this->uploadfile);
            $upsize = $upsize *.8;

            if ($size > $upsize) {

            DB::table('loan_payments')->delete();
            try {

                $this->UploadData($this->filename);

                $filepath = base_path('EDI/Uploaded');

                if(!File::exists($filepath)){
                    File::makeDirectory($filepath, 0777, true,true);
                }
                $newpath = $filepath . '/loan_payments.csv';
                File::move($this->filename, $newpath);

                $tbl_up = Table_Update::Where('table_name','loan_payments')->count();

                if ($tbl_up > 0){
                    DB::table('table_updates')
                        ->where('table_name','loan_payments')
                        ->update(['record_date' => Carbon::now()]);
                }else{
                    Table_Update::Create([
                        'table_name' => 'loan_payments',
                        'record_date' => Carbon::now(),
                    ]);
                }

            }Catch (Exception $e){
                echo 'Exception Caught: '. $e->getMessage() . "\n";
            }

          }else{
                $update = [
                  'filename' => 'Please check FTP for Loan Payments table insufficient data!',
                ];

                Mail::to('vandongenfritz@gmail.com')
                      ->cc('cxss1963@gmail.com')
                      ->send(new FileSizeConfirmation($update));

                  }

              }else{
                $update = [
                  'filename' => 'Please check FTP Loan Payments table was not uploaded!',
                ];

                Mail::to('vandongenfritz@gmail.com')
                      ->cc('cxss1963@gmail.com')
                      ->send(new FileSizeConfirmation($update));
              }


        }

    private function UploadData($filename){
        echo 'Processing Loan Payments File: ' . $filename . "\n";

        $query = "LOAD DATA LOCAL INFILE '" . $filename . "'
    INTO TABLE loan_payments CHARACTER SET LATIN1 FIELDS TERMINATED BY ','
    OPTIONALLY ENCLOSED BY '\"'
    LINES TERMINATED BY '\r\n'
    IGNORE 0 LINES
        (loan_id,
        tran_date,
        tran_no,
        prin_due,
        int_due,
        fines_due,
        prin_payment,
        int_payment,
        fines_payment,
        pb_printed,
        past_prin_bal,
        past_int_bal,
        past_fines_bal,
        fire_trg,
        last_tran_dt,
        op_id,
        dbt_prin_type,
        paymt_type,
        check_no,
        check_dt,
        clear_dt)";
        DB::connection()->getpdo()->exec($query);
    }

}
