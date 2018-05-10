<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Table_Update;
use Carbon\Carbon;
use App\Mail\FileSizeConfirmation;

class timedepositseeder extends Seeder
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
        $this->filename = base_path('EDI/time.csv');
		    $this->uploadfile = base_path('EDI/Uploaded/time.csv');

        if (File::exists($this->filename)) {

          $size = File::size($this->filename);
          $upsize = File::size($this->uploadfile);
          $upsize = $upsize * .8;

          if ($size > $upsize) {

            DB::table('time_depo')->delete();
            try {

                $this->UploadData($this->filename);

                $filepath = base_path('EDI/Uploaded');

                if(!File::exists($filepath)){
                    File::makeDirectory($filepath, 0777, true,true);
                }
                $newpath = $filepath . '/time.csv';
                File::move($this->filename, $newpath);

                $tbl_up = Table_Update::Where('table_name','time_depo')->count();

                if ($tbl_up > 0){
                    DB::table('table_updates')
                        ->where('table_name','time_depo')
                        ->update(['record_date' => Carbon::now()]);
                }else{
                    Table_Update::Create([
                        'table_name' => 'time_depo',
                        'record_date' => Carbon::now(),
                    ]);
                }

            }Catch (Exception $e){
                echo 'Exception Caught: '. $e->getMessage() . "\n";
            }

          }else{
                $update = [
                  'filename' => 'Please check FTP for Time Deposit table insufficient data!',
                ];

                Mail::to('vandongenfritz@gmail.com')
                      ->cc('cxss1963@gmail.com')
                      ->send(new FileSizeConfirmation($update));

                  }

              }else{
                $update = [
                  'filename' => 'Please check FTP Loan Time Deposit was not uploaded!',
                ];

                Mail::to('vandongenfritz@gmail.com')
                      ->cc('cxss1963@gmail.com')
                      ->send(new FileSizeConfirmation($update));
              }


        }

    private function UploadData($filename){
        echo 'Processing Time Deposit File: ' . $filename . "\n";

        $query = "LOAD DATA LOCAL INFILE '" . $filename . "'
    INTO TABLE time_depo FIELDS TERMINATED BY ','
    OPTIONALLY ENCLOSED BY '\"'
    LINES TERMINATED BY '\r\n'
    IGNORE 0 LINES
        (jrnref_no,
	member_no,
	dep_date,
	term,
	due_date,
	dep_amt,
	int_rate,
	open_status,
	term_status,
	td_certif_no,
	sl_code2,
	dm_cm_amt,
	ref_jrnref_no,
	op_id,
	term_dt,
	acct_code,
	coltrl_amt,
	last_ws,
	last_user,
	last_update,
	active_date)";
        DB::connection()->getpdo()->exec($query);


    }
}
