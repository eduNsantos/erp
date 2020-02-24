<div class="container-fluid">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <h4>Cadastramento de clientes</h4>
    <hr>
    <h5><b>Geral</b></h5>
    <form action="{{ route('client.store') }}" class="ajax-form" method="POST">
        @csrf
        <div class="row mb-2">
            <div class="col">
                <label for="person_type">Tipo de pessoa *</label>
                <select name="person_type" class="form-control">
                    <option value="CPF">Pessoa física</option>
                    <option value="CNPJ">Jurídica</option>
                </select>
        </div>
            <div class="col">
                <label for="register_number">CPF/CNPJ</label>
                <input type="text" name="register_number" class="form-control">
            </div>
            <div class="col">
                <label for="corporate_name">Razão social/Nome *</label>
                <input type="text" name="corporate_name" class="form-control">
            </div>
            <div class="col">
                <label for="fantasy_name">Nome fantasia/Apelido</label>
                <input type="text" name="fantasy_name" class="form-control">
            </div>
        </div>
        @include('components.form-buttons')
    </form>
</div>

<script>
    $(document).ready(function() {
        clientMasks()
    })
    /**
     * Altera a mascara do register_number conforme o tipo de pessoa
     * 
    **/
    $(document).on('change', 'select[name=person_type]', function () {
        clientMasks()
    })

    function clientMasks () {
        let registerNumber = $('input[name="register_number"]')
        let personType = $('select[name="person_type"]')
        let newMask = personType.val() == "CPF" ? '000.000.000-00' : '00.000.000/0000-00'

        $(registerNumber).mask(newMask)
    }
</script>