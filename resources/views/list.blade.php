@extends('layouts.grid')

{{-- @section('export_route', route($exportRoute)) --}}

@section('content')
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        @isset($multiSelect)
                            <th>Selec.</th>
                        @endisset
                        @foreach ($columns as $column => $relationField)
                            <th 
                                class="{{ $column }}"
                                draggable="true"
                                ondrag="event.preventDefault()"
                                ondragover="dragOver(event)"
                                ondragend="removePlacingArrow(event)"
                            >
                                {{ trans("messages.stock.$column") }}
                            </th>                      
                        @endforeach
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            @isset($multiSelect)
                                <td>
                                    <div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="{{ $loop->index }}">
                                            <label class="custom-control-label" for="{{ $loop->index }}"></label>
                                        </div>
                                    </div>
                                </td>
                            @endisset
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
    <script>
        function dragOver(e) {
            const element = $(e.target)
            const pos = {
                top: element[0].offsetHeight,
                left: element[0].offsetLeft
            }

            $('.placing-arrow').remove()
            const arrow = $(`
                <span class="placing-arrow position-absolute" style="left:${pos.left + 10}px;top:${pos.top-10}px">
                    <i class="fas fa-arrow-down"></i>
                </span>
            `)

            $(element).append(arrow)
        }

        function removePlacingArrow(e) {
            e.preventDefault()
            console.log($(e.target))
            $('.placing-arrow').remove()
        }

    </script>
@endsection