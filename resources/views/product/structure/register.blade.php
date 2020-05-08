@extends('menu')

@section('menu-content')
    <div class="container">
        <h3 class="font-weight-bold">Cadastro de estrutura/receita de produto</h3>
        <form action="{{ route('product-structure.store') }}" method="POST">
            @csrf
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" data-target="#general" aria-expanded="true" aria-controls="general" data-toggle="collapse" href="#general">Geral</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-target="#feedstock" aria-expanded="false" aria-controls="feedstock" data-toggle="collapse" href="#feedstock">Matérias-primas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-target="#package" aria-expanded="false" aria-controls="package" data-toggle="collapse" href="#package">Embalagem</a>
                </li>
            </ul>
            <section id="general" class="collapse show">
                <h4>Geral</h4>
                <div class="row">
                    <input type="hidden" id="finished-products" value="{{ json_encode($finishedProducts) }}">
                    <input type="hidden" id="feedstock-products" value="{{ json_encode($feedstockProducts) }}">
                    <input type="hidden" id="package-products" value="{{ json_encode($packageProducts) }}">

                    <div class="form-group col">
                        <label for="product_id" data-toggle="tooltip" title="Nome fantasia">Produto</label>
                        <select name="product_id" class="form-control" id="product_id" required>
                            <option value="">Selecione um produto</option>
                            @foreach ($finishedProducts as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="name" data-toggle="tooltip" title="Nome fantasia">Nome da estrutura</label>
                        <input type="text" name="name" id="name" class="form-control" required maxlength="120">
                        <label>Manter nome <input type="checkbox" id="keep_name"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col col-md-4">
                        <label
                            for="is_main"
                            data-toggle="tooltip"
                            title="Marcar essa estrutura como principal desativará a atual"
                        >Estrutura principal desse produto</label>
                        <input type="checkbox" name="is_main" id="is_main">
                    </div>
                </div>
            </section>

            <section class="collapse" id="feedstock">
                <h4>Componentes do produtos</h4>
                <div class="row">
                    <div class="form-group col">
                        <label>Matéria-prima</label>
                        <select name="feedstock_product_id" class="form-control product-id" required>
                            <option value="">Selecione a matéria prima</option>
                            @foreach ($feedstockProducts as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col">
                        <label>Medida</label>
                        <input type="text" name="unit" class="form-control unit" readonly>
                    </div>
                    <div class="form-group col">
                        <label for="feedstock_quantity">Quantidade</label>
                        <input type="number" step="0.00001" name="feedstock_quantity" class="form-control quantity">
                    </div>
                    <div class="form-group col">
                        <button 
                            type="button"
                            class="btn btn-primary add-component"
                            data-toggle="tooltip"
                            title="Adicionar mais um componente">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </section>

            <section class="collapse" id="package">
                <h4>Embalagens do produto</h4>
                <div class="row">
                    <div class="form-group col">
                        <label>Embalagem</label>
                        <select name="package_product_id" class="form-control product-id" required>
                            <option value="">Selecione a matéria prima</option>
                            @foreach ($packageProducts as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col">
                        <label>Medida</label>
                        <input type="text" name="unit" class="form-control unit" readonly>
                    </div>
                    <div class="form-group col">
                        <label for="package_quantity">Quantidade</label>
                        <input type="number" step="0.00001" name="package_quantity" class="form-control quantity">
                    </div>
                </div>
            </section>
        </form>
        <div class="form-row"></div>
    </div>
@endsection
@section("scripts")
    @parent
    <script>
        const products = {};

        $(document).ready(function () {
            products.finished = JSON.parse($("#finished-products").val())
            products.feedstock = JSON.parse($("#feedstock-products").val())
            products.package = JSON.parse($("#package-products").val())
        })

        $(document).on('change', '[name="product_id"]', function (e) {
            let selectedProduct = $(this).children("option:selected")

            if (!$('#keep_name').is(':checked')) {
                $('#name').val(selectedProduct.text())
            } else if (selectedProduct.val() == "") {
                $("#name").val("")
            }
        })
        
        $(document).on('change', '.product-id', function (e) {
            let selectedProduct = $(this).children('option:selected')
            let row = $(this).closest('.row')
            let product = products.finished.find(product => product.id == selectedProduct.val())
            row.find('.unit').val(product.unit.initials)
        });

        $(document).on('click', '.add-component', function (e) {
            let row = $(this).closest('.row').clone()

            row.find('input, select, textarea').val("")

            $(this).closest('.row').after(row)
        })

        $(document).on('click', '#is_main', function () {

            if ($(this).is(':checked')) {
                swal.fire({
                    text: 'Marcar essa estrutura como principal desativará a atual',
                    icon: 'warning'
                })
            }
        })
    </script>
@endsection