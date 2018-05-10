@extends('layouts.scega')

@section('content')
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Loan Application Status</h2></div>
                    <div class="panel-body">
                        <div class="form-group col-md-12">
                            <label for="member_no" class="col-md-2 control-label text-right"><strong>Member No.:</strong></label>
                            <div class="col-md-10">
                                <label id="member_no" class="control-label" name="member_no">{{$member->member_no}}</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="member_name" class="col-md-2 control-label text-right"><strong>Member Name</strong>(Last,First MI):</label>
                            <div class="col-md-10">
                                <label id="member_name" class="control-label" name="member_name">{{ $member->member_name  }}</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="loan_table">
                                    <thead>
                                        <tr>
                                            <th onclick="sortTable(0)">Reference No</th>
                                            <th onclick="sortTable(1)">Application Date</th>
                                            <th onclick="sortTable(2)">Loan Type</th>
                                            <th onclick="sortTable(3)">Loan Purpose</th>
                                            <th onclick="sortTable(4)">Loan Amount</th>
                                            <th onclick="sortTable(5)">status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($loan_app as $loan)
                                            <tr id="{{ $loan->loan_id }}">
                                                <td>{{ $loan->loan_id }}</td>
                                                <td>{{ $loan->loan_app_date->toDateString() }}</td>
                                                <td>{{ $loan->loan_types->loan_desc }}</td>
                                                <td>{{ $loan->loan_purpose }}</td>
                                                <td>{{ $loan->loan_amount_app }}</td>
                                                @if($loan->status === 'N')
                                                    <td>New Application</td>
                                                @elseif($loan->status === 'O')
                                                    <td>On Process</td>
                                                @elseif($loan->status === 'A')
                                                    <td>Approved</td>
                                                @elseif($loan->status === 'D')
                                                    <td>Disapproved</td>
                                                @elseif($loan->status === 'R')
                                                    <td>Released</td>
                                                @else
                                                    <td>Cancelled</td>
                                                @endif
                                                <td><button class="btn btn-primary" type="button">Status Hist</button> <div class="col-sm-2"></div> <button class="btn btn-primary" type="button" onclick="window.location='{{ url('/loanapplication/'.$loan->loan_id) }}'">View Dtls</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group col-md-12 text-center">
                            <button class="btn btn-primary" type="button" onclick="window.location='{{ url('/') }}'">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("loan_table");
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.getElementsByTagName("TR");
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch= true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch= true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>



@endsection