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
            <div class="products border px-2">
                <div class="form-row my-3">
                    <input type="hidden" class="products" value="{{ json_encode($products) }}">
                    <div class="col-2">
                        <label for="product-search">Procurar</label>
                        <input 
                            type="text"
                            class="product-search form-control">
                    </div>
                    <input type="hidden" name="product_id[]" class="form-control"s>
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
                    <div class="col-1 d-flex align-items-end justify-content-end btn-group">
                        <button
                            type="button"
                            class="btn btn-primary btn-block add-item"
                            data-toggle="tooltip"
                            title="Adicionar novo item">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger btn-block remove-item"
                            data-toggle="tooltip"
                            title="Remover linha">
                            <i class="fas fa-times"></i>
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
    @section('scripts')
        @parent
        <script>
            let products = JSON.parse($('input[class*="products"').val())

            $(document).on('click', '.add-item', function () {
                let formRow = $(this).closest('.form-row')
                let clonedFormRow = $(formRow).clone()
                clonedFormRow.find('input, select').val('')
                $(formRow).after(clonedFormRow)
                $('[data-toggle]').tooltip()
            })

            $(document).on('click', '.remove-item', function () {
                let formRows = $('div.products').find('.form-row')

                if (formRows.length == 1) {
                    swal.fire('Aviso', 'Não é possivel remover todos os itens!', 'warning')
                    return false
                }

                $(this).closest('.form-row').remove()
            })

            $(document).on('keyup', '.product-search', function (e) {
                let searchedProduct = $(this).val().toLowerCase()
                let product = products.find(product => {
                    let productCode = product.code.toLowerCase()
                    let productName = product.name.toLowerCase()
                    
                    if (productCode.indexOf(searchedProduct) != -1 || productName.indexOf(searchedProduct) != -1) {
                        return true
                    }
                })

                let productId = $(this).closest('.form-row').find('[name="product_id[]"]')
                let description = $(this).closest('.form-row').find('.description')
                let unit = $(this).closest('.form-row').find('.unit')

                if (typeof product !== "undefined") {
                    productId.val(product.id)
                    description.val(product.description)
                    unit.val(product.unit.initials)
                } else {
                    productId.val('')
                    description.val('Produto não encontrado. Procure novamente.')
                }
            })
        </script>
    @endsection
@endsection