<div class="container-fluid mb-3">
    <div class="d-flex align-items-center">
        <a href="#filter" data-toggle="collapse" class="btn btn-primary">
            <i class="fas fa-calendar"></i>
        </a>
        <div id="current-period" class="btn">
            <span class="initial-date"></span>
            <span class="final-date"></span>
        </div>
        <div class="ml-auto text-right">
            <a href="{{ route(substr(Route::current()->getName(), 0, strpos(Route::current()->getName(), '.')).'.exportToExcel') }}" download class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Exportar para excel">
                <i class="fas fa-file-excel fa-lg"></i>
            </a>
            <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Novo produto">
                <i class="fas fa-plus fa-lg"></i>
            </a>
        </div>
    </div>
    <div id="filter" class="collapse mb-3" aria-expanded="false">
        <form action="#">
            <div class="form-row mx-0 px-0 align-items-bottom">
                <div class="col">
                    <label for="initial_date">Data inicial</label>
                    <input type="date" name="initial_date" id="initial_date" class="form-control" value="{{ date('Y-m-d', session('date')['initial_date']) }}">
                </div>
                <div class="col">
                    <label for="final_date">Data final</label>
                    <input type="date" name="final_date" id="final_date" class="form-control" value="{{ date('Y-m-d', session('date')['final_date']) }}">
                </div>
                <div class="col-2 row align-items-end mx-0">
                    <div class="btn-group w-100">
                        <button class="btn btn-primary col-6">Aplicar</button>
                        <button type="reset" class="btn btn-outline-danger col-6">Cancelar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div>
    @yield('content')
</div>