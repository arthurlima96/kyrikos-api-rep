<?php

namespace App\Http\Controllers;

use App\Informacao;
use App\Dado;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InformacaoController extends Controller
{
    public function salvar(Request $req)
    {
        if(!$req->informacao)
            return array('mensagem'=>'É necessário enviar os dados seguindo o exemplo: http://178.128.156.57/api/salvar?informacao=algo1;nome1;coisa1');

        $info = Informacao::create(['nome' => 'Informacao '.Carbon::now()]);

        $dados = explode(';',$req->informacao);

        $result = $this->separarDados($dados);

        foreach($result as $res) {
            $dado = new Dado(['chave' => $res['chave'],'valor' => $res['valor']]);
            $info->dados()->save($dado);
        }

        return array('mensagem'=>'Os dados foram separados e salvos','informacao ID'=>$info->id,'separacao'=>$result);
    }

    private function separarDados ($dados)
    {
        $array = array();

        $i = 0;
        foreach ($dados as $dado) {
            $array[] = array('chave' => $i,'valor' => $dado);
            $i++;
        }

        return $array;
    }

    public function recuperar($id = null)
    {
        if ($id) {
            return Informacao::with('dados')->where('id',$id)->get();
        }

        return Informacao::with('dados')->get();

    }
}
