<div class="container">
    <h3 class="font-weight-bold">CADASTRO DE MARCA DE PRODUTO</h3>
    <form method="POST" action="{{ route('brand.store') }}" class="ajax-form">
        @csrf
        <div class="row">
            <div class="form-group col">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" id="name" maxlength="30">
            </div>
            <div class="form-group col">
                <label for="initials">Siglas</label>
                <input type="text" class="form-control" name="initials" id="initials" maxlength="7">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-2">
                <label for="is_active">Ativo</label>
                <input type="checkbox" name="is_active" id="is_active" value="1" checked="checked">
            </div>
        </div>
        <div class="row">
            @component('components.form-buttons')
            @endcomponent
        </div>
    </form>
</div>