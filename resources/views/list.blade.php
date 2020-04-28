@php
    $translationPrefix = Route::current()->getController();
    $translationPrefix = $translationPrefix::TRANSLATION_PREFIX;
@endphp

@extends('menu')

@section('menu-content')
    <div class="container-fluid mb-3">
        <div class="d-flex align-items-center">
            <div class="ml-auto text-right">
                <a 
                    href="#"
                    class="btn btn-primary toggle-columns"
                    data-toggle="tooltip"
                    data-placement="bottom"
                    title="Colunas"
                >
                    <i class="fas fa-eye"></i>
                </a>
                <div id="columns" class="bg-white">
                    <div class="row">
                        @foreach ($columns as $column => $relationField)
                            <div class="col-2">
                                <input type="checkbox" name="column-{{ $column }}" id="column-{{ $column }}" checked="checked">
                            </div>
                            <div class="col-9 text-left">
                                <label for="{{ $column }}">
                                    {{ trans("messages.$translationPrefix.$column") }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @isset($buttons)
                    @foreach ($buttons as $button)
                        <a 
                            href="{{ $button->getRoute() }}"
                            {{ $button->getHasTooltip() ? 'data-toggle=tooltip' : "" }}
                            title="{{  $button->getHasTooltip() ? $button->getTooltip() : ""  }}"
                            class="{{ $button->getClasses() }} {{ $button->getUsesModal() ? 'uses-modal' : '' }}">
                                <i class="{{ $button->getIcon() }}"></i>
                        </a>
                    @endforeach
                @endisset
            </div>
        </div>
        <div id="filter" class="mb-3 d-none" aria-expanded="false">
            <form action="#">
                <div class="row align-items-end">
                    <div class="col-4">
                        <label for="search">Procurar</label>
                        <input type="text" name="search" class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="initial_date">Data inicial</label>
                        <input type="date" name="initial_date" id="initial_date" class="form-control" value="{{ date('Y-m-d', session('date')['initial_date']) }}">
                    </div>
                    <div class="col-3">
                        <label for="final_date">Data final</label>
                        <input type="date" name="final_date" id="final_date" class="form-control" value="{{ date('Y-m-d', session('date')['final_date']) }}">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-block btn-primary">Aplicar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div>
        <div class="container-fluid">
            <div class="table-responsive table-list">
                @section('table')
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            @section('thead')
                                <tr>
                                    @isset($multiSelect)
                                        <th>Selec.</th>
                                    @endisset
                                    @foreach ($columns as $column => $relationField)
                                        <th 
                                            class="column-{{ $column }}"
                                            draggable="true"
                                            ondrag="onDragStart(event)"
                                            ondragover="dragOver(event)"
                                            ondragend="removePlacingArrow(event)"
                                            column="{{ $column }}">
                                            {{ trans("messages.$translationPrefix.$column") }}
                                            <span class="order-icon"></span>
                                        </th>                      
                                    @endforeach
                                    @section('tbody-actions')
                                        <th>Ações</th>
                                    @show
                                </tr>
                            @show
                        </thead>
                        <tbody>
                            @section('tbody')
                                @forelse ($items as $item)
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
                                            @if (strpos($column, '_at'))
                                                <td class="column-{{ $column }}" column="{{ $column }}">
                                                    {{ date('d/m/Y H:i:s', strtotime($cell)) }}
                                                </td>
                                            @elseif (substr($column, 0, 3) == "is_")
                                                <td class="column-{{ $column }}" column="{{ $column }}">
                                                    {{ $cell ? 'Sim' : 'Não' }}
                                                </td>
                                            @else
                                                <td class="column-{{ $column }}" column="{{ $column }}">
                                                    {{ $cell }}  
                                                </td>
                                            @endif
                                        @endforeach
                                        <td>
                                            <button class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty 
                                    <tr>
                                        <td colspan="{{ count($columns) + 1 }}" class="text-center">Nada encontrado.</td>
                                    </tr>
                                @endforelse
                            @show
                        </tbody>
                    </table>
                @show
            </div>
        </div>
        <script>
            function onDragStart (e) {
                e.preventDefault()
            }

            function dragOver(e) {
                const element = $(e.target)
                const pos = {
                    top: element[0].offsetHeight,
                    left: element[0].offsetLeft
                }

                $('.placing-arrow').remove()
                const arrow = $(`
                    <span 
                        class="placing-arrow position-absolute text-success">
                        <i class="fas fa-arrow-down"></i>
                    </span>
                `)
    
                $(element).append(arrow)
            }
    
            function removePlacingArrow(e) {
                e.preventDefault()
                
                $('.placing-arrow').remove()
            }
    
        </script>
        @component('components.register-modal')
        @endcomponent
    </div>
@endsection