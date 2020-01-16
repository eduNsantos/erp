@extends('layouts.app')

@section('content')
    <div class="row h-100 px-0 mx-0">
        <div class="h-100 navbar navbar-light bg-light shadow align-content-start col-2 px-0 py-0" id="sidebar">
            <ul class="navbar-nav w-100 text-center px-0">
                @foreach ($menus as $menu)
                    <li class="nav-item border">
                        <a href="#menu-{{ $menu->id }}" class="nav-link" data-toggle="collapse">{{ $menu->name }}</a>
                    </li>
                    @foreach ($menu->functions as $function)
                        <li class="nav-item collapse bg-info" aria-expanded="false" id="menu-{{ $menu->id }}">
                            <a href="{{ route($function->route) }}" class="nav-link function-item">
                                <div class="text-white">
                                    <div>
                                        <i class="{{ $function->icon }} fa-2x"></i>
                                    </div>
                                    <span class="text-break">{{ $function->name }}</span>
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