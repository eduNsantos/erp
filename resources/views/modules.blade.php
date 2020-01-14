@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($modules as $module)
                <div class="col-2">
                    <a href="{{ $module->route !="#" ? route($module->route) : $module->route }}">
                        <div class="text-center">
                            <i class="fas {{ $module->icon }} fa-2x"></i>
                            <h5>{{ $module->name }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection