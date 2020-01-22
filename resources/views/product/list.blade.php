@extends('layouts.grid')

@section('content')
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Selec.</th>
                        @foreach ($columns as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="{{ $loop->index }}">
                                        <label class="custom-control-label" for="{{ $loop->index }}"></label>
                                      </div>
                                </div>
                            </td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->unit->initials }}</td>
                             <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->group->name }}</td>
                            {{-- <td>{{ $product->status->name }}</td> --}}
                            <td>
                                <button class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection