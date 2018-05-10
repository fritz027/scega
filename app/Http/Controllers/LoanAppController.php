<?php

namespace App\Http\Controllers;

use App\CoMaker;
use App\Loan;
use App\Loan_Application;
use App\Mail\LoanApplicationInformation;
use App\Member;
use App\System_Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Loan_Type;
use Illuminate\Support\Facades\DB;
use JavaScript;
use Validator;
use Mail;

class LoanAppController extends Controller
{
    public function ShowLoanApp(){
        If (Auth::Check()){

            $user = Auth::user();

            $loan_types = Loan_Type::all();

            $members = Member::all()->take(30);



            $data =[
                'user' => $user,
                'loan_types' => $loan_types,
                'members' => $members,
                'application' => true,
            ];
            return view('loanapplication',$data);
        }else{
            return redirect()->route('/');
        }
    }
    protected function getloanid(){
        $count = System_Master::where('table_name','LOANAPP')->count();
        if ($count == 0){
                 System_Master::create([
                'table_name' => 'LOANAPP',
                'last_value' => 1,
                 ]);

            $last_value = System_Master::find('LOANAPP');
            $new_val = $last_value->last_value;
            
            return $new_val;
        }else{
            DB::table('sys_mstr')
                   ->where('table_name','LOANAPP')
                   ->update(['last_value'=> DB::raw('last_value+1')]);

            $last_value = System_Master::find('LOANAPP');
            $new_val = $last_value->last_value;
            return $new_val;
                //
        }
    }

    protected function createLoancomaker(array $data){
        $loan_id = 'W'. sprintf("%09s",$this->getloanid());
         Loan_Application::create([
            'loan_id' => $loan_id,
            'member_no' => $data['member_no'],
            'loan_app_date' => $data['date_app'] . ' 00:00:00',
            'loan_type' =>  $data['loan_type'],
            'loan_amount_app' => $data['loan_amount'],
            'loan_purpose' => $data['loan_purpose'],
            'term' => $data['term'],
        ]);
        for ($x = 0; $x < 4; $x++) {
                if ( $data['comaker_id'.$x] != "" ){
                    CoMaker::create([
                        'loan_id' => $loan_id,
                        'comaker_id' => $data['comaker_id'.$x],
                    ]);
                }
        }

        $loan_comaker = CoMaker::Where('loan_id',$loan_id)->get();
        $loan_app   =   Loan_Application::Where('loan_id',$loan_id)->get();

        Mail::to('vandongenfritz@gmail.com')
            ->send(new LoanApplicationInformation($loan_app,$loan_comaker));

        //$app = array_merge($loan_app->toArray(),$loan_comaker->toArray());

//        $datas = [
//            'laon_comaker' => $loan_comaker,
//            'loan_app' => $loan_app,
//        ];

        return $loan_id;
    }
//    protected function createComaker(array $data){
//        return CoMaker::create([
//            'loan_id' => $data['']
//        ]);
//    }
    public function CreateLoanApp(Request $request){
        $this->validator($request->all())->validate();

        $loan_app = $this->createLoancomaker($request->all());




        return redirect()->route('Loan_Rec',[$loan_app]);

    }


    public function GetLoanType(Request $request){

        $loan_type = Loan_Type::find($request->data);

        return response()->json($loan_type);
    }

    public function GetLoanStatus($data){

        $loanapp = Loan_Application::all()->where('member_no',$data);

        $members = Member::find($data);

        //$loan_type = DB::table('loan_type')->where('loan_type',$loanapp->loan_type)->get();

        return view('loanappstatus',['loan_app' => $loanapp,'member' => $members]);
    }

    public function validator(array $data){
        return Validator::make($data, [
           'loan_type' => 'required|not_in:selected',
            'loan_amount' => 'required|numeric',
            'loan_purpose' => 'required|max:255|min:10',
            'comaker_id0' => 'nullable|different:comaker_id1|different:comaker_id2|different:comaker_id3',
            'comaker_id1' => 'nullable|different:comaker_id0|different:comaker_id2|different:comaker_id3',
            'comaker_id2' => 'nullable|different:comaker_id0|different:comaker_id1|different:comaker_id3',
            'comaker_id3' => 'nullable|different:comaker_id0|different:comaker_id2|different:comaker_id1',
        ]);
    }

    public function GetLoanAppRec($id){

        $user = Auth::user();

        $w_loanapp = Loan_Application::find($id);

        $w_comaker = CoMaker::all()->where('loan_id',$id);

        $c_comaker = $w_comaker->count();

        $loan_types = Loan_Type::all();

        $loanapp_type = Loan_Type::find($w_loanapp->loan_type);

        $members = Member::all()->take(30);




        $data =[
            'user' => $user,
            'loan_types' => $loan_types,
            'w_comaker' => $w_comaker,
            'c_comaker' => $c_comaker,
            'w_loanapp' => $w_loanapp,
            'members' => $members,
            'loanapp_types' => $loanapp_type,
            'application' => false,
        ];
        return view('loanapplication',$data);


    }
}
