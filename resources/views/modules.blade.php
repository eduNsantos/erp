@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Aqui estão todos os módulos disponíveis para você:</h2>
        <div class="row my-3">
            @foreach($modules as $module)
                <div class="col-2">
                    <a href="{{ $module->route !="#" ? route($module->route) : $module->route }}">
                        <div class="text-center">
                            <i class="fas {{ $module->icon }} fa-2x"></i>
                            <h5>{{ trans("messages.$module->name.module_name") }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection