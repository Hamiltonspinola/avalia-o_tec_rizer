@extends('adminlte::page')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<h2>Bem vindo</h2>
<form action="{{ route('chamados.store') }}" method="post">
    @csrf
    <label for="assunto" class="control-label">Assunto:</label><br>
    <input type="text" name="assunto" id="assunto" value="{{ old('assunto') }}" placeholder="Digite o assunto do chamado"><br><br>

    <label for="descricao">Descrição</label><br>
    <textarea  class="form-control" rows="3" name="descricao" id="descricao" placeholder="Descreva do chamado">{{ old('descricao') }}</textarea><br><br>

    <label for="data_criacao_chamado">Data de criação do chamdado</label><br>
    <input type="date" name="data_criacao_chamado" id="data_criacao_chamado" value="{{ old('data_criacao_chamado') }}"><br><br>

    <label for="status">Status do chamado</label><br>
    <select name="status" id="status">
        <option value="aberto">Aberto</option>
        <option value="atrasado">Atrasado</option>
        <option value="andamento">Em andamento</option>
        <option value="resolvido">Resolvido</option>
    </select><br><br>
    <button type="submit">Enviar</button>
</form>
@stop
