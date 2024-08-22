@extends('layouts.master')
@section('title', "Listagem")
@section('route-header', route('home'))
@section('name-header', "< Voltar")

@section('content')
    @if (count($carnes) >= 1)
    <table>
        <thead>
            <th>ID</th>
            <th>Valor Total</th>
            <th>Valor Entrada</th>
            <th>Parcelas</th>
            <th>Periodicidade</th>
            <th>Ação</th>
        </thead>

        <tbody>

            @foreach ($carnes as $c)
            <tr>
                <td>{{$c->id}}</td>
                <td>R$ {{number_format($c->valor_total, 2, ',', '.')}}</td>
                <td>R$ {{number_format($c->valor_entrada, 2, ',', '.')}}</td>
                <td>{{$c->qtd_parcelas}}</td>
                <td>{{$c->periodicidade}}</td>
                <td><a class="view-btn" href="{{route("showCarne", ['id'=>$c->id])}}">Visualizar</a></td>
            </tr>
            @endforeach
        </tbody>

    </table>
    @else
        <h1>Não foram encontrados registros!</h1>
    @endif

@endsection
