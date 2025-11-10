<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Медицинский центр')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
@include('frontend.components.header')

<main>
    @yield('content')
</main>

@include('frontend.components.footer')
</body>
</html>
