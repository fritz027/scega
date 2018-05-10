@extends('layouts.scega')

@section('content')
<div class="container">
   <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2> Member Profile </h2> </div>

                <div class="panel-body">
                    <div class="form-group">
                        <label for="member_no" class="col-md-3 control-label">Member No</label>

                        <div class="col-md-9">
                            <div class="col-md-9 col-md-pull-1" >
                                <label for="member_no" class="form-control" name="member_no" > {{$users->member_no}} </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="member_name" class="col-md-3 control-label">Member Name</label>

                        <div class="col-md-9">
                            <div class="col-md-9 col-md-pull-1" >
                                <label for="member_name" class="form-control" name="member_name" > {{$users->members->member_name}} </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date-or-birth" class="col-md-3 control-label">Date Of Birth</label>

                        <div class="col-md-9">
                            <div class="col-md-9 col-md-pull-1" >
                               <label for="date-or-birth" class="form-control" name="date-or-birth" > {{$users->members->bdate->toDateString()}} </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">E-mail</label>

                        <div class="col-md-9">
                            <div class="col-md-9 col-md-pull-1" >
                                    <label for="email" class="form-control" name="email" > {{$users->email}} </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telno" class="col-md-3 control-label">Tel No.</label>

                        <div class="col-md-9">
                            <div class="col-md-9 col-md-pull-1" >
                                <label for="telno" class="form-control" name="telno" > {{$users->members->telno}} </label>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($tbl_update as $update)
                    @if($update->table_name == 'member')
                        <span class="btn-success bg-success"> Member Profile As Of : {{ $update->record_date }} </span>
                    @endif
                @endforeach
            </div>
        <div class="panel panel-default">
            <div class="panel-heading">Deposits</div>
            <div class="panel-body">
                @foreach($users->Members_Deposits as $deposit)
                    @if ( $deposit->status == 1 )
                    @foreach($users->Member_DepType($deposit->deposit_type) as $deptype)
						
                        <div class="form-group">
                            <label for="deposit_desc" class="col-md-4 control-label">{{ $deptype->deposit_desc }}</label>
                            <div class="col-md-8">
                                <div class="col-md-9">
                                    <label for="balance" class="form-control text-right" name="{{ $deptype->deposit_desc }}">
                                    {{number_format($deposit->balance,2)}}
                                    </label>
                                </div>
                                <div class="col-md-3 hidden-print">
                                    <button  class="btn btn-primary"  type="button" onclick="window.location='{{ url('/deposit/'. $deposit->deposit_type.'/') }}'">View Ledger</button>
                                </div>
                            </div>
                        </div>
						 @if( $deptype->deposit_type == 300 )
							<span class="badge badge-info" role="alert"> Note: Maintaining Balance of 500 Pesos </span>
						@endif
								
                    @endforeach
                    @endif
                @endforeach
            </div>
            @foreach($tbl_update as $update)
                @if($update->table_name == 'deposit') 
                    <span class="btn-success bg-success"> Deposit Data As Of : {{ $update->record_date }} </span>
                @endif
            @endforeach
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">TIME DEPOSITS</div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-12"></div>
                    <table class="table">
                        <table class="table table-responsive table-striped">
                            <thead class="table-bordered">
                                <tr class="text-primary">
                                    <th>Date</th>
                                    <th>Reference No.</th>
                                    <th>Amount</th>
                                    <th>Term</th>
                                    <th>Maturity</th>
                                    <th>Interest Rate</th>
                                    <th>Certificate No</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($depo as $time_depo)
                                <tr>
                                    <td class="table-bordered">{{$time_depo->dep_date->toDateString()}}</td>
                                    <td class="table-bordered">{{$time_depo->jrnref_no}}</td>
                                    <td class="table-bordered text-right">{{number_format($time_depo->dep_amt,2)}}</td>
                                    <td class="table-bordered text-right">{{$time_depo->term}}</td>
                                    <td class="table-bordered">{{ $maturity = date('Y-m-d', strtotime($time_depo->dep_date . ' + 60 days')) }}</td>
                                    <td class="table-bordered text-right">{{number_format($time_depo->int_rate,5)}}</td>
                                    <td class="table-bordered">{{$time_depo->td_certif_no}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </table>
                </div>
            </div>
            @foreach($tbl_update as $update)
                @if($update->table_name == 'time_depo')
                    <span class="btn-success bg-success"> Time Deposit Data As OF :  {{ $update->record_date }} </span>
                @endif
            @endforeach
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">LOANS</div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-12"></div>
                        <table class="table" >
                            <table  class="table">
                                <thead class="table-bordered">
                                    <tr class="text-primary">
                                        <th>Loan ID</th>
                                        <th>Loan Type</th>
                                        <th>Loan Date</th>
                                        <th>Loan Amount</th>
                                        <th>Payments</th>
                                        <th>Interest</th>
                                        <th>Balance</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users->Member_Loan as $loans)
                                        @if(($loans->loan_amount - $loans->payments) > 0 )
                                            @if ( is_null($loans->loan_types))
                                                <tr>
                                                    <td class="table-bordered">{{ $loans->loan_id  }}</td>
                                                    <td class="table-bordered">{{ $loans->loan_type }}</td>
                                                    <td class="table-bordered">{{ $loans->loan_date->toDateString() }}</td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->loan_amount,2) }}</td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->payments,2) }} </td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->interest,2) }}</td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->loan_amount - $loans->payments + $loans->interest,2) }} </td>
                                                    <td class="table-bordered text-center"></td>

                                                </tr>
                                            @else
                                                <tr ondblclick="window.location='{{ url('/loanprofile/'. $loans->loan_id.'/') }}'">
                                                    <td class="table-bordered">{{ $loans->loan_id  }}</td>
                                                    <td class="table-bordered">{{ $loans->loan_types->loan_desc }}</td>
                                                    <td class="table-bordered">{{ $loans->loan_date->toDateString() }}</td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->loan_amount,2) }}</td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->payments,2) }} </td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->interest,2) }}</td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->loan_amount - $loans->payments + $loans->interest,2) }} </td>
                                                    <td class="table-bordered text-center"> <button  class="btn btn-primary hidden-print"  type="button" onclick="window.location='{{ url('/loanprofile/'. $loans->loan_id.'/') }}'">View Ledger</button></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </table>
                    </div>
                </div>
            @foreach($tbl_update as $update)
                @if($update->table_name == 'loan_payments')
                    <span class="btn-success bg-success"> Loan Payments Data As OF :  {{ $update->record_date }} </span>
                @endif
            @endforeach
           </div>
        </div>
       <div class="col-md-12">
           <div class="panel">
               <div class="panel-body panel-default">
                    <div class="form-group">
                       <div class="col-md-3 text-center">
                            <button class="btn btn-primary hidden-print" type="button" onclick="window.location='{{ url('/changepassword') }}'">Change Password</button>
                        </div>
                       <div class="col-md-3 text-center hidden-print">
                           <button class="btn btn-primary" type="button" onclick="window.location='{{ url('/loanapplication') }}'">Loan Application</button>
                       </div>
                       <div class="col-md-3 text-center hidden-print">
                           <button class="btn btn-primary" type="button" onclick="window.location='{{ url('/loanappstatus/'.$users->member_no.'/') }}'">Loan Application Status</button>
                       </div>
                       <div class="col-md-3 text-center hidden-print">
                           <button class="btn btn-primary" type="button" onclick="window.location='{{ url('/logout') }}'">Logoff</button>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>
</div>

@endsection
