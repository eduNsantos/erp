@extends('list')

@section('top-buttons')
    <div class="col-2 px-0 mr-auto">
        <select name="#" id="" class="form-control">
            <option value="">Tipo movimentação</option>
        </select>
    </div>
    <div>
        @parent
    </div>
@endsection

@section('tbody-actions', '')

@section('tbody')
    @forelse ($items as $movement)
        <tr>
            <td columns="id">{{ $movement->id }}</td>
            <td columns="code">{{ $movement->product->code }}</td>
            <td columns="name">{{ $movement->product->name }}</td>
            <td columns="description">{{ $movement->product->description }}</td>
            <td columns="type">{{ $movement->type->name }}</td>
            <td columns="quantity">{{ $movement->quantity }}</td>
            <td columns="reason">{{ $movement->reason }}</td>
            <td columns="created_at">{{ date('d/m/Y H:i:s', strtotime($movement->created_at)) }}</td>
            <td columns="updated_at">{{ date('d/m/Y H:i:s', strtotime($movement->updated_at)) }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="{{ count($columns) }}"></td>
        </tr>
    @endforelse
@endsection