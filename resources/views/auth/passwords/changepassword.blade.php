@extends('layouts.scega')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading bg-primary"><h2>Change Password</h2></div>
                    <div class="panel-body">
                        <form method="post" role="form" class="form-horizontal" action="{{ url('/changepassword') }}">
                            {{csrf_field()}}
                            @if (Session::has('Success'))
                                <div class="alert alert-success"> {!! Session::get('Success') !!} </div>
                            @endif
                            <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }}">
                                <label for="old_password" class="col-md-4 control-label">Current Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="old_password" id="old_password" value="{{old('old_password')}}">
                                    @if ($errors->has('old_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <label for="new_password" class="col-md-4 control-label">New Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="new_password" id="new_password" value="{{old('new_password')}}">
                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                                <label for="new_password_confirmation" class="col-md-4 control-label">Password Confirmation</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation">
                                    @if ($errors->has('new_password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                               <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                               </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection