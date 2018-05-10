<?php

use Illuminate\Database\Seeder;
use App\Deposit_Dtl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Table_Update;
use Carbon\Carbon;
use App\Mail\FileSizeConfirmation;

class deposit_dtlseeder extends Seeder
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
        $this->filename = base_path('EDI/deposit_dtl.csv');
	      $this->uploadfile = base_path('EDI/Uploaded/deposit_dtl.csv');


        if (File::exists($this->filename)) {

          $size = File::size($this->filename);
          $upsize = File::size($this->uploadfile);
          $upsize = $upsize *.8;

          if ($size > $upsize) {

            DB::table('deposit_dtl')->delete();
            try {

                $this->UploadData($this->filename);

                $filepath = base_path('EDI/Uploaded');


                if(!File::exists($filepath)){
                    File::makeDirectory($filepath, 0777, true,true);
                }
                $newpath = $filepath . '/deposit_dtl.csv';
                File::move($this->filename, $newpath);

                $tbl_up = Table_Update::Where('table_name','deposit_dtl')->count();

                if ($tbl_up > 0){
                    DB::table('table_updates')
                        ->where('table_name','deposit_dtl')
                        ->update(['record_date' => Carbon::now()]);
                }else{
                    Table_Update::Create([
                        'table_name' => 'deposit_dtl',
                        'record_date' => Carbon::now(),
                    ]);
                }

            }Catch (Exception $e){
                echo 'Exception Caught: '. $e->getMessage() . "\n";
            }

        }else{
            $update = [
              'filename' => 'Please check FTP for Deposit Detail table insufficient data!',
            ];

            Mail::to('vandongenfritz@gmail.com')
                  ->cc('cxss1963@gmail.com')
                  ->send(new FileSizeConfirmation($update));

              }

          }else{
            $update = [
              'filename' => 'Please check FTP Deposit Detail table was not uploaded!',
            ];

            Mail::to('vandongenfritz@gmail.com')
                  ->cc('cxss1963@gmail.com')
                  ->send(new FileSizeConfirmation($update));
          }


    }

    private function UploadData($filename){
        echo 'Processing Deposit Detail File: ' . $filename . "\n";

        $query = "LOAD DATA LOCAL INFILE '" . $filename . "'
    INTO TABLE deposit_dtl FIELDS TERMINATED BY ','
    OPTIONALLY ENCLOSED BY '\"'
    LINES TERMINATED BY '\r\n'
    IGNORE 0 LINES
        (member_no,
        deposit_type,
        tran_date,
        tran_no,
        tran_type,
        amount,
        clear_date,
        pb_printed,
        paymt_type,
        check_no,
        bank,
        check_dt,
        seq_no,
        curr_balance,
        last_trn_date,
        op_id)";
        DB::connection()->getpdo()->exec($query);

    }
}
