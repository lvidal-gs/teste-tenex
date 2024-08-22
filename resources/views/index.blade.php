@extends('layouts.master')
@section('title','Home')
@section('route-header', route('listagem'))
@section('name-header', "Listagem")

@section('content')
    <div id="container">
        @if (session('success'))
            <h3>
               Registro criado!
            </h3>
        @endif

        @if (session('exception'))
            <div class="error-msg">
                <b>Erro: </b>
                {{ session('exception') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-msg">
                <b>Erro de preenchimento: </b>
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <form id="form" method="POST" action="{{route('send')}}">
            @csrf
            <input type="text" placeholder="Valor total - Ex.: 1000.00" name="valor_total">
            <input type="text" placeholder="Valor Entrada (opcional)" name="valor_entrada">

            <input type="number" placeholder="N° de parcelas" min="1" max='120' name="qtd_parcelas">

            <input type="date" name="data_primeiro_vencimento">
            <select name="periodicidade">
                <option value="mensal">Mensal</option>
                <option value="semanal">Semanal</option>
            </select>

            <button type="submit">Enviar</button>

            <small><b>* Usar "." para as casas decimais dos valores monetários</b></small>
        </form>
    </div>
@endsection
