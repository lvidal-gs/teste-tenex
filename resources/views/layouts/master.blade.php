<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('assets/style.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <title>@yield('title')</title>
    </head>
    <body class="antialiased">
        <header>
            <a class="back" href="@yield('route-header')">@yield('name-header')</a>
        </header>
        <main>
            @yield('content')
        </main>

        <footer>
            <span>
                Feito por <a target="_blank" title="Ir para LinkedIn" href="https://www.linkedin.com/in/lucas-vidal-dev/">Lucas Vidal</a> - Desenvolvedor Web
            </span>
        </footer>
    </body>
</html>
