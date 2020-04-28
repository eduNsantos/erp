<div class="container">
    <h2>Cadastro de unidade de produto</h2>
    <form action="{{ route('product-unit.store') }}" method="post" class="ajax-form">
        @csrf
        <div class="form-row">
            <div class="col form-group">
                <label for="initials">Nome da unidade</label>
                <input type="text" class="form-control" name="name" maxlength="30">
            </div>
            <div class="col form-group">
                <label for="initials">Sigla</label>
                <input type="text" class="form-control text-uppercase" name="initials" maxlength="2">
            </div>
        </div>
        @include('components.form-buttons')
    </form>
</div>