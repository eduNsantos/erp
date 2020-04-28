@extends('menu')

@section('menu-content')
    <div class="container-fluid">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <h3 class="font-weight-bold">CADASTRO DE PRODUTO</h3>
        <form action="{{ route('product.store') }}" class="ajax-form" method="POST">
            @csrf
            <section>
                <h5 class="font-weight-bold">GERAL</h5>
                <div class="form-inline">
                    <div class="form-group">
                        <label for="is_generic">Produto genérico</label>
                        <input type="checkbox" class="mx-2" name="is_generic" id="is_generic" value="1">
                    </div>
                    
                    <div class="form-group">
                        <label for="original_product_id">Produto Original</label>
                        <select disabled="disabled" class="form-control mx-2" name="original_product_id" id="original_product_id">
                            <option value="">Selecione um produto</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" product="{{ $product }}">{{ $product->code }} {{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </section>
            <section id="general">
                <div class="row">
                    <div class="col-2 form-group">
                        <label for="code">Código</label>
                        <input class="form-control" type="text" name="code" id="code" maxlength="7">
                    </div>
                    <div class="col-4 form-group">
                        <label for="name">Nome</label>
                        <input class="form-control" type="text" name="name" maxlength="120">
                    </div>
                    <div class="col-6 form-group">
                        <label for="description">Descrição</label>
                        <input class="form-control" type="text" name="description" maxlength="120">
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
            </section>
            <section id="logistic" class="mt-3">
                <h5 class="font-weight-bold">LOGÍSTICA</h5>
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
            </section>
            <section id="pcp" class="mt-3">
                <h5 class="font-weight-bold">PCP</h5>
                <div class="row">
                    <div class="form-group col-2">
                        <label for="is_feedstock">Materia prima</label>
                        <input type="checkbox" name="is_feedstock" id="is_feedstock" value="1">
                    </div>
                    <div class="form-group col-2">
                        <label for="is_finished_product">Produto acabado</label>
                        <input type="checkbox" name="is_finished_product" id="is_finished_product" value="1">
                    </div>
                    <div class="form-group col-2">
                        <label for="is_package">Embalagem</label>
                        <input type="checkbox" name="is_package" id="is_package" value="1">
                    </div>
                    <div class="form-group col-2">
                        <label for="is_fixed_asset">Ativo fixo</label>
                        <input type="checkbox" name="is_fixed_asset" id="is_fixed_asset" value="1">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-3">
                        <label for="expiration_days">Dias para vencimento</label>
                        <input type="text" class="form-control" name="expiration_days" id="expiration_days">
                    </div>
                </div>
            </section>
            @include('components.form-buttons')
        </form>
    </div>

    @section('scripts')
        @parent
        <script>
            $(document).on('click', '[name*="is_generic"]', function () {
                if ($(this).prop('checked')) {
                    swal.fire({
                        title: 'Atenção',
                        text: 'As matérias-primas deste produto serão as mesmas do produto original. Deverá ser especificado a embalagem deste produto na receita.',
                        icon: 'warning'
                    })
                    $('[name="original_product_id"]').prop('disabled', false)
                } else {
                    $('[name="original_product_id"]').prop('disabled', true)
                }
            })
            
            $(document).on('change', '[name*="original_product_id"]', function () {
                let product = JSON.parse($(this).children('option:selected').attr('product'))

                $('[name*="code"]').val(product.code)
                $('[name*="name"]').val(product.name)
                $('[name*="description"]').val(product.description)
                $('[name*="brand_id"]').val(product.brand.id)
                $('[name*="product_category_id"]').val(product.category.id)
                $('[name*="product_group_id"]').val(product.group.id)
                $('[name*="unit_id"]').val(product.unit.id)
                $('[name*="multiple"]').val(product.multiple)
                $('[name*="is_feedstock"]').prop('checked', product.is_feedstock)
                $('[name*="is_finished_product"]').prop('checked', product.is_finished_product)
                $('[name*="is_package"]').prop('checked', product.is_package)
                $('[name*="is_fixed_asset"]').prop('checked', product.is_fixed_asset)
                $('[name*="expiration_days"]').val(product.expiration_days)
            })
        </script>
    @endsection
@endsection