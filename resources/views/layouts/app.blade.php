<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Material Design for Bootstrap CSS -->
</head>
<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <a href="{{ url('/') }} " class="navbar-brand">
            {{ config('app.name') }}
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('modules') }}" class="nav-link">Módulos</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link active">Iniciar sessão</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link active dropdown-toggle" data-toggle="dropdown">Olá, {{ Auth::user()->name }}!</a>
                        <div class="dropdown-menu">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">
                                    Encerrar sessão
                                </button>
                            </form>
                        </div>
                    </li>   
                @endauth
            </ul>
        </div>
    </nav>
    @yield('content')
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</body>
</html>