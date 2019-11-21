<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SistemaController extends Controller
{

    public function montaJSONSessao($loginDados)
    {
        $dados = [];
        if (!empty($loginDados[0]) and isset($loginDados)) {
            $dados['usuario']['autenticado'] = true;
            $dados['usuario']['ultimo_acesso'] = date('d/m/Y H:i:s');
            $dados['usuario']['codigo'] = $loginDados[0]->cod_usuarios;
            $dados['usuario']['perfil'] = $loginDados[0]->cod_perfis;
            $dados['usuario']['usuario'] = $loginDados[0]->usuario;
            $dados['usuario']['nome'] = $loginDados[0]->nome;
            $dados['usuario']['email'] = $loginDados[0]->email;
            foreach ($loginDados as $i => $v) {
                $dados['usuario']['cod_pizzarias'][] = $v->cod_pizzarias;
            }
            $paginas = $this->buscaPaginas($loginDados[0]->cod_perfis);
            foreach ($paginas as $i => $v) {
                if ($v->arquivo != '') {
                    $dados['usuario']['paginas'][] = $v->arquivo;
                }
                if ($v->arquivo_aux1 != '') {
                    $dados['usuario']['paginas'][] = $v->arquivo_aux1;
                }
                if ($v->arquivo_aux2 != '') {
                    $dados['usuario']['paginas'][] = $v->arquivo_aux2;
                }
                if ($v->arquivo_aux3 != '') {
                    $dados['usuario']['paginas'][] = $v->arquivo_aux3;
                }
            }
        }
        echo json_encode($dados);
    }

    public function buscaPaginas($cod_perfis)
    {
        return DB::table("nuc_paginas")
            ->join('nuc_paginas_nuc_perfis', 'nuc_paginas_nuc_perfis.cod_paginas', '=', 'nuc_paginas.cod_paginas')
            ->where('cod_perfis', $cod_perfis)
            ->get();
    }

    public function login($usuario, $senha)
    {
        $senha = MD5($senha);
        $dados = DB::table('nuc_usuarios')
            ->select(['ipi_pizzarias_nuc_usuarios.cod_pizzarias', 'nuc_usuarios.cod_usuarios', 'nuc_usuarios.cod_perfis', 'nuc_usuarios.email', 'nuc_usuarios.usuario', 'nuc_usuarios.nome', 'nuc_usuarios.senha'])
            ->join('ipi_pizzarias_nuc_usuarios', 'nuc_usuarios.cod_usuarios', '=', 'ipi_pizzarias_nuc_usuarios.cod_usuarios')
            ->where('nuc_usuarios.usuario', $usuario)
            ->where('nuc_usuarios.senha', $senha)
            ->where('nuc_usuarios.situacao', 'ATIVO')
            ->get();
        $this->montaJSONSessao($dados);
    }

    public function menu_site($perfil)
    {
        $perfil = explode(',', $perfil);
        return DB::table('nuc_paginas')
            ->join('nuc_paginas_nuc_perfis', 'nuc_paginas.cod_paginas', '=', 'nuc_paginas_nuc_perfis.cod_paginas')
            ->where('nuc_paginas.habilitado', '1')
            ->whereIn('nuc_paginas_nuc_perfis.cod_perfis', $perfil)
            ->orderBy('nuc_paginas.ordem')
            ->orderBy('nuc_paginas.menu')
            ->get();
    }

    public function paginas($acao = null, $cod_pagina = null, $dados = array())
    {
        if ($acao == 'BUSCA') {
            return DB::table('nuc_paginas')->get();
        }
        if ($acao == 'DELETAR') {
            try {
                DB::table('nuc_paginas')->whereIn('cod_paginas', [$cod_pagina])->delete();
                DB::table('nuc_paginas')->whereIn('cod_paginas_pai', [$cod_pagina])->delete();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        if ($acao == 'CRIAR') {
            if (!empty($dados)) {
                $dados = json_decode($dados, true);
                try {
                    DB::table('nuc_paginas')->insert([
                        $dados
                    ]);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
        if ($acao == 'ATUALIZAR') {
            if (!empty($dados)) {
                $dados = json_decode($dados, true);
                try {
                    $update = DB::table('nuc_paginas')
                        ->where('cod_paginas', $dados['cod_paginas']);
                    unset($dados['cod_paginas']);
                    $update->update(
                        [
                            $dados
                        ]
                    );
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
    }
}
