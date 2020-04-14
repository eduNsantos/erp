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
                <div class="col">
                    <label for="order_status_id">Status</label>
                    <select name="order_status_id" id="order_status_id" class="form-control">
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive mt-2">
                <table 
                    id="order-table"
                    class="table table- table-bordered table-striped"
                    products="{{ json_encode($products) }}">
                    <thead>
                        <tr>
                            <th>Procurar</th>
                            <th>Descrição</th>
                            <th>Unidade</th>
                            <th>Quantidade</th>
                            <th data-toggle="tooltip" title="O que está a venda (físico - reservado)">Saldo disponível</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="order-items">
                        <tr>
                            <td>
                                <input type="hidden" class="product-id" name="product_id[]">
                                <input type="text"class="product-search form-control">
                            </td>
                            <td>
                                <input type="text" name="description[]" class="description form-control" readonly="readonly">
                            </td>
                            <td>
                                <input type="text" class="unit form-control" disabled="disabled">
                            </td>
                            <td>
                                <input type="number" name="quantity[]" class="quantity form-control">
                            </td>
                            <td>
                                <input type="number" class="balance form-control" readonly disabled value="0">
                            </td>
                            <td class="btn-group">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-block add-item"
                                    data-toggle="tooltip"
                                    title="Adicionar novo item">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-danger btn-block remove-item m-0"
                                    data-toggle="tooltip"
                                    title="Remover linha">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Gravar pedido</button>
                </div>
            </div>
        </form>
    </div>
@endsection