<?php

namespace App\Http\Controllers;

use App\Informacao;
use App\Dado;
use Illuminate\Http\Request;

class InformacaoController extends Controller
{
    public function salvar(Request $req)
    {
        $info = Informacao::create(['nome' => $req->nome]);

        $dados = explode(';',$req->dados);

        $result = $this->separarDados($dados);

        foreach($result as $res) {
            $dado = new Dado(['chave' => $res['chave'],'valor' => $res['valor']]);
            $info->dados()->save($dado);
        }

        return $result[0];
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
