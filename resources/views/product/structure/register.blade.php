@extends('menu')

@section('menu-content')
    <div class="container">
        <h3 class="font-weight-bold">Cadastro de estrutura/receita de produto</h3>
        <form action="{{ route('product-structure.store') }}" class="ajax-form" method="POST" onsubmit="validateForm()">
            @csrf
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" data-target="#general" aria-expanded="true" aria-controls="general" data-toggle="collapse" href="#general">Geral</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-target="#feedstock" aria-expanded="false" aria-controls="feedstock" data-toggle="collapse" href="#feedstock">Matérias-primas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-target="#package" aria-expanded="false" aria-controls="package" data-toggle="collapse" href="#package">Embalagem</a>
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
                    <div class="form-group col">
                        <label
                            for="is_main"
                            data-toggle="tooltip"
                            title="Marcar essa estrutura como principal desativará a atual"
                        >Estrutura principal desse produto</label>
                        <input type="checkbox" name="is_main" id="is_main" value="1">
                    </div>
                </div>
            </section>

            <section class="collapse show" id="feedstock">
                <h4>Componentes do produtos</h4>
                <table class="w-100">
                    <thead>
                        <tr>
                            <th>Matéria-prima</th>
                            <th>Medida</th>
                            <th>Quantidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="feedstock_product_id[]" class="form-control product-id" product-type="feedstock" required>
                                    <option value="">Selecione a matéria prima</option>
                                    @foreach ($feedstockProducts as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="unit" class="form-control unit" readonly>
                            </td>
                            <td>
                                <input type="number" step="0.00001" name="feedstock_quantity[]" class="form-control quantity">
                            </td>
                            <td>
                                <button 
                                    type="button"
                                    class="btn btn-primary add-component"
                                    data-toggle="tooltip"
                                    title="Adicionar mais um componente">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button 
                                    type="button"
                                    class="btn btn-danger remove-component"
                                    data-toggle="tooltip"
                                    title="Remover componente">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section class="collapse show mt-4" id="package">
                <h4>Embalagens do produto</h4>
                <div class="row">
                    <div class="form-group col">
                        <label for="no_package">Produto não tem embalagem</label>
                        <input type="checkbox" id="no_package" name="no_package" value="1">
                    </div>
                </div>
                <table class="w-100" id="packages">
                    <thead>
                        <tr>
                            <th>Embalagem</th>
                            <th>Medida</th>
                            <th>Quantidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="package_product_id[]" class="form-control product-id" product-type="package">
                                    <option value="">Selecione a embalagem</option>
                                    @foreach ($packageProducts as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="unit" class="form-control unit" readonly>
                            </td>
                            <td>
                                <input type="number" step="0.00001" name="package_quantity[]" class="form-control quantity">
                            </td>
                            <td>
                                <button 
                                    type="button"
                                    class="btn btn-primary add-component"
                                    data-toggle="tooltip"
                                    title="Adicionar mais um componente">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button 
                                    type="button"
                                    class="btn btn-danger remove-component"
                                    data-toggle="tooltip"
                                    title="Remover componente">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <div class="my-2">
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Gravar
                </button>
            </div>
        </form>
    </div>
@endsection
@section("scripts")
    @parent
    <script src="{{ mix('js/structure.js') }}"></script>
@endsection