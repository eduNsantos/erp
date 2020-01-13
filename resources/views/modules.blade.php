@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($modules as $module)
                <div class="col-2">
                    <div class="text-center">
                        <i class="fas fa-edit fa-2x"></i>
                        <h5>{{ $module }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection