<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiFornecedore
 * 
 * @property int $cod_fornecedores
 * @property int $cod_pizzarias
 * @property string $nome_fantasia
 * @property string $razao_social
 * @property string $cnpj
 * @property string $endereco
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep
 * @property string $site
 * @property string $email
 * @property string $dias_pagamento
 * @property string $historico
 * @property string $situacao
 * @property string $telefone
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ipi_estoque_entradas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_titulos_subcategorias
 *
 * @package App\Models
 */
class IpiFornecedore extends Eloquent
{
	protected $primaryKey = 'cod_fornecedores';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int'
	];

	protected $fillable = [
		'cod_pizzarias',
		'nome_fantasia',
		'razao_social',
		'cnpj',
		'endereco',
		'numero',
		'complemento',
		'bairro',
		'cidade',
		'estado',
		'cep',
		'site',
		'email',
		'dias_pagamento',
		'historico',
		'situacao',
		'telefone'
	];

	public function ipi_estoque_entradas()
	{
		return $this->hasMany(\App\Models\IpiEstoqueEntrada::class, 'cod_fornecedores');
	}

	public function ipi_titulos_subcategorias()
	{
		return $this->belongsToMany(\App\Models\IpiTitulosSubcategoria::class, 'ipi_titulos_subcategorias_ipi_fornecedores', 'cod_fornecedores', 'cod_titulos_subcategorias');
	}
}
