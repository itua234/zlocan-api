<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comforter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
</head>
<body>

<div style="font-family: 'Dancing Script', cursive;">
    Hello {{ $email }},
    <br>
    Please click on the link below to reset your password!
    <br>

    <a href="{{ url('password/reset', ['email' => $email, 'token' = $reset_token]) }}"> Reset password </a>

    <br/>
</div>

</body>
</html>
