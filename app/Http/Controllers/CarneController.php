<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Exception;
use App\Models\Carne;
use App\Models\ParcelaCarne;


class CarneController extends Controller
{
    private $carne;
    private $parcelasCarne;


    public function __construct(Carne $carne, ParcelaCarne $parcelasCarne) {
        $this->carne = $carne;
        $this->parcelasCarne = $parcelasCarne;
    }

    public function sendFormFrontEnd(Request $request)
    {
        $carne = $this->receberDadosCarne($request);

        if(!is_array($carne) && $carne->getStatusCode() == 400) {
            $carne = $carne->getData(true);
            return redirect()->route('home')->with('exception', $carne['mensagem']);
        }

        return redirect()->back()->with('success', 'Registro criado com sucesso!');

    }


    public function receberDadosCarne(Request $request)
    {
        $request->validate([
            "qtd_parcelas" => "required|integer|min:1",
            "valor_entrada" => "nullable|numeric|",
            "valor_total" => "required|numeric|min:0.01",
            "periodicidade" => "required|string",
            "data_primeiro_vencimento" => "required|date",
        ]);

        $valorTotal = floatval($request->valor_total);
        $qtdParcelas = intval($request->qtd_parcelas);
        $valorEntrada = floatval($request->valor_entrada) ?? 0.00;

        try {
            if($valorEntrada >= $valorTotal)
                throw new \Exception("Valor da entrada não pode ser igual/maior ao valor total!");

            $carne = $this->carne->create([
                "valor_total" => $valorTotal,
                "valor_entrada" => $valorEntrada,
                "qtd_parcelas" => $qtdParcelas,
                "periodicidade" => $request->periodicidade,
                "data_primeiro_vencimento" => $request->data_primeiro_vencimento
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => true,
                'mensagem' => $e->getMessage(),
            ], 400);
        }

        $listaParcelas = $this->criaParcelas($carne);

        return [ $carne, $listaParcelas ];
    }

    private function criaParcelas(
        object $carne
    ){
        $parcelas = [];
        $contadorParcelas = 1;
        $somaDasParcelas = 0;

        $valorEntrada = floatval($carne->valor_entrada);

        if($valorEntrada != 0)
        {
            $parcela = $this->parcelasCarne->create([
                "data_vencimento" => date("Y-m-d"),
                "valor" => $valorEntrada,
                "numero" => 0,
                "entrada" => 1,
                "carne_id" => $carne->id
            ]);

            $somaDasParcelas = $valorEntrada;

            $parcelas['entrada'] = $parcela;
        }

        $valorParcela = round(($carne->valor_total - $carne->valor_entrada) / $carne->qtd_parcelas, 2);


        for($contadorParcelas; $contadorParcelas <= $carne->qtd_parcelas; $contadorParcelas++)
        {
            $proximaDataVencimento = $contadorParcelas == 1 ?
                $carne->data_primeiro_vencimento :
                $this->checaPeriodicidade($carne->periodicidade, $proximaDataVencimento);

            $parcela = $this->parcelasCarne->create([
                "data_vencimento" => $proximaDataVencimento,
                "valor" => $valorParcela,
                "numero" => $contadorParcelas,
                "carne_id" => $carne->id
            ]);

            $somaDasParcelas += $valorParcela;

            array_push($parcelas, $parcela);
        }

        /* Trecho responsável por colocar na ÚLTIMA parcela a diferença
        de valores que são dízimas periódicas.*/
        $diferenca = round($carne->valor_total - $somaDasParcelas, 2);
        $ultimaParcela = $parcelas[$carne->qtd_parcelas - 1];
        $ultimaParcela->valor += $diferenca;

        $registroUltimaParcela = $this->parcelasCarne->find($ultimaParcela->id);
        $registroUltimaParcela->valor = $ultimaParcela->valor;
        $registroUltimaParcela->save();

        return $parcelas;
    }

    private function checaPeriodicidade($periodo = 'mensal', $dataVencimento)
    {
        return $periodo == 'mensal' ? date('Y-m-d', strtotime($dataVencimento . ' +1 month')) : date('Y-m-d', strtotime($dataVencimento .' +1 week'));
    }

    public function getDadosCarne($id)
    {
        try {
            $carne = $this->carne->find($id);

            if($carne) {
                $parcelasCarne = $this->parcelasCarne->where('carne_id',$id)->get();
                if(count($parcelasCarne) != 0) {
                    return $parcelasCarne;
                } else
                    throw new \Exception("N&atilde;o foram encontradas parcelas para esse registro.");

            }  else {
                throw new \Exception("Nenhum carn&ecirc; encontrado.");
            }

        } catch (\Exception $e){
            return response()->json([
                'erro' => true,
                'mensagem' => $e->getMessage(),
            ], 400);
        }
    }

    public function listagem()
    {
        $carnes = $this->carne->all();

        return view('list', compact('carnes'));
    }

    public function showCarne($id)
    {

        $carne = $this->carne->find($id);
        $parcelas = $this->getDadosCarne($id);

        return view('show', compact('parcelas','carne'));
    }
}
