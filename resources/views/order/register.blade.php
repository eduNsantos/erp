<div class="container-fluid">
    <form action="{{ route('order.store') }}">
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
        <div class="form-row my-3">
            <div class="col-8">
                <label for="product_id">Produto</label>
                <select name="product_id[]" class=" select2-de">
                    <option value="" selected="selected">Selecione</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                <label for="quantity">Quantidade</label>
                <input type="number" name="quantity[]" class="form-control">
            </div>
            <div class="col-1 d-flex align-items-end justify-content-end">
                <a
                    href="#"
                    class="btn btn-primary btn-block"
                    data-toggle="tooltip"
                    title="Adicionar novo item">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>

    </form>
</div>