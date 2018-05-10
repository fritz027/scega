<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\User;





Route::get('/', function () {

    if (Auth::check())
    {
        return redirect()->route('profile');
    }
    else
    {
        return view('auth/login');

    }




});

Route::get('/home', function(){

    if (Auth::check())
    {
        return redirect()->route('profile');
    }
    else
    {
        return view('auth/login');
    }
});


Auth::routes();


Route::get('/auth/login','HomeController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register/confirm/{token}', 'Auth\RegisterController@ConfirmEmail');
Route::get('/profilewithdraw', 'MemberProfileController@index')->name('profilewithdraw');

Route::group(['middleware' => 'auth'], function(){


    Route::get('/profile', 'MemberProfileController@index')->name('profile');
    Route::get('/deposit/{dep_type}','MemberDepositsController@ShowDeposits');
    Route::get('/loanprofile/{member_loan}','MemberLoansController@ShowLoans');
    Route::get('/loanapplication','LoanAppController@ShowLoanApp')->name('loan_app');
    Route::post('/loanapplication','LoanAppController@CreateLoanApp')->name('loan_applied');
    Route::get('/getloantype','LoanAppController@GetLoanType');
    Route::get('/loanappstatus/{member_no}','LoanAppController@GetLoanStatus')->name('Loan_Status');
    Route::get('/loanapplication/{loan_id}','LoanAppController@GetLoanAppRec')->name('Loan_Rec');
    Route::get('/changepassword','Auth\ChangepasswordController@index');
    Route::post('/changepassword','Auth\ChangePasswordController@ChangePass')->name('Change_Password');



});


