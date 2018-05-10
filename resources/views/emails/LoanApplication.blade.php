<!doctype html>

<html >

<head>

    <meta charset="UTF-8">

    <meta name="viewport"

          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Online Loan Application</title>




</head>

<body>







{{dd($member_name)}}

{{dd($data)}}

@foreach($comaker as $key => $row)
    {{$row['comaker_id']}}
@endforeach


@foreach($loan_app as $loan )
{{$loan->loan_id}}
{{$loan->member_no}}
{{$loan->loan_app_date}}
@endforeach

{{$comaker->comaker_id}}
@foreach($comaker as $make)
    {{dd($make->comaker_id)}}
@endforeach


Scega Webmaster.

</body>

</html>
