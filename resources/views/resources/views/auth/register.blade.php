@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>


                    @include('status.flash');

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}
                            {{--Member Number Field--}}
                            <div class="form-group{{ $errors->has('member_no') ? ' has-error' : '' }}">
                                <label for="member_no" class="col-md-4 control-label">Member No</label>

                                <div class="col-md-6">
                                    <input id="member_no" type="text" class="form-control" name="member_no" value="{{ old('member_no') }}">

                                    @if ($errors->has('member_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('member_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Member Name Field--}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Date of Birth Field--}}
                            <div class="form-group{{ $errors->has('date-of-birth') ? ' has-error' : '' }}">
                                <label for="date-of-birth" class="col-md-4 control-label">Date of Birth</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input class="form-control" id="date-of-birth" name="date-of-birth" placeholder="YYYY/MM/DD" type="date"/>

                                        @if ($errors->has('date-of-birth'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('date-of-birth') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            {{--Password Field--}}
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Password Confirmation Field--}}
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Member Email Field--}}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Email Confirmation Field--}}
                            <div class="form-group{{ $errors->has('email_confirmation') ? ' has-error' : '' }}">
                                <label for="email-confirm" class="col-md-4 control-label">Confirm E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email-confirm" type="email" class="form-control" name="email_confirmation">

                                    @if ($errors->has('email_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
