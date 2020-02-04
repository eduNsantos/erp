<div class="container-fluid">
    <h2>Cadastramento de unidade de produto</h2>
    <form action="{{ route('product-unit.store') }}" method="post">
        @csrf
        <div class="form-row">
            <div class="col form-group">
                <label for="initials">Nome da unidade</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="col form-group">
                <label for="initials">Sigla</label>
                <input type="text" class="form-control text-uppercase" name="initials" max-length="2">
            </div>
        </div>
        @include('components.form-buttons')
    </form>
</div>