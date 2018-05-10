@extends('layouts.scega')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel panel-heading"> <h2> Loan Application </h2> </div>
                <div class="panel-body">
                    <form role="form" method="post" action="{{ url('/loanapplication') }}" id="loanform">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group row {{ $application ? 'hide' : '' }}" >
                                <label for="loan_id" class="col-sm-4 col-form-label text-right">Loan ID:</label>
                                <div class="col-sm-8">
                                    <input id="loan_id_input" type="text" class="form-control" name="loan_id" value="{{ $application ? '' : $w_loanapp->loan_id }}">
                                </div>

                            </div>
                            <div class="form-group row ">
                                <label for="member_no" class="col-sm-4 col-form-label text-right">Member No.</label>
                                <div class="col-sm-8">
                                    <input id="member_no" type="text" class="form-control" name="member_no" value="{{ $user->member_no }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="member_name" class="col-sm-4 col-form-label text-right">Member Name.</label>
                                <div class="col-sm-8">
                                    <input id="member_name" type="text" class="form-control" name="member_name" value="{{ $user->members->member_name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date_app" class="col-sm-4 col-form-label text-right">Application Date</label>
                                <div class="col-sm-8">
                                    <input id="date_app" type="datetime" class="form-control" name="date_app" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('loan_type') ? ' has-error' : '' }}">
                                <label for="loan_type" class="col-sm-4 col-form-label text-right">Loan Type</label>
                                <div class="col-sm-8">
                                    <select name="loan_type" id="loan_type" class="form-control dropdown-toggle">
                                        @if (!$application))
                                             <option value="{{ $loanapp_types->loan_type }}">{{$loanapp_types->loan_desc}}</option>

                                        @else
                                                <option value="selected">SELECT LOAN TYPE</option>
                                            @foreach($loan_types as $loan_type)
                                                <option value="{{ $loan_type->loan_type  }}">{{ $loan_type->loan_desc }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('loan_type'))
                                        <span class="help-block">
                                         <strong>{{ $errors->first('loan_type') }}</strong>
                                     </span>
                                    @endif
                               </div>
                            </div>
                            <div class="form-group row {{  $errors->has('loan_purpose') ? ' has-error' : '' }}">
                                <label for="loan_purpose" class="col-sm-4 col-form-label text-right">Loan Purpose</label>
                                <div class="col-sm-8">
                                    <textarea id="loan_purpose" type="text" class="form-control loan_purpose" name="loan_purpose">{{  !$application ? $w_loanapp->loan_purpose : '' }}</textarea>
                                    @if ($errors->has('loan_purpose'))
                                        <span class="help-block">
                                         <strong>{{ $errors->first('loan_purpose') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row {{  $errors->has('loan_amount') ? ' has-error' : '' }}" >
                                <label for="loan_amount" class="col-sm-4 col-form-label text-right">Loan Amount</label>
                                <div class="col-sm-8">
                                    <input id="loan_amount" type="number" class="form-control" name="loan_amount" value="{{  !$application ? $w_loanapp->loan_amount_app : '' }}">
                                    @if ($errors->has('loan_amount'))
                                        <span class="help-block">
                                         <strong>{{ $errors->first('loan_amount') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="int_rate" class="col-sm-4 col-form-label text-right">Interest Rate</label>
                                <div class="col-sm-8">
                                    <input id="int_rate" type="text" class="form-control" name="int_rate" value="{{  !$application ? $loanapp_types->int_rate : '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="int_type" class="col-sm-4 col-form-label text-right">Inerest Type</label>
                                <div class="col-sm-8">
                                    <input id="int_type" type="text" class="form-control" name="int_type" value="{{  !$application ? $loanapp_types->int_type : '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="term" class="col-sm-4 col-form-label text-right">Term</label>
                                <div class="col-sm-8">
                                    <input id="term" type="text" class="form-control" name="term" value="{{  !$application ? $w_loanapp->term : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row {{ $application ? 'hide' : '' }}" id="status">
                                <label for="status" class="col-sm-3 col-form-label text-right">Status</label>
                                @if (!$application)
                                    <div class="col-sm-9">
                                        <input id="status_input" type="text" class="form-control" name="status" value="{{ $w_loanapp->status === 'N' ? 'New Application' : '' }}">
                                    </div>
                                @endif
                            </div>
                            <div class="container-fluid">
                                <div class="panel-heading text-primary"><h4> COMAKER </h4></div>
                                <div class="table-responsive">
                                    <div class="col-sm-12 row">
                                         <div class="col-sm-4 text-left">
                                             <label class="form-control">ID</label>
                                         </div>
                                         <div class="col-sm-8 text-left">
                                             <label class="form-control">Name</label>
                                         </div>
                                     </div>

                                    @if (!$application)
                                        @foreach($w_comaker as $comaker)
                                            <div class="col-sm-12 row">
                                                <br>
                                                <div class="col-sm-4 text-left">
                                                    <input class="form-control" type="text" readonly value="{{ $comaker->comaker_id }}">
                                                </div>
                                                <div class="col-sm-8 text-left">
                                                    <select class="form-control dropdown-toggle" onchange="Item()">
                                                        <option>{{ $comaker->member_comaker->member_name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @for($x = 0; $x < 4; $x++)
                                            <div class="col-sm-12 row {{ $errors->has('comaker_id'.$x) ? ' has-error' : '' }}">
                                                <br>
                                                <div class="col-sm-4 text-left">
                                                    <input id="comaker_id{{ $x }}" name="comaker_id{{ $x }}" class="form-control {{ $errors->has('comake_id'.$x) ? ' has-error' : '' }}" type="text" readonly>
                                                </div>
                                                <div class="col-sm-8 text-left">
                                                    <select name="comaker{{$x}}"   id="comaker{{$x}}" class="form-control dropdown-toggle" onchange="Item()">
                                                        <option value="">SELECT</option>
                                                        @foreach($members as $member)
                                                            <option value="{{ $member->member_no  }}">{{ $member->member_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if($errors->has('comaker_id'.$x))
                                                    <span class="help-block">
                                                        <strong> {{ $errors->first('comaker_id'.$x) }} </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endfor
                                    @endif
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="col-md-2"></div>
                                <div class="col-md-3 text-center {{ $application ? '' : ' hide' }}" id="for_save">
                                    <button type="submit" class="btn btn-primary mx-auto" id="save">Save</button>
                                </div>
                                <div class="col-md-3 text-center {{ $application ? ' hide' : '' }}" id="for_pp">
                                    <button type="button" class="btn btn-primary mx-auto" id="ppreview">Print Preview</button>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-3 text-center">
                                    <button type="button" class="btn btn-primary mx-auto" onclick="window.location='{{ url('/')}}'">Back</button>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="col-md-4"></div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
//$(document).ready(function(){
//    $('#save').click(function(e){
//        $.ajax({
//           url: 'loanapplication',
//           type: 'POST',
//           data:{member_no:$('#member_no').val(),
//               app_date:$('#date_app').val(),
//               loan_type:$('#loan_type').val(),
//               loan_amount:$('#loan_amount').val(),
//               loan_purpose:$('#loan_purpose').val(),
//               term:$('#term').val(),
//               comaker_id0:$('#comaker_id0').val(),
//               comaker_id1:$('#comaker_id1').val(),
//               comaker_id2:$('#comaker_id2').val(),
//               comaker_id3:$('#comaker_id3').val()},
//            success: function (response) {
//
//                if (!response.success) {
//
//
//
//                } else {
//                    e.preventDefault();
//                    $('div#loan_id').removeClass('hide').addClass('has-success');
//                    $('div#status').removeClass('hide').addClass('has-warning');
//                    response.forEach(function (element) {
//                        $('#loan_id_input').val(element.loan_id);
//                        $('#status_input').val("Pending");
//                        $('div#for_save').addClass('hide');
//                        $('div#for_pp').removeClass('hide');
//                        $('.form-control').prop('readonly', true);
//                        $('.dropdown-toggle').prop('disabled', true);
//                    });
//
//                }
//            }
//
//
//
//        });
//    });
//    $('#ppreview').click(function(e){
//          e.preventDefault();
//          alert('this is a print preview button');
//    });
//});
//    $.ajaxSetup({
//
//        headers: {
//
//            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//
//        }
//
//    });


    $('#loan_type').on('change', function(){
        var $sam  = $('#loan_type').val();

        $.ajax({
            url: 'getloantype',
            type: 'GET',
            data: {data:$sam},
            success: function(response){
                $('#int_rate').val(response.int_rate);
                $('#int_type').val(response.int_type);
                $('#term').val(response.term);
            }
        });
    });

    function Item() {
        for(var x = 0; x < 4; x++){

            var sel= document.getElementById("comaker" + x).value;
            document.getElementById("comaker_id" + x).value = sel;
        }

    }

</script>
@endsection