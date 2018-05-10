<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ConfirmationEmail;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {



        $messages = [
            'member_no.exists' => 'Member No. Doe\'s not exist on our records',
            'member_no.required' => 'Member No Required!',
            'member_no.max' => 'Member Not be greater than 30 characters',
            'name.exists' => 'Name not found',


        ];


        $name = $data['name'];
        $name = trim($name);
        $data['name'] = ($name);

        $validator =  Validator::make($data,[
            'member_no' => 'required|max:30|unique:users|exists:member',
            'name' => 'required|max:255|exists:member,member_name',
            'date-of-birth' =>  'required|date|date_format:Y-m-d|exists:member,bdate',
            'email' => 'required|email|max:255|unique:users|confirmed',
            'password' => 'required|min:6|confirmed',

        ],$messages);

         return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'member_no' => $data['member_no'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }



    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Mail::to($user->email)->send(new ConfirmationEmail($user));

        return redirect('login')->with('status','Please confirm your email address.');
    }

    public function ConfirmEmail($token)
    {

        User::whereToken($token)->firstOrFail()->hasVerified();

        return redirect('login')->with('status','Your account is already activated. Please Login.');

    }

}
