<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Model::unguard();

 	      $this->call(memberseeder::class);
        $this->call(loanseeder::class);
        $this->call(depositseeder::class);
	      $this->call(deposit_dtlseeder::class);
        $this->call(loan_paymentsseeder::class);
        $this->call(timedepositseeder::class);
    }
}
