<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>

<header class="header">
    <div class="header-left">
        <img src="{{ asset('img/coachtech_logo.png') }}" alt="ロゴ" class="logo">
    </div>

    @hasSection('header-center')
        <div class="header-center">
            @yield('header-center')
        </div>
    @endif

    @hasSection('header-right')
        <div class="header-right">
            @yield('header-right')
        </div>
    @endif
</header>

<main class="@yield('main-class', 'container')">
    @yield('content')
    @yield('scripts')
</main>

</body>
</html>