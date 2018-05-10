@extends('layouts.scega')

@section('content')
    <div class="container">
        <div class="row" >
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Member Loan Ledger</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="member_no" class="col-md-3 control-label">Member No: </label>
                            <div class="col-md-9">
                                <div class="col-md-12 col-md-pull-1" >
                                    <label for="member_no" class="control-label form-control"> {{$users->member_no }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="member_name" class="col-md-3 control-label">Name (Last, First MI): </label>
                            <div class="col-md-9">
                                <div class="col-md-12 col-md-pull-1" >
                                    <label for="member_name" class="control-label form-control"> {{ $users->name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-md-12">
                            <label class="col-md-2 control-label h3 text-primary"> Loan Type:   </label>
                            <label class="col-md-5 control-label h3 text-primary">   {{$loan_type->loan_desc}} </label>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-4 control-label">
                                <label class="col-md-5 text-info">Loan Amount:</label>
                                <label class="col-sm-4 table-bordered text-info text-right" > {{ number_format($loans->loan_amount,2)  }}</label>
                            </div>
                            <div class="col-md-4 control-label">
                                <label class="col-md-5 text-info"> Loan Date: </label>
                                <label class="col-sm-4 table-bordered text-info"> {{$loans->loan_date->toDateString()}} </label>
                             </div>
                            <div class="col-md-4 control-label">
                                <label class="col-md-5 text-info"> Balance: </label>
                                <label class="col-sm-4 table-bordered text-info text-right"> {{ number_format(($loans->loan_amount + $loans->interest + $loans->fines) - $loans->payments,2) }}</label>

                            </div>
                        </div>
                        <div class="panel-group">
                            <div class="col-md-11">
                                <div class="hide"> {{ $var= 0  }} </div>
                                <table class="table">
                                    <table class="table table-bordered table-responsive table-striped">
                                        <thead>
                                            <tr>
                                                <td class="text-primary h3 ">Date</td>
                                                <td class="text-primary h3 ">Reference</td>
                                                <td class="text-primary h3 ">Principal</td>
                                                <td class="text-primary h3 ">Interest</td>
                                                <td class="text-primary h3 ">Fines</td>
                                                <td class="text-primary h3 ">Balance</td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($loan_payments as $loan_payment)
                                            <tr>
                                                <td>{{$loan_payment->tran_date->toDateString()}}</td>
                                                <td>{{$loan_payment->tran_no}}</td>
                                                <td class="text-right">{{number_format($loan_payment->prin_payment,2)}}</td>
                                                <td class="text-right">{{number_format($loan_payment->int_payment,2)}}</td>
                                                <td class="text-right">{{number_format($loan_payment->fines_payment,2)}}</td>

                                                <p class="hide"> {{ $var = $var + $loan_payment->prin_payment - $loan_payment->int_payment}}</p>


                                                <td class="text-right">{{ number_format($loans->loan_amount - $var,2) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </table>
                            </div>
                            <div class="col-md-1 for-bckbtn">
                                <button  class="btn btn-primary bck-button"  type="button" onclick="window.location='{{ URL::previous() }}'">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
