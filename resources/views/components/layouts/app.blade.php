<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - {{ Route::currentRouteName() ?? request()->path() }}</title>
    <link rel="icon" type="image/png" href="{{ asset('student-favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body>
    <!-- Card Section -->
    {{ $slot }}
    <!-- End Card Section -->
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
