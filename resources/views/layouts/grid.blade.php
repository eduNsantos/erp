@php
    $translationPrefix = Route::current()->getController();
    $translationPrefix = $translationPrefix::TRANSLATION_PREFIX;
@endphp
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
            <a 
                href="{{ route(substr(Route::current()->getName(), 0, strpos(Route::current()->getName(), '.')).'.exportToExcel') }}"
                download
                class="btn btn-success export-excel"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Exportar para excel"
            >
                <i class="fas fa-file-excel"></i>
            </a>
            <a 
                href="{{ route(substr(Route::current()->getName(), 0, strpos(Route::current()->getName(), '.')).'.create') }}"
                class="btn btn-primary create-item"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Novo produto"
            >
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
    <div id="filter" class="mb-3" aria-expanded="false">
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
    @yield('content')
    @component('components.register-modal')
    @endcomponent
</div>