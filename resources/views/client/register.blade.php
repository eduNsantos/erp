<div class="container-fluid">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <h4>Cadastramento de clientes</h4>
    <hr>
    <h5><b>Geral</b></h5>
    <form action="{{ route('clients.store') }}" class="ajax-form" method="POST">
        @csrf
        <div class="row mb-2">
            <div class="col">
                <label for="type">Tipo de pessoa</label>
                <select name="type" class="person_type form-control">
                    <option value="1">Pessoa física</option>
                    <option value="1">Jurídica</option>
                </select>
            </div>
            <div class="col">
                <label for="register_number">CPF/CNPJ</label>
                <input type="text" name="register_number" class="register_number form-control">
            </div>
            <div class="col">
                <label for="corporate_name">Razão social/Nome</label>
                <input type="text" name="corporate_name" class="form-control">
            </div>
            <div class="col">
                <label for="fantasy_name">Nome fantasia/Nome</label>
                <input type="text" name="fantasy_name" class="form-control">
            </div>
        </div>
        @include('components.form-buttons')
    </form>
</div>