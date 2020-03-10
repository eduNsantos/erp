@extends('menu')

@section('menu-content')
    <vc-order 
        :clients="{{ $clients }}" 
        :products="{{ $products }}"/>
@endsection