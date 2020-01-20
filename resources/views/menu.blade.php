@extends('layouts.app')

@section('content')
    <div class="row h-100 px-0 mx-0">
        <div class="h-100 navbar navbar-light bg-light shadow align-content-start col-2 px-0 py-0" id="sidebar">
            <ul class="navbar-nav w-100">
                @foreach ($menus as $menu)
                    <li class="nav-item border px-3">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <i class="fas fa-minus"></i>
                            </div>
                            <div class="col-10">
                                <a href="#menu-{{ $menu->id }}" class="nav-link" data-toggle="collapse">{{ $menu->name }}</a>
                            </div>
                        </div>
                    </li>
                    @foreach ($menu->functions as $function)
                        <li class="nav-item collapse bg-info px-3" aria-expanded="false" id="menu-{{ $menu->id }}">
                            <a href="{{ route($function->route) }}" class="nav-link function-item">
                                <div class="text-white row align-items-center">
                                    <div class="col-2">
                                        <i class="{{ $function->icon }}"></i>
                                    </div>
                                    <div class="col-10">
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

        </div>
    </div>
@endsection