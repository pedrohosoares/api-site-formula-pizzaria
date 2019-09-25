<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiDadosAcesso
 * 
 * @property int $cod_pedidos_dados
 * @property int $cod_pedidos
 * @property \Carbon\Carbon $data_hora_inicial_carrinho
 * @property \Carbon\Carbon $data_hora_final_carrinho
 * @property string $ip
 * @property string $ultima_pagina
 * @property string $navegador_idioma
 * @property string $navegador_versao
 * @property string $navegador_string
 * @property string $sistema_operacional
 * @property string $cores_tela
 * @property string $resolucao_tela
 * @property string $dns_visitante
 * @property int $velocidade_conexao
 * @property string $cookie
 * @property \Carbon\Carbon $data_hora_inicial_site
 * @property \Carbon\Carbon $data_hora_final_site
 * @property bool $primeira_compra
 *
 * @package App\Models
 */
class IpiDadosAcesso extends Eloquent
{
	protected $table = 'ipi_dados_acesso';
	protected $primaryKey = 'cod_pedidos_dados';
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'velocidade_conexao' => 'int',
		'primeira_compra' => 'bool'
	];

	protected $dates = [
		'data_hora_inicial_carrinho',
		'data_hora_final_carrinho',
		'data_hora_inicial_site',
		'data_hora_final_site'
	];

	protected $fillable = [
		'cod_pedidos',
		'data_hora_inicial_carrinho',
		'data_hora_final_carrinho',
		'ip',
		'ultima_pagina',
		'navegador_idioma',
		'navegador_versao',
		'navegador_string',
		'sistema_operacional',
		'cores_tela',
		'resolucao_tela',
		'dns_visitante',
		'velocidade_conexao',
		'cookie',
		'data_hora_inicial_site',
		'data_hora_final_site',
		'primeira_compra'
	];
}
