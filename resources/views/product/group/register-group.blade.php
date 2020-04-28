<div class="container">
    <h3 class="font-weight-bold">Cadastro de grupo de produto</h3>
    <form action="{{ route('product-group.store') }}" method="POST" class="ajax-form">
        @csrf
        <div class="row">
            <div class="form-group col">
                <label for="name">Nome do grupo</label>
                <input type="text" class="form-control" name="name" id="name" maxlength="30">
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                @component('components.form-buttons')
                @endcomponent
            </div>
        </div>
    </form>
</div>