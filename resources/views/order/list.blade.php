@extends('list')

@section('tbody')
    @foreach ($items as $order)
        @include('order.row')
    @endforeach
@endsection