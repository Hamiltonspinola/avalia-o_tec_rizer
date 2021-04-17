<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChamado;
use App\Models\Chamado;
use App\Models\Vendedor;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChamadoController extends Controller
{
    public function index(){
        $vendedor = Vendedor::get();
        $chamados=Chamado::get();            
        $vendedores = $vendedor->min('qtd_chamados_aberto');
        return view('auth.chamados.index', compact('chamados', 'vendedor'));
    }
    public function create(){
        return view('auth.chamados.create');
    }
    public static function store(StoreChamado $request){       
        // $query = Vendedor::orderBy('qtd_chamados_aberto')->get()->first();
        // $teste = DB::table('vendedores')->orderBy('qtd_chamados_aberto')->get()->first();

        $ticket = new Chamado;
        $ticket_foreign = DB::table('vendedores')->orderBy('qtd_chamados_aberto')->get()->min('qtd_chamados_aberto');

        $ticket->assunto = $request->assunto;
        $ticket->descricao = $request->descricao;
        $ticket->data_criacao_chamado = $request->data_criacao_chamado;
        $ticket->status = $request->status;
        $ticket->vendedores_id = $ticket_foreign;
        $success = $ticket->save() ? $request->session()->flash('success', 'Chamado Aberto.'): $request->session()->flash('success', 'Oooops! Algo saiu errado.');
        //Incrementar uma unidade à quantidade chamados do vendedor
        
        return redirect(route('chamados.index', compact('ticket')));
    }
    
    public function show($id){
        $result = Chamado::find($id);
        return view('auth.chamados.show', compact('result'));
    }
    public function antenderChamado($id){
        $andamentoVendedor = DB::table('vendedores')->orderBy('qtd_chamados_aberto')->get()->min('qtd_chamados_aberto');
        //Encontrar o chamado que deve ser atualizado
        $andamentoChamado = Chamado::find($id);
        //Checar se o chamado está em aberto
        if($andamentoChamado->status !="aberto"){
            return redirect()->back();
        }
        //Modificar o status para andamento
        $andamentoChamado->status = "andamento";
        //Gravar o chamado na base
        $success = $andamentoChamado->save();/*  ? $id->session()->flash('success', 'Chamado em andamento.'): $id->session()->flash('success', 'Oooops! Algo saiu errado.'); */
        //Buscar o registro do vendedor
        $andamentoVendedor = Vendedor::find($id);
        //Decrementar a quantidade de chamados em aberto
        $andamentoVendedor->qtd_chamados_aberto -= $andamentoVendedor;
        //Incremetar a quantidade de chamados em andamento
        $andamentoVendedor->qtd_chamados_andamento += $andamentoVendedor;
        //Gravar o vendedor na base
        $success = $andamentoChamado->save() ? $id->session()->flash('success', 'Chamado em andamento.'): $id->session()->flash('success', 'Oooops! Algo saiu errado.');
    }
    public function resolverChamado($id){
        //Encontrar o chamado que deve ser atualizado
        $resolvidoChamado = Chamado::find($id);
        //checar se este chamado está em andamento
        if($resolvidoChamado->status != "andamento"){
            return redirect()->back();
        }
        //Modificar o status para resolvido
        $resolvidoChamado->status = "resolvido";
        //Gravar o chamado na base
        $success = $resolvidoChamado->save();
        //Buscar o registro do vendedor
        $resolvidoVendedor = Vendedor::find($id);
        //Decrementar a quantidade de chamados em andamento
        $resolvidoVendedor->qtd_chamados_andamento -= $resolvidoVendedor;
        //Incrementar a quantidade de chamados resolvidos
        $resolvidoVendedor->qtd_chamados_resolvido += $resolvidoVendedor;
        //Gravar o vendedor na base
        $success = $resolvidoChamado->save() ? $id->session()->flash('success', 'Chamado resolvido.'): $id->session()->flash('success', 'Oooops! Algo saiu errado.');
    }
}
