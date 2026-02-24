<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Aula de laravel')</title>

    {{-- CSS básico --}}
    <style>
        body {
            font-family: Arial;
            margin: 0;
            padding: 20px;
            color: green;
        }
    </style>

    @yield('styles')

</head>
<body>
    @yield('content')
</body>
</html>
