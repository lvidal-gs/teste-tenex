@extends('layouts.master')
@section('title', "Visualizar carnê")
@section('route-header', route('listagem'))
@section('name-header', "< Voltar")

@section('content')
    @isset($carne)
        <div class="show-carne" style="width: 400px;margin-right: 25px; padding: 20px">
            <h1>Dados Carnê</h1>
            <ul>
                <li><b>Registro n°:</b> {{$carne->id}}</li>
                <li><b>Valor Total:</b> R$ {{ number_format($carne->valor_total, 2, ',', '.' )}}</li>
                <li><b>Valor Entrada:</b> R$ {{ number_format($carne->valor_entrada, 2, ',', '.' )}}</li>
                <li><b>Data 1° vencimento:</b> {{date('d/m/Y',strtotime($carne->data_primeiro_vencimento))}}</li>
                <li><b>N° de parcelas:</b> {{$carne->qtd_parcelas}}</li>
                <li><b>Periodicidade:</b> {{$carne->periodicidade}}</li>
            </ul>
        </div>
    @endisset

    <table>
        <thead>
            <th>Número Parcela</th>
            <th>Valor</th>
            <th>Data Vencimento</th>
        </thead>

        <tbody>
            @foreach ($parcelas as $p)
            <tr>
                <td>{{ $p->numero != 0 ? $p->numero : 'Entrada' }}</td>
                <td>R$ {{ number_format($p->valor, 2, ',', '.') }}</td>
                <td>{{ date('d/m/Y', strtotime($p->data_vencimento)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
