@extends('menu')

@section('menu-content')
    <div class="container-fluid" id="menu-content">
        <h2>Novo pedido</h2>
        <form action="{{ route('order.store') }}" method="POST" class="ajax-form">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="client_id">Selecione um cliente</label>
                    <select name="client_id" class="form-control">
                        <option value="" selected="selected">Selecione</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->corporate_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-2">
                <h4>Produtos</h4>
            </div>
            <div class="border px-2">
                <div class="form-row my-3">
                    <input type="hidden" name="products" value="{{ json_encode($products) }}">
                    <div class="col-2">
                        <label for="product-search">Procurar</label>
                        <input type="text" name="product-search" class="product-search form-control">
                    </div>
                    <input type="hidden" name="product_id[]" class="form-control" disabled="disabled">
                    <div class="col-6">
                        <label>Descrição</label>
                        <input type="text" class="description form-control" disabled="disabled">
                    </div>
                    <div class="col-1">
                        <label>UN</label>
                        <input type="text" class="unit form-control" disabled="disabled">
                    </div>
                    <div class="col-2">
                        <label for="quantity">Quantidade</label>
                        <input type="number" name="quantity[]" class="form-control">
                    </div>
                    <div class="col-1 d-flex align-items-end justify-content-end">
                        <button
                            type="button"
                            class="btn btn-primary btn-block add-item"
                            data-toggle="tooltip"
                            title="Adicionar novo item">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <button class="btn btn-primary">Gravar pedido</button>
                </div>
            </div>
        </form>
    </div>
@endsection