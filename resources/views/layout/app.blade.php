<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg mb-2">
        <a href="#" class="navbar-brand">
            Sistema melhor q o egis
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">Faturamento</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Cadastramento geral</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Estoque</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="app">
        @yield('content')
    </div>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>