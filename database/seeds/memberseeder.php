<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Table_Update;
use Carbon\Carbon;
use App\Mail\FileSizeConfirmation;

class memberseeder extends Seeder
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
        $this->filename =  base_path('EDI/member.csv');
		    $this->uploadfile = base_path('EDI/Uploaded/member.csv');

        if (File::exists($this->filename)) {

          $size = File::size($this->filename);
          $upsize = File::size($this->uploadfile);
          $upsize = $upsize * .8;

          if ($size > $upsize) {

            DB::table('member')->delete();
            try {

                $this->UploadData($this->filename);

                $filepath = base_path('EDI/Uploaded');


                if(!File::exists($filepath)){
                    File::makeDirectory($filepath, 0777, true,true);
                }
                $newpath = $filepath . '/member.csv';
                File::move($this->filename, $newpath);

                $tbl_up = Table_Update::Where('table_name','member')->count();

                if ($tbl_up > 0){
                    DB::table('table_updates')
                        ->where('table_name','member')
                        ->update(['record_date' => Carbon::now()]);
                }else{
                    Table_Update::Create([
                        'table_name' => 'member',
                        'record_date' => Carbon::now(),
                    ]);
                }

            }Catch (Exception $e){
                echo 'Exception Caught: '. $e->getMessage() . "\n";
            }

          }else{
                $update = [
                  'filename' => 'Please check FTP for Members table insufficient data!',
                ];

                Mail::to('vandongenfritz@gmail.com')
                      ->cc('cxss1963@gmail.com')
                      ->send(new FileSizeConfirmation($update));

                  }

              }else{
                $update = [
                  'filename' => 'Please check FTP Members table was not uploaded!',
                ];

                Mail::to('vandongenfritz@gmail.com')
                      ->cc('cxss1963@gmail.com')
                      ->send(new FileSizeConfirmation($update));
              }


        }
    private function UploadData($filename){
        echo 'Processing Members File: ' . $filename . "\n";

        $query = "LOAD DATA LOCAL INFILE '" . $filename . "'
    INTO TABLE member
    CHARACTER SET LATIN1
    FIELDS TERMINATED BY ','
    OPTIONALLY ENCLOSED BY '\"'
    LINES TERMINATED BY '\r\n'
    IGNORE 0 LINES
        (member_no,
        member_name,
        nick_name,
        member_type,
        assoc_type,
        bdate,
        birth_place,
        addr_street1,
        addr_street2,
        zipcode,
        telno,
        email,
        gender,
        height,
        weight,
        civ_stat,
        spouse,
        sps_bdate,
        membership_date,
        membership_wdr_date,
        death_date,
        cause_of_death,
        mbr_rem,
        religion,
        blood_type,
        chapter,
        mbr_status,
        mbr_class,
        ctc_no,
        issued_on,
        issued_at,
        op_id,
        bank_acct_no,
        mbr_emp_no,
        mbr_tin_no,
        soa_nofnot,
        soa_coltrl,
        last_ws,
        last_user,
        last_update,
        active_date)";
        DB::connection()->getpdo()->exec($query);

    }
}
