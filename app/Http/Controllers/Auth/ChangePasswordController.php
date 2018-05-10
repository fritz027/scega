<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;


class ChangePasswordController extends Controller
{
    public function ChangePass(Request $request){
        $this->validator($request->all())->validate();

        $user = User::find(Auth::id());

        $hpass = $user->password;

        if (Hash::check($request->old_password, $hpass)){
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            $request->session()->flash('Success','Your Password Has been changed.');
            return back();
        }else{
            $request->session()->flash('Error','There is an error please input your password carefully');
            return back();
        }

    }

    public function index(){
        $user = Auth::user();

        return view('auth.passwords.changepassword',['user' => $user]);
    }

    protected function validator(array $data){

        $user = Auth::user();

        $mesasge = [
          'hash' => 'Incorrect Password',
            'old_password.required' => 'Please Input Current Password',
            'new_password.required' => 'Please Input new password',
            'new_password.min' => 'Password must be at least 8 characters',
            'new_password.different' => 'New password must not be the same on your current password',
            'new_password.confirmed' => 'Password Confirmation is not the same,'

        ];

        return Validator::make($data,[
           'old_password' => 'required|hash:'. $user->password,
            'new_password' => 'required|min:8|different:old_password|confirmed'
        ],$mesasge);

    }
}
