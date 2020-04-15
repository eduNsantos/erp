@extends('layouts.app')

@section('content')
    <div class="row h-100 px-0 mx-0">
        <div class="h-100 navbar navbar-light bg-light shadow align-content-start d-none d-md-inline-block col-md-2 px-0 py-0" id="sidebar">
            <ul class="navbar-nav w-100">
                @foreach ($menus as $menu)
                    <li class="nav-item border px-3">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-6 mx-md-auto d-md-none d-lg-block">
                                <i class="fas fa-minus"></i>
                            </div>
                            <div class="col-lg-10 col-md-12">
                                <a href="#menu-{{ $menu->id }}" class="nav-link" data-toggle="collapse">{{ $menu->name }}</a>
                            </div>
                        </div>
                    </li>
                    @foreach ($menu->functions as $function)
                        <li 
                            class="nav-item collapse bg-info px-3"
                            aria-expanded="{{ session('current_function_id') == $function->id }}"
                            id="menu-{{ $menu->id }}">
                            <a href="{{ route($function->route) }}" class="nav-link function-item">
                                <div class="text-white row align-items-center">
                                    <div class="col-lg-2 col-md-6">
                                        <i class="{{ $function->icon }}"></i>
                                    </div>
                                    <div class="col-lg-10 col-md-12">
                                        <span class="text-break">{{ $function->name }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
        <div id="menu-content" class="col-10 px-0 pt-2">
            @yield('menu-content')
        </div>
    </div>
@endsection