@extends('layouts.scega')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-heading text-center text-danger"><h1> Please Contact Coop Office for your Status! </h1> </div>
                <button class="btn btn-primary center-block" type="button" onclick="window.location='{{ url('/logout') }}'">LOGOUT</button>
            </div>
        </div>
    </div>


@endsection
