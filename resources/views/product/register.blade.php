@extends('layouts.grid')
@section('content')
<div class="container-fluid">
    <h4>Cadastramento de produto</h4>
    <form action="#">
        <div class="form-row">
            <div class="col-2 form-group">
                <label for="code">Código</label>
                <input class="form-control" type="text" name="code" id="code">
            </div>
            <div class="col-6 form-group">
                <label for="name">Nome</label>
                <input class="form-control" type="text" name="name">
            </div>
            <div class="col-2 form-group">
                <label for="unit">Unidade</label>
                <select class="form-control" name="unit" id="unit">
                    <option value="">-- Selecione --</option>
                    <option value="1">Caixa</option>
                    <option value="2">Unidade</option>
                    <option value="3">Quilo</option>
                </select>
            </div>
            <div class="col-2 form-group">
                <label for="brand">Marca</label>
                <select class="form-control" name="brand" id="brand">
                    <option value="">-- Selecione --</option>
                    <option value="1">Bariloche</option>
                    <option value="2">Coop</option>
                    <option value="3">Terceirização</option>
                </select>
            </div>
            <div class="col form-group">
                <label for="description">Descrição</label>
                <input class="form-control" type="text" name="description">
            </div>
            <div class="col form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">-- Selecione --</option>
                    <option value="1">Freezer</option>
                    <option value="2">Sorvete PT 1,5L Bariloche</option>
                    <option value="3">Terceirização</option>
                </select>
            </div>
            <div class="col form-group">
                <label for="product_group_id">Grupo do produto</label>
                <select class="form-control" name="product_group_id" id="product_group_id">
                    <option value="">-- Selecione --</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="">-- Selecione --</option>
                    <option value="1">Freezer</option>
                    <option value="2">Sorvete PT 1,5L Bariloche</option>
                    <option value="3">Terceirização</option>
                </select>
            </div>
        </div>
    </form>
</div>
@endsection