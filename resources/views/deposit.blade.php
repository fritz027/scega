@extends('layouts.scega')

@section('content')

<div class="container">
    <div class="row" >
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Member Deposit Profile</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="member_no" class="col-md-3 control-label">Member No: </label>
                        <div class="col-md-9">
                            <div class="col-md-9 col-md-pull-1" >
                                    <label for="member_no" class="form-control"> {{$users->member_no}} </label>
                            </div>
                        </div>
                    </div>

					
                    <div class="form-group">
                        <label for="member_name" class="col-md-3 control-label">Name (Last, First MI): </label>
                        <div class="col-md-9">
                            <div class="col-md-9 col-md-pull-1" >
                                <label for="member_name" class="form-control"> {{$users->name}} </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group spacer-body">
                        <div class="h4 col-md-6 text-primary"> {{ $dtype->deposit_desc}} </div>
                        <div class="h4 col-md-6">
                            <label class="col-md-3 text-right text-primary"> Balance:   </label>
                           <label class="col-md-3 text-right" >
                                @foreach($dep as $deposit)
                                    {{number_format($deposit->balance,2)}}
                                @endforeach
                           </label>
                        </div>
                        <div class="panel-group">
                            <div class="col-md-11">
                                <table class="table table-bordered table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Reference</th>
                                            <th>Withdrawal</th>
                                            <th>Deposit</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        <tr>

                                            @foreach($dep as $deposit)
                                                <td>{{ $deposit->beg_bal_dt->toDateString() }}</td>
                                                <td>{{ "Beginning Balance" }}</td>
                                                <td class="text-right">{{ number_format(0,2) }}</td>
                                                <td class="text-right">{{ number_format(0,2) }}</td>
                                                <td class="text-right">{{ number_format($deposit->beg_bal,2) }}</td>
                                                <p class="hide"> {{ $bal = $deposit->beg_bal   }} </p>
                                            @endforeach
                                        </tr>

                                    @foreach($depdtl as $deposit_dtl)
                                        <tr>
                                            <td>{{ $deposit_dtl->tran_date->toDateString() }}</td>
                                            <td>{{ $deposit_dtl->tran_no }}</td>
                                            @if($deposit_dtl->tran_type == 'W')
                                                <td class="text-right">{{ number_format($deposit_dtl->amount,2) }}</td>
                                                <td class="text-right">{{ number_format(0,2) }}</td>
                                                <p class="hide"> {{ $bal = $bal - $deposit_dtl->amount }} </p>
                                            @else
                                                <td class="text-right"> {{ number_format(0,2) }}</td>
                                                <td class="text-right">{{ number_format($deposit_dtl->amount,2) }}</td>
                                                <p class="hide"> {{ $bal = $bal + $deposit_dtl->amount }} </p>
                                            @endif
                                                <td class="text-right"> {{ number_format($bal,2) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-1 for-bckbtn">
                                <button  class="btn btn-primary bck-button"  type="button" onclick="window.location='{{ url('/')}}'">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span class="btn-success bg-success"> Deposit Details As Of : {{ $tbl_update->record_date }} </span>
</div>


@endsection
