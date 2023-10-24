<!DOCTYPE html>
<html lang="en">
<head>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E Tailor App</title>
    <link rel="icon" href="{{ asset('assets/images/logo-e-tailor.svg') }}">
    @vite('resources/css/app.css')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css')}}">
  </head>
</head>
<body>
  {{ $slot }}
  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>