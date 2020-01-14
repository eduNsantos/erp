@extends('layouts.app')

@section('content')
<div class="container">
    <form action="" class="p-3 shadow row">
        <legend>Cadastro de produto</legend>
        <div class="form-group col-2">
            <label for="code">Código</label>
            <input class="form-control" type="text" name="code">
        </div>
        <div class="form-group col-6">
            <label for="name">Nome</label>
            <input class="form-control" type="text" name="name">
        </div>
        <div class="form-group col-2">
            <label for="unit">Unidade</label>
            <select class="form-control" name="unit" id="unit">
                <option value="">-- Selecione --</option>
                <option value="1">Caixa</option>
                <option value="2">Unidade</option>
                <option value="3">Quilo</option>
            </select>
        </div>
        <div class="form-group col-2">
            <label for="brand">Marca</label>
            <select class="form-control" name="brand" id="brand">
                <option value="">-- Selecione --</option>
                <option value="1">Bariloche</option>
                <option value="2">Coop</option>
                <option value="3">Terceirização</option>
            </select>
        </div>
        <div class="form-group col-8">
            <label for="description">Descrição</label>
            <input class="form-control" type="text" name="description">
        </div>
        <div class="form-group col-2">
            <label for="category_id">Categoria</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">-- Selecione --</option>
                <option value="1">Freezer</option>
                <option value="2">Sorvete PT 1,5L Bariloche</option>
                <option value="3">Terceirização</option>
            </select>
        </div>
        <div class="form-group col-2">
            <label for="product_group_id">Grupo do produto</label>
            <select class="form-control" name="product_group_id" id="product_group_id">
                <option value="">-- Selecione --</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-3">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option value="">-- Selecione --</option>
                <option value="1">Freezer</option>
                <option value="2">Sorvete PT 1,5L Bariloche</option>
                <option value="3">Terceirização</option>
            </select>
        </div>
    </form>
</div>
@endsection