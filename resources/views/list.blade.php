@extends('layouts.grid')

{{-- @section('export_route', route($exportRoute)) --}}

@section('content')
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Selec.</th>
                        @foreach ($columns as $column => $relationField)
                            <th class="{{ $column }}">{{ trans("messages.stock.$column") }}</th>                      
                        @endforeach
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="{{ $loop->index }}">
                                        <label class="custom-control-label" for="{{ $loop->index }}"></label>
                                    </div>
                                </div>
                            </td>
                            @foreach ($columns as $column  => $relationField)
                                @php 
                                    $cell = $relationField === true ? $item->{$column} : $item->{$column}->{$relationField}
                                @endphp
                                <td class="{{ $column }}">{{ $cell }}</td>
                            @endforeach
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