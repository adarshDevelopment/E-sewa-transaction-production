<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment {{ $msg }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

</head>

<body>
    <h1>{{ $msg }}</h1>
    <hr>
    <h2>{{ $msg1 }}</h2>

    <a href="{{ url('/') }}">Back to Home</a>

</body>

</html>
