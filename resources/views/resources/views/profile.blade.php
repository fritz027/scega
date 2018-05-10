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
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Deposits</div>
                <div class="panel-body">	
                @foreach($users->Members_Deposits as $deposit)
                    @if ( $deposit->status = 1 )
                        @foreach($users->Member_DepType($deposit->deposit_type) as $deptype)
                            <div class="form-group">
                                <label for="deposit_desc" class="col-md-4 control-label">{{ $deptype->deposit_desc }}</label>
                                 <div class="col-md-8">
                                    <div class="col-md-9">
                                        <label for="balance" class="form-control text-right" name="{{ $deptype->deposit_desc }}">
                                        {{number_format($deposit->balance,2)}}
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <button  class="btn btn-primary"  type="button" onclick="window.location='{{ url('/deposit/'. $deposit->deposit_type.'/') }}'">View Ledger</button>
                                    </div>
                                </div>

                             </div>
                        @endforeach
                    @endif
                @endforeach
			
                </div>
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
                                                <tr ondblclick="window.location='{{ url('/loan/'. $loans->loan_id.'/') }}'">
                                                    <td class="table-bordered">{{ $loans->loan_id  }}</td>
                                                    <td class="table-bordered">{{ $loans->loan_types->loan_desc }}</td>
                                                    <td class="table-bordered">{{ $loans->loan_date->toDateString() }}</td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->loan_amount,2) }}</td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->payments,2) }} </td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->interest,2) }}</td>
                                                    <td class="table-bordered text-right">{{ number_format($loans->loan_amount - $loans->payments + $loans->interest,2) }} </td>
                                                    <td> <button  class="btn btn-primary"  type="button" onclick="window.location='{{ url('/loanprofile/'. $loans->loan_id.'/') }}'">View Ledger</button></td>
							
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </table>
                        </div>
                    </div>
               </div>
            </div>
        </div>
      </div>
</div>
@endsection
