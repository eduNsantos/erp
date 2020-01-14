@extends('layouts.app')

@section('content')
    <div class="h-100 navbar navbar-light bg-light shadow align-content-start" id="sidebar">
        <ul class="navbar-nav w-100 text-center">
            @foreach ($menus as $menu)
                <li class="nav-item">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $menu->name }}</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach ($menu->functions as $function)
                            <a class="dropdown-item" href="{{ route($function->route) }}">
                                {{ $function->name }}
                            </a>
                        @endforeach
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection