<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class Db_Refresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Custom:Database_Refresh';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refesh Datas on each Tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle(){
        Artisan::call('db:seed',['--class' => 'DatabaseSeeder']);
    }

    /* public function handle()
    {
        $tables = $this->getTableName();
        foreach ($tables as $table){

            $table_name = $table->Tables_in_scegacoo_db;
            $filename = base_path('EDI/'. $table_name . '.csv' );

            IF (File::exists($filename)){
		if ($table_name == 'loan') {
	               Artisan::call('db:seed',['--class' => 'loanseeder']);
		}else{
                      $this->info('dli ni loan');
                }
               $this->info('Refreshing ' . $table_name . ' records.');
		//File::delete($filename);
            }else{
                $this->info('No data Found on '. $table_name .'.');
            }
        }

    }

    public function getTableName(){
        $table_name = DB::select("SHOW TABLES");

        return $table_name;
    }
    */
}
