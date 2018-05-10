<!doctype html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmation Email</title>
</head>
<body>
<h1>Hi {{ $user->name }}</h1>
<p>
    Thank you for signing up to Telem Coop Web Service. Do not reply to this email.
</p>
<p>
    Please <a href={{ url("register/confirm/{$user->token}")  }}> Click </a> to confirm your email address.
</p>
<p>
    Have a nice day,
</p>
<p>
    TelemCOOP Webmaster.
</p>
</body>
</html>