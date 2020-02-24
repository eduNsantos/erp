<div class="container-fluid">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <h4>Cadastramento de produto</h4>
    <hr>
    <h5><b>Geral</b></h5>
    <form action="{{ route('product.store') }}" class="ajax-form" method="POST">
        @csrf
        <div class="form-row">
            <div class="col-2 form-group">
                <label for="code">Código</label>
                <input class="form-control" type="text" name="code" id="code">
            </div>
            <div class="col-4 form-group">
                <label for="name">Nome</label>
                <input class="form-control" type="text" name="name">
            </div>
            <div class="col-6 form-group">
                <label for="description">Descrição</label>
                <input class="form-control" type="text" name="description">
            </div>
            <div class="col-2 form-group">
                <label for="brand_id">Marca</label>
                <select class=" form-control" name="brand_id" id="brand_id">
                    <option value="">Selecione</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col form-group">
                <label for="product_category_id">Categoria</label>
                <select class=" form-control" name="product_category_id" id="product_category_id">
                    <option value="">Selecione</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col form-group">
                <label for="product_group_id">Grupo do produto</label>
                <select class=" form-control" name="product_group_id" id="product_group_id">
                    <option value="">Selecione</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col form-group">
                <label for="product_status_id">Status</label>
                <select class=" form-control" name="product_status_id" id="product_status_id">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach>
                </select>
            </div>
        </div>
        <div>
            <hr>
            <h5><b>Logística</b></h5>
            <div class="row">
                <div class="col-3 form-group">
                    <label for="unit_id">Unidade</label>
                    <select class="form-control" name="unit_id" id="unit">
                        <option value="">Selecione</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 form-group">
                    <label 
                        for="multiple"
                        data-toggle="tooltip"
                        title="Quantidade de produtos na unidade"
                    >
                        Múltiplo de embalagem
                    </label>
                    <input class="form-control" type="number" name="multiple" value="1">
                </div>
            </div>
        </div>
        @include('components.form-buttons')
    </form>
</div>