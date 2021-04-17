
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<h2>Bem vindo</h2>

<a href="{{ route('chamados.create') }}">Abrir novo chamado</a>
@foreach($chamados as $chamado)
<hr>

@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
        <p>{{session('success')}}</p>
    </div>
@endif


<div class="box box-info">
            <!-- /.box-header -->
            <div class="box-body">
                    @if(date('H', strtotime($chamado->created_at))>=24)
                        {{ $chamado->status = "atrasado" }}
                    @endif
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  
                  <tr>
                 
                    <th>Nº do chamado:</th>
                    <th>Assunto</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Vendedor</th>
                    <th>Data de abertura do chamado</th>
                  
                  </tr>
                  </thead>
                  <tbody>
                  
                  <tr>
                    <td>{{ $chamado->id }}</td>
                    <td>{{ $chamado->assunto }}</td>
                    <td>{{ $chamado->descricao }}</td>                    
                    <td>{{ $chamado->status }}</td>
                    <td>{{ $chamado->vendedores_id }}</td>
                    <td>{{ $chamado->data_criacao_chamado }}</td>
                  </tr>
                  
                  
          @endforeach
          
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


