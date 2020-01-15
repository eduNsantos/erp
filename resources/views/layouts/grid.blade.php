<div class="container-fluid">
    <div class="row">
        <a href="#filter" data-toggle="collapse" class="btn btn-primary">
            <i class="fas fa-calendar"></i>
        </a>
        <div id="filter" class="collapse mb-3" aria-expanded="false">
            <form action="#">
                <div class="form-row mx-0 px-0">
                    <div class="col">
                        <label for="initial_date">Data inicial</label>
                        <input type="date" name="initial_date" id="initial_date" class="form-control">
                    </div>
                    <div class="col">
                        <label for="final_date">Data final</label>
                        <input type="date" name="final_date" id="final_date" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="btn-group">
                            <button class="btn btn-primary">Aplicar</button>
                            <button type="reset" class="btn btn-danger">Cancelar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="current-period">
            <span class="initial-date"></span>
            <span class="final-date"></span>
        </div>
    </div>
</div>
<div>
    @yield('content')
</div>