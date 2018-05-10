<?php

use App\Deposit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Table_Update;
use Carbon\Carbon;
use App\Mail\FileSizeConfirmation;

class depositseeder extends Seeder
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
       $this->filename = base_path('EDI/deposit.csv');
	     $this->uploadfile = base_path('EDI/Uploaded/deposit.csv');

        if (File::exists($this->filename)) {

          $size = File::size($this->filename);
          $upsize = File::size($this->uploadfile);
          $upsize = $upsize *.8;

          if ($size > $upsize) {

            DB::table('deposit')->delete();
            try {

                $this->UploadData($this->filename);

                $filepath = base_path('EDI/Uploaded');



                if(!File::exists($filepath)){
                    File::makeDirectory($filepath, 0777, true,true);
                }
                $newpath = $filepath . '/deposit.csv';
                File::move($this->filename, $newpath);

                $tbl_up = Table_Update::Where('table_name','deposit')->count();

                if ($tbl_up > 0){
                    DB::table('table_updates')
                        ->where('table_name','deposit')
                        ->update(['record_date' => Carbon::now()]);
                }else{
                    Table_Update::Create([
                        'table_name' => 'deposit',
                        'record_date' => Carbon::now(),
                    ]);
                }

            }Catch (Exception $e){
                echo 'Exception Caught: '. $e->getMessage() . "\n";
            }
          }else{
                $update = [
                  'filename' => 'Please check FTP for Deposit table insufficient data!',
                ];

                Mail::to('vandongenfritz@gmail.com')
                      ->cc('cxss1963@gmail.com')
                      ->send(new FileSizeConfirmation($update));

                  }

              }else{
                $update = [
                  'filename' => 'Please check FTP Deposit table was not uploaded!',
                ];

                Mail::to('vandongenfritz@gmail.com')
                      ->cc('cxss1963@gmail.com')
                      ->send(new FileSizeConfirmation($update));
              }


        }
    private function UploadData($filename){
        echo 'Processing Deposit File: ' . $filename . "\n";

        $query = "LOAD DATA LOCAL INFILE '" . $filename . "'
    INTO TABLE deposit FIELDS TERMINATED BY ','
    OPTIONALLY ENCLOSED BY '\"'
    LINES TERMINATED BY '\n'
    IGNORE 0 LINES
        (member_no,
        deposit_type,
        beg_bal,
        beg_bal_dt,
        balance,
        withdrawble,
        last_trn_date,
        pb_lineno,
        status,
        op_id,
        min_amt,
        max_amt,
        coltrl_amt,
        serial_no,
        last_ws,
        last_user,
        last_update,
        active_date)";
        DB::connection()->getpdo()->exec($query);


    }
}
